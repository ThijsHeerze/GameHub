<?php

namespace App\Models\PaardenRace;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = ['progress', 'deck', 'winner'];

    protected $casts = [
        'progress' => 'array',
        'deck' => 'array',
    ];
}
