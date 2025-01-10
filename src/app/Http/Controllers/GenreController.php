<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function create() {
        return view('genres.create');
    }

    public function store(Request $request) {
        $request->validate([
            'genre' => 'required|unique:genres,name'
        ], [
            'genre.required' => 'Моля, въведете име на жанр.',
            'genre.unique' => 'Жанрът с такова име вече съществува.'
        ]);

        Genre::create([
            'name' => $request->genre
        ]);

        return redirect()->route('movies.index')->with('success', 'Жанрът беше добавен успешно!');
    }
}
