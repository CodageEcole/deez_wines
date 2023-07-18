@extends('layout.app')
@section('title', $cellier->nom)
@push('styles')
    <link href=" {{ asset('css/carte-vin-lr.css') }}" rel="stylesheet">
@endpush
@section('content')
<main>
    
    <div>
        <h1>{{ $cellier->nom }}</h1>
        <a href="{{ route('celliers.edit', $cellier->id) }}">Modifier</a>
        <form class="formulaireDel" action="{{ route('celliers.destroy', $cellier->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="boutonSupp" type="submit">Supprimer</button>
        </form>
    </div>
    <div>
        <h2>Vos bouteilles</h2>
        <a href="{{ route('bouteilles.create', Auth::id()) }}">Ajouter une bouteille</a>
        {{-- @foreach($bouteilles as $bouteille) --}}
        @foreach($cellierQuantiteBouteille as $quantiteBouteille)
        <div class="carte-vin-container">
            @if($quantiteBouteille->bouteille->image_pastille_alt == "Pastille de goût : Fruité et vif")
                    <div class="bande-de-gout-fv"> <span>Fruité et Vif</span> </div>
                @elseif($quantiteBouteille->bouteille->image_pastille_alt == "Pastille de goût : Aromatique et charnu")
                    <div class="bande-de-gout-ac"> <span>Aromatique et Charnu</span> </div>
                @elseif($quantiteBouteille->bouteille->image_pastille_alt == "Pastille de goût : Aromatique et rond")
                    <div class="bande-de-gout-ar"> <span>Aromatique et Rond</span> </div>
                @elseif($quantiteBouteille->bouteille->image_pastille_alt == "Pastille de goût : Aromatique et souple")
                    <div class="bande-de-gout-as"> <span>Aromatique et Souple</span> </div>
                @elseif($quantiteBouteille->bouteille->image_pastille_alt == "Pastille de goût : Délicat et léger")
                    <div class="bande-de-gout-dl">  <span>Délicat et Léger</span></div>
                @elseif($quantiteBouteille->bouteille->image_pastille_alt == "Pastille de goût : Fruité et doux")
                    <div class="bande-de-gout-fd"> <span>Fruité et Doux</span> </div>
                @elseif($quantiteBouteille->bouteille->image_pastille_alt == "Pastille de goût : Fruité et généreux")
                    <div class="bande-de-gout-fg"> <span>Fruité et Généreux</span> </div>
                @elseif($quantiteBouteille->bouteille->image_pastille_alt == "Pastille de goût : Fruité et léger")
                    <div class="bande-de-gout-fl"> <span>Fruité et Léger</span> </div>
                @elseif($quantiteBouteille->bouteille->image_pastille_alt == "Pastille de goût : Fruité et vif")
                    <div class="bande-de-gout-fv"> <span>Fruité et Vif</span> </div>
                @elseif($quantiteBouteille->bouteille->image_pastille_alt == "Pastille de goût : Fruité et extra-doux")
                    <div class="bande-de-gout-fed"> <span>Fruité et Extra-Doux</span></div>
                @endif

                <div class="carte-vin @if(!$quantiteBouteille->bouteille->image_pastille_alt) no-pastille @endif">
                        <picture class="protruding">
                            {{--* Ici j'utilise le glide, le chemin est img/glide/images car c'est l'origine de l'image des bouteilles --}}
                            {{--* Pour une pastille, ce serait img/glide/pastilles/ $image_pastille, environ --}}
                        @if($quantiteBouteille->bouteille->est_personnalisee)
                            <img src="{{ url('glide/imagesPersonnalisees/'. $quantiteBouteille->bouteille->image_bouteille . '?p=maquette') }}" alt="{{ $quantiteBouteille->bouteille->nom }}">
                        @else
                                <img src="{{ url('glide/images/'. $quantiteBouteille->bouteille->image_bouteille . '?p=maquette') }}" alt="{{ $quantiteBouteille->bouteille->image_bouteille_alt }}">
                        @endif
                        </picture>
                        <section>
                            <a href="{{ route('bouteilles.show', $quantiteBouteille->bouteille->id) }}"><h2>{{ $quantiteBouteille->bouteille->nom }}</h2></a>
                            <div>
                                <div>
                                    <p>{{ $quantiteBouteille->bouteille->couleur_fr }}  |  {{ $quantiteBouteille->bouteille->format }}  |  {{ $quantiteBouteille->bouteille->pays_fr }}</p>
                                </div>
                                {{-- <button type="button" class="btn btn-primary btn-details" onclick="openModal('{{ $quantiteBouteille->bouteille->nom }}', '{{ $quantiteBouteille->bouteille->id }}')">
                                    Ajouter
                                </button> --}}
                                <div>
                                    <p>Quantité : <span class="nombreBouteilles">{{ $quantiteBouteille->quantite }}</span></p>
                                </div>
                            </div>

                            <form action="{{ route('cellier_quantite_bouteille.store') }}">
                                @csrf
                                <div class="overlap boireBouteille" data-nom="{{ $quantiteBouteille->bouteille->nom }}" data-id="{{ $quantiteBouteille->bouteille->id }}"><button style="appearance:none;" type="submit">Boire</button></div>
                            </form>
                            @if($quantiteBouteille->quantite > 1)
                            <form action="{{ route('cellier_quantite_bouteille.update', $quantiteBouteille->id) }}">
                            @else
                            <form action="{{ route('cellier_quantite_bouteille.destroy', $quantiteBouteille->id) }}">
                            @endif
                                @csrf
                                <div class="overlap boireBouteille" data-nom="{{ $quantiteBouteille->bouteille->nom }}" data-id="{{ $quantiteBouteille->bouteille->id }}"><button type="submit">Boire</button></div>
                                
                            </form>
                            {{-- <div class="overlap boireBouteille" dataNom="{{ $quantiteBouteille->bouteille->nom }} dataId="{{ $quantiteBouteille->bouteille->id }}"onclick="openModal('{{ $quantiteBouteille->bouteille->nom }}', '{{ $quantiteBouteille->bouteille->id }}')">
                                <p>Boire</p>
                            </div>
                            <div class="overlap boireBouteille" dataNom="{{ $quantiteBouteille->bouteille->nom }} dataId="{{ $quantiteBouteille->bouteille->id }}"onclick="openModal('{{ $quantiteBouteille->bouteille->nom }}', '{{ $quantiteBouteille->bouteille->id }}')">
                                <p>Boire</p>
                            </div> --}}
                        </section>
                    </div>
                </div>
            </div>
            {{-- <div>
                <a href="{{ route('bouteilles.show', $quantiteBouteille->bouteille->id) }}">{{ $quantiteBouteille->bouteille->nom }}</a>
                <span>Quantité : <strong id="quantite-actuelle">{{ $quantiteBouteille->bouteille->pivot->quantite }}</strong></span>
                <button type="button" class="btn btn-primary btn-details" onclick="openModal('{{ $quantiteBouteille->bouteille->nom }}', '{{ $quantiteBouteille->bouteille->id }}', '{{ $cellier->id }}')">
                    Modifier
                </button>
            </div> --}}
        @endforeach
    </div>
</main>
@endsection


{{-- la boîte modale d'ajout de bouteilles au cellier --}}
@include('components.modals.modale-modifier-bouteille')
@include('components.modals.modale-confirmer-suppression')
@push('scripts')
{{-- <script src="{{ asset('js/modal.js')}}"></script> --}}
<script src="{{ asset('js/boireBouteille.js') }}"></script>
<script src="{{ asset('js/confirmerSupp.js') }}"></script>
@endpush