<?php

use Illuminate\Support\Facades\Route;
use Vector\Spider\Http\Controllers\AdminControllers\AdminPageController;
use Vector\Spider\Http\Controllers\AdminControllers\BlogController;
use Vector\Spider\Http\Controllers\AdminControllers\EmployeeController;
use Vector\Spider\Http\Controllers\AdminControllers\SEOController;
use Vector\Spider\Http\Controllers\AdminControllers\UserController;
use Vector\Spider\Http\Middlewares\AdminAuth;

Route::get('', fn () => view('Spider::admin.index'))->name('admin_home');
Route::get('index', fn () => redirect()->route('admin_home'));

Route::controller(AdminPageController::class)->prefix('page')->group(function () {
    Route::get('', 'ui_view_pages');
    Route::any('toggle/{pageId}', 'api_toggle_page_status');
    Route::prefix('create')->group(function () {
        Route::get('', 'ui_create_page');
        Route::post('', 'web_create_page');
    });
    Route::prefix('edit')->group(function () {
        Route::get('{webpageId}', 'ui_edit_page');
        Route::post('', 'web_edit_page');
    });
    Route::prefix("group")->group(function () {
        Route::get('', 'ui_view_groups');
        Route::prefix("create")->group(function () {
            Route::get('', 'ui_create_group');
            Route::post('', 'web_create_group');
        });
        Route::prefix("edit")->group(function () {
            Route::get('{catId}', 'ui_edit_group');
            Route::post('', 'web_edit_group');
        });
    });
});
Route::controller(BlogController::class)->prefix('blog')->group(function () {
    Route::get('', 'ui_view_blogs');
    Route::any('toggle/{blogId}', 'api_toggle_blog_status');
    Route::prefix("create")->group(function () {
        Route::get('', 'ui_create_blog');
        Route::post('', 'web_create_blog');
    });
    Route::prefix("edit")->group(function () {
        Route::get('{blogId}', 'ui_edit_blog');
        Route::post('', 'web_edit_blog');
    });
    Route::prefix("category")->group(function () {
        Route::get('', 'ui_view_categories');
        Route::prefix("create")->group(function () {
            Route::get('', 'ui_create_category');
            Route::post('', 'web_create_category');
        });
        Route::prefix("edit")->group(function () {
            Route::get('{catId}', 'ui_edit_category');
            Route::post('', 'web_edit_category');
        });
    });
});
Route::controller(EmployeeController::class)->group(function () {
    Route::withoutMiddleware(AdminAuth::class)->group(function () {
        Route::prefix('login')->group(function () {
            Route::get('', 'ui_login')->name('admin_login');
            Route::post('', 'web_login');
        });
        Route::any('logout', 'web_logout')->name('admin_logout');
    });

    Route::prefix('employee')->group(function () {
        Route::get('', 'ui_view_emps');
        Route::get('togglestatus', 'web_toggle_status');
        Route::prefix('create')->group(function () {
            Route::get('', 'ui_create_emp');
            Route::post('', 'web_create_emp');
        });
        Route::prefix('edit')->group(function () {
            Route::get('{empId}', 'ui_edit_emp');
            Route::post('', 'web_edit_emp');
        });
    });

    Route::prefix('jobrole')->group(function () {
        Route::get('', 'ui_view_roles');
        Route::prefix('create')->group(function () {
            Route::get('', 'ui_create_role');
            Route::post('', 'web_create_role');
        });
        Route::prefix('edit')->group(function () {
            Route::get('{roleId}', 'ui_edit_role');
            Route::post('', 'web_edit_role');
        });
    });
});
Route::controller(SEOController::class)->prefix('seo')->group(function () {
    Route::prefix('webpage')->group(function () {
        Route::get('', 'ui_view_webpages');
        Route::any('toggle/{webpageId}', 'api_toggle_webpage_status');
        Route::prefix('add')->group(function () {
            Route::get('', 'ui_add_webpage');
            Route::post('', 'web_add_webpage');
        });
        Route::prefix('edit')->group(function () {
            Route::get('{webpageId}', 'ui_edit_webpage');
            Route::post('', 'web_edit_webpage');
        });
    });
    Route::prefix('webimage')->group(function () {
        Route::get('', 'ui_view_webimages');
        Route::prefix('upload')->group(function () {
            Route::get('', 'ui_upload_webimages');
            Route::post('', 'web_upload_webimages');
        });
        Route::prefix('edit')->group(function () {
            Route::get('{webpageId}', 'ui_edit_webimage');
            Route::post('', 'web_edit_webimage');
        });
    });
});
Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::get('', 'ui_view_users');
});
