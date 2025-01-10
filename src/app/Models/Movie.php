<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'movie_name',
        'year',
        'image_path',
        'user_id',
        'genre_id',
        'director_id',
        'language_id',
        'trailer_youtube_link'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function director() {
        return $this->belongsTo(Director::class);
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function language() {
        return $this->belongsTo(Language::class);
    }
}
