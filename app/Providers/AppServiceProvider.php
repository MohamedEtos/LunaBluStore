<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Prodimg;


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

        Carbon::setLocale('ar');
        Schema::defaultStringLength(191);

    }
}
