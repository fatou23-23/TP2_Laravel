@extends('layouts.app')

@section('titre', 'Classes')

@section('contenu')
    <h1>Classes</h1>
    <p><a href="{{ route('classes.create') }}">+ Nouvelle classe</a></p>

    <table>
        <tr><th>Code</th><th>Libellé</th><th>Niveau</th><th>Effectif</th><th>Actions</th></tr>
        @forelse ($classes as $classe)
            <tr>
                <td><a href="{{ route('classes.show', $classe) }}">{{ $classe->code }}</a></td>
                <td>{{ $classe->libelle }}</td>
                <td>{{ $classe->niveau }}</td>
                <td>{{ $classe->etudiants_count }} / {{ $classe->effectif_max }}</td>
                <td>
                    <a href="{{ route('classes.edit', $classe) }}">Modifier</a>
                    <form class="en-ligne" method="POST" action="{{ route('classes.destroy', $classe) }}"
                          onsubmit="return confirm('Supprimer cette classe ?')">
                        @csrf
                        @method('DELETE')
                        <button>Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Aucune classe.</td></tr>
        @endforelse
    </table>
@endsection