<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Главная страница — список категорий
Route::get('/', [CategoryController::class, 'index'])
    ->name('categories.index');

// Категории (просмотр)
Route::get('/categories/{category}', [CategoryController::class, 'show'])
    ->name('categories.show');

// Темы
Route::get('/topics/{topic}', [TopicController::class, 'show'])
    ->name('topics.show');

// ----------
// Защищённые маршруты (только авторизованные пользователи)
// ----------
Route::middleware(['auth'])->group(function () {

    // Темы
    Route::post('/categories/{category}/topics', [TopicController::class, 'store'])
        ->name('topics.store');

    Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])
        ->name('topics.destroy');

    // Сообщения
    Route::post('/topics/{topic}/posts', [PostController::class, 'store'])
        ->name('posts.store');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');
});

// ----------
// Админка (категории)
// ----------
//Route::middleware(['auth'])->group(function () {
//
//   Route::middleware('can:admin')->group(function () {
//
//        Route::get('/admin/categories', [CategoryController::class, 'adminIndex'])
//            ->name('admin.categories.index');
//
//        Route::post('/admin/categories', [CategoryController::class, 'store'])
//            ->name('admin.categories.store');
//
//        Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])
//            ->name('admin.categories.destroy');
//    });
//});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
