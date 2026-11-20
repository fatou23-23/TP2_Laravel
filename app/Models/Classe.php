<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'libelle', 'niveau', 'filiere', 'annee_academique', 'effectif_max'];

    // Une classe a plusieurs étudiants
    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class);
    }

    public function estComplete(): bool
    {
        return $this->etudiants()->count() >= $this->effectif_max;
    }
}