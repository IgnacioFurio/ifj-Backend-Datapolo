<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function teams_trophies()
    {
        return $this->hasMany(Team_Trophy::class);
    }

}
