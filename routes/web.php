<?php

use App\Models\Component;
use App\Models\Varient;
use App\Models\WebPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('user.index');
});
Route::prefix('vector')->group(function () {
    Route::get('', function () {
        return view('user.vector.vector_files');
    });
    Route::prefix('customize')->group(function () {
        Route::get('', function () {
            return view('user.vector.customize');
        });
        Route::get('js', function () {
            return view('user.vector.js');
        });
        Route::get('css', function () {
            return view('user.vector.css');
        });
    });
});
Route::get('contribute', function () {
    return view('user.contribute');
});
Route::get('conventions', function () {
    return view('user.conventions');
});
Route::prefix('components')->group(function () {
    Route::get('', function () {
        $data = ["components" => Component::WithCount('varients')->with('web_page:id,webpage_slug')->get()->toArray()];
        return view('user.components', $data);
    });
    Route::prefix('{component}')->group(function ($component) {
        Route::get('', function ($component) {
            $slug = WebPage::where('webpage_slug', "components/$component")->first()->toArray();
            $data = ['component' => Component::where('slug_id', $slug['id'])->with('varients')->first()->toArray()];
            return view('user.varients', $data);
        });
        Route::get('{varient}', function ($component, $varient) {
            return view('user.components');
        });
    });
});
