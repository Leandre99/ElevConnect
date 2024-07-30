<?php

namespace App\Models;

use App\Models\ferme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Race extends Model
{
    protected $fillable = [
        'especes_id',
        'nomrace',];

        public function espece()
        {
            return $this->belongsTo(Espece::class);
        }

        public function tasks()
        {
            return $this->hasMany(Task::class);
        }

        public function ferme()
        {
            return $this->hasMany(ferme::class);
        }
}
