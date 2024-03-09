<?php

namespace App\Models;

use App\Models\Story;
use App\Models\Users;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(Users::class, 'id');
    }
    public function story()
    {
        return $this->belongsTo(Story::class, 'id_story');
    }
}
