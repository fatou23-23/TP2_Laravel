<?php

namespace Database\Factories;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Classe>
 */
class ClasseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    $filieres = [
        'GL' => 'Génie logiciel',
        'RSI' => 'Réseaux et systèmes informatiques',
        'IAD' => 'Intelligence artificielle et données',
    ];
    $niveau = fake()->randomElement(['L1', 'L2', 'L3', 'M1', 'M2']);
    $sigle = fake()->randomElement(array_keys($filieres));

    return [
        'code' => $niveau . '-' . $sigle . '-' . fake()->unique()->numberBetween(1, 99),
        'libelle' => $niveau . ' ' . $filieres[$sigle],
        'niveau' => $niveau,
        'filiere' => $filieres[$sigle],
        'annee_academique' => '2026-2027',
        'effectif_max' => 40,
    ];
}

}
