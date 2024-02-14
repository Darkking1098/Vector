<?php

use Illuminate\Support\Facades\Route;
use Vector\Spider\Http\Controllers\AdminControllers\AdminPageController;

Route::controller(AdminPageController::class)->prefix('page')->group(function () {
    Route::get('', 'api_view_pages');
    Route::any('toggle/{pageId}', 'api_toggle_page_status');
    Route::prefix('create')->group(function () {
        Route::get('', 'api_create_page');
    });
    Route::prefix('edit')->group(function () {
        Route::get('{webpageId}', 'api_edit_page');
    });
    Route::prefix("group")->group(function () {
        Route::get('', 'api_view_groups');
        Route::prefix("create")->group(function () {
            Route::get('', 'api_create_group');
        });
        Route::prefix("edit")->group(function () {
            Route::get('{catId}', 'api_edit_group');
        });
    });
});