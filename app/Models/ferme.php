<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ferme extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomferme',
        'description',
        'adresse',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animaux()
    {
        return $this->hasMany(Animal::class);
    }
}
