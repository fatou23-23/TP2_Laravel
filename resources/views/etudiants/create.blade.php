@extends('layouts.app')

@section('titre', 'Inscrire un étudiant')

@section('contenu')
    <h1>Inscrire un étudiant</h1>
    <p>Le matricule est attribué automatiquement à l'enregistrement.</p>
    <form method="POST" action="{{ route('etudiants.store') }}">
        @include('etudiants._form')
    </form>
@endsection