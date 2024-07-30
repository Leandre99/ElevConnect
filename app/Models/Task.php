<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'race_id',
        'nomtache',
        'age_min',
        'age_max',
        'jour',
    ];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function completedTasks()
    {
        return $this->hasMany(CompletedTask::class);
    }
}
