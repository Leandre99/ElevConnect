<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReport extends Model
{
    use HasFactory;

    // Champs qui peuvent être assignés en masse
    protected $fillable = [
        'user_id',
        'week_start_date',
        'week_end_date',
        'completed_tasks',
        'total_tasks'
    ];

    // Définir les dates pour les attributs date
    protected $dates = [
        'week_start_date',
        'week_end_date'
    ];

    // Optionnel : Si tu souhaites définir des relations, fais-le ici
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
