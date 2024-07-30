<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ferme extends Model
{
        protected $fillable = [
        'nomferme',
        'especes',
        'race',
        'agemoyen',
        'nombre_animaux',
        'user_id'];

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        public function races(): BelongsTo
        {
            return $this->belongsTo(Race::class,'race');
        }
}
