<?php

namespace Fintech\Core\Models;

use Fintech\Core\Abstracts\BaseModel;

class Job extends BaseModel
{

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $connection = 'support';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];


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
            'show' => action_link(route('core.jobs.show', $primaryKey), __('core::messages.action.show'), 'get'),
            'update' => action_link(route('core.jobs.update', $primaryKey), __('core::messages.action.update'), 'put'),
            'destroy' => action_link(route('core.jobs.destroy', $primaryKey), __('core::messages.action.destroy'), 'delete'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
