<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Userzone\DashboardController;
use App\Http\Controllers\Userzone\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
 * Public Website routes
 */
Route::get('/', WelcomeController::class)->name('welcome');
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('authors/{id}', [AuthorController::class, 'show'])->name('authors.show');
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Todo: add your public routes here

/*
 * Authentication routes
 */
require __DIR__.'/auth.php';

/*
 * Userzone routes
 */
Route::middleware('auth')->group(function () {
    // For the user's dashboard (after login)
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Todo: add your Userzone routes here
    Route::get('/user/categories', [\App\Http\Controllers\Userzone\CategoryController::class, 'index'])->name('userzone.categories.index');
    Route::get('/user/categories/create', [\App\Http\Controllers\Userzone\CategoryController::class, 'create'])->name('userzone.categories.create');
    Route::post('/user/categories', [\App\Http\Controllers\Userzone\CategoryController::class, 'store'])->name('userzone.categories.store');

    Route::get('/user/categories/{id}/edit', [\App\Http\Controllers\Userzone\CategoryController::class, 'edit'])->name('userzone.categories.edit');
    Route::post('/user/categories/{id}', [\App\Http\Controllers\Userzone\CategoryController::class, 'update'])->name('userzone.categories.update');


    // For the user's profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
