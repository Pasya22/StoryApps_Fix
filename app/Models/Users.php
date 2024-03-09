<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    public function rate()
    {
        return $this->hasMany(Rate::class, 'id');
    }
    public function preferredGenres()
    {
        return $this->belongsToMany(Genre::class, 'users', 'id', 'id_genre');
    }
}
