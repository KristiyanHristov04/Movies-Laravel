<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class AdminMovieController extends Controller
{
    public function index() {
        $moviesPerPage = 5;
        $movies = Movie::paginate($moviesPerPage);

        return view('admin.movies', [
            'movies' => $movies,
            'counter' => 0
        ]);
    }

    public function destroy($id) {
        $movie = Movie::find($id);
        if (!$movie) {
            return redirect()->route('admin.movies.index')->with('error', 'Не съществува такъв ресурс!');
        }

        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Филмът беше изтрит успешно!');

    }
}
