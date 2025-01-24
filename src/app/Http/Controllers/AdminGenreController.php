<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class AdminGenreController extends Controller
{
    public function index()
    {
        $genresPerPage = 5;
        $genres = Genre::orderby('id', 'desc')->paginate($genresPerPage);

        return view('admin.genres', [
            'genres' => $genres,
            'counter' => 0
        ]);
    }

    public function edit($id)
    {
        $genre = Genre::find($id);
        if (!$genre) {
            return redirect()->route('admin.genres.index')->with('error', 'Не съществува такъв ресурс!');
        }

        return view('admin.genre-edit', [
            'genre' => $genre,
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'genre' => 'required|unique:genres,name'
        ], [
            'genre.required' => 'Моля, въведете име на жанр.',
            'genre.unique' => 'Жанрът с такова име вече съществува.'
        ]);

        
        $genre = Genre::find($id);

        $genre->name = $request->genre;
        $genre->save();

        return redirect()->route('admin.genres.index')->with('success', 'Жанрът беше добавен успешно!');
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);
        if (!$genre) {
            return redirect()->route('admin.genres.index')->with('error', 'Не съществува такъв ресурс!');
        }

        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', 'Жанрът беше изтрит успешно!');
    }
}
