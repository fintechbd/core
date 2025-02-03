<?php

namespace Fintech\Core\Http\Resources;

use Fintech\Core\Facades\Core;
use Fintech\Core\Supports\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiLogCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($apiLog) {
            return [
                'id' => $apiLog->getKey(),
                'direction' => $apiLog->direction,
                'user_id' => $apiLog->user_id,
                'user_name' => ($apiLog->user_id != null && Core::packageExists('Auth')) ? \Fintech\Auth\Facades\Auth::user()->find($apiLog->user_id)?->name ?? null : null,
                'method' => $apiLog->method,
                'host' => $apiLog->host,
                'url' => $apiLog->url,
                'status_code' => $apiLog->status_code,
                'ip_address' => $apiLog->ip_address,
                'user_agent' => $apiLog->user_agent,
                'created_at' => $apiLog->created_at,
            ];
        })->toArray();
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'options' => [
                'dir' => Constant::SORT_DIRECTIONS,
                'per_page' => Constant::PAGINATE_LENGTHS,
                'sort' => ['id', 'name', 'created_at', 'updated_at'],
            ],
            'query' => $request->all(),
        ];
    }
}
