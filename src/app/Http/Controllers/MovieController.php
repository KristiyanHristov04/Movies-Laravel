<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                    ->orWhereHas('language', function ($q) use ($search) {
                        $q->where('language_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('genre', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('director', function ($q) use ($search) {
                        $q->where('first_name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%')
                            ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $search . '%');
                    });
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
        $genres = Genre::orderBy('name', 'ASC')->get();
        $directors = Director::orderBy('first_name', 'ASC')->get();
        $languages = Language::all();
        return view('movies.create', [
            "genres" => $genres,
            "directors" => $directors,
            "languages" => $languages
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'movieName' => 'required|max:100',
            'year' => 'required',
            'director_id' => 'required|exists:directors,id',
            'genre_id' => 'required|exists:genres,id',
            'language_id' => 'required|exists:languages,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3096',
        ], [
            "movieName.required" => "Моля, въведете име на филма.",
            "movieName.max" => "Името на филма не трябва да надвишава 100 символа.",
            "year.required" => "Моля, въведете година на издаване на филма.",
            "director_id.required" => "Моля, изберете режисьор.",
            "director_id.exists" => "Избраният от вас режисьор не съществува.",
            "genre_id.required" => "Моля, изберете жанр.",
            "genre_id.exists" => "Избраният от вас жанр не съществува.",
            "language_id.required" => "Моля, изберете език.",
            "language_id.exists" => "Избраният от вас език не съществува.",
            "image.required" => "Моля, прикачете снимка на филма.",
            "image.image" => "Невалиден файлов формат. Валидни файлови формати: jpeg,png,jpg,gif",
            "image.max" => "Файлът не трябва да надвишава 3 MB."
        ]);

        $filePath = $request->file('image')->store('images', 'public');

        Movie::create([
            'movie_name' => $request->movieName,
            'year' => $request->year,
            'image_path' => $filePath,
            'user_id' => Auth::id(),
            'genre_id' => $request->genre_id,
            'director_id' => $request->director_id,
            'language_id' => $request->language_id
        ]);

        return redirect()->route('movies.index')->with('success', 'Филмът беше създаден успешно!');
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return redirect()->route('movies.index')->with('error', 'Не съществува такъв ресурс!');
        }

        if (Auth::user()->id != $movie->user_id) {
            return redirect()->route('movies.index')->with('error', 'Нямате достъп до този ресурс!');
        }

        $genres = Genre::orderBy('name', 'ASC')->get();
        $directors = Director::orderBy('first_name', 'ASC')->get();
        $languages = Language::all();
        return view('movies.edit', [
            "movie" => $movie,
            "genres" => $genres,
            "directors" => $directors,
            "languages" => $languages
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'movieName' => 'required|max:100',
            'year' => 'required',
            'director_id' => 'required|exists:directors,id',
            'genre_id' => 'required|exists:genres,id',
            'language_id' => 'required|exists:languages,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3096',
        ], [
            "movieName.required" => "Моля, въведете име на филма.",
            "movieName.max" => "Името на филма не трябва да надвишава 100 символа.",
            "year.required" => "Моля, въведете година на издаване на филма.",
            "director_id.required" => "Моля, изберете режисьор.",
            "director_id.exists" => "Избраният от вас режисьор не съществува.",
            "genre_id.required" => "Моля, изберете жанр.",
            "genre_id.exists" => "Избраният от вас жанр не съществува.",
            "language_id.required" => "Моля, изберете език.",
            "language_id.exists" => "Избраният от вас език не съществува.",
            "image.required" => "Моля, прикачете снимка на филма.",
            "image.image" => "Невалиден файлов формат. Валидни файлови формати: jpeg,png,jpg,gif",
            "image.max" => "Файлът не трябва да надвишава 3 MB."
        ]);

        $movie = Movie::find($id);
        $movie->movie_name = $request->movieName;
        $movie->year = $request->year;
        $movie->director_id = $request->director_id;
        $movie->genre_id = $request->genre_id;
        $movie->language_id = $request->language_id;

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
