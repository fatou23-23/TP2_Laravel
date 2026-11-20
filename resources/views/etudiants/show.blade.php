@extends('layouts.app')

@section('titre', $etudiant->nom_complet)

@section('contenu')
    <h1>{{ $etudiant->nom_complet }}</h1>
    <table>
        <tr><th>Matricule</th><td>{{ $etudiant->matricule }}</td></tr>
        <tr><th>E-mail</th><td>{{ $etudiant->email }}</td></tr>
        <tr><th>Date de naissance</th>
            <td>{{ $etudiant->date_naissance->format('d/m/Y') }} ({{ $etudiant->date_naissance->age }} ans)</td></tr>
        <tr><th>Sexe</th><td>{{ $etudiant->sexe === 'F' ? 'Féminin' : 'Masculin' }}</td></tr>
        <tr><th>Téléphone</th><td>{{ $etudiant->telephone ?? 'Non renseigné' }}</td></tr>
        <tr><th>Classe</th>
            <td><a href="{{ route('classes.show', $etudiant->classe) }}">{{ $etudiant->classe->code }}</a> - {{ $etudiant->classe->libelle }}</td></tr>
    </table>
    <p>
        <a href="{{ route('etudiants.edit', $etudiant) }}">Modifier</a> ·
        <a href="{{ route('etudiants.index') }}">Retour à la liste</a>
    </p>
@endsection