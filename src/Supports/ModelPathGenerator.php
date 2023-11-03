<?php

namespace Fintech\Core\Supports;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

class ModelPathGenerator extends DefaultPathGenerator
{
    /*
     * Get a unique base path for the given media.
     */
    protected function getBasePath(Media $media): string
    {
        $prefix = config('media-library.prefix', '');

        return strtolower(
            rtrim($prefix, '/')
            . '/' . class_basename($media->model_type) . '_' . $media->collection_name
            . '/' . date('Y')
            . '/' . date('F')
            . '/' . $media->getKey()
        );

    }
}
