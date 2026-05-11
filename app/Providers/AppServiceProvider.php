<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
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
        $loginRateLimitResponse = function(Request $request){
            if($request
             ->expectsJson()) {
                return response()
                ->json(
                    ['message' => 'Too many attempts. Please try again later'],
                    429
                );
            }

            return back()
            ->withErrors(
                [
                    'email' => 'Too many login attempts. Please try again later'
                ]
            )
            ->withInput($request->except('password'));
        };

        RateLimiter::for('login',  function(Request $request) use ($loginRateLimitResponse) {
            return [
                Limit::perMinute(50)->by($request->ip())->response($loginRateLimitResponse),

                Limit::perMinute(5)->by($request->input('email'))->response($loginRateLimitResponse),
            ];
        });


        Password::defaults(function() {
            if($this->app->isLocal()) {
                return Password::min(4);
            }

            return Password::min(8)
                ->mixedCase()
                ->uncompromised()
                ->letters()
                ->symbols()
                ->numbers();

        });
    }
}
