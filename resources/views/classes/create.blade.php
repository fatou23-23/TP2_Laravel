@extends('layouts.app')

@section('titre', 'Nouvelle classe')

@section('contenu')
    <h1>Nouvelle classe</h1>
    <form method="POST" action="{{ route('classes.store') }}">
        @include('classes._form')
    </form>
@endsection