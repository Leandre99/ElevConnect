<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    protected $fillable = ['animal_id', 'maladie_id', 'date'];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function maladie()
    {
        return $this->belongsTo(Maladie::class);
    }
}
