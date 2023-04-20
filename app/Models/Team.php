<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function matches()
    {
        return $this->hasMany(Game::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function trophies_teams()
    {
        return $this->hasMany(Team_Trophy::class);
    }
}
