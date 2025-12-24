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
        // نفّذ الطلب الأول
        $response = $next($request);

        // 1️⃣ تجاهل أي Request مالوش Route (CSS / JS / images)
        if (!$request->route()) {
            return $response;
        }

        // 2️⃣ تجاهل الملفات الثابتة
        if ($this->isStaticFile($request)) {
            return $response;
        }

        // 3️⃣ تجاهل localhost
        $ip = $request->ip();
        if (in_array($ip, ['127.0.0.1', '::1'])) {
            return $response;
        }

        // 4️⃣ تجاهل لو الزيارة اتسجلت في نفس الجلسة ونفس اليوم
        $alreadyVisited = Visit::where('session_id', session()->getId())
            ->whereDate('created_at', today())
            ->exists();

        if ($alreadyVisited) {
            return $response;
        }

        // ======================
        // 🌍 Geo Location (مرة واحدة فقط)
        // ======================
        $country = null;
        $city    = null;

        if (!session()->has('geo')) {
            try {
                $apiResponse = Http::timeout(2)
                    ->acceptJson()
                    ->get("http://ip-api.com/json/{$ip}");

                if ($apiResponse->successful()) {
                    $data = $apiResponse->json();

                    $country = $data['country'] ?? null;
                    $city    = $data['city'] ?? null;

                    session([
                        'geo' => [
                            'country' => $country,
                            'city'    => $city,
                        ]
                    ]);
                }
            } catch (\Exception $e) {
                // تجاهل أي خطأ من الـ API
            }
        } else {
            $geo     = session('geo');
            $country = $geo['country'] ?? null;
            $city    = $geo['city'] ?? null;
        }

        // ======================
        // ✅ تسجيل زيارة حقيقية
        // ======================
        Visit::create([
            'ip_address'  => $ip,
            'user_agent'  => $request->userAgent(),
            'url'         => $request->fullUrl(),
            'referrer'    => $request->headers->get('referer'),
            'session_id'  => session()->getId(),
            'device_type' => $this->deviceType($request->userAgent()),
            'browser'     => $this->browser($request->userAgent()),
            'platform'    => $this->platform($request->userAgent()),
            'country'     => $country,
            'city'        => $city,
            'created_at'  => now(),
        ]);

        return $response;
    }

    // ===== helpers =====

    private function isStaticFile(Request $request): bool
    {
        $extensions = [
            'css','js','png','jpg','jpeg','gif','svg','ico',
            'woff','woff2','ttf','eot','map'
        ];

        $ext = pathinfo($request->path(), PATHINFO_EXTENSION);

        return in_array($ext, $extensions);
    }

    private function deviceType($agent)
    {
        return preg_match('/mobile|android|iphone|ipad/i', $agent)
            ? 'mobile'
            : 'desktop';
    }

    private function browser($agent)
    {
        return match (true) {
            str_contains($agent, 'Chrome')  => 'Chrome',
            str_contains($agent, 'Firefox') => 'Firefox',
            str_contains($agent, 'Safari') && !str_contains($agent, 'Chrome') => 'Safari',
            str_contains($agent, 'Edge')    => 'Edge',
            default => 'Other',
        };
    }

    private function platform($agent)
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
