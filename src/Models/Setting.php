<?php

namespace Fintech\Core\Models;

use Fintech\Core\Abstracts\BaseModel;
use Fintech\Core\Supports\Utility;
use Fintech\Core\Traits\Audits\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Setting extends BaseModel implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use BlameableTrait;
    use SoftDeletes;


    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'id';

    protected $fillable = [];

    protected $guarded = ['id'];


    protected $casts = [];

    protected $hidden = ['creator_id', 'editor_id', 'destroyer_id', 'restorer_id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function (self $setting) {
            $setting->value = Utility::stringify($setting->type, $setting->value);
            $setting->getDirty();
        });
    }
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
            'show' => action_link(route('core.settings.show', $primaryKey), __('core::messages.action.show'), 'get'),
            'update' => action_link(route('core.settings.update', $primaryKey), __('core::messages.action.update'), 'put'),
            'destroy' => action_link(route('core.settings.destroy', $primaryKey), __('core::messages.action.destroy'), 'delete'),
            'restore' => action_link(route('core.settings.restore', $primaryKey), __('core::messages.action.restore'), 'post'),
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
