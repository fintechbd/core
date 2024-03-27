<?php

// config for Fintech/Core
return [

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'enabled' => env('PACKAGE_CORE_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | APIs Outbound Request Logger
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'api_logger_enabled' => false,

    /*
    |--------------------------------------------------------------------------
    | Http Inbound Request Logger
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'http_logger_enabled' => false,

    /*
    |--------------------------------------------------------------------------
    | Server Pulse Checker
    |--------------------------------------------------------------------------
    | this setting allows frontend to check server status and server
    | verifies frontend integrity.
    */
    'pulse_checker_enabled' => false,
    'pulse_checker_interval' => 60 * SECOND,

    /*
    |--------------------------------------------------------------------------
    | Database Query Logger
    |--------------------------------------------------------------------------
    | this setting enable the db query logger
    */
    'query_logger_enabled' => env('PACKAGE_CORE_QUERY_LOGGER_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'blameable_model' => Fintech\Auth\Models\User::class,
    'blameable_guard' => 'web',
    /*
    |--------------------------------------------------------------------------
    | Pagination Function Type
    |--------------------------------------------------------------------------
    |
    | options:
    | 1. paginate -> for length aware pagination
    | 2. simplePaginate -> for basic prev and next pagination
    | 3. options: cursorPaginate -> for advance memory cursor pagination
    |
    */
    'pagination_type' => 'paginate',

    /*
    |--------------------------------------------------------------------------
    | System Packages or Modules Available
    |--------------------------------------------------------------------------
    |
    | options:
    | 1. paginate -> for length aware pagination
    | 2. simplePaginate -> for basic prev and next pagination
    | 3. options: cursorPaginate -> for advance memory cursor pagination
    |
    */
    'packages' => [
        'core' => 'Core',
    ],

    /*
    |--------------------------------------------------------------------------
    | System Packages Entry Number Generate Rules
    |--------------------------------------------------------------------------
    |
    | options:
    | 1. paginate -> for length aware pagination
    | 2. simplePaginate -> for basic prev and next pagination
    | 3. options: cursorPaginate -> for advance memory cursor pagination
    |
    */

    'entry_number_length' => 20,
    'entry_number_fill' => '0',
    'purchase_number_prefix' => 'PM',
    'reject_number_prefix' => 'R',
    'cancel_number_prefix' => 'C',
    'accept_number_prefix' => 'A',

    /*
    |--------------------------------------------------------------------------
    | Encrypted Network Communication
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'encrypt_response' => false,
    'encryption_key' => env('PACKAGE_CORE_ENCRYPT_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | System Setting Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'setting_model' => Fintech\Core\Models\Setting::class,

    /*
    |--------------------------------------------------------------------------
    | Job Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'job_model' => Fintech\Core\Models\Job::class,


    /*
    |--------------------------------------------------------------------------
    | ApiLog Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'api_log_model' => Fintech\Core\Models\ApiLog::class,


    /*
    |--------------------------------------------------------------------------
    | FailedJob Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'failed_job_model' => Fintech\Core\Models\FailedJob::class,

    //** Model Config Point Do not Remove **//

    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'repositories' => [
        \Fintech\Core\Interfaces\SettingRepository::class => \Fintech\Core\Repositories\Eloquent\SettingRepository::class,

        \Fintech\Core\Interfaces\JobRepository::class => \Fintech\Core\Repositories\Eloquent\JobRepository::class,

        \Fintech\Core\Interfaces\ApiLogRepository::class => \Fintech\Core\Repositories\Eloquent\ApiLogRepository::class,

        \Fintech\Core\Interfaces\FailedJobRepository::class => \Fintech\Core\Repositories\Eloquent\FailedJobRepository::class,

        //** Repository Binding Config Point Do not Remove **//
    ],
];
