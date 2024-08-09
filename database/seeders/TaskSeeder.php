<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run()
    {
        // Insérer les tâches avec les ids d'espèces corrects
        DB::table('tasks')->insert([

            // Pour les Porcs Locaux (race_id = 4)
            ['race_id' => 4, 'espece_id' => 4, 'nomtache' => 'Vaccination contre la Peste Porcine Classique', 'age_min' => 0, 'age_max' => 30, 'frequence' => 3, 'quantite' => 1, 'type' => 'Soins', 'jour' => 4],
            ['race_id' => 4, 'espece_id' => 4, 'nomtache' => 'Vaccination contre la Peste Porcine Africaine', 'age_min' => 30, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],
            ['race_id' => 4, 'espece_id' => 4, 'nomtache' => 'Vaccination contre la Leptospirose', 'age_min' => 120, 'age_max' => 365, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 180],

            // Pour les Vaches (race_id = 1)
            ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Brucellose', 'age_min' => 0, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Leucose Bovine', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Fièvre Catarrhale', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

            // Pour les Pintades (race_id = 11)
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Nouvelle-Castellose', 'age_min' => 0, 'age_max' => 15, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 15],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Maladie de Marek', 'age_min' => 15, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Coccidiose', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],

            // Pour les Taureaux (race_id = 2)
            ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Brucellose', 'age_min' => 0, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Leucose Bovine', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Fièvre Catarrhale', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

            // Pour les Veaux (race_id = 3)
            ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Brucellose', 'age_min' => 0, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Leucose Bovine', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Fièvre Catarrhale', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

            // Pour les Balibalis (race_id = 4)
            ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Vaccination contre la Fièvre Q', 'age_min' => 0, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Vaccination contre la Leucose', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Vaccination contre la Fièvre Catarrhale', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

            // Pour les Chèvres Djallonké (race_id = 5)
            ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Peste des Petits Ruminants', 'age_min' => 0, 'age_max' => 30, 'frequence' => 3, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Fièvre de la Vallée du Rift', 'age_min' => 30, 'age_max' => 60, 'frequence' => 3, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Brucellose', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

            // Pour les Chèvres du Sahel (race_id = 6)
            ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Peste des Petits Ruminants', 'age_min' => 0, 'age_max' => 30, 'frequence' => 3, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Fièvre de la Vallée du Rift', 'age_min' => 30, 'age_max' => 60, 'frequence' => 3, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Brucellose', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

            // Pour les Poules Pondues (race_id = 7)
            ['race_id' => 7, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Maladie de Marek', 'age_min' => 0, 'age_max' => 15, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 15],
            ['race_id' => 7, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Coccidiose', 'age_min' => 15, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 7, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Nouvelle-Castellose', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],

            // Pour les Dindes (race_id = 8)
            ['race_id' => 8, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Nouvelle-Castellose', 'age_min' => 0, 'age_max' => 15, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 15],
            ['race_id' => 8, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Coccidiose', 'age_min' => 15, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 8, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Maladie de Marek', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],

            // Pour les Poulets Locaux (Bicyclette) (race_id = 9)
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Nouvelle-Castellose', 'age_min' => 0, 'age_max' => 15, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 15],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Maladie de Marek', 'age_min' => 15, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Coccidiose', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],

            // Pour les Poulets de Chair (race_id = 10)
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Maladie de Marek', 'age_min' => 0, 'age_max' => 15, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 15],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Coccidiose', 'age_min' => 15, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Nouvelle-Castellose', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
        ]);
    }
}
