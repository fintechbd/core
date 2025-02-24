<?php

namespace Fintech\Core\Models;

use Fintech\Auth\Models\User;
use Fintech\Core\Abstracts\BaseModel;
use Fintech\Core\Enums\RequestDirection;
use Fintech\Core\Enums\RequestMethod;
use Fintech\Core\Enums\ResponseStatusCode;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiLog extends BaseModel
{
    protected $connection = 'support';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $casts = [
        'request' => 'array',
        'response' => 'array',
        'user_agent' => 'array',
        'direction' => RequestDirection::class,
        'method' => RequestMethod::class,
        'status_code' => ResponseStatusCode::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('fintech.auth.user_model', User::class));
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /**
     * @return array
     */
    public function getLinksAttribute()
    {
        $primaryKey = $this->getKey();

        return [
            'show' => action_link(route('core.api-logs.show', $primaryKey), __('core::messages.action.show'), 'get'),
            'destroy' => action_link(route('core.api-logs.destroy', $primaryKey), __('core::messages.action.destroy'), 'delete'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
