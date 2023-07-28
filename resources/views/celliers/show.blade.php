@extends('layout.app')
@section('title', $cellier->nom)
@push('styles')
    <link href=" {{ asset('css/carte-vin-lr.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/cellier-show.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
@endpush
@section('content')
<main>
    @if (session('edit-cellier'))
        <div class="alert-success" role="alert">{{ session('edit-cellier') }}</div>
    @endif
    <div class="header-nom-cellier">
        <form action="{{ route('celliers.update', $cellier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input class="input-edit-nom" type="text" name="nom" id="nom" value="{{ $cellier->nom }}">
            <button class="crayon-edit-icon" type="submit"><img src="{{ asset('icons/edit_pen.svg') }}" alt="crayon modification"></button>
        </form>
        <form class="formulaireDel" action="{{ route('celliers.destroy', $cellier->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="x-icon" type="submit"><img src="{{ asset('icons/x.svg') }}" alt=""></button>
        </form>
    </div>
    <div>
        <h2>Vos bouteilles</h2>
        <a class="boutonCellier espace" href="{{ route('bouteilles.create', Auth::id()) }}">Ajouter une bouteille personnalisée</a>
    
        @if (session('success'))
            <div class="alert-success" role="alert">{{ session('success') }}</div>
        @endif

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
                        {{--* Comme ca on ne voit pas les "|" si il n'y a pas de couleur ou de format --}} 
                        <p>
                            {{ $quantiteBouteille->bouteille->couleur_fr ? $quantiteBouteille->bouteille->couleur_fr . " | " : $quantiteBouteille->bouteille->couleur_fr }}
                            {{ $quantiteBouteille->bouteille->format ? $quantiteBouteille->bouteille->format . " | " : $quantiteBouteille->bouteille->format }}
                            {{ $quantiteBouteille->bouteille->pays_fr }}
                        </p>
                        <p>Quantité : <span class="nombreBouteilles">{{ $quantiteBouteille->quantite }}</span></p>
                    </div>
                    <div class="sectionBoutons">
                        <div>
                            <button class="modifierQuantite boutonCellier espace" data-id="{{ $quantiteBouteille->id }}" data-nombre="{{ $quantiteBouteille->quantite }}">Modifier</button>
                        </div>
                        <form action="{{ route('cellier_quantite_bouteille.destroy', $quantiteBouteille->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden"  name="cellier_id" value="{{ $cellier->id }}">
                            <button class="boutonCellier espace" type="submit">Supprimer</button>
                        </form>
                    </div>
                </section>
            </div>
            </div>
        @endforeach
    </div>
</main>
@include('components.modals.modale-changer-qte-bouteille')
@include('components.modals.modale-confirmer-suppression')
@endsection

{{-- la boîte modale d'ajout de bouteilles au cellier --}}
@push('scripts')
    <script src="{{ asset('js/changerQuantiteBouteille.js') }}"></script>
    <script src="{{ asset('js/messages.js')}}"></script>
@endpush