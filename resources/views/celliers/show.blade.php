@extends('layout.app')
@section('title', $cellier->nom)
@section('content')
    <div>
        <h1>{{ $cellier->nom }}</h1>
        <a href="{{ route('celliers.edit', $cellier->id) }}">Modifier</a>
        <form action="{{ route('celliers.destroy', $cellier->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Supprimer</button>
        </form>
    </div>
    <div>
        <h2>Vos bouteilles</h2>
        <a href="{{ route('bouteilles.create', Auth::id()) }}">Ajouter une bouteille</a>
        @foreach($bouteilles as $bouteille)
            <div>
                <a href="{{ route('bouteilles.show', $bouteille->id) }}">{{ $bouteille->nom }}</a>
                <span>Quantité : {{ $bouteille->pivot->quantite }}</span>
                <button type="button" class="btn btn-primary btn-details" onclick="openModal('{{ $bouteille->nom }}', '{{ $bouteille->id }}')">
                    Modifier
                </button>
            </div>
        @endforeach
    </div>
@endsection

{{-- la boîte modale d'ajout de bouteilles au cellier --}}
@include('components.modals.modale-modifier-bouteille')
