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
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }
}
