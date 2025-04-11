<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function maladie()
    {
        return $this->belongsTo(Maladie::class);
    }
}
