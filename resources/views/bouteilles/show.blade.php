@extends('layout.app')
@section('title', 'Bouteille')
@section('content')
    @push('styles') 
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
    @endpush
    <div>
        <h1>{{ $bouteille->nom }}</h1>
        <hr>
        <div>
            <div>
                <strong>{{ $bouteille->couleur_fr }} </strong>
                <p>{{ $bouteille->pays_fr }}, {{ $bouteille->region_fr }}</p>
            </div>
            <button type="button" class="btn btn-primary btn-details" onclick="openModal('{{ $bouteille->nom }}', '{{ $bouteille->id }}')">
                Ajouter
            </button>
            @if($bouteille->est_personnalisee)
                <img src="{{ url('glide/imagesPersonnalisees/'. $bouteille->image_bouteille . '?p=xs') }}" alt="{{ $bouteille->image_bouteille_alt }}">
            @else
                <img src="{{ url('glide/images/'. $bouteille->image_bouteille . '?p=xs') }}" alt="{{ $bouteille->image_bouteille_alt }}">
            @endif
        </div>
    </div>
    
@endsection