<?php

namespace Fintech\Core\Traits;

trait HasFindWhereSearch
{
    public function findWhere(array $filters = []): ?\Fintech\Core\Abstracts\BaseModel
    {
        if (!method_exists($this, 'list')) {
            throw new \BadMethodCallException(self::class . '::list(array $filters = []) method is required and missing.');
        }

        return $this->list($filters)->first();
    }
}
