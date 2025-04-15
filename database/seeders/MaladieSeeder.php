<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maladie;

class MaladieSeeder extends Seeder
{
    public function run()
    {
        $maladies = [
            // Vache (id: 1)
            ['nom' => 'Fièvre aphteuse', 'symptomes' => 'Fièvre, bave, boiterie', 'race_id' => 1],
            ['nom' => 'Brucellose', 'symptomes' => 'Avortement, fièvre, perte d’appétit', 'race_id' => 1],

            // Taureaux (id: 2)
            ['nom' => 'Dermatose nodulaire', 'symptomes' => 'Nodules sur la peau, fièvre', 'race_id' => 2],
            ['nom' => 'Actinomycose', 'symptomes' => 'Gonflement de la mâchoire', 'race_id' => 2],

            // Veau (id: 3)
            ['nom' => 'Diarrhée néonatale', 'symptomes' => 'Diarrhée, déshydratation', 'race_id' => 3],
            ['nom' => 'Pneumonie néonatale', 'symptomes' => 'Toux, respiration rapide', 'race_id' => 3],

            // Balibali (id: 4)
            ['nom' => 'Trypanosomiase', 'symptomes' => 'Amaigrissement, fièvre intermittente', 'race_id' => 4],

            // Chèvre Djallonké (id: 5)
            ['nom' => 'PPR (Peste des petits ruminants)', 'symptomes' => 'Écoulements nasaux, diarrhée', 'race_id' => 5],

            // Chèvre du Sahel (id: 6)
            ['nom' => 'Fièvre de la vallée du Rift', 'symptomes' => 'Avortements, fièvre, saignement', 'race_id' => 6],

            // Porc Local (id: 7)
            ['nom' => 'Rouget du porc', 'symptomes' => 'Rougeur de la peau, fièvre', 'race_id' => 7],

            // Porc Landrace (id: 8)
            ['nom' => 'Gastro-entérite transmissible', 'symptomes' => 'Diarrhée, vomissements', 'race_id' => 8],

            // Pintade (id: 9)
            ['nom' => 'Coryza infectieux', 'symptomes' => 'Écoulements oculaires, éternuement', 'race_id' => 9],

            // Poulet de chair (id: 10)
            ['nom' => 'Maladie de Newcastle', 'symptomes' => 'Éternuement, paralysie, diarrhée verte', 'race_id' => 10],

            // Poule pondeuse (id: 11)
            ['nom' => 'Salmonellose', 'symptomes' => 'Diarrhée, chute de ponte', 'race_id' => 11],

            // Dinde (id: 12)
            ['nom' => 'Histomonose (Blackhead)', 'symptomes' => 'Diarrhée jaune, léthargie', 'race_id' => 12],

            // Poulet locale (id: 13)
            ['nom' => 'Variole aviaire', 'symptomes' => 'Lésions cutanées, croûtes sur la tête', 'race_id' => 13],
        ];

        foreach ($maladies as $maladie) {
            Maladie::create($maladie);
        }
    }
}
