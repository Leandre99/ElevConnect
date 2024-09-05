<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'week_start_date',
        'week_end_date',
        'completed_tasks',
        'total_tasks'
    ];

    protected $dates = [
        'week_start_date',
        'week_end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
