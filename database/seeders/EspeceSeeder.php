<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EspeceSeeder extends Seeder
{

    public function run()
    {
        DB::table('especes')->insert([
            ['nomespece' => 'Bovins'],
            ['nomespece' => 'Ovins'],
            ['nomespece' => 'Caprins'],
            ['nomespece' => 'Porcs'],
            ['nomespece' => 'Volaille'],
        ]);
    }
}
