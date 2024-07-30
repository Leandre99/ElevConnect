<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'age',
        'position_actuelle',
        'recommande',
        'plus_aime',
        'preferences',
        'commentaires',
    ];

    protected $casts = [
        'preferences' => 'array', // Ensure preferences are cast to array
    ];
}
