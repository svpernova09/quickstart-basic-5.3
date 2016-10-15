<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\Widget;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/widgets', function () {
    $widgets = Widget::all();

    return view('widgets.index')
        ->with('widgets', $widgets);
});
