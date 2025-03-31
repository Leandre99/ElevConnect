<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinaire extends Model
{
    protected $fillable = [
        'name',
        'description',
        'contact',
        'role',
    ];
}
