<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $fillable = [
        'admin_id',
        'action',
        'model',
        'model_id',
        'details'
    ];
    public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}

}
