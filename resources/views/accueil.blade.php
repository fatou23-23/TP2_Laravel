@extends('layouts.app')

@section('titre', 'Accueil')

@section('contenu')
    <h1>Bienvenue sur {{ config('app.name') }}</h1>
    <p>Année académique 2026-2027 : <strong>{{ $nbClasses }}</strong> classes et <strong>{{ $nbEtudiants }}</strong> étudiants inscrits.</p>
    <p>
        <a href="{{ route('etudiants.create') }}">Inscrire un étudiant</a> ·
        <a href="{{ route('classes.create') }}">Créer une classe</a>
    </p>
@endsection
