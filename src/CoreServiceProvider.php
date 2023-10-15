<?php

namespace Fintech\Core;

use Fintech\Core\Commands\InstallCommand;
use Fintech\Core\Facades\Core;
use Fintech\Core\Supports\Utility;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
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
            __DIR__ . '/../config/core.php',
            'fintech.core'
        );

        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'core');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');

        $this->publishes([
            __DIR__ . '/../lang' => $this->app->langPath('vendor/core'),
        ]);

        $this->publishes([
            __DIR__ . '/../config/core.php' => config_path('fintech/core.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/core'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        $this->loadSettings();
    }

    private function loadSettings()
    {
        if(!App::environment('testing')) {
            if (Schema::hasTable('settings')) {
                Core::setting()->list()->each(function ($setting) {
                    Config::set("fintech.{$setting->package}.{$setting->key}", Utility::typeCast($setting->value, $setting->type));
                });
            }
        }
    }
}
