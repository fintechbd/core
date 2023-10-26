<?php

namespace Fintech\Core\Traits;

use Spatie\MediaLibrary\MediaCollections\FileAdder;

trait HasUploadFiles
{
    protected array $files = [];

    protected array $mediaCollections = [];

    protected function uploadMediaFiles()
    {
        if (!eempty($this->mediaCollections)) {
            foreach ($this->files as $group => $file) {
                if (!method_exists($this->model, 'addMediaFromBase64')) {
                    throw new \BadMethodCallException(get_class($this->model) . " model is missing `use InteractsWithMedia` trait call");
                }

                if (is_array($file)) {
                    /**
                     * @var FileAdder $fileAdder
                     */
                    $fileAdder = $this->model->addMediaFromBase64($file);
                    $fileAdder->setFileName()
                        ->toMediaCollection($group);
                } else {
                    $fileAdder = $this->model->addMediaFromBase64($file)
                        ->setFileName()
                        ->toMediaCollection($group);
                }
            }
        }
    }
    protected function stripMediaCollections()
    {
        if (method_exists($this->model, 'getRegisteredMediaCollections')) {
            $this->mediaCollections = $this->model->getRegisteredMediaCollections()->pluck('name')->toArray();
        }
    }
    protected function verifyBase64Content($content)
    {

    }
}
