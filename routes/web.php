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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login',[App\Http\Controllers\Backend\AuthController::class, 'index'])->name('auth.index');
Route::post('/login',[App\Http\Controllers\Backend\AuthController::class, 'login'])->name('auth.login');
Route::post('/logout',[App\Http\Controllers\Backend\AuthController::class, 'logout'])->name('auth.logout');

Route::get('/signup',[App\Http\Controllers\Backend\AuthController::class, 'signup'])->name('auth.signup');
Route::post('/signup',[App\Http\Controllers\Backend\AuthController::class, 'register'])->name('auth.register');

Route::get('/posts',[App\Http\Controllers\Backend\PostController::class, 'index'])->name('posts.index');
Route::post('/post/delete',[App\Http\Controllers\Backend\PostController::class, 'delete'])->name('post.delete');
Route::post('/post/store',[App\Http\Controllers\Backend\PostController::class, 'store'])->name('post.store');
Route::post('/post/update',[App\Http\Controllers\Backend\PostController::class, 'update'])->name('post.update');
