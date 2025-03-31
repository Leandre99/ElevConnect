<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AnimalSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EspeceSeeder::class,
            RaceSeeder::class,
            TaskSeeder::class,
            TacheSeeder::class,
        ]);
    }
}
