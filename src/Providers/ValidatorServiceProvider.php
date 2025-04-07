<?php

namespace Fintech\Core\Providers;

use Fintech\Core\Rules\ArrayOfRule;
use Fintech\Core\Rules\Base64File;
use Fintech\Core\Rules\CurrentPin;
use Fintech\Core\Rules\Locale;
use Fintech\Core\Rules\MasterCurrency;
use Fintech\Core\Rules\MobileNumber;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('base64', function ($attribute, $value, $parameters, $validator) {
            (new Base64File(...$parameters))->validate(
                $attribute,
                $value,
                function ($message) use ($validator, $attribute) {
                    $validator->errors()->add($attribute, __($message, ['attribute' => $attribute]));
                }
            );
            return !$validator->errors()->has($attribute);
        });

        Validator::extend('current_pin', function ($attribute, $value, $parameters, $validator) {
            (new CurrentPin())->validate(
                $attribute,
                $value,
                function ($message) use ($validator, $attribute) {
                    $validator->errors()->add($attribute, __($message, ['attribute' => $attribute]));
                }
            );
            return !$validator->errors()->has($attribute);
        });

        Validator::extend('locale', function ($attribute, $value, $parameters, $validator) {
            (new Locale())->validate(
                $attribute,
                $value,
                function ($message) use ($validator, $attribute) {
                    $validator->errors()->add($attribute, __($message, ['attribute' => $attribute]));
                }
            );
            return !$validator->errors()->has($attribute);
        });

        Validator::extend('mobile', function ($attribute, $value, $parameters, $validator) {
            (new MobileNumber())->validate(
                $attribute,
                $value,
                function ($message) use ($validator, $attribute) {
                    $validator->errors()->add($attribute, __($message, ['attribute' => $attribute]));
                }
            );
            return !$validator->errors()->has($attribute);
        });

        Validator::extend('master_currency', function ($attribute, $value, $parameters, $validator) {
            (new MasterCurrency())->validate(
                $attribute,
                $value,
                function ($message) use ($validator, $attribute) {
                    $validator->errors()->add($attribute, __($message, ['attribute' => $attribute]));
                }
            );
            return !$validator->errors()->has($attribute);
        });

        Validator::extend('array_of', function ($attribute, $value, $parameters, $validator) {
            (new ArrayOfRule(...$parameters))->validate(
                $attribute,
                $value,
                function ($message) use ($validator, $attribute) {
                    $validator->errors()->add($attribute, __($message, ['attribute' => $attribute]));
                }
            );
            return !$validator->errors()->has($attribute);
        });

    }
}
