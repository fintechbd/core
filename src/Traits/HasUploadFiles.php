<?php

namespace Fintech\Core\Traits;

use Spatie\MediaLibrary\MediaCollections\FileAdder;

trait HasUploadFiles
{
    protected array $files = [];

    public function uploadModelFiles()
    {
        foreach ($this->files as $group => $file) {

            if (!method_exists($this->model, 'addMediaFromBase64')) {
                throw new \BadMethodCallException(get_class($this->model) . " is missing `use InteractsWithMedia` trait call");
            }

            if (is_array($file)) {
                /**
                 * @var FileAdder $fileAdder
                 */
                $fileAdder = $this->model->addMediaFromBase64($file);
                $fileAdder->
                    ->setFileName()
                    ->toMediaCollection($group);
            } else {
                $fileAdder = $this->model->addMediaFromBase64($file)
                    ->setFileName()
                    ->toMediaCollection($group);
            }
        }
    }
}
