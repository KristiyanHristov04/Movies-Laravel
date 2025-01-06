<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'movie_name',
        'year',
        'director',
        'genre',
        'language',
        'image_path',
    ];
}
