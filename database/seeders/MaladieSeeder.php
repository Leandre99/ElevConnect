<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Maladie;
class MaladieSeeder extends Seeder
{
    public function run()
{
    $maladies = [
        [
            'nom' => 'Fièvre aphteuse',
            'symptomes' => 'Fièvre, bave, boiterie',
            'espece_id' => 1
        ],
        [
            'nom' => 'Maladie de Newcastle',
            'symptomes' => 'Éternuements, diarrhée verte',
            'espece_id' => 5
        ]
    ];

    foreach ($maladies as $maladie) {
        Maladie::create($maladie);
    }
}
}
