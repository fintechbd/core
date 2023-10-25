<?php

namespace Fintech\Core\Traits;

trait HasUploadFiles
{
    protected array $files = [];

    public function uploadModelFiles()
    {
        foreach ($this->files as $group => $file) {

            if (!method_exists($this->model, 'addMedia')) {
                throw new \BadMethodCallException(get_class($this->model) . " is missing `use InteractsWithMedia` trait call");
            }

            if (is_array($file)) {
                $this->model->addMedia($file)->toMediaCollection($group);
            } else {
                $this->model->addMedia($file)->toMediaCollection($group);
            }
        }
    }
}
