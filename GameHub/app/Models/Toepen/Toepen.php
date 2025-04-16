<?php

namespace App\Models\Toepen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toepen extends Model
{
    use HasFactory;

    protected $fillable = ['players', 'scores', 'status'];

    protected $casts = [
        'players' => 'array',
        'scores' => 'array',
    ];
}
