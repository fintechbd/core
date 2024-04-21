<?php

namespace Fintech\Core\Traits;

use Illuminate\Support\Facades\Config;

trait RegisterPackageTrait
{
    private string $packageName;

    private string $packageCode;

    /**
     * register all package code to app
     * @param string|null $code
     * @param string|null $label
     * @return void
     */
    public function injectOnConfig(string $code = null, string $label = null): void
    {
        if ($code == null && $this->packageCode == null) {
            throw new \InvalidArgumentException("Code Argument or `packageCode` Property is missing from service provider class.");
        }

        $code = $code ?: $this->packageCode;

        if ($label == null) {
            $label = ucfirst($code);
        }

        $this->packageName = $label;

        Config::set("fintech.core.packages.{$code}", $label);
    }
}
