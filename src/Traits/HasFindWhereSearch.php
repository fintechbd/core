<?php

namespace Fintech\Core\Traits;

trait HasFindWhereSearch
{
    /**
     * @param array $filters
     * @return \Closure|null|\Fintech\Core\Abstracts\BaseModel
     */
    public function findWhere(array $filters = [])
    {
        if (!method_exists($this, 'list')) {
            throw new \BadMethodCallException(self::class . '::list(array $filters = []) method is required and missing.');
        }

        return $this->list($filters)->first();
    }
}
