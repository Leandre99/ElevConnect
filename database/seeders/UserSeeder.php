<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123'),
            'role' => 'admin',
            'contact' => '61050590',
        ]);


        User::create([
            'name' => 'Aubierge EGUIN',
            'email' => 'aubiergeeguin@gmail.com',
            'password' => Hash::make('Aubiergeeguin123'),
            'role' => 'Eleveur',
            'description' => 'Eleveur passionné par l\'agriculture durable.',
            'contact' => '58967435',
        ]);

        User::create([
            'name' => 'Léandre ELISHA',
            'email' => 'leandreelisha20@gmail.com',
            'password' => Hash::make('Leandre123'),
            'role' => 'Eleveur',
            'description' => 'Eleveur passionné par l\'agriculture durable.',
            'contact' => '0161050590',
        ]);


        User::create([
            'name' => 'Dr TCHASSOU Kenneth',
            'email' => 'kennethtchassou@gmail.com',
            'password' => Hash::make('Kennethtchassou123'),
            'role' => 'Veterinaire',
            'description' => 'Ingénieur des travaux d\'levage(CPU/UAC 2004), Médecin Véterinaire (EISMV Dakar 2009, Responsable du Cabinet-Pharmacie Véterinaire et Compagnie Benin SARL)',
            'contact' => '96783756',
        ]);

        User::create([
            'name' => 'Dr Eustache ZINSOU',
            'email' => 'eustachezinsou@gmail.com',
            'password' => Hash::make('Eustachezinsou123'),
            'role' => 'Veterinaire',
            'description' => 'Vétérinaire et chercheur au BENIN, spécialisé dans la santé animale durable et l\'épidémiologie vétérinaire.',
            'contact' => '96783756',
        ]);

        User::create([
            'name' => 'Dr. Grace Kahindi',
            'email' => 'gracekahindi@gmail.com',
            'password' => Hash::make('Gracekahindi123'),
            'role' => 'Veterinaire',
            'description' => 'Vétérinaire au Kenya, experte en médecine vétérinaire et conservation de la faune sauvage.',
            'contact' => '96785249',
        ]);
    }
}
