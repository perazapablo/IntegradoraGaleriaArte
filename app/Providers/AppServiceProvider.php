<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;  // ← agrega esto


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
    // Solo fuerza HTTPS si viene de ngrok
    if (str_contains(request()->getHost(), 'ngrok')) {
        \URL::forceScheme('https');
    }
}
}
