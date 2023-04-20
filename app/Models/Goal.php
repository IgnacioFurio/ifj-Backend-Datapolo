<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    public function players()
    {
        return $this->belongsTo(Player::class);
    }

    public function teams()
    {
        return $this->belongsTo(Team::class);
    }

    public function games()
    {
        $this->belongsTo(Game::class);
    }
}
