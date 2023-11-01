<?php

namespace Fintech\Core\Traits;

use Fintech\Core\Supports\Mimes;

trait HasUploadFiles
{
    public array $files = [];

    /**
     * @throws \Exception
     */
    public function uploadMediaFiles()
    {
        foreach ($this->files as $group => $files) {
            if (is_array($files)) {
                foreach ($files as $file) {
                    if (is_array($file)) {
                        $resolver = "{$group}MediaResolve";
                        [$resolvedFile, $attributes] = $this->$resolver($file);
                        $this->uploadTargetFile($resolvedFile, $group, $attributes);
                    } else {
                        $this->uploadTargetFile($file, $group);
                    }
                }
                continue;
            }

            $this->uploadTargetFile($files, $group);
        }
    }

    private function uploadTargetFile($file, string $group, array $attributes = [])
    {
        logger("File Group:" . $group);

        $ext = Mimes::guessExtFromB64($file);

        $this->model->addMediaFromBase64($file)
            ->usingFileName($this->mediaNameFormatter($ext, $group))
            ->usingName($this->mediaNameFormatter($ext, $group))
            ->withCustomProperties($attributes)
            ->toMediaCollection($group);
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
