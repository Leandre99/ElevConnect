<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espece extends Model
{
    protected $fillable = [
        'nomespece',
    ];
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
