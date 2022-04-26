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

Route::middleware('auth')->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::resource('posts', \App\Http\Controllers\PostController::class)
                ->only(['index', 'edit', 'show', 'update', 'create', 'store', 'destroy'])
                ->name('GET', 'edit')
                ->name('POST', 'store')
                ->name('PUT', 'update');
            Route::resource('post-categories', \App\Http\Controllers\PostCategoriesController::class)
                ->only(['index', 'edit', 'show', 'update', 'create', 'store', 'destroy'])
                ->name('GET', 'edit')
                ->name('POST', 'store')
                ->name('PUT', 'update');
            Route::resource('users', \App\Http\Controllers\UserController::class)
                ->only(['index', 'edit', 'show', 'update', 'create', 'store', 'destroy'])
                ->name('GET', 'edit')
                ->name('POST', 'store')
                ->name('PUT', 'update');
            Route::resource('tags', \App\Http\Controllers\TagController::class)
                ->only(['index', 'edit', 'show', 'update', 'create', 'store', 'destroy'])
                ->name('GET', 'edit')
                ->name('POST', 'store')
                ->name('PUT', 'update');
        });
    });
});
