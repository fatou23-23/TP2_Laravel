@extends('layouts.app')

@section('titre', 'Page introuvable')

@section('contenu')
    <h1>Page introuvable (erreur 404)</h1>
    @php($message = $exception->getMessage())
    {{-- Les messages techniques de Laravel (« No query results… ») sont remplacés --}}
    <p>{{ $message && ! str_starts_with($message, 'No query results') ? $message : "L'adresse demandée n'existe pas." }}</p>
    <p><a href="{{ route('accueil') }}">Retour à l'accueil</a></p>
@endsection
