<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public function rate()
    {
        return $this->hasMany(Rate::class, 'id');
    }
    public function users()
    {
        return $this->belongsToMany(Users::class, 'users', 'id_genre', 'id');
    }
}
