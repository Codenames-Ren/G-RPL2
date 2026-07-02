<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\URL;

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

        if (app()->isProduction()) {
            URL::forceScheme('https');
        }

        /*
        | Login Rate Limiter
        */

        RateLimiter::for('login', function (Request $request) {

            return [
                Limit::perMinute(5)
                    ->by($request->ip()),
            ];
        });

        /*
        | Register Rate Limiter
        */

        RateLimiter::for('register', function (Request $request) {

            return [
                Limit::perMinute(3)
                    ->by($request->ip()),
            ];
        });

        /*
        | Global API Rate Limiter
        */

        RateLimiter::for('api', function (Request $request) {

            return [
                Limit::perMinute(60)
                    ->by(
                        $request->user()?->id
                        ?: $request->ip()
                    ),
            ];
        });
    }
}