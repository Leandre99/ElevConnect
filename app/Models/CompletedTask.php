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
        'completed_at',
    ];

    public function task()
{
    return $this->belongsTo(Tache::class, 'task_id');
}


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
