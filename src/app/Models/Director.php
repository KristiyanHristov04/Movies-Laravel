<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'born_year',
        'about',
        'image_path'
    ];

    public function movies() {
        return $this->hasMany(Movie::class);
    }
}
