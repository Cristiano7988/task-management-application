<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'tasks'], function () use ($router) {
    $router->post('', [App\Http\Controllers\TaskController::class, 'store']);
    $router->get('', [App\Http\Controllers\TaskController::class, 'index']);
    $router->get('{id}', [App\Http\Controllers\TaskController::class, 'show']);
    $router->put('{id}', [App\Http\Controllers\TaskController::class, 'update']);
});
