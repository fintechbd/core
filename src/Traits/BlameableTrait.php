<?php

namespace Fintech\Core\Traits;

use Fintech\Auth\Models\User;
use Fintech\Core\Observers\BlameableObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Trait BlameableTrait
 *
 * @property-read null|BelongsTo $creator
 * @property-read null|BelongsTo $editor
 * @property-read null|BelongsTo $destroyer
 * @property-read null|BelongsTo $restorer
 */
trait BlameableTrait
{
    /**
     * Boot the Blameable service by attaching
     * a new observer into the current model object.
     *
     * @return void
     */
    public static function bootBlameableTrait(): void
    {
        if (!app()->runningInConsole()) {
            static::observe(app(BlameableObserver::class));
        }
    }

    /**
     * return the model class that created this model
     */
    public function creator(): MorphTo
    {
        return $this->belongsTo(config('fintech.core.blameable_model', User::class), 'creator_id', 'id');
    }

    /**
     * return the model class that updated this model
     */
    public function editor(): MorphTo
    {
        return $this->belongsTo(config('fintech.core.blameable_model', User::class), 'editor_id', 'id');
    }

    /**
     * return the model class that deleted this model
     */
    public function destroyer(): MorphTo
    {
        return $this->belongsTo(config('fintech.core.blameable_model', User::class), 'destroyer_id', 'id');
    }

    /**
     * return the model class that restored this model
     */
    public function restorer(): MorphTo
    {
        return $this->belongsTo(config('fintech.core.blameable_model', User::class), 'restorer_id', 'id');
    }

    /**
     * Silently update the model without firing any
     * events.
     *
     * @return int
     */
    public function silentUpdate(): int
    {
        return $this->newQueryWithoutScopes()
            ->where($this->getKeyName(), $this->getKey())
            ->getQuery()
            ->update($this->getDirty());
    }

    /**
     * Confirm if the current model uses SoftDeletes.
     *
     * @return bool
     */
    public function useSoftDeletes(): bool
    {
        return in_array(SoftDeletes::class, class_uses_recursive($this), true);
    }

}
