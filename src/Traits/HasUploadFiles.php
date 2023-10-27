<?php

namespace Fintech\Core\Traits;

use Fintech\Core\Supports\Mimes;

trait HasUploadFiles
{
    protected array $files = [];

    protected array $mediaCollections = [];

    protected function uploadMediaFiles()
    {
        if (!empty($this->mediaCollections)) {
            foreach ($this->files as $group => $file) {
                if (!method_exists($this->model, 'addMediaFromBase64')) {
                    throw new \BadMethodCallException(get_class($this->model) . " model is missing `use InteractsWithMedia` trait call");
                }

                if (is_array($file)) {
//                    /**
//                     * @var FileAdder $fileAdder
//                     */
//                    $fileAdder = $this->model->addMediaFromBase64($file);
//                    $fileAdder->setFileName()
//                        ->toMediaCollection($group);
                } else {
                    $this->addMedia($group, $file);
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

    private function addMedia($file, $group)
    {
        $matches = [];

        preg_match('/^data:(.+);base64,/i', $file, $matches);

        if (isset($matches[1])) {

            $ext = Mimes::guessExtFromType($matches[1]);

            $this->model
                ->addMediaFromBase64($file)
                ->usingFileName($this->mediaNameFormatter($ext, $group))
                ->usingName($this->mediaNameFormatter($ext, $group))
                ->toMediaCollection($group);
        }
    }

    private function mediaNameFormatter(string $ext, $group = 'default')
    {
        return implode('-', [
                strtolower(class_basename($this->model)),
                $this->model->getKey(),
                $group,
                now()->format('Y-m-d-H-m-s')
            ]) . '.' . $ext;

    }
}
