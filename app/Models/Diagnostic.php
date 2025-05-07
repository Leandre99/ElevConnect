<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = ['maladie_id', 'veterinaire_id', 'alert_id','traitement', 'nom_autre_maladie', 'symptomes_autre'];

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

    public function race()
    {
        return $this->hasOneThrough(Race::class, Alert::class, 'id', 'id', 'alert_id', 'race_id');
    }

    public function ferme()
    {
        return $this->hasOneThrough(Ferme::class, Alert::class, 'id', 'id', 'alert_id', 'ferme_id');
    }
}

