<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\Http;

class CountVisits
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // 1️⃣ تجاهل أي request مالوش route
        if (!$request->route()) {
            return $response;
        }

        // 2️⃣ تجاهل الملفات الثابتة
        if ($this->isStaticFile($request)) {
            return $response;
        }

        $ip    = $request->ip();
        $agent = $request->userAgent();

        // 3️⃣ تجاهل localhost
        if (in_array($ip, ['127.0.0.1', '::1'])) {
            return $response;
        }

        // 4️⃣ تجاهل البوتس
        if ($this->isBot($agent)) {
            return $response;
        }

        // 5️⃣ تجاهل IPs الداتا سنتر
        if ($this->isDataCenterIp($ip)) {
            return $response;
        }

        // 6️⃣ زيارة واحدة فقط لكل IP في اليوم
        $alreadyVisited = Visit::where('ip_address', $ip)
            ->whereDate('created_at', today())
            ->exists();

        if ($alreadyVisited) {
            return $response;
        }

        // ======================
        // 🌍 Geo Location
        // ======================
        $country = null;
        $city    = null;

        try {
            $res = Http::timeout(2)
                ->acceptJson()
                ->get("http://ip-api.com/json/{$ip}");

            if ($res->successful()) {
                $data = $res->json();
                $country = $data['country'] ?? null;
                $city    = $data['city'] ?? null;
            }
        } catch (\Exception $e) {
            // تجاهل الخطأ
        }

        // ======================
        // ✅ تسجيل زيارة حقيقية
        // ======================
        Visit::create([
            'ip_address'  => $ip,
            'user_agent'  => $agent,
            'url'         => $request->fullUrl(),
            'session_id'      => $agent,
            'referrer'    => $request->headers->get('referer'),
            'device_type' => $this->deviceType($agent),
            'browser'     => $this->browser($agent),
            'platform'    => $this->platform($agent),
            'country'     => $country,
            'city'        => $city,
            'created_at'  => now(),
        ]);

        return $response;
    }

    // ======================
    // Helpers
    // ======================

    private function isStaticFile(Request $request): bool
    {
        $ext = pathinfo($request->path(), PATHINFO_EXTENSION);

        return in_array($ext, [
            'css','js','png','jpg','jpeg','gif','svg','ico',
            'woff','woff2','ttf','eot','map'
        ]);
    }

    private function isBot(?string $agent): bool
    {
        if (!$agent) return true;

        $bots = [
            'bot','crawl','spider','slurp',
            'google','bing','yandex','baidu',
            'facebook','telegram','whatsapp',
            'discord','axios','curl','wget'
        ];

        $agent = strtolower($agent);

        foreach ($bots as $bot) {
            if (str_contains($agent, $bot)) {
                return true;
            }
        }

        return false;
    }

    private function isDataCenterIp(string $ip): bool
    {
        return str_starts_with($ip, '3.')
            || str_starts_with($ip, '18.')
            || str_starts_with($ip, '35.')
            || str_starts_with($ip, '52.')
            || str_starts_with($ip, '2600:')
            || str_starts_with($ip, '2a03:');
    }

    private function deviceType(string $agent): string
    {
        return preg_match('/mobile|android|iphone|ipad/i', $agent)
            ? 'mobile'
            : 'desktop';
    }

    private function browser(string $agent): string
    {
        return match (true) {
            str_contains($agent, 'Chrome')  => 'Chrome',
            str_contains($agent, 'Firefox') => 'Firefox',
            str_contains($agent, 'Safari') && !str_contains($agent, 'Chrome') => 'Safari',
            str_contains($agent, 'Edge')    => 'Edge',
            default => 'Other',
        };
    }

    private function platform(string $agent): string
    {
        return match (true) {
            str_contains($agent, 'Windows') => 'Windows',
            str_contains($agent, 'Android') => 'Android',
            str_contains($agent, 'iPhone'),
            str_contains($agent, 'iPad')    => 'iOS',
            str_contains($agent, 'Mac')     => 'MacOS',
            default => 'Other',
        };
    }
}
