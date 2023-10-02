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

        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getId()
    {
        return $this->id;
    }
}
