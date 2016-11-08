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
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/marketing/join-list', 'MarketingEmailController@showJoin');
Route::post('/marketing/join-list', 'MarketingEmailController@doJoin');
Route::get('/marketing/pending', 'MarketingEmailController@showPending')->name('show-pending');
Route::get('/marketing/verify-email/{hash}', 'MarketingEmailController@validateEmailHash');

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::get('widgets', 'WidgetController@index')->name('widgets.index');
    Route::get('widgets/add', 'WidgetController@add')->name('widgets.add');
    Route::post('widgets', 'WidgetController@create')->name('widgets.create');

    Route::get('tasks', 'TaskController@index')->name('tasks.index');
    Route::get('tasks/add', 'TaskController@add')->name('tasks.add');
    Route::post('tasks', 'TaskController@create')->name('tasks.create');

    Route::get('/users', function () {
        $users = \App\User::with('tasks')->get();

        return view('users.index')
            ->with('users', $users);
    });
});
