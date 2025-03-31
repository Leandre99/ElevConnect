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
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    public function races()
    {
        return $this->belongsToMany(Race::class);
    }
    public function tache()
    {
        return $this->hasMany(Tache::class);
    }

}
