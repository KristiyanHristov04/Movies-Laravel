<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $totalMovies = Movie::all()->count();
        $totalDirectors = Director::all()->count();
        $totalGenres = Genre::all()->count();
        $totalUsers = User::all()->count();
        
        return view('admin.index', [
            'moviesCount' => $totalMovies,
            'directorsCount' => $totalDirectors,
            'genresCount' => $totalGenres,
            'usersCount' => $totalUsers,
        ]);
    }
}
