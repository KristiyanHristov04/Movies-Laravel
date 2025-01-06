<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sortByYear = $request->get('sortByYear');
        $query = Movie::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('movie_name', 'like', '%' . $search . '%')
                    ->orWhere('director', 'like', '%' . $search . '%')
                    ->orWhere('year', 'like', '%' . $search . '%')
                    ->orWhere('genre', 'like', '%' . $search . '%');
            });
        }

        if ($sortByYear) {
            if ($sortByYear === 'newest') {
                $query->orderBy('year', 'desc');
            } else if ($sortByYear === 'oldest') {
                $query->orderBy('year', 'asc');
            }
        }

        $movies = $query->paginate(2)->appends(['search' => $search, 'sortByYear' => $sortByYear]);
        return view('movies.index', ["movies" => $movies]);
    }

    public function show($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return redirect()->route('movies.index')->with('error', 'Не съществува такъв ресурс!');
        }
        return view('movies.show', ["movie" => $movie]);
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
            "image.max" => "Файлът не трябва да надвишава 3 MB."
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

        return redirect()->route('movies.index')->with('success', 'Филмът беше създаден успешно!');
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return redirect()->route('movies.index')->with('error', 'Не съществува такъв ресурс!');
        }
        return view('movies.edit', ["movie" => $movie]);
    }

    public function update($id, Request $request)
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
            "image.max" => "Файлът не трябва да надвишава 3 MB."
        ]);

        $movie = Movie::find($id);
        $movie->movie_name = $request->movieName;
        $movie->year = $request->year;
        $movie->director = $request->director;
        $movie->genre = $request->genre;
        $movie->language = $request->language;

        $imagePath = public_path('storage/' . $movie->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $filePath = $request->file('image')->store('images', 'public');
        $movie->image_path = $filePath;

        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Филмът беше редактиран успешно!');
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);

        if ($movie) {
            $imagePath = public_path('storage/' . $movie->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $movie->delete();
        }

        return redirect()->route('movies.index')->with('success', 'Филмът беше изтрит успешно!');
    }
}
