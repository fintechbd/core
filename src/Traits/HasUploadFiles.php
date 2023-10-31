<?php

namespace Fintech\Core\Traits;

use Fintech\Core\Supports\Mimes;
use Spatie\MediaLibrary\InteractsWithMedia;

trait HasUploadFiles
{

    use InteractsWithMedia;

    public array $files = [];

    public array $fileGroups = [];

    public function uploadMediaFiles()
    {
        if (!empty($this->fileGroups)) {
            foreach ($this->files as $group => $files) {
                if (is_array($files)) {
                    foreach ($files as $file) {
                        if (is_array($file)) {
                            $resolver = "{$group}MediaResolver";
                            $this->$resolver($group, $file);
                            continue;
                        }
                        $this->loadMediaFile($group, $file);
                    }
                } else {
                    $this->loadMediaFile($group, $files);
                }
            }
        }
    }

    private function loadMediaFile($file, $group)
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
