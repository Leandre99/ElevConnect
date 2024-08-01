<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomtache',
        'race_id',
        'frequence',
        'quantite',
        'type',
        'age_min',
        'age_max'
    ];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
