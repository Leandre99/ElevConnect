<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RaceSeeder extends Seeder
{
    public function run()
    {
        DB::table('races')->insert([
            ['espece_id' => 1, 'nomrace' => 'Vache'],
            ['espece_id' => 1, 'nomrace' => 'Taureaux'],
            ['espece_id' => 1, 'nomrace' => 'Veau'],
            ['espece_id' => 2, 'nomrace' => 'Balibali'],
            ['espece_id' => 2, 'nomrace' => 'Autres'],
            ['espece_id' => 3, 'nomrace' => 'Chèvre Djallonké'],
            ['espece_id' => 3, 'nomrace' => 'Chèvre du Sahel'],
            ['espece_id' => 4, 'nomrace' => 'Porc Local'],
            ['espece_id' => 4, 'nomrace' => 'Porc Landrace'],
            ['espece_id' => 4, 'nomrace' => 'Autre'],
            ['espece_id' => 5, 'nomrace' => 'Pintade'],
            ['espece_id' => 5, 'nomrace' => 'Poulet de chair'],
            ['espece_id' => 5, 'nomrace' => 'Poule pondeuse'],
            ['espece_id' => 5, 'nomrace' => 'Dinde'],
            ['espece_id' => 5, 'nomrace' => 'Poulet locale (Bicyclette)'],
        ]);
    }
}
