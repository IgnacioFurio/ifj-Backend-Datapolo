<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team_Trophy extends Model
{
    use HasFactory;

    public function teams()
    {
        return $this->belongsTo(Team::class);
    }

    public function seasons()
    {
        return $this->belongsTo(Season::class);
    }

    public function trophies()
    {
        return $this->belongsTo(Trophy::class);
    }

}
