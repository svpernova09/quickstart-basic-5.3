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
use App\Http\Requests\WidgetCreateRequest;
use App\Http\Requests\TaskCreateRequest;
use App\Task;
use App\User;
use App\Widget;

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('widgets', 'WidgetController@index')->name('widgets.index');
    Route::get('widgets/add', 'WidgetController@add')->name('widgets.add');
    Route::post('widgets', 'WidgetController@create')->name('widgets.create');

    Route::get('/tasks', function () {
        $tasks = Task::all();

        return view('tasks.index')
            ->with('tasks', $tasks);
    });

    Route::get('/tasks/add', function () {
        $users = User::all();

        return view('tasks.add')
            ->with('users', $users);
    });

    Route::post('/tasks', function (TaskCreateRequest $request) {
        $task = new Task();
        $task->name = $request->name;
        $task->user_id = $request->user_id;
        $task->save();

        return redirect()->to('/tasks');
    });
});