<?php

namespace Vector\Spider;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Vector\Spider\Http\Middleware\AdminApiAuth;
use Vector\Spider\Http\Middleware\AdminAuth;

class SpiderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $ADMIN_ROUTES = base_path('routes/admin.php');
        $ADMIN_API_ROUTES = base_path('routes/admin_api.php');

        // Creating Files if not found
        if (!is_file($ADMIN_ROUTES)) fclose(fopen($ADMIN_ROUTES, 'w'));
        if (!is_file($ADMIN_API_ROUTES)) fclose(fopen($ADMIN_API_ROUTES, 'w'));

        // Loading Routes
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");
        // Loading Views
        $this->loadViewsFrom(__DIR__ . "/views", "Spider");

        // Admin Routes
        Route::middleware(['web',AdminAuth::class])->prefix('admin')->group(__DIR__ . '/routes/admin.php')->group($ADMIN_ROUTES);

        // Admin Routes
        Route::middleware(['api', AdminApiAuth::class])->prefix('api/admin')->group(__DIR__ . '/routes/admin_api.php')->group($ADMIN_API_ROUTES);

        // Copy resources to spider folder
        $this->publishes([
            __DIR__ . '/public' => public_path('vector/spider')
        ], 'public');
    }
}
