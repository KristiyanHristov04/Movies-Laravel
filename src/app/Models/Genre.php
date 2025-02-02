<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function movies() {
        return $this->hasMany(Movie::class);
    }
}
