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
}
