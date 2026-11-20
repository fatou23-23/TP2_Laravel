@extends('layouts.app')

@section('titre', 'Annuaire')

@section('contenu')
    <h1>Annuaire des classes {{ $niveau ? "de niveau $niveau" : '' }}</h1>
    <p>
        <a href="{{ route('annuaire') }}">Tous</a>
        @foreach (['L1', 'L2', 'L3', 'M1', 'M2'] as $n)
            · <a href="{{ route('annuaire', $n) }}">{{ $n }}</a>
        @endforeach
    </p>
    <ul>
        @foreach ($classes as $classe)
            <li>
                <a href="{{ route('classes.show', $classe) }}">{{ $classe->code }}</a> :
                {{ $classe->libelle }} ({{ $classe->etudiants_count }} étudiants)
            </li>
        @endforeach
    </ul>
@endsection
