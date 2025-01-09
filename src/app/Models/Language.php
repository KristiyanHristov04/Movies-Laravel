<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'language_name'
    ];

    public $timestamps = false;

    public function movies() {
        return $this->hasMany(Movie::class);
    }
}
