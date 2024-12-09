<?php

namespace App\Models\FTD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['status'];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function turns()
    {
        return $this->hasMany(Turn::class);
    }
}
