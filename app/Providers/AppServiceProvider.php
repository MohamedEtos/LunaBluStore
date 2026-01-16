<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Prodimg;
use App\Models\Orders;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {
            $GlobalProductImg = Prodimg::inRandomOrder()->limit(5)->get();

            $view->with('GlobalProductImg', $GlobalProductImg);
        });

    View::composer('admin.layout.aside', function ($view) {
        $ordersCount = Orders::where('payment_status', 'notaccepted')->count(); // كل الأوردرات
        $reviewsCount = \App\Models\Review::where('is_approved', 0)->count();
        $view->with(['ordersCount' => $ordersCount, 'reviewsCount' => $reviewsCount]);
    });

    View::composer('admin.layout.navbar', function ($view) {
        $notifications = Orders::where('payment_status', 'notaccepted')
            ->orderBy('created_at', 'desc')
            ->get(); // Get all to show count properly, or paginate
        
        $view->with([
            'notifications' => $notifications,
            'notificationsCount' => $notifications->count()
        ]);
    });

        Carbon::setLocale('ar');
        Schema::defaultStringLength(191);

        $setting = \App\Models\setting::first();
        View::share('setting', $setting);

    }
}
