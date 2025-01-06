<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index() {
        $movies = Movie::all();
        return view('movies.index', ["movies" => $movies]);
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'movieName' => 'required|max:100',
            'year' => 'required',
            'director' => 'required|max:100',
            'genre' => 'required|max:60',
            'language' => 'required|max:60',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3096',
        ]);

        $filePath = $request->file('image')->store('images', 'public');

        Movie::create([
            'movie_name' => $request->movieName,
            'year' => $request->year,
            'director' => $request->director,
            'genre' => $request->genre,
            'language' => $request->language,
            'image_path' => $filePath,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully!');
    }
}
