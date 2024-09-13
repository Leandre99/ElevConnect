<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'priority', 'media', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function race()
{
    return $this->belongsTo(Race::class);
}

}
