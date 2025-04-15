<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = ['animal_id', 'maladie_id', 'veterinaire_id', 'alert_id', 'date', 'traitement'];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function maladie()
    {
        return $this->belongsTo(Maladie::class);
    }

    public function veterinaire()
    {
        return $this->belongsTo(User::class, 'veterinaire_id');
    }

    public function alerte()
    {
        return $this->belongsTo(Alert::class, 'alert_id');
    }
}
