<?php

namespace Fintech\Core\Models;

use Fintech\Core\Abstracts\BaseModel;
use Fintech\Core\Traits\AuditableTrait;
use Fintech\Core\Traits\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends BaseModel
{
    use BlameableTrait;
    use SoftDeletes;

    protected $connection = 'support';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $attributes = [
        'enabled' => false,
        'parameters' => '[]',
        'interval' => '0 0 0 0 0',
        'timezone' => 'UTC',
        'schedule_data' => '{"last_triggered_at":null,"last_succeed_at":null,"last_failed_at":null,"next_scheduled_at":null}'
    ];

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $casts = ['parameters' => 'array', 'restored_at' => 'datetime', 'enabled' => 'bool', 'schedule_data' => 'array'];

    protected $hidden = ['creator_id', 'editor_id', 'destroyer_id', 'restorer_id'];

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

        $links = [
            'show' => action_link(route('core.schedules.show', $primaryKey), __('core::messages.action.show'), 'get'),
            'update' => action_link(route('core.schedules.update', $primaryKey), __('core::messages.action.update'), 'put'),
            'destroy' => action_link(route('core.schedules.destroy', $primaryKey), __('core::messages.action.destroy'), 'delete'),
            'restore' => action_link(route('core.schedules.restore', $primaryKey), __('core::messages.action.restore'), 'post'),
        ];

        if ($this->getAttribute('deleted_at') == null) {
            unset($links['restore']);
        } else {
            unset($links['destroy']);
        }

        return $links;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
