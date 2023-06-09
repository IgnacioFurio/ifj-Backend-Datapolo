<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
