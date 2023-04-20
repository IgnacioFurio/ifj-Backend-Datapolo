<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trophy extends Model
{
    use HasFactory;

    public function teams_trophies()
    {
        return $this->hasMany(Team_Trophy::class);
    }
}
