<?php

namespace Fintech\Core\Traits\Packages;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;

trait RegisterPackageTrait
{
    private string $packageName;

    private string $packageCode;

    /**
     * register package code to core configuration
     *
     * @param string|null $code
     * @param string|null $label
     * @return void
     */
    public function injectOnConfig(string $code = null, string $label = null): void
    {
        if ($code == null && $this->packageCode == null) {
            throw new InvalidArgumentException("Code Argument or `packageCode` Property is missing from service provider class.");
        }

        $code = $code ?: $this->packageCode;

        if ($label == null) {
            $label = ucfirst($code);
        }

        $this->packageName = $label;

        Config::set("fintech.core.packages.{$code}", $label);
    }

    /**
     * register package app binding
     *
     * @param string $class
     * @param string|null $alias
     * @return void
     */
    public function injectOnContainer(string $class, string $alias = null): void
    {
        if ($alias == null && $this->packageCode == null) {
            throw new InvalidArgumentException("Code Argument or `packageCode` Property is missing from service provider class.");
        }

        $alias = $alias ?: $this->packageCode;

        $this->app->bind($alias, function (Application $app) use ($class) {
            return $app->make($class);
        });
    }
}
