<?php

namespace Fintech\Core;

use Exception;
use Fintech\Core\Commands\EncryptionKeyGenerateCommand;
use Fintech\Core\Commands\InstallCommand;
use Fintech\Core\Http\Middlewares\EncryptedRequestResponse;
use Fintech\Core\Http\Middlewares\HttpLogger;
use Fintech\Core\Http\Middlewares\ImposterCheck;
use Fintech\Core\Providers\EventServiceProvider;
use Fintech\Core\Providers\MacroServiceProvider;
use Fintech\Core\Providers\RepositoryServiceProvider;
use Fintech\Core\Traits\RegisterPackageTrait;
use Illuminate\Routing\Router;
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

        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(MacroServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     * @param Router $router
     */
    public function boot(Router $router): void
    {
        $this->loadSettings();

        $this->injectOnConfig();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'core');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->publishes([
            __DIR__ . '/../lang' => $this->app->langPath('vendor/core'),
        ]);

        $this->publishes([
            __DIR__ . '/../config/core.php' => config_path('fintech/core.php'),
            __DIR__ . '/../config/media-library.php' => config_path('media-library.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/core'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                EncryptionKeyGenerateCommand::class
            ]);
        }

        $router->middlewareGroup('encrypted', [EncryptedRequestResponse::class])
            ->middlewareGroup('http_log', [HttpLogger::class])
            ->middlewareGroup('imposter', [ImposterCheck::class]);
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
