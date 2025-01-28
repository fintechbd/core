<?php

// config for Fintech/Core

return [

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'enabled' => env('CORE_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | APIs Outbound Request Logger
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'default_currency_code' => env('CORE_DEFAULT_CURRENCY_CODE', 'USD'),

    /*
    |--------------------------------------------------------------------------
    | APIs Outbound Request Logger
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'api_logger_enabled' => env('CORE_OUTBOUND_API_LOG', false),
    'api_logger_whitelist' => [],

    /*
    |--------------------------------------------------------------------------
    | Http Inbound Request Logger
    |--------------------------------------------------------------------------
    | this setting enable the log of inbound http request logging
    */
    'http_logger_enabled' => env('CORE_INBOUND_REQUEST_LOG', false),
    'secret_fields' => ['pin', 'password'],
    'http_logger_whitelist' => [
        '/api-logs',
        '/dropdown/(.*)'
    ],

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
    'query_logger_enabled' => env('CORE_QUERY_LOGGER_ENABLED', false),
    'log_console_query' => env('CORE_LOG_CONSOLE_QUERY', false),
    'whitelist_query' => [
        "insert into `api_logs`",
        "select * from `api_logs`",
        "select column_name as `name`",
        "select * from `personal_access_tokens`"
    ],

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'blameable_enabled' => env('CORE_BLAMEABLE_ENABLED', false),
    'blameable_model' => Fintech\Auth\Models\User::class,
    'blameable_guard' => 'sanctum',
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
    'encrypt_response' => (bool)env('CORE_ENCRYPT_COMMUNICATION', false),
    'encryption_key' => env('CORE_ENCRYPT_KEY', ''),
    'append_status_code' => (bool)env('CORE_APPEND_HTTP_CODE', false),

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
    'schedule_model' => Fintech\Core\Models\Schedule::class,


    /*
    |--------------------------------------------------------------------------
    | Translation Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'translation_model' => \Fintech\Core\Models\Translation::class,


    /*
    |--------------------------------------------------------------------------
    | JobBatch Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'job_batch_model' => \Fintech\Core\Models\JobBatch::class,


    /*
    |--------------------------------------------------------------------------
    | ClientError Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'client_error_model' => \Fintech\Core\Models\ClientError::class,


    /*
    |--------------------------------------------------------------------------
    | Mail Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'mail_model' => \Fintech\Core\Models\Mail::class,

    //** Model Config Point Do not Remove **//

    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'repositories' => [
        Fintech\Core\Interfaces\SettingRepository::class
        => Fintech\Core\Repositories\Eloquent\SettingRepository::class,

        Fintech\Core\Interfaces\JobRepository::class
        => Fintech\Core\Repositories\Eloquent\JobRepository::class,

        Fintech\Core\Interfaces\ApiLogRepository::class
        => Fintech\Core\Repositories\Eloquent\ApiLogRepository::class,

        Fintech\Core\Interfaces\FailedJobRepository::class
        => Fintech\Core\Repositories\Eloquent\FailedJobRepository::class,

        Fintech\Core\Interfaces\ScheduleRepository::class
        => Fintech\Core\Repositories\Eloquent\ScheduleRepository::class,

        Fintech\Core\Interfaces\TranslationRepository::class
        => Fintech\Core\Repositories\Eloquent\TranslationRepository::class,

        Fintech\Core\Interfaces\JobBatchRepository::class
        => Fintech\Core\Repositories\Eloquent\JobBatchRepository::class,

        Fintech\Core\Interfaces\ClientErrorRepository::class
        => Fintech\Core\Repositories\Eloquent\ClientErrorRepository::class,

        \Fintech\Core\Interfaces\MailRepository::class => \Fintech\Core\Repositories\Eloquent\MailRepository::class,

        //** Repository Binding Config Point Do not Remove **//
    ],
];
