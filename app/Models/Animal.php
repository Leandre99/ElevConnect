<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'espece_id', 'race_id', 'age', 'nombre', 'ferme_id'
    ];

    public function espece()
    {
        return $this->belongsTo(Espece::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function ferme()
    {
        return $this->belongsTo(Ferme::class);
    }

    public function tache()
    {
        return $this->hasMany(Tache::class);
    }

    public function alerts()
{
    return $this->hasMany(Alert::class);
}

    public function diagnostics()
    {
        return $this->hasMany(Diagnostic::class);
    }
}
