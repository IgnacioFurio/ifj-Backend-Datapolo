<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
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

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
