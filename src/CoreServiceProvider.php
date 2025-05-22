<?php

namespace Fintech\Core;

use Exception;
use Fintech\Core\Commands\AppInstallCommand;
use Fintech\Core\Commands\AppReleaseCommand;
use Fintech\Core\Commands\AppUpdateCommand;
use Fintech\Core\Commands\EncryptionKeyGenerateCommand;
use Fintech\Core\Commands\HealthCheckupCommand;
use Fintech\Core\Commands\InstallCommand;
use Fintech\Core\Providers\EventServiceProvider;
use Fintech\Core\Providers\MacroServiceProvider;
use Fintech\Core\Providers\OverwriteServiceProvider;
use Fintech\Core\Providers\RepositoryServiceProvider;
use Fintech\Core\Providers\RouteServiceProvider;
use Fintech\Core\Providers\ValidatorServiceProvider;
use Fintech\Core\Traits\Packages\RegisterPackageTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    use RegisterPackageTrait;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->packageCode = 'core';

        $this->mergeConfigFrom(
            __DIR__ . '/../config/core.php',
            'fintech.core'
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../config/changelog.php',
            'fintech.changelog'
        );

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(OverwriteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(MacroServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(ValidatorServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->loadSettings();

        $this->injectOnConfig();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'core');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');

        $this->publishes([
            __DIR__ . '/../lang' => $this->app->langPath('vendor/core'),
        ], 'fintech-core-lang');

        $this->publishes([
            __DIR__ . '/../config/core.php' => config_path('fintech/core.php'),
            __DIR__ . '/../config/media-library.php' => config_path('media-library.php'),
        ], 'fintech-core-config');
        $this->publishes([
            __DIR__ . '/../config/changelog.php' => config_path('fintech/changelog.php'),
        ], 'fintech-core-changelog');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/core'),
        ], 'fintech-core-views');

        if ($this->app->runningInConsole()) {
            $this->commands([
                AppInstallCommand::class,
                AppUpdateCommand::class,
                AppReleaseCommand::class,
                InstallCommand::class,
                EncryptionKeyGenerateCommand::class,
                HealthCheckupCommand::class
            ]);
        }
    }

    private function loadSettings(): void
    {
        try {

            $cacheValues = cache()->remember('fintech.setting', DAY, function () {
                if (Schema::hasTable('settings')) {
                    return \Fintech\Core\Facades\Core::setting()->configurations();
                }
                return [];
            });

            if (!empty($cacheValues)) {
                config($cacheValues);
            }

        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
