<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    protected $table = 'tache';
    protected $fillable = [
        'nomtache', 'race_id', 'quantite', 'type', 'user_id', 'status', 'tache_id', 'ferme_id', 'affichage_date','expired_date'
    ];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function ferme()
    {
        return $this->belongsTo(Ferme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Tache::class, 'tache_id');
    }

    public function completedTasks()
{
    return $this->hasMany(CompletedTask::class, 'tache_id');
}


    public function animal()
        {
            return $this->belongsTo(Animal::class);
        }
        protected $casts = [
            'quantite' => 'string',
        ];
}
