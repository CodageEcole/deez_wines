@push('styles') 
<link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
<link href=" {{ asset('css/detail-lr.css') }}" rel="stylesheet">
@endpush

@extends('layout.app')
@section('title', 'Bouteille')
@section('content')
    
    <main>
        <picture class="bouteille-container">
            @if($bouteille->est_personnalisee)
                <img src="{{ url('glide/imagesPersonnalisees/'. $bouteille->image_bouteille . '?p=detail') }}" alt="{{ $bouteille->image_bouteille_alt }}">
            @else
                <img src="{{ url('glide/images/'. $bouteille->image_bouteille . '?p=detail') }}" alt="{{ $bouteille->image_bouteille_alt }}">
            @endif
        </picture>

        <div class="description-container">
            <div class="carte-titre">
                <h2>{{ $bouteille->nom }}</h2>
                <p>{{ $bouteille->couleur_fr }}  |  {{ $bouteille->format }}  |  {{ $bouteille->pays_fr }}</p>
            </div>

            <a class="bouton-ajouter" href="">
                Ajouter <img src="{{ asset('icons/cellier_icon_white.svg') }}" alt="Ajouter">
            </a>

            <div class="informations">
                <div class="info-double">
                    <div>
                        <h3>Région</h3>
                        <p>{{ $bouteille->region_fr }}</p>
                    </div>
                    <div>
                        <h3>Format</h3>
                        <p>{{ $bouteille->format }}</p>
                    </div>
                </div>
                <div class="info-double">
                    <div>
                        <h3>Degrée d'alcool</h3>
                        <p>{{ $bouteille->degree_alcool }}</p>
                    </div>
                    <div>
                        <h3>Taux de sucre</h3>
                        <p>{{ $bouteille->taux_de_sucre }}</p>
                    </div>
                </div>

                <div class="info-simple">
                    <h3>Température de service</h3>
                    <p>{{ $bouteille->temperature_fr }}</p>
                </div>
                <div class="info-simple">
                    <h3>Arômes</h3>
                    <p>{{ $bouteille->aromes_fr }}</p>
                </div>
                <div class="info-simple">
                    <h3>Désignation reglementée</h3>
                    <p>{{ $bouteille->designation_reglementee_fr }}</p>
                </div>
                <div class="info-simple">
                    <h3>Producteur</h3>
                    <p>{{ $bouteille->producteur }}</p>
                </div>
                <div class="info-simple">
                    <h3>Agent romotionnel</h3>
                    <p>{{ $bouteille->agent_promotionnel }}</p>
                </div>

                <div class="division"></div>

                @if($bouteille->description_fr)
                    <div class="info-detaillee">
                        <h3>Infos détaillées</h3>
                        <p>{{ $bouteille->description_fr }}</p>
                    </div>
                @endif

            </div>
        </div>












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
</main>
    
@endsection