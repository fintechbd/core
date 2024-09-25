<?php

// config for Fintech/Core
use Fintech\Core\Models\Schedule;
use Fintech\Core\Repositories\Eloquent\ApiLogRepository;
use Fintech\Core\Repositories\Eloquent\FailedJobRepository;
use Fintech\Core\Repositories\Eloquent\JobRepository;
use Fintech\Core\Repositories\Eloquent\ScheduleRepository;
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
    'api_logger_enabled' => env('PACKAGE_CORE_API_LOG', false),

    /*
    |--------------------------------------------------------------------------
    | Http Inbound Request Logger
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'http_logger_enabled' => env('PACKAGE_CORE_REQUEST_LOG', false),

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
    'log_console_query' => env('PACKAGE_CORE_LOG_CONSOLE_QUERY', false),

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'blameable_enabled' => env('PACKAGE_CORE_BLAMEABLE_ENABLED', false),
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
    'successful_number_prefix' => 'S',

    /*
    |--------------------------------------------------------------------------
    | Network Communication
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'encrypt_response' => (bool)env('PACKAGE_CORE_ENCRYPT_COMMUNICATION', false),
    'encryption_key' => env('PACKAGE_CORE_ENCRYPT_KEY', ''),
    'append_status_code' => (bool)env('PACKAGE_CORE_APPEND_HTTP_CODE', false),

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


    /*
    |--------------------------------------------------------------------------
    | Schedule Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'schedule_model' => Schedule::class,

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

        \Fintech\Core\Interfaces\ScheduleRepository::class => ScheduleRepository::class,

        //** Repository Binding Config Point Do not Remove **//
    ],
];
