<?php

namespace Vector\Spider;

use Carbon\Laravel\ServiceProvider;
use Vector\Spider\Http\Middlewares\AdminAuth;
use Illuminate\Support\Facades\Route;
use Vector\Spider\Http\Middlewares\APIAuth;

class SpiderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Some Views for promotion
        $this->loadViewsFrom(__DIR__ . "/views","Spider");

        // Some web routes for promotion
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");

        // Admin Routes
        Route::
            middleware(['web',AdminAuth::class])->
            prefix('admin')->
            group(__DIR__ . '/routes/admin.php')->
            group(base_path('routes/admin.php'));

            // Admin Routes
        Route::
            middleware(['api',APIAuth::class])->
            prefix('api/admin')->
            group(__DIR__ . '/routes/admin_api.php')->
            group(base_path('routes/admin_api.php'));

        // Copy resources to spider folder
        $this->publishes([
            __DIR__ . '/public' => public_path('vector/spider')
        ], 'public');
    }
}
