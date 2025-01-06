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
        ], [
            "movieName.required" => "Моля, въведете име на филма.",
            "movieName.max" => "Името на филма не трябва да надвишава 100 символа.",
            "year.required" => "Моля, въведете година на издаване на филма.",
            "director.required" => "Моля, въведете режисьор на филма.",
            "director.max" => "Името на режисьора не трябва да надвишава 100 символа.",
            "genre.required" => "Моля, въведете жанр на филма.",
            "genre.max" => "Името на жанра не трябва да надвишава 60 символа.",
            "language.required" => "Моля, въведете език на филма.",
            "language.max" => "Името на езика не трябва да надвишава 60 символа.",
            "image.required" => "Моля, прикачете снимка на филма.",
            "image.image" => "Невалиден файлов формат. Валидни файлови формати: jpeg,png,jpg,gif",
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
