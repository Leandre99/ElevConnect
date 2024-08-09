<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomtache',
        'espece_id',
        'race_id',
        'frequence',
        'quantite',
        'type',
        'age_min',
        'age_max',
        'jour',
        'expired_date'
    ];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function espece()
    {
        return $this->belongsTo(Espece::class);
    }

    public function tache()
{
    return $this->hasMany(Tache::class);
}

}
