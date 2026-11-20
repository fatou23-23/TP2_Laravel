@extends('layouts.app')

@section('titre', 'Étudiants')

@section('contenu')
    <h1>Étudiants ({{ $etudiants->total() }})</h1>

    <form method="GET" action="{{ route('etudiants.index') }}">
        <input name="q" value="{{ $recherche }}" placeholder="Nom, prénom ou matricule">
        <select name="classe">
            <option value="">Toutes les classes</option>
            @foreach ($classes as $classe)
                <option value="{{ $classe->id }}" @selected(request('classe') == $classe->id)>{{ $classe->code }}</option>
            @endforeach
        </select>
        <button>Filtrer</button>
        <a href="{{ route('etudiants.create') }}">+ Inscrire un étudiant</a>
    </form>
    <br>

    <table>
        <tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>Classe</th><th>Actions</th></tr>
        @forelse ($etudiants as $etudiant)
            <tr>
                <td><a href="{{ route('etudiants.show', $etudiant) }}">{{ $etudiant->matricule }}</a></td>
                <td>{{ $etudiant->nom }}</td>
                <td>{{ $etudiant->prenom }}</td>
                <td>{{ $etudiant->classe->code }}</td>
                <td>
                    <a href="{{ route('etudiants.edit', $etudiant) }}">Modifier</a>
                    <form class="en-ligne" method="POST" action="{{ route('etudiants.destroy', $etudiant) }}"
                          onsubmit="return confirm('Supprimer cet étudiant ?')">
                        @csrf
                        @method('DELETE')
                        <button>Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Aucun étudiant trouvé.</td></tr>
        @endforelse
    </table>

    @if ($etudiants->hasPages())
        <p>
            @if ($etudiants->onFirstPage())
                « Précédent
            @else
                <a href="{{ $etudiants->previousPageUrl() }}">« Précédent</a>
            @endif

            · Page {{ $etudiants->currentPage() }} sur {{ $etudiants->lastPage() }} ·

            @if ($etudiants->hasMorePages())
                <a href="{{ $etudiants->nextPageUrl() }}">Suivant »</a>
            @else
                Suivant »
            @endif
        </p>
    @endif
@endsection