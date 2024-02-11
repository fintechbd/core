<?php

namespace Fintech\Core;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $root_prefix = Config::get('core.root_prefix', '');

        $this->routes(function () use (&$root_prefix) {
            Route::prefix("{$root_prefix}api")
                ->middleware('api')
                ->group(__DIR__ . '/../routes/api.php');
        });

        ($this->app->make(Router::class))
            ->middlewareGroup('http-log', [
                \Fintech\Core\Http\Middlewares\HttpLogger::class
            ]);

        ($this->app->make(Router::class))
            ->middlewareGroup('encrypted', [
                \Fintech\Core\Http\Middlewares\EncryptedRequestResponse::class
            ]);

    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
