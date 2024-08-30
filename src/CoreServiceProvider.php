<?php

namespace Fintech\Core;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    use \Fintech\Core\Traits\RegisterPackageTrait;

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

        $this->app->register(\Fintech\Core\Providers\EventServiceProvider::class);
        $this->app->register(\Fintech\Core\Providers\RepositoryServiceProvider::class);
        $this->app->register(\Fintech\Core\Providers\MacroServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(\Illuminate\Routing\Router $router): void
    {
        $this->loadSettings();

        $this->injectOnConfig();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'core');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');

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
                \Fintech\Core\Commands\InstallCommand::class,
            ]);
        }

        $this->loadQueryLogger();

        $router->middlewareGroup('encrypted', [\Fintech\Core\Http\Middlewares\EncryptedRequestResponse::class])
            ->middlewareGroup('http_log', [\Fintech\Core\Http\Middlewares\HttpLogger::class])
            ->middlewareGroup('imposter', [\Fintech\Core\Http\Middlewares\ImposterCheck::class]);
    }

    private function loadSettings(): void
    {
        try {

            $cacheValues = cache()->remember('fintech.setting', DAY, function () {
                if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                    return \Fintech\Core\Facades\Core::setting()->configurations();
                }
                return [];
            });

            if (!empty($cacheValues)) {
                config($cacheValues);
            }

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);
        }
    }

    private function loadQueryLogger(): void
    {
        if (Config::get('fintech.core.query_logger_enabled') && Config::get('database.default') != 'mongodb') {
            \Illuminate\Support\Facades\DB::listen(function (\Illuminate\Database\Events\QueryExecuted $event) {
                //skip console query logging
                if ($this->app->runningInConsole() && !config('fintech.core.log_console_query')) {
                    return;
                }
                $query = \Illuminate\Support\Str::replaceArray('?', $event->bindings, $event->sql);
                \Illuminate\Support\Facades\Log::channel('query')
                    ->debug("TIME: {$event->time} ms, SQL: {$query}");
            });
        }
    }
}
