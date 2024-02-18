<?php

use App\Http\Controllers\AdminControllers\ComponentController;
use App\Http\Controllers\AdminControllers\VarientController;
use Illuminate\Support\Facades\Route;

Route::controller(ComponentController::class)->prefix('components')->group(function () {
    Route::get('', 'ui_view_components')->name('View_componnets');
    Route::get('{compId}', 'ui_view_component')->whereNumber('compId');
    Route::prefix('create')->group(function () {
        Route::get('', 'ui_create_component');
        Route::post('', 'web_create_component');
    });
    Route::prefix('edit')->group(function () {
        Route::get('', 'ui_edit_component');
        Route::post('', 'web_edit_component');
    });
});
Route::controller(VarientController::class)->prefix('varient')->group(function () {
    Route::get('', fn () => redirect()->route('View_componnets'));
    Route::get('init', fn () => redirect()->route('View_componnets'));
    Route::get('init/{compId}','ui_init_varient')->whereNumber('compId');
    Route::prefix('modify')->group(function () {
        Route::get('', 'ui_modify_varient');
        Route::post('', 'web_modify_varient');
    });
});
