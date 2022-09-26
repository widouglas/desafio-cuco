<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Respect\Validation\Rules as RespectRules;

class ValidatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('cpf', function($attribute, $value, $parameters, $validator) {
            return (new RespectRules\Cpf())->validate($value);
        });

        Validator::extend('phone', function ($attributes, $value) {
            return preg_match('/^\(\d{2}\)\d{4,5}-\d{4}$/', $value) > 0;
        });
    }
}
