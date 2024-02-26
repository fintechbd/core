<?php

// config for Fintech/Core
use Fintech\Auth\Models\User;
use Fintech\Core\Models\ApiLog;
use Fintech\Core\Models\FailedJob;
use Fintech\Core\Models\Job;
use Fintech\Core\Models\Setting;
use Fintech\Core\Repositories\Eloquent\ApiLogRepository;
use Fintech\Core\Repositories\Eloquent\FailedJobRepository;
use Fintech\Core\Repositories\Eloquent\JobRepository;
use Fintech\Core\Repositories\Eloquent\SettingRepository;

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
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'blameable_model' => User::class,
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
    'setting_model' => Setting::class,

    /*
    |--------------------------------------------------------------------------
    | Job Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'job_model' => Job::class,


    /*
    |--------------------------------------------------------------------------
    | ApiLog Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'api_log_model' => ApiLog::class,


    /*
    |--------------------------------------------------------------------------
    | FailedJob Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'failed_job_model' => FailedJob::class,

    //** Model Config Point Do not Remove **//

    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'repositories' => [
        \Fintech\Core\Interfaces\SettingRepository::class => SettingRepository::class,

        \Fintech\Core\Interfaces\JobRepository::class => JobRepository::class,

        \Fintech\Core\Interfaces\ApiLogRepository::class => ApiLogRepository::class,

        \Fintech\Core\Interfaces\FailedJobRepository::class => FailedJobRepository::class,

        //** Repository Binding Config Point Do not Remove **//
    ],
];
