<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Anhskohbo\NoCaptcha\NoCaptchaServiceProvider;

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
        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
            return app('captcha')->verifyResponse($value);
        });

        Validator::replacer('recaptcha', function ($message, $attribute, $rule, $parameters) {
            return 'Invalid reCAPTCHA response.';
        });
    }
}
