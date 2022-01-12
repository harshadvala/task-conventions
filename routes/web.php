<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Redirect;
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
    return Redirect::route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('key-auth/{key}', [\App\Http\Controllers\Auth\LoginController::class, 'loginByTaskKey'])->name('auth-by-key');

Route::get('send-mail', [\App\Http\Controllers\TaskController::class, 'sendMail']);

Route::middleware(['auth'])->group(function () {
//    Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
//    Route::get('/tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
//    Route::post('/tasks', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
//    Route::get('/tasks/created', [App\Http\Controllers\TaskController::class, 'created'])->name('tasks.created');

    Route::resource('tasks', TaskController::class);
});
