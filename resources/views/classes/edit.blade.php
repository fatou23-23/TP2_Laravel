@extends('layouts.app')

@section('titre', 'Modifier ' . $classe->code)

@section('contenu')
    <h1>Modifier la classe {{ $classe->code }}</h1>
    <form method="POST" action="{{ route('classes.update', $classe) }}">
        @method('PUT')
        @include('classes._form')
    </form>
@endsection