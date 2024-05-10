<?php

namespace Fintech\Core\Traits;

trait HasVendorCode
{
    /**
     * This method get you pull vendor code values
     * if both package and vendor null get all value
     * if vendor is null then get all that package vendor aliases
     *
     * @param string|null $package
     * @param string|null $vendor
     * @return array|mixed|null
     */
    public function vendorAlias(string $package = null, string $vendor = null): mixed
    {
        if ($column = $this->getAttribute('vendor_code')) {
            if ($package == null) {
                return $column;
            }
            $aliases = $column[$package] ?? [];
            if ($vendor == null) {
                return $aliases;
            }
            return $aliases[$vendor] ?? null;
        }
        return null;
    }
}
