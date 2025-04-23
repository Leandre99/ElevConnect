<?php

namespace App\Models;
use App\Models\Meetings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'priority', 'media', 'user_id', 'race_id', 'ferme_id','is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function ferme()
    {
        return $this->belongsTo(Ferme::class);
    }

    public function diagnostics()
    {
        return $this->hasMany(Diagnostic::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
    public function getStatutAttribute()
{
    return $this->diagnostics()->exists() ? 'Traitée' : 'Non traitée';
}

}

