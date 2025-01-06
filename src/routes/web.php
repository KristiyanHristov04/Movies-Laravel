<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');

Route::post('/movies/create', [MovieController::class, 'store'])->name('movies.store');

Route::put('movies/{id}', [MovieController::class, 'update'])->name('movies.update');

Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.delete');
