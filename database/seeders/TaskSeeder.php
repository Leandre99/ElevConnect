<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $poulePondeuseId = DB::table('especes')->where('nomespece', 'Volaille')->value('id');

        DB::table('tasks')->insert([
            // ['age_min' => 0, 'age_max' => 7, 'frequence' => 'quotidien', 'jour' => 1, 'nomtache' => 'Vérification de l\'eau et de la nourriture', 'quantite' => 0, 'race_id' => 13, 'espece_id' => $poulePondeuseId, 'type' => 'Alimentation'],
            // ['age_min' => 0, 'age_max' => 3, 'frequence' => 'quotidien', 'jour' => 2, 'nomtache' => 'Ajout de vitamines dans l\'eau', 'quantite' => 0, 'race_id' => 13, 'espece_id' => $poulePondeuseId, 'type' => 'Alimentation'],
            // ['age_min' => 7, 'age_max' => 7, 'frequence' => 'unique', 'jour' => 3, 'nomtache' => 'Vaccination contre la maladie de Newcastle', 'quantite' => 1, 'race_id' => 13, 'espece_id' => $poulePondeuseId, 'type' => 'Soins'],
            // ['age_min' => 14, 'age_max' => 14, 'frequence' => 'unique', 'jour' => 4, 'nomtache' => 'Vaccination contre la Gumboro', 'quantite' => 1, 'race_id' => 13, 'espece_id' => $poulePondeuseId, 'type' => 'Soins'],
            // ['age_min' => 21, 'age_max' => 21, 'frequence' => 'unique', 'jour' => 5, 'nomtache' => 'Administration de vermifuge', 'quantite' => 1, 'race_id' => 13, 'espece_id' => $poulePondeuseId, 'type' => 'Soins'],
            // ['age_min' => 28, 'age_max' => 28, 'frequence' => 'unique', 'jour' => 6, 'nomtache' => 'Vaccination contre la maladie de Newcastle (rappel)', 'quantite' => 1, 'race_id' => 13, 'espece_id' => $poulePondeuseId, 'type' => 'Soins'],
            // ['age_min' => 29, 'age_max' => 42, 'frequence' => 'hebdomadaire', 'jour' => 7, 'nomtache' => 'Contrôle de la croissance et ajustement de l\'alimentation', 'quantite' => 0, 'race_id' => 13, 'espece_id' => $poulePondeuseId, 'type' => 'Alimentation'],

            // Tâches pour les Porcs Locaux (race_id = 1)
            ['race_id' => 8, 'nomtache' => 'Alimentation matinale', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 8, 'nomtache' => 'Alimentation du soir', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Alimentation', 'jour' => 2],
            ['race_id' => 8, 'nomtache' => 'Vérification de la santé', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Soins', 'jour' => 3],
            ['race_id' => 8, 'nomtache' => 'Vaccination', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'unique', 'quantite' => 1, 'type' => 'Soins', 'jour' => 4],
            ['race_id' => 8, 'nomtache' => 'Contrôle de l\'eau', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Environnement', 'jour' => 5],

            // Tâches pour les Vaches (race_id = 2)
            ['race_id' => 1, 'nomtache' => 'Alimentation matinale', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 1, 'nomtache' => 'Alimentation du soir', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Alimentation', 'jour' => 2],
            ['race_id' => 1, 'nomtache' => 'Vérification de la santé', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Soins', 'jour' => 3],
            ['race_id' => 1, 'nomtache' => 'Vaccination', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'unique', 'quantite' => 1, 'type' => 'Soins', 'jour' => 4],
            ['race_id' => 1, 'nomtache' => 'Nettoyage de l\'étable', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Environnement', 'jour' => 5],

            // Tâches pour les Pintades (race_id = 3)
            ['race_id' => 11, 'nomtache' => 'Alimentation matinale', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 11, 'nomtache' => 'Alimentation du soir', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Alimentation', 'jour' => 2],
            ['race_id' => 11, 'nomtache' => 'Vérification de la santé', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Soins', 'jour' => 3],
            ['race_id' => 11, 'nomtache' => 'Vaccination', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'unique', 'quantite' => 1, 'type' => 'Soins', 'jour' => 4],
            ['race_id' => 11, 'nomtache' => 'Contrôle de l\'eau', 'age_min' => 0, 'age_max' => 520, 'frequence' => 'quotidien', 'quantite' => 0, 'type' => 'Environnement', 'jour' => 5],
        ]);
    }
}
