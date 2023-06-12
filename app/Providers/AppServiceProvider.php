<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        // Panggil command cuti:reset saat pergantian tahun
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;

        $newYearDate = $nextYear . '-01-01 00:00:00';

        if (date('Y-m-d H:i:s') >= $newYearDate) {
            Artisan::call('cuti:reset');
        }
    }
}
