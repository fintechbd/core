<?php


namespace Fintech\Core\Traits;


trait ModelExceptionTrait
{
    /**
     * Name of the affected Eloquent model.
     *
     * @var class-string<TModel>
     */
    protected $model;

    /**
     * The affected model IDs.
     *
     * @var int|string $id
     */
    protected $id;

    /**
     * Set the affected Eloquent model and instance ids.
     *
     * @param  class-string<TModel>  $model
     * @param null $id
     * @return $this
     */
    public function setModel($model, $id = null)
    {
        $this->model = class_basename($model);

        $this->id = $id;

        $this->setMessage();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return void
     */
    private function setMessage()
    {
        $this->message = match($this->type){
            'delete' => __('core::messages.exception.delete', ['model' => $this->getModel(), 'id' => $this->getId()]),
            'store' => __('core::messages.exception.store', ['model' => $this->getModel()]),
            'update' => __('core::messages.exception.update', ['model' => $this->getModel(), 'id' => $this->getId()]),
            'restore' => __('core::messages.exception.restore', ['model' => $this->getModel(), 'id' => $this->getId()]),
            default => __('core::messages.exception.default')
        };
    }
}
