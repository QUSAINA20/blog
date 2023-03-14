<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('posts')->middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/{post:slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->name('comments.store');
    Route::get('/posts/{post:slug}/comments/{comment}/edit', [PostCommentsController::class, 'edit'])->name('comments.edit');
    Route::delete('/posts/{post:slug}/comments/{comment}', [PostCommentsController::class, 'destroy'])->name('comments.destroy');
});

Route::prefix('categories')->middleware('auth')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category:slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
Route::prefix('tags')->middleware('auth')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('tags.index');
    Route::get('/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/', [TagController::class, 'store'])->name('tags.store');
    Route::get('/{tag:slug}', [TagController::class, 'show'])->name('tags.show');
    Route::get('/{tag:slug}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/{tag:slug}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/{tag:slug}', [TagController::class, 'destroy'])->name('tags.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/contact', [ContactUsController::class, 'showContactForm'])->name('contact.show');
    Route::post('/contact', [ContactUsController::class, 'submitContactForm'])->name('contact.submit');
});
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
