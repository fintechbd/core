<?php

// config for Fintech/Core
return [
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
    | System Setting Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'setting_model' => \Fintech\Core\Models\Setting::class,

    //** Model Config Point Do not Remove **//

    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'repositories' => [
        \Fintech\Auth\Interfaces\PermissionRepository::class => \Fintech\Auth\Repositories\Eloquent\PermissionRepository::class,

        //** Repository Binding Config Point Do not Remove **//
    ],
];
