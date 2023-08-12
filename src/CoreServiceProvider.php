<?php

namespace Fintech\Core;

use Illuminate\Support\ServiceProvider;
use Fintech\Core\Commands\InstallCommand;
use Fintech\Core\Commands\CoreCommand;

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
            __DIR__.'/../config/core.php', 'core'
        );

        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/core.php' => config_path('core.php'),
        ]);


        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'core');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/core'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'core');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/core'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                CoreCommand::class,
            ]);
        }
    }
}
