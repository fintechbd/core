<?php

namespace Fintech\Core\Supports;

use Illuminate\Support\Str;
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

        $month = $media->getCustomProperty('month', date('F'));

        $year = $media->getCustomProperty('year', date('Y'));

        $collection_name = Str::snake(class_basename($media->model_type) . '_' . $media->collection_name);

        return strtolower(
            rtrim($prefix, '/') . "{$collection_name}/{$year}/{$month}/{$media->getKey()}"
        );

    }
}
