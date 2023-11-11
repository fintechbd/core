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
    'http_logger_enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'blameable_model' => \Fintech\Auth\Models\User::class,
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
    'pagination_type' => 'simplePaginate',

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
    | System Setting Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'setting_model' => \Fintech\Core\Models\Setting::class,


    /*
    |--------------------------------------------------------------------------
    | Job Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'job_model' => \Fintech\Core\Models\Job::class,


    /*
    |--------------------------------------------------------------------------
    | ApiLog Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'api_log_model' => \Fintech\Core\Models\ApiLog::class,


    /*
    |--------------------------------------------------------------------------
    | FailedJob Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'failed_job_model' => \Fintech\Core\Models\FailedJob::class,

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
