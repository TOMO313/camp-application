<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;

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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('シーズン別キャンプ場リサーチ！');
    Route::get('/posts/create', 'create')->name('create');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
    Route::post('/posts', 'store')->name('store');
    Route::post('/posts/like', 'like')->name('posts.like');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}', 'delete')->name('delete');
});

Route::get('/seasons/{season}', [SeasonController::class, 'index'])->middleware("auth");
Route::get('/seasons/{season}/{style}', [SeasonController::class, 'style'])->middleware("auth");

Route::post('/comments/{post}', [CommentController::class, 'store'])->middleware("auth");

Route::post('/images', [ImageController::class, 'store'])->middleware("auth");

require __DIR__.'/auth.php';
