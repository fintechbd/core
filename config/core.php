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

        //** Repository Binding Config Point Do not Remove **//
    ],
];
