@extends('layouts.app')

@section('titre', 'Modifier ' . $etudiant->nom_complet)

@section('contenu')
    <h1>Modifier {{ $etudiant->nom_complet }} ({{ $etudiant->matricule }})</h1>
    <form method="POST" action="{{ route('etudiants.update', $etudiant) }}">
        @method('PUT')
        @include('etudiants._form')
    </form>
@endsection