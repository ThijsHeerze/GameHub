<?php

namespace App\Models\Whist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhistRound extends Model
{
    use HasFactory;

    protected $fillable = ['round_number'];

    public function players()
    {
        return $this->hasMany(WhistPlayer::class);
    }
}
