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
        DB::table('tasks')->insert([
            // Tâches pour les poulets de chair (race_id = 1)
            ['race_id' => 1, 'nomtache' => 'Vérification de l\'eau et de la nourriture', 'age_min' => 0, 'age_max' => 7],
            ['race_id' => 1, 'nomtache' => 'Ajout de vitamines dans l\'eau', 'age_min' => 0, 'age_max' => 3],
            ['race_id' => 1, 'nomtache' => 'Vaccination contre la maladie de Newcastle', 'age_min' => 7, 'age_max' => 7],
            ['race_id' => 1, 'nomtache' => 'Vaccination contre la Gumboro', 'age_min' => 14, 'age_max' => 14],
            ['race_id' => 1, 'nomtache' => 'Administration de vermifuge', 'age_min' => 21, 'age_max' => 21],
            ['race_id' => 1, 'nomtache' => 'Vaccination contre la maladie de Newcastle (rappel)', 'age_min' => 28, 'age_max' => 28],
            ['race_id' => 1, 'nomtache' => 'Contrôle de la croissance et ajustement de l\'alimentation', 'age_min' => 29, 'age_max' => 42],
            // Tâches pour les Taureaux (race_id = 2)
            ['race_id' => 2, 'nomtache' => 'Alimentation matinale', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 2, 'nomtache' => 'Alimentation du soir','age_min' => 0, 'age_max' => 520],
            ['race_id' => 2, 'nomtache' => 'Vérification de la santé quotidienne','age_min' => 0, 'age_max' => 520],
            ['race_id' => 2, 'nomtache' => 'Vaccination', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 2, 'nomtache' => 'Contrôle de l\'eau', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 2, 'nomtache' => 'Nettoyage de l\'étable', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 2, 'nomtache' => 'Gestion des déchets','age_min' => 0, 'age_max' => 520],
            ['race_id' => 2, 'nomtache' => 'Inspection des sabots','age_min' => 0, 'age_max' => 520],
            ['race_id' => 2, 'nomtache' => 'Exercice physique','age_min' => 0, 'age_max' => 520],
            ['race_id' => 2, 'nomtache' => 'Inspection des cornes','age_min' => 0, 'age_max' => 520],
            // Tâches pour les Veaux (race_id = 3)
            ['race_id' => 3, 'nomtache' => 'Alimentation au lait', 'age_min' => 0, 'age_max' => 12],
            ['race_id' => 3, 'nomtache' => 'Alimentation en foin','age_min' => 0, 'age_max' => 520],
            ['race_id' => 3, 'nomtache' => 'Vérification de la santé quotidienne','age_min' => 0, 'age_max' => 520],
            ['race_id' => 3, 'nomtache' => 'Vaccination','age_min' => 0, 'age_max' => 520],
            ['race_id' => 3, 'nomtache' => 'Contrôle de l\'eau', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 3, 'nomtache' => 'Nettoyage de l\'étable','age_min' => 0, 'age_max' => 520],
            ['race_id' => 3, 'nomtache' => 'Gestion des déchets', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 3, 'nomtache' => 'Inspection des sabots','age_min' => 0, 'age_max' => 520],
            ['race_id' => 3, 'nomtache' => 'Pesée régulière','age_min' => 0, 'age_max' => 520],
            ['race_id' => 3, 'nomtache' => 'Surveillance des signes de maladie','age_min' => 0, 'age_max' => 520],
            // Tâches pour les chèvres djallonké
            ['race_id' => 6,'nomtache' => 'Alimentation matinale', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 6,'nomtache' => 'Alimentation du soir', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 6,'nomtache' => 'Vérification de la santé quotidienne', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 6,'nomtache' => 'Vaccination', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 6,'nomtache' => 'Contrôle de l\'eau', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 6,'nomtache' => 'Nettoyage de la bergerie', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 6,'nomtache' => 'Gestion des déchets', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 6,'nomtache' => 'Tonte', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 6,'nomtache' => 'Inspection des sabots', 'age_min' => 0, 'age_max' => 520],
            ['race_id' => 6,'nomtache' => 'Surveillance des naissances', 'age_min' => 0, 'age_max' => 520],
        ]);
    }
}
