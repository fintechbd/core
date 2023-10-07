<?php

namespace Fintech\Core\Observers;

class BlameableObserver
{
    /**
     * Listening to any creating events.
     *
     *
     * @return void
     */
    public function creating($model): void
    {
        $this->setAttribute($model, 'creator_id');
    }

    /**
     * Listening to any saving events.
     *
     *
     * @return void
     */
    public function updating($model): void
    {
        $this->setAttribute($model, 'editor_id');
    }

    /**
     * Listening to any deleted events.
     *
     *
     * @return void
     */
    public function deleted($model): void
    {
        $this->setAttribute($model, 'destroyer_id');

        if (method_exists($model, 'useSoftDeletes')
            && method_exists($model, 'silentUpdate')
            && $model->useSoftDeletes() && $model->isDirty()) {
            $model->silentUpdate();
        }
    }

    /**
     * Listening to any restoring events.
     *
     *
     * @return void
     */
    public function restoring($model): void
    {
        $this->setAttribute($model, 'restorer_id');
    }

    /**
     * Set Model's attribute value for the given key.
     *
     * @param $model
     * @param string $attribute
     * @return bool
     */
    private function setAttribute($model, string $attribute): bool
    {
        $model->setAttribute($attribute, ((auth()->check()) ? auth()->id() : null));

        return $model->isDirty($attribute);
    }
}
