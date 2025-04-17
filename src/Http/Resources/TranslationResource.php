<?php

namespace Fintech\Core\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method string|null getTranslation(string $code)
 */
class TranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getKey(),
            'key' => $this->key ?? null,
            'locale' => $this->getTranslation($request->input('locale', config('app.locale'))),
            'created_at' => $this->created_at ?? null,
            'updated_at' => $this->updated_at ?? null,
            'deleted_at' => $this->deleted_at ?? null,
            'restored_at' => $this->restored_at ?? null,
        ];
    }
}
