<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::withCount('etudiants')->orderBy('niveau')->orderBy('code')->get();

        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        return view('classes.create', [
            'classe' => new Classe(['annee_academique' => '2026-2027', 'effectif_max' => 40]),
        ]);
    }

    public function store(Request $request)
    {
        $donnees = $request->validate($this->regles());
        $classe = Classe::create($donnees);

        return redirect()->route('classes.show', $classe)
            ->with('succes', "La classe {$classe->code} a été créée.");
    }

    public function show(Classe $classe)
    {
        $classe->load(['etudiants' => fn ($requete) => $requete->orderBy('nom')->orderBy('prenom')]);

        return view('classes.show', compact('classe'));
    }

    public function edit(Classe $classe)
    {
        return view('classes.edit', compact('classe'));
    }

    public function update(Request $request, Classe $classe)
    {
        $donnees = $request->validate($this->regles($classe));
        $classe->update($donnees);

        return redirect()->route('classes.show', $classe)
            ->with('succes', "La classe {$classe->code} a été modifiée.");
    }

    public function destroy(Classe $classe)
    {
        if ($classe->etudiants()->exists()) {
            return back()->with('erreur', "Impossible de supprimer {$classe->code} : la classe contient encore des étudiants.");
        }

        $classe->delete();

        return redirect()->route('classes.index')
            ->with('succes', "La classe {$classe->code} a été supprimée.");
    }

    public function annuaire(?string $niveau = null)
    {
        $classes = Classe::withCount('etudiants')
            ->when($niveau, fn ($requete) => $requete->where('niveau', $niveau))
            ->orderBy('code')
            ->get();

        abort_if($niveau && $classes->isEmpty(), 404, "Aucune classe de niveau $niveau.");

        return view('classes.annuaire', compact('classes', 'niveau'));
    }

    private function regles(?Classe $classe = null): array
    {
        return [
            'code' => ['required', 'string', 'max:20', Rule::unique('classes', 'code')->ignore($classe)],
            'libelle' => ['required', 'string', 'max:100'],
            'niveau' => ['required', Rule::in(['L1', 'L2', 'L3', 'M1', 'M2'])],
            'filiere' => ['required', 'string', 'max:60'],
            'annee_academique' => ['required', 'regex:/^\d{4}-\d{4}$/'],
            'effectif_max' => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }
}