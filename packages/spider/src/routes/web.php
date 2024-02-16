<?php

use Illuminate\Support\Facades\Route;

Route::get('developer',function(){
    return view('Spider::user.developer');
});