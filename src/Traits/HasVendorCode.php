<?php

namespace Fintech\Core\Traits;

trait HasVendorCode
{
    /**
     * This method get you pull vendor code values
     * if both package and vendor null get all value
     * if vendor is null then get all that package vendor aliases
     *
     * @param string $path
     * @param mixed|null $default
     * @return array|mixed|null
     */
    public function vendorAlias(string $path = '*', mixed $default = null): mixed
    {
        if ($column = $this->getAttribute('vendor_code')) {
            return data_get($column, $path, $default);
        }
        return null;
    }
}
