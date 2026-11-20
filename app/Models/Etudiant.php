<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['matricule', 'prenom', 'nom', 'email', 'date_naissance', 'sexe', 'telephone', 'classe_id'];

    protected function casts(): array
    {
        return ['date_naissance' => 'date'];
    }

    // Un étudiant appartient à une classe
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    // Attribut calculé : $etudiant->nom_complet
    protected function nomComplet(): Attribute
    {
        return Attribute::get(fn () => "{$this->prenom} {$this->nom}");
    }
}