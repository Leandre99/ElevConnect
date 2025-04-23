<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'alert_id',
        'meeting_date',
        'meeting_url',
    ];

    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }
}