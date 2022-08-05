<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('/task');
});

/*Route::get('/task', function () {
    return view('Task.index');
});*/

Route::resource('task', TaskController::class);
Route::put('/task/updatepriority/{id}', 'App\Http\Controllers\TaskController@update_priority');
