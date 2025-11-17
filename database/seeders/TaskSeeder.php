<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->insert( [

            //Pour les Porcs Locaux (race_id = 7)
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Vaccination contre la Peste Porcine Classique', 'age_min' => 0, 'age_max' => 30, 'frequence' => 3, 'quantite' => 1, 'type' => 'Soins', 'jour' => 4],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Vaccination contre la Peste Porcine Africaine', 'age_min' => 30, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Vaccination contre la Leptospirose', 'age_min' => 120, 'age_max' => 365, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 180],

             //Pour les Vaches (race_id = 1)
            ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Brucellose', 'age_min' => 0, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Leucose Bovine', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Fièvre Catarrhale', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

             //Pour les Pintades (race_id = 9)
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Nouvelle-Castellose', 'age_min' => 0, 'age_max' => 15, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 15],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Maladie de Marek', 'age_min' => 15, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Coccidiose', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],

            //Pour les Taureaux (race_id = 2)
            ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Brucellose', 'age_min' => 0, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Leucose Bovine', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Fièvre Catarrhale', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

             //Pour les Veaux (race_id = 3)
            ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Brucellose', 'age_min' => 0, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Leucose Bovine', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Vaccination contre la Fièvre Catarrhale', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

            //Pour les Balibalis (race_id = 4)
            ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Vaccination contre la Fièvre Q', 'age_min' => 0, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Vaccination contre la Leucose', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Vaccination contre la Fièvre Catarrhale', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

             //Pour les Chèvres Djallonké (race_id = 5)
            ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Peste des Petits Ruminants', 'age_min' => 0, 'age_max' => 30, 'frequence' => 3, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Fièvre de la Vallée du Rift', 'age_min' => 30, 'age_max' => 60, 'frequence' => 3, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Brucellose', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

            //Pour les Chèvres du Sahel (race_id = 6)
            ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Peste des Petits Ruminants', 'age_min' => 0, 'age_max' => 30, 'frequence' => 3, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Fièvre de la Vallée du Rift', 'age_min' => 30, 'age_max' => 60, 'frequence' => 3, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],
            ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Vaccination contre la Brucellose', 'age_min' => 60, 'age_max' => 120, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 90],

            //Pour les Poules Pondeuses (race_id = 11)
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Maladie de Marek', 'age_min' => 0, 'age_max' => 15, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 15],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Coccidiose', 'age_min' => 15, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Nouvelle-Castellose', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],

            //Pour les Dindes (race_id = 12)
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Nouvelle-Castellose', 'age_min' => 0, 'age_max' => 15, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 15],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Coccidiose', 'age_min' => 15, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Maladie de Marek', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],

             //Pour les Poulets Locaux (Bicyclette) (race_id = 13)
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Nouvelle-Castellose', 'age_min' => 0, 'age_max' => 15, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 15],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Maladie de Marek', 'age_min' => 15, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Coccidiose', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],

            //Pour les Poulets de Chair (race_id = 10)
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Maladie de Marek', 'age_min' => 0, 'age_max' => 15, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 15],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Coccidiose', 'age_min' => 15, 'age_max' => 30, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 30],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Vaccination contre la Nouvelle-Castellose', 'age_min' => 30, 'age_max' => 60, 'frequence' => 1, 'quantite' => 1, 'type' => 'Soins', 'jour' => 60],


                    //Pour les vaches de race 1
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 0, 'age_max' => 4, 'frequence' => 1, 'quantite' => '1 kg de lait en poudre + 200 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 5, 'age_max' => 8, 'frequence' => 1, 'quantite' => '2 kg de fourrage + 300 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 9, 'age_max' => 16, 'frequence' => 1, 'quantite' => '3 kg de fourrage + 400 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 17, 'age_max' => 52, 'frequence' => 1, 'quantite' => '4 kg de fourrage + 500 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 53, 'age_max' => 104, 'frequence' => 1, 'quantite' => '5 kg de fourrage + 600 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 105, 'age_max' => 365, 'frequence' => 1, 'quantite' => '6 kg de fourrage + 700 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Vérifier la Propreté de l’Enclos', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet de l’enclos', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Contrôler le Niveau d’Eau', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Vérification et remplissage des abreuvoirs', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Vérifier la Santé des Animaux', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel et palpation', 'type' => 'Santé', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Contrôler l\'État des Équipements de Traite', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Inspection et maintenance des équipements', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Gérer les Déchets', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Collecte et élimination des déchets', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 1, 'espece_id' => 1, 'nomtache' => 'Contrôler les Parasites Externes', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Inspection régulière pour détecter les parasites externes', 'type' => 'Santé', 'jour' => 1],

                    //Pour les Taureaux (race_id = 2)
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 0, 'age_max' => 4, 'frequence' => 1, 'quantite' => '1 kg de concentré + 1 kg de fourrage', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 5, 'age_max' => 8, 'frequence' => 1, 'quantite' => '2 kg de concentré + 2 kg de fourrage', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 9, 'age_max' => 16, 'frequence' => 1, 'quantite' => '3 kg de concentré + 3 kg de fourrage', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 17, 'age_max' => 52, 'frequence' => 1, 'quantite' => '4 kg de concentré + 4 kg de fourrage', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 53, 'age_max' => 104, 'frequence' => 1, 'quantite' => '5 kg de concentré + 5 kg de fourrage', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Alimentation Quotidienne', 'age_min' => 105, 'age_max' => 365, 'frequence' => 1, 'quantite' => '6 kg de concentré + 6 kg de fourrage', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Vérifier la Propreté de l’Enclos', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet de l’enclos', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Contrôler le Niveau d’Eau', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Vérification et remplissage des abreuvoirs', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Vérifier la Santé des Animaux', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel et palpation', 'type' => 'Santé', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Contrôler l\'État des Équipements de Traite', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Inspection et maintenance des équipements', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Gérer les Déchets', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Collecte et élimination des déchets', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Planifier des Examens Vétérinaires', 'age_min' => 0, 'age_max' => 365, 'frequence' => 5, 'quantite' => 'Organisation des visites vétérinaires régulières', 'type' => 'Santé', 'jour' => 1],
                    ['race_id' => 2, 'espece_id' => 1, 'nomtache' => 'Contrôler les Parasites Externes', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Inspection régulière pour détecter les parasites externes', 'type' => 'Santé', 'jour' => 1],

                // Pour les Veaux (race_id = 3)
                ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Nourrir les Veaux', 'age_min' => 0, 'age_max' => 6, 'frequence' => 1, 'quantite' => '3 kg de lait maternisé pour veaux', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Nourrir les Veaux', 'age_min' => 7, 'age_max' => 24, 'frequence' => 1, 'quantite' => '6 kg de foin et 1 kg de concentré pour jeunes veaux', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Nourrir les Veaux', 'age_min' => 25, 'age_max' => 365, 'frequence' => 1, 'quantite' => '12 kg de foin et 2 kg de concentré pour veaux', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Nettoyer les Écuries des Veaux', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet', 'type' => 'Environnement', 'jour' => 1],
                ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Vérifier l\'Abreuvement des Veaux', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'S\'assurer que l\'eau est propre', 'type' => 'Environnement', 'jour' => 1],
                ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Inspecter les Veaux pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien', 'type' => 'Santé', 'jour' => 1],
                ['race_id' => 3, 'espece_id' => 1, 'nomtache' => 'Vérifier la Propreté des Équipements de Nourriture', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage et désinfection', 'type' => 'Environnement', 'jour' => 1],

                 //Balibali
                    ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Nourrir les Ovins Balibali', 'age_min' => 0, 'age_max' => 6, 'frequence' => 1, 'quantite' => '4 kg de lait maternisé pour agneaux', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Nourrir les Ovins Balibali', 'age_min' => 7, 'age_max' => 24, 'frequence' => 1, 'quantite' => '8 kg de foin et 1.5 kg de concentré pour jeunes ovins', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Nourrir les Ovins Balibali', 'age_min' => 25, 'age_max' => 365, 'frequence' => 1, 'quantite' => '15 kg de foin et 3 kg de concentré pour ovins', 'type' => 'Alimentation', 'jour' => 1],
                    ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Nettoyer les Bergeries', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet des sols et des équipements', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Vérifier l\'Abreuvement', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'S\'assurer que l\'eau est propre et renouvelée', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Inspecter les Ovins pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien', 'type' => 'Santé', 'jour' => 1],
                    ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Vérifier les Équipements de Nourriture', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage et désinfection', 'type' => 'Environnement', 'jour' => 1],
                    ['race_id' => 4, 'espece_id' => 2, 'nomtache' => 'Appliquer les Vaccins', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Administration selon le calendrier vaccinal', 'type' => 'Santé', 'jour' => 1],

                //Pour les Chèvres (race_id = 5)
                ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Nourrir les Chèvres ', 'age_min' => 4, 'age_max' => 6, 'frequence' => 1, 'quantite' => '2.5 kg de fourrage + 300 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Nourrir les Chèvres ', 'age_min' => 7, 'age_max' => 12, 'frequence' => 1, 'quantite' => '4 kg de fourrage + 500 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Nourrir les Chèvres ', 'age_min' => 13, 'age_max' => 24, 'frequence' => 1, 'quantite' => '6 kg de fourrage + 700 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Nourrir les Chèvres ', 'age_min' => 25, 'age_max' => 365, 'frequence' => 1, 'quantite' => '8 kg de fourrage + 1 kg de concentré', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Nettoyer les Écuries des Chèvres', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet des sols et équipements', 'type' => 'Environnement', 'jour' => 1],
                ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Vérifier l\'Abreuvement des Chèvres', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'S\'assurer que l\'eau est propre et renouvelée', 'type' => 'Environnement', 'jour' => 1],
                ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Inspecter les Chèvres pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien et palpation', 'type' => 'Santé', 'jour' => 1],
                ['race_id' => 5, 'espece_id' => 3, 'nomtache' => 'Vérifier les Équipements de Nourriture', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage et désinfection réguliers', 'type' => 'Environnement', 'jour' => 1],

                ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Nourrir les Chèvres ', 'age_min' => 0, 'age_max' => 3, 'frequence' => 1, 'quantite' => '2 kg de lait maternisé + 300 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Nourrir les Chèvres ', 'age_min' => 4, 'age_max' => 6, 'frequence' => 1, 'quantite' => '3 kg de fourrage + 400 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Nourrir les Chèvres ', 'age_min' => 7, 'age_max' => 12, 'frequence' => 1, 'quantite' => '5 kg de fourrage + 600 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Nourrir les Chèvres ', 'age_min' => 13, 'age_max' => 24, 'frequence' => 1, 'quantite' => '8 kg de fourrage + 800 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Nourrir les Chèvres ', 'age_min' => 25, 'age_max' => 365, 'frequence' => 1, 'quantite' => '10 kg de fourrage + 1 kg de concentré', 'type' => 'Alimentation', 'jour' => 1],
                ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Nettoyer les Écuries des Chèvres', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet des sols et équipements', 'type' => 'Environnement', 'jour' => 1],
                ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Vérifier l\'Abreuvement des Chèvres', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'S\'assurer que l\'eau est propre et renouvelée', 'type' => 'Environnement', 'jour' => 1],
                ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Inspecter les Chèvres pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien et palpation', 'type' => 'Santé', 'jour' => 1],
                ['race_id' => 6, 'espece_id' => 3, 'nomtache' => 'Vérifier les Équipements de Nourriture', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage et désinfection réguliers', 'type' => 'Environnement', 'jour' => 1],

                //Pour les Porcs Locaux (race_id = 8)
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs ', 'age_min' => 0, 'age_max' => 4, 'frequence' => 1, 'quantite' => '2 kg de lait maternisé + 300 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs ', 'age_min' => 5, 'age_max' => 8, 'frequence' => 1, 'quantite' => '4 kg de fourrage + 500 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs ', 'age_min' => 9, 'age_max' => 16, 'frequence' => 1, 'quantite' => '6 kg de fourrage + 700 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs ', 'age_min' => 17, 'age_max' => 52, 'frequence' => 1, 'quantite' => '8 kg de fourrage + 900 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs ', 'age_min' => 53, 'age_max' => 104, 'frequence' => 1, 'quantite' => '10 kg de fourrage + 1 kg de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs ', 'age_min' => 105, 'age_max' => 365, 'frequence' => 1, 'quantite' => '12 kg de fourrage + 1.2 kg de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Nettoyer les Écuries des Porcs', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet des sols et équipements', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Vérifier l\'Abreuvement des Porcs', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'S\'assurer que l\'eau est propre et renouvelée', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Inspecter les Porcs pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien et palpation', 'type' => 'Santé', 'jour' => 1],
            ['race_id' => 7, 'espece_id' => 4, 'nomtache' => 'Vérifier les Équipements de Nourriture', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage et désinfection réguliers', 'type' => 'Environnement', 'jour' => 1],

            //Pour les Porcs Landrace (race_id = 9)
            ['race_id' => 8, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs', 'age_min' => 0, 'age_max' => 4, 'frequence' => 1, 'quantite' => '3 kg de lait maternisé + 400 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 8, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs', 'age_min' => 5, 'age_max' => 8, 'frequence' => 1, 'quantite' => '5 kg de fourrage + 600 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 8, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs', 'age_min' => 9, 'age_max' => 16, 'frequence' => 1, 'quantite' => '8 kg de fourrage + 800 g de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 8, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs', 'age_min' => 17, 'age_max' => 52, 'frequence' => 1, 'quantite' => '10 kg de fourrage + 1 kg de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 8, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs', 'age_min' => 53, 'age_max' => 104, 'frequence' => 1, 'quantite' => '12 kg de fourrage + 1.2 kg de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 8, 'espece_id' => 4, 'nomtache' => 'Nourrir les Porcs', 'age_min' => 105, 'age_max' => 365, 'frequence' => 1, 'quantite' => '15 kg de fourrage + 1.5 kg de concentré', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 8, 'espece_id' => 4, 'nomtache' => 'Nettoyer les Écuries des Porcs', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet des sols et équipements', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 8, 'espece_id' => 4, 'nomtache' => 'Vérifier l\'Abreuvement des Porcs', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'S\'assurer que l\'eau est propre et renouvelée', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 8, 'espece_id' => 4, 'nomtache' => 'Inspecter les Porcs pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien et palpation', 'type' => 'Santé', 'jour' => 1],
            ['race_id' => 8, 'espece_id' => 4, 'nomtache' => 'Vérifier les Équipements de Nourriture', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage et désinfection réguliers', 'type' => 'Environnement', 'jour' => 1],

            // Pour les Pintades (race_id = 9)
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Nourrir les Pintades', 'age_min' => 0, 'age_max' => 6, 'frequence' => 1, 'quantite' => '150 g de mélange pour pintades', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Nourrir les Pintades', 'age_min' => 5, 'age_max' => 12, 'frequence' => 1, 'quantite' => '200 g de mélange pour pintades', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Nourrir les Pintades', 'age_min' => 13, 'age_max' => 20, 'frequence' => 1, 'quantite' => '250 g de mélange pour pintades', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Nourrir les Pintades', 'age_min' => 21, 'age_max' => 52, 'frequence' => 1, 'quantite' => '300 g de mélange pour pintades', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Nourrir les Pintades', 'age_min' => 53, 'age_max' => 365, 'frequence' => 1, 'quantite' => '350 g de mélange pour pintades', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Nettoyer le Poulailler', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet du poulailler', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Vérifier l\'Abreuvement', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Assurer la propreté et le niveau d\'eau', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Inspecter les Pintades pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien', 'type' => 'Santé', 'jour' => 1],
            ['race_id' => 9, 'espece_id' => 5, 'nomtache' => 'Vérifier les Équipements de Nourriture', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage et maintenance des équipements', 'type' => 'Environnement', 'jour' => 1],

            // Pour les Poulets de Chair (race_id = 10)
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Nourrir les Poulets de Chair', 'age_min' => 0, 'age_max' => 7, 'frequence' => 1, 'quantite' => '200 g de starter par poulet', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Nourrir les Poulets de Chair', 'age_min' => 8, 'age_max' => 14, 'frequence' => 1, 'quantite' => '300 g de grower par poulet', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Nourrir les Poulets de Chair', 'age_min' => 15, 'age_max' => 21, 'frequence' => 1, 'quantite' => '400 g de finisher par poulet', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Nettoyer le Poulailler', 'age_min' => 0, 'age_max' => 21, 'frequence' => 1, 'quantite' => 'Nettoyage complet et désinfection', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Vérifier l\'Abreuvement', 'age_min' => 0, 'age_max' => 21, 'frequence' => 1, 'quantite' => 'Assurer la propreté et le niveau d\'eau', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Inspecter les Poulets de Chair pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 21, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien', 'type' => 'Santé', 'jour' => 1],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Vérifier les Équipements de Nourriture', 'age_min' => 0, 'age_max' => 21, 'frequence' => 1, 'quantite' => 'Nettoyage et maintenance des équipements', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 10, 'espece_id' => 5, 'nomtache' => 'Gérer les Déchets du Poulailler', 'age_min' => 0, 'age_max' => 21, 'frequence' => 1, 'quantite' => 'Collecte et élimination des déchets', 'type' => 'Environnement', 'jour' => 1],

            // Pour les Poules Pondeuses (race_id = 11)
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Nourrir les Poules Pondeuses', 'age_min' => 0, 'age_max' => 8, 'frequence' => 1, 'quantite' => '150 g de starter pour poules pondeuses', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Nourrir les Poules Pondeuses', 'age_min' => 9, 'age_max' => 16, 'frequence' => 1, 'quantite' => '200 g de grower pour poules pondeuses', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Nourrir les Poules Pondeuses', 'age_min' => 17, 'age_max' => 365, 'frequence' => 1, 'quantite' => '250 g de layer feed par poule', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Nettoyer le Poulailler', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet et désinfection', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Vérifier l\'Abreuvement', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Assurer la propreté et le niveau d\'eau', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Inspecter les Poules Pondeuses pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien', 'type' => 'Santé', 'jour' => 1],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Vérifier les Équipements de Nourriture', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage et maintenance des équipements', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 11, 'espece_id' => 5, 'nomtache' => 'Gérer les Déchets du Poulailler', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Collecte et élimination des déchets', 'type' => 'Environnement', 'jour' => 1],

            // Pour les Dindes (race_id = 12)
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Nourrir les Dindes', 'age_min' => 0, 'age_max' => 4, 'frequence' => 1, 'quantite' => '200 g de starter pour dindons', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Nourrir les Dindes', 'age_min' => 5, 'age_max' => 8, 'frequence' => 1, 'quantite' => '300 g de grower pour dindons', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Nourrir les Dindes', 'age_min' => 9, 'age_max' => 16, 'frequence' => 1, 'quantite' => '400 g de finisher pour dindons', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Nettoyer le Poulailler', 'age_min' => 0, 'age_max' => 16, 'frequence' => 1, 'quantite' => 'Nettoyage complet et désinfection', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Vérifier l\'Abreuvement', 'age_min' => 0, 'age_max' => 16, 'frequence' => 1, 'quantite' => 'Assurer la propreté et le niveau d\'eau', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Inspecter les Dindes pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 16, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien', 'type' => 'Santé', 'jour' => 1],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Vérifier les Équipements de Nourriture', 'age_min' => 0, 'age_max' => 16, 'frequence' => 1, 'quantite' => 'Nettoyage et maintenance des équipements', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Gérer les Déchets du Poulailler', 'age_min' => 0, 'age_max' => 16, 'frequence' => 1, 'quantite' => 'Collecte et élimination des déchets', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Contrôler les Apports en Minéraux', 'age_min' => 0, 'age_max' => 16, 'frequence' => 1, 'quantite' => 'Distribution régulière de minéraux', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Vérifier la Qualité de la Litière', 'age_min' => 0, 'age_max' => 16, 'frequence' => 1, 'quantite' => 'Contrôle et ajout de litière si nécessaire', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 12, 'espece_id' => 5, 'nomtache' => 'Contrôler l\'État des Abreuvoirs', 'age_min' => 0, 'age_max' => 16, 'frequence' => 1, 'quantite' => 'Vérification régulière de l’état des abreuvoirs', 'type' => 'Environnement', 'jour' => 1],

            // Pour les Poulets Locaux (race_id = 13)
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Nourrir les Poulets Locaux', 'age_min' => 0, 'age_max' => 4, 'frequence' => 1, 'quantite' => '100 g de starter pour poulets locaux', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Nourrir les Poulets Locaux', 'age_min' => 5, 'age_max' => 8, 'frequence' => 1, 'quantite' => '150 g de grower pour poulets locaux', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Nourrir les Poulets Locaux', 'age_min' => 9, 'age_max' => 16, 'frequence' => 1, 'quantite' => '200 g de finisher pour poulets locaux', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Nettoyer le Poulailler', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage complet et désinfection', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Vérifier l\'Abreuvement', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Assurer la propreté et le niveau d\'eau', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Inspecter les Poulets Locaux pour les Signes de Maladies', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Examen visuel quotidien', 'type' => 'Santé', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Vérifier les Équipements de Nourriture', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Nettoyage et maintenance des équipements', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Gérer les Déchets du Poulailler', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Collecte et élimination des déchets', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Contrôler les Apports en Minéraux', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Distribution régulière de minéraux', 'type' => 'Alimentation', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Assurer une Bonne Ventilation', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Vérification et ajustement des systèmes de ventilation', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Vérifier la Qualité de la Litière', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Contrôle et ajout de litière si nécessaire', 'type' => 'Environnement', 'jour' => 1],
            ['race_id' => 13, 'espece_id' => 5, 'nomtache' => 'Contrôler l\'État des Abreuvoirs', 'age_min' => 0, 'age_max' => 365, 'frequence' => 1, 'quantite' => 'Vérification régulière de l’état des abreuvoirs', 'type' => 'Environnement', 'jour' => 1],
            ]
        );
    }
}
