<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;

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
        $loginRateLimitResponse = function(){
            throw ValidationException::withMessages(
                [
                    'email' => 'Too many login attempts. Please try again later'
                ]
            );
        };

        RateLimiter::for('login',  function(Request $request) use ($loginRateLimitResponse) {
            return [
                Limit::perMinute(50)->by($request->ip())->response($loginRateLimitResponse),

                Limit::perMinute(5)->by($request->input('email'))->response($loginRateLimitResponse),
            ];
        });

    }
}
