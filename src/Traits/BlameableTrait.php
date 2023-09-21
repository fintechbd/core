<?php

namespace Fintech\Core\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Trait BlameableTrait
 * @package Fintech\Core\Traits
 *
 * @property-read null|MorphTo $creator
 * @property-read null|MorphTo $editor
 * @property-read null|MorphTo $destroyer
 * @property-read null|MorphTo $restorer
 */
trait BlameableTrait
{
    /**
     * return the model class that created this model
     *
     * @return MorphTo
     */
    public function creator(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * return the model class that updated this model
     * @return MorphTo
     */
    public function editor(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * return the model class that deleted this model
     * @return MorphTo
     */
    public function destroyer(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * return the model class that restored this model
     * @return MorphTo
     */
    public function restorer(): MorphTo
    {
        return $this->morphTo();
    }
}
