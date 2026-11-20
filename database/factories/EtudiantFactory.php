<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $prenomsF = ['Awa', 'Fatou', 'Aminata', 'Mariama', 'Khady', 'Ndeye', 'Aïssatou', 'Coumba', 'Bineta', 'Astou'];
    $prenomsM = ['Moussa', 'Ousmane', 'Cheikh', 'Ibrahima', 'Mamadou', 'Abdoulaye', 'Modou', 'Pape', 'Serigne', 'Babacar'];
    $noms = ['Diop', 'Ndiaye', 'Fall', 'Sow', 'Ba', 'Gueye', 'Diallo', 'Sarr', 'Faye', 'Mbaye', 'Cissé', 'Seck', 'Kane', 'Thiam', 'Sy'];

    $sexe = fake()->randomElement(['F', 'M']);
    $prenom = fake()->randomElement($sexe === 'F' ? $prenomsF : $prenomsM);
    $nom = fake()->randomElement($noms);

    return [
        'matricule' => 'ISI-2026-' . fake()->unique()->numerify('####'),
        'prenom' => $prenom,
        'nom' => $nom,
        'email' => Str::lower(Str::ascii($prenom . '.' . $nom)) . fake()->unique()->numberBetween(1, 9999) . '@etu.isi.test',
        'date_naissance' => fake()->dateTimeBetween('-28 years', '-18 years')->format('Y-m-d'),
        'sexe' => $sexe,
        'telephone' => fake()->boolean(80)
            ? fake()->randomElement(['70', '75', '76', '77', '78']) . ' ' . fake()->numerify('### ## ##')
            : null,
        'classe_id' => Classe::factory(),
    ];
}

}
