<?php

namespace App\Models\FTD;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'drinks', 'is_dealer'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
