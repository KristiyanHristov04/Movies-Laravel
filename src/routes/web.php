<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMovieController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\RestrictAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [MovieController::class, 'index'])->name('movies.index')->middleware([RestrictAdminMiddleware::class]);
Route::get('/directors', [DirectorController::class, 'index'])->name('directors.index')->middleware([RestrictAdminMiddleware::class]);;
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create')->middleware(['auth', RestrictAdminMiddleware::class]);
Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create')->middleware(['auth', RestrictAdminMiddleware::class]);
Route::get('/directors/create', [DirectorController::class, 'create'])->name('directors.create')->middleware(['auth', RestrictAdminMiddleware::class]);
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show')->middleware(['auth', RestrictAdminMiddleware::class]);;
Route::get('/directors/{id}', [DirectorController::class, 'show'])->name('directors.show')->middleware(['auth', RestrictAdminMiddleware::class]);;
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit')->middleware(['auth', RestrictAdminMiddleware::class]);
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard.index')->middleware(['auth', AdminMiddleware::class]);
Route::get('/admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index')->middleware(['auth', AdminMiddleware::class]);

Route::post('/movies', [MovieController::class, 'store'])->name('movies.store')->middleware('auth');
Route::post('/genres', [GenreController::class, 'store'])->name('genres.store')->middleware('auth');
Route::post('/directors', [DirectorController::class, 'store'])->name('directors.store')->middleware('auth');

Route::put('movies/{id}', [MovieController::class, 'update'])->name('movies.update')->middleware('auth');

Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.delete')->middleware('auth');

require __DIR__.'/auth.php';
