<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Force English for all Carbon date formatting regardless of server locale
        Carbon::setLocale('en');

        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
