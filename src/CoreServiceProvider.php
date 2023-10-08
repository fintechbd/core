<?php

namespace Fintech\Core;

use Fintech\Core\Commands\InstallCommand;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/core.php',
            'fintech.core'
        );

    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'core');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'core');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/core'),
        ]);

        $this->publishes([
            __DIR__.'/../config/core.php' => config_path('fintech/core.php'),
        ]);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/core'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        AliasLoader::getInstance()->alias('Utility', \Fintech\Core\Supports\Utility::class);
    }
}
