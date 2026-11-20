@extends('layouts.app')

@section('titre', $classe->code)

@section('contenu')
    <h1>{{ $classe->code }} : {{ $classe->libelle }}</h1>
    <p>
        Filière : {{ $classe->filiere }} · Année : {{ $classe->annee_academique }} ·
        Effectif : {{ $classe->etudiants->count() }} / {{ $classe->effectif_max }}
    </p>
    <p>
        <a href="{{ route('classes.edit', $classe) }}">Modifier</a> ·
        <a href="{{ route('etudiants.create', ['classe' => $classe->id]) }}">Inscrire un étudiant dans cette classe</a>
    </p>

    <h2>Étudiants</h2>
    <table>
        <tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>E-mail</th></tr>
        @forelse ($classe->etudiants as $etudiant)
            <tr>
                <td><a href="{{ route('etudiants.show', $etudiant) }}">{{ $etudiant->matricule }}</a></td>
                <td>{{ $etudiant->nom }}</td>
                <td>{{ $etudiant->prenom }}</td>
                <td>{{ $etudiant->email }}</td>
            </tr>
        @empty
            <tr><td colspan="4">Aucun étudiant dans cette classe.</td></tr>
        @endforelse
    </table>
    <p><a href="{{ route('classes.index') }}">Retour aux classes</a></p>
@endsection