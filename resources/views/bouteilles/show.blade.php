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

        <div>
            @if(!empty($commentaireBouteille->commentaire))
                <small>Commentaire</small>
                <span>{{ $commentaireBouteille->commentaire }}</span>
            @endif
            @if(!empty($commentaireBouteille->note))
                <small>Note</small>
                <span>{{ $commentaireBouteille->note }}/5</span>
            @endif
        </div>

        @if(empty($commentaireBouteille->commentaire) && empty($commentaireBouteille->note))
            <form action="{{ route('commentaire_bouteille.store') }}" method="POST">
            @csrf
        @else
            <form action="{{ route('commentaire_bouteille.update', $commentaireBouteille->id) }}" method="POST">
                @csrf
                @method('PUT')
        @endif
                <label for="commentaire">Commentaire</label>
                <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
                <input type="hidden" name="bouteille_id" value="{{ $bouteille->id }}">
                <label for="note">Note</label>
                <input type="number" name="note" id="note" min="0" max="5">
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </div>
    
@endsection