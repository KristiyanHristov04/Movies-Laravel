<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDirectorController;
use App\Http\Controllers\AdminGenreController;
use App\Http\Controllers\AdminMovieController;
use App\Http\Controllers\AdminUserController;
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
Route::get('/admin/directors', [AdminDirectorController::class, 'index'])->name('admin.directors.index')->middleware(['auth', AdminMiddleware::class]);
Route::get('/admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index')->middleware(['auth', AdminMiddleware::class]);
Route::get('/admin/genres', [AdminGenreController::class, 'index'])->name('admin.genres.index')->middleware(['auth', AdminMiddleware::class]);
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index')->middleware(['auth', AdminMiddleware::class]);
Route::get('/admin/movies/{id}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit')->middleware(['auth', AdminMiddleware::class]);
Route::get('/admin/directors/{id}/edit', [AdminDirectorController::class, 'edit'])->name('admin.directors.edit')->middleware(['auth', AdminMiddleware::class]);
Route::get('/admin/genres/{id}/edit', [AdminGenreController::class, 'edit'])->name('admin.genres.edit')->middleware(['auth', AdminMiddleware::class]);


Route::post('/movies', [MovieController::class, 'store'])->name('movies.store')->middleware('auth');
Route::post('/genres', [GenreController::class, 'store'])->name('genres.store')->middleware('auth');
Route::post('/directors', [DirectorController::class, 'store'])->name('directors.store')->middleware('auth');
Route::post('/admin/users/{id}/promote', [AdminUserController::class, 'promote'])->name('admin.users.promote')->middleware(['auth', AdminMiddleware::class]);
Route::post('/admin/users/{id}/demote', [AdminUserController::class, 'demote'])->name('admin.users.demote')->middleware(['auth', AdminMiddleware::class]);

Route::put('/movies/{id}', [MovieController::class, 'update'])->name('movies.update')->middleware('auth');
Route::put('/admin/movies/{id}', [AdminMovieController::class, 'update'])->name('admin.movies.update')->middleware(['auth', AdminMiddleware::class]);
Route::put('/admin/directors/{id}', [AdminDirectorController::class, 'update'])->name('admin.directors.update')->middleware(['auth', AdminMiddleware::class]);
Route::put('/admin/genres/{id}', [AdminGenreController::class, 'update'])->name('admin.genres.update')->middleware(['auth', AdminMiddleware::class]);

Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.delete')->middleware('auth');
Route::delete('/admin/movies/{id}', [AdminMovieController::class, 'destroy'])->name('admin.movies.delete')->middleware(['auth', AdminMiddleware::class]);
Route::delete('/admin/directors/{id}', [AdminDirectorController::class, 'destroy'])->name('admin.directors.delete')->middleware(['auth', AdminMiddleware::class]);
Route::delete('/admin/genres/{id}', [AdminGenreController::class, 'destroy'])->name('admin.genres.delete')->middleware(['auth', AdminMiddleware::class]);

require __DIR__.'/auth.php';
