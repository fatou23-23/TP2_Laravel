<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['code' => 'L1-GL', 'libelle' => 'Licence 1 Génie logiciel', 'niveau' => 'L1', 'filiere' => 'Génie logiciel'],
            ['code' => 'L2-GL', 'libelle' => 'Licence 2 Génie logiciel', 'niveau' => 'L2', 'filiere' => 'Génie logiciel'],
            ['code' => 'L3-GL', 'libelle' => 'Licence 3 Génie logiciel', 'niveau' => 'L3', 'filiere' => 'Génie logiciel'],
            ['code' => 'M1-RSI', 'libelle' => 'Master 1 Réseaux et systèmes informatiques', 'niveau' => 'M1', 'filiere' => 'Réseaux et systèmes informatiques'],
            ['code' => 'M2-IAD', 'libelle' => 'Master 2 Intelligence artificielle et données', 'niveau' => 'M2', 'filiere' => 'Intelligence artificielle et données'],
        ];

        foreach ($classes as $donnees) {
            $classe = Classe::create($donnees + ['annee_academique' => '2026-2027', 'effectif_max' => 30]);
            Etudiant::factory()->count(20)->for($classe)->create();
        }
    }
}