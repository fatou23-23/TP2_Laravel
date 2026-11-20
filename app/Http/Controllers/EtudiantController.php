<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $recherche = $request->input('q');

        $etudiants = Etudiant::with('classe')
            ->when($request->filled('classe'), fn ($requete) => $requete->where('classe_id', $request->integer('classe')))
            ->when($recherche, fn ($requete) => $requete->where(function ($sous) use ($recherche) {
                $sous->where('nom', 'like', "%$recherche%")
                    ->orWhere('prenom', 'like', "%$recherche%")
                    ->orWhere('matricule', 'like', "%$recherche%");
            }))
            ->orderBy('nom')->orderBy('prenom')
            ->paginate(15)
            ->withQueryString();

        $classes = Classe::orderBy('code')->get();

        return view('etudiants.index', compact('etudiants', 'classes', 'recherche'));
    }

    public function create(Request $request)
    {
        return view('etudiants.create', [
            'etudiant' => new Etudiant(['classe_id' => $request->integer('classe') ?: null]),
            'classes' => Classe::orderBy('code')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $donnees = $request->validate($this->regles());

        $classe = Classe::findOrFail($donnees['classe_id']);
        if ($classe->estComplete()) {
            return back()->withInput()
                ->withErrors(['classe_id' => "La classe {$classe->code} est complète ({$classe->effectif_max} places)."]);
        }

        $donnees['matricule'] = $this->nouveauMatricule();
        $etudiant = Etudiant::create($donnees);

        return redirect()->route('etudiants.show', $etudiant)
            ->with('succes', "{$etudiant->nom_complet} est inscrit(e) sous le matricule {$etudiant->matricule}.");
    }

    public function show(Etudiant $etudiant)
    {
        $etudiant->load('classe');

        return view('etudiants.show', compact('etudiant'));
    }

    public function edit(Etudiant $etudiant)
    {
        return view('etudiants.edit', [
            'etudiant' => $etudiant,
            'classes' => Classe::orderBy('code')->get(),
        ]);
    }

    public function update(Request $request, Etudiant $etudiant)
    {
        $donnees = $request->validate($this->regles($etudiant));

        if ((int) $donnees['classe_id'] !== $etudiant->classe_id) {
            $classe = Classe::findOrFail($donnees['classe_id']);
            if ($classe->estComplete()) {
                return back()->withInput()
                    ->withErrors(['classe_id' => "La classe {$classe->code} est complète."]);
            }
        }

        $etudiant->update($donnees);

        return redirect()->route('etudiants.show', $etudiant)
            ->with('succes', "La fiche de {$etudiant->nom_complet} a été modifiée.");
    }

    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')
            ->with('succes', "{$etudiant->nom_complet} a été supprimé(e).");
    }

    public function parMatricule(string $matricule)
    {
        $etudiant = Etudiant::where('matricule', $matricule)->firstOrFail();

        return redirect()->route('etudiants.show', $etudiant);
    }

    private function regles(?Etudiant $etudiant = null): array
    {
        return [
            'prenom' => ['required', 'string', 'max:60'],
            'nom' => ['required', 'string', 'max:60'],
            'email' => ['required', 'email', 'max:255', Rule::unique('etudiants', 'email')->ignore($etudiant)],
            'date_naissance' => ['required', 'date', 'before:-15 years'],
            'sexe' => ['required', Rule::in(['F', 'M'])],
            'telephone' => ['nullable', 'string', 'max:20'],
            'classe_id' => ['required', 'exists:classes,id'],
        ];
    }

    private function nouveauMatricule(): string
    {
        $annee = now()->year;
        $dernier = Etudiant::where('matricule', 'like', "ISI-$annee-%")->max('matricule');
        $numero = $dernier ? (int) substr($dernier, -4) + 1 : 1;

        return sprintf('ISI-%d-%04d', $annee, $numero);
    }
}