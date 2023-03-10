<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
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

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category:slug}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/', function () {
    return view('welcome');
});
