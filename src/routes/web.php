<?php

use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/directors', [DirectorController::class, 'index'])->name('directors.index');
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create')->middleware('auth');
Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create')->middleware('auth');
Route::get('/directors/create', [DirectorController::class, 'create'])->name('directors.create')->middleware('auth');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit')->middleware('auth');

Route::post('/movies/create', [MovieController::class, 'store'])->name('movies.store')->middleware('auth');
Route::post('/genres/create', [GenreController::class, 'store'])->name('genres.store')->middleware('auth');
Route::post('/directors/create', [DirectorController::class, 'store'])->name('directors.store')->middleware('auth');

Route::put('movies/{id}', [MovieController::class, 'update'])->name('movies.update')->middleware('auth');

Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.delete')->middleware('auth');

require __DIR__.'/auth.php';
