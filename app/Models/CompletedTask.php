<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'tache_id',
        'user_id',
        'ferme_id',
        'nomtache',
        'completed_at',
        'race_id',
        'quantite', 'race_id'
    ];

    public function tache()
    {
        return $this->belongsTo(Tache::class, 'tache_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        public function race()
    {
        return $this->belongsTo(Race::class);
    }

}
