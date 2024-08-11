<?php

namespace Fintech\Core\Models;

use Fintech\Auth\Models\User;
use Fintech\Core\Abstracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiLog extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'id';

    protected $guarded = ['id'];



    protected $casts = ['request' => 'array', 'response' => 'array', 'user_agent' => 'array'];

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
            'show' => action_link(route('core.api-logs.show', $primaryKey), __('restapi::messages.action.show'), 'get'),
            'destroy' => action_link(route('core.api-logs.destroy', $primaryKey), __('restapi::messages.action.destroy'), 'delete'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
