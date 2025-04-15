<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maladie extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = ['nom', 'symptomes', 'race_id'];

    public function diagnostics()
    {
        return $this->hasMany(Diagnostic::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
