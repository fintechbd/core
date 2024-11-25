<?php

use Fintech\Core\Supports\Currency;

if (!function_exists('permission_format')) {
    function permission_format(string $name, string $origin = 'auth'): string
    {
        $name = strtolower($name);

        $name = str_replace([$origin . '.', '-', '.'], ['', ' ', ' '], $name);

        return ucwords($name);

    }
}

if (!function_exists('action_link')) {

    function action_link($url, $label, $method = 'get'): array
    {
        return [
            'url' => $url,
            'label' => $label,
            'method' => $method,
        ];
    }
}

if (!function_exists('currency')) {

    /**
     * @param string|float|int|null $amount
     * @param string|null $code
     * @return Currency
     */
    function currency(string|float|int|null $amount = 0.0, string $code = null): Currency
    {
        return new Currency($amount, $code);
    }
}

if (!function_exists('entry_number')) {

    /**
     * generate a right format purchase reject order accept number for receipt
     *
     * @param $serial
     * @param string $country_code
     * @param string $type
     * @return string
     */
    function entry_number($serial, string $country_code, string $type = ''): string
    {
        $prefix = $country_code . strtoupper(config("fintech.core.{$type}_number_prefix", ''));

        $length = (int)config('fintech.core.entry_number_length', 20) - strlen($prefix);

        return $prefix . str_pad(
            filter_var($serial, FILTER_SANITIZE_NUMBER_INT),
            $length,
            config('fintech.core.entry_number_fill', '0'),
            STR_PAD_LEFT
        );
    }
}

if (!function_exists('get_table')) {

    /**
     * Return a model class table or collection name for mongodb
     * for given model class path on configuration
     * @param string $model_path
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function get_table(string $model_path): mixed
    {
        $model_namespace = config("fintech.{$model_path}_model");

        if ($model_namespace == null) {
            throw new InvalidArgumentException("Invalid Model path (fintech.{$model_path}_model) given.");
        }

        $model = app()->make($model_namespace);

        $table = $model->getTable();

        unset($model);

        return $table;

    }
}

if (!function_exists('calculate_flat_percent')) {
    /**
     * Return a numerical value for a amount given
     *
     * @param float|int $amount base compound value
     * @param string|int|float $value percent or flat value to reduce
     * @return float|int
     */
    function calculate_flat_percent(int|float $amount, string|int|float $value): float|int
    {
        $targetNumber = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        if (in_array($targetNumber, [0, '0', false, '', null], true)) {
            return 0;
        }

        if (!$targetNumber) {
            throw new InvalidArgumentException("Invalid value ($value) is given");
        }

        return (str_contains($value, '%'))
            ? (float)(($amount * $targetNumber) / 100)
            : (float)$targetNumber;
    }
}

if (!function_exists('determine_base_model')) {
    /**
     * @return string
     * @throws ErrorException
     */
    function determine_base_model(): string
    {
        $connection = config('database.default');

        if ($connection == 'mongodb' && !class_exists(\MongoDB\Laravel\Eloquent\Model::class)) {
            throw new ErrorException('Mongo DB Package missing. Please install `mongodb/laravel-mongodb` package.');
        }

        return match ($connection) {
            'mongodb' => \MongoDB\Laravel\Eloquent\Model::class,
            default => \Illuminate\Database\Eloquent\Model::class
        };
    }
}

if (!function_exists('response_format')) {
    /**
     * @param string|array $data
     * @param null $statusCode
     * @return mixed|string[]
     */
    function response_format(string|array $data, $statusCode = null): mixed
    {
        if (is_string($data)) {
            $data = ['message' => $data];
        }

        if (config('fintech.core.append_status_code') && !isset($data['code'])) {
            $data['code'] = $statusCode;
        }

        return $data;
    }
}

if (!function_exists('singleton')) {

    /**
     * @param string $abstract
     * @param null $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed
     */
    function singleton(string $abstract, $filters = null): mixed
    {
        if (!app()->offsetExists($abstract)) {
            $singleton = app($abstract);
            app()->instance($abstract, $singleton);
        }

        $singleton = app($abstract);

        if (method_exists($singleton, 'list') && is_array($filters)) {
            return $singleton->list($filters);
        }

        return $singleton;
    }
}

if (!function_exists('next_purchase_number')) {
    /**
     * @throws \Exception
     */
    function next_purchase_number(string $countryIso3): string
    {
        $serial = \Fintech\Core\Facades\Core::setting()->getValue('transaction', 'purchase_count', 1);

        \Fintech\Core\Facades\Core::setting()->setValue('transaction', 'purchase_count', $serial + 1, 'integer');

        return entry_number($serial, $countryIso3, \Fintech\Core\Enums\Transaction\OrderStatusConfig::Purchased->value);
    }
}

if (!function_exists('recursive_copy_dir')) {
    /**
     * @param $src
     * @param $dest
     * @return void
     */
    function recursive_copy_dir($src, $dest): void
    {
        if (is_file($src)) {
            copy($src, $dest);
        }
        if (!is_dir($dest)) {
            mkdir($dest, 0755, true);
        }

        foreach (scandir($src) as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            recursive_copy_dir($src . DIRECTORY_SEPARATOR . $file, $dest . DIRECTORY_SEPARATOR . $file);
        }
    }
}
