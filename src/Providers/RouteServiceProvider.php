<?php

namespace Fintech\Core\Providers;

use Fintech\Core\Http\Middlewares\EncryptedRequestResponse;
use Fintech\Core\Http\Middlewares\HttpLogger;
use Fintech\Core\Http\Middlewares\ImposterCheck;
use Fintech\Core\Http\Middlewares\Localization;
use Fintech\Core\Http\Middlewares\PlatformCheck;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix(config('fintech.core.root_prefix', 'api/'))
                ->group(__DIR__ . '/../../routes/api.php');

            Route::middleware('web')
                ->prefix(config('fintech.core.root_prefix', ''))
                ->group(__DIR__ . '/../../routes/web.php');
        });

        /**
         * Future support to laravel 11
         * @version 11.0.x
         */
        if ((int)$this->app->version() >= 11) {
            $this
                ->pushMiddlewareToGroup('api', Localization::class)
                ->pushMiddlewareToGroup('api', HttpLogger::class)
                ->pushMiddlewareToGroup('api', EncryptedRequestResponse::class)
                ->pushMiddlewareToGroup('api', PlatformCheck::class);
        }

        $this->pushMiddlewareToGroup('imposter', ImposterCheck::class);
    }
}
