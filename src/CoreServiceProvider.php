<?php

namespace Fintech\Core;

use Fintech\Core\Commands\InstallCommand;
use Fintech\Core\Facades\Core;
use Fintech\Core\Http\Middlewares\EncryptedRequestResponse;
use Fintech\Core\Http\Middlewares\HttpLogger;
use Fintech\Core\Supports\Utility;
use Fintech\Core\Traits\RegisterPackageTrait;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
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

        Config::set('database.connections.mongodb', [
            'driver' => 'mongodb',
            'dsn' => env('DATABASE_URL', 'mongodb+srv://forge:forge@localhost/myappdb?retryWrites=true&w=majority'),
            'database' => env('DB_DATABASE', 'mongodb'),
        ]);

        Config::set('logging.channels.query', [
            'driver' => 'daily',
            'path' => storage_path('logs/query.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
            'replace_placeholders' => true,
        ]);

        $this->app->register(\Fintech\Core\Providers\EventServiceProvider::class);
        $this->app->register(\Fintech\Core\Providers\RepositoryServiceProvider::class);
        $this->app->register(\Fintech\Core\Providers\MacroServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router): void
    {
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
                InstallCommand::class,
            ]);
        }

        $router->middlewareGroup('encrypted', [EncryptedRequestResponse::class])
            ->middlewareGroup('http_log', [HttpLogger::class]);

        $this->loadSettings();

        $this->loadQueryLogger();
    }

    private function loadSettings(): void
    {
        if (!App::environment('testing')) {
            Core::setting()->list()->each(function ($setting) {
                Config::set("fintech.{$setting->package}.{$setting->key}", Utility::typeCast($setting->value, $setting->type));
            });
        }
    }

    private function loadQueryLogger(): void
    {
        if (Config::get('fintech.core.query_logger_enabled') && Config::get('database.default') != 'mongodb') {
            \Illuminate\Support\Facades\DB::listen(function (\Illuminate\Database\Events\QueryExecuted $event) {
                $query = \Illuminate\Support\Str::replaceArray('?', $event->bindings, $event->sql);
                \Illuminate\Support\Facades\Log::channel('query')
                    ->debug("Duration: {$event->time}, Query: {$query}");
            });
        }
    }
}
