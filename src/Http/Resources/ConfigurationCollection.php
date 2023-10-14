<?php

namespace Fintech\Core\Http\Resources;

use Fintech\Core\Supports\Utility;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConfigurationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($configuration) {
            return [
                'package' => $configuration->package,
                'type' => $configuration->type,
                'key' => $configuration->key,
                'value' => Utility::typeCast($configuration->value, $configuration->type),
                'label' => $configuration->label,
                'description' => $configuration->description,
                $configuration->key => Utility::typeCast($configuration->value, $configuration->type)
            ];
        })->toArray();
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'options' => [
                'package' => config('fintech.core.packages')
            ],
            'query' => $request->all(),
        ];
    }

    /**
     * return the input field type based on datatype
     * @param string|null $type
     * @return string
     */
    private function guessInputFromType(string $type = null)
    {
        switch ($type) {
            case 'integer' :
            case 'float':
            case 'double' :
                return 'number';

            case 'boolean':
            case 'bool':
                return 'checkbox';
            case 'array':
            case 'json':
                return 'textarea';

            case 'string':
            default :
                return 'text';
        }
    }
}
