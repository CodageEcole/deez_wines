@extends('layout.app')
@section('content')
@push('styles')
    <link href=" {{ asset('css/carte-vin-lr.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/paginate.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
@endpush
<main class="demo-liste">
    <h1 class="titre-principal"> Toutes les bouteilles!</h1>
    @if($bouteilles)
        @foreach ($bouteilles as $bouteille)

            <div class="carte-vin-container">
                @if($bouteille->image_pastille_alt == "Pastille de goût : Fruité et vif")
                    <div class="bande-de-gout-fv"> Fruité et Vif </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Aromatique et charnu")
                    <div class="bande-de-gout-ac"> Aromatique et Charnu </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Aromatique et rond")
                    <div class="bande-de-gout-ar"> Aromatique et Rond </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Aromatique et souple")
                    <div class="bande-de-gout-as"> Aromatique et Souple </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Délicat et léger")
                    <div class="bande-de-gout-dl">  Délicat et Léger</div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Fruité et doux")
                    <div class="bande-de-gout-fd"> Fruité et Doux </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Fruité et généreux")
                    <div class="bande-de-gout-fg"> Fruité et Généreux </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Fruité et léger")
                    <div class="bande-de-gout-fl"> Fruité et Léger </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Fruité et vif")
                    <div class="bande-de-gout-fv"> Fruité et Vif </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Fruité et extra-doux")
                    <div class="bande-de-gout-fed"> Fruité et Extra-Doux </div>
                
                @endif
                <div class="carte-vin">
                        <picture class="protruding">
                            {{--* Ici j'utilise le glide, le chemin est img/glide/images car c'est l'origine de l'image des bouteilles --}}
                            {{--* Pour une pastille, ce serait img/glide/pastilles/ $image_pastille, environ --}}
                        @if($bouteille->est_personnalisee)
                            <img src="{{ url('glide/imagesPersonnalisees/'. $bouteille->image_bouteille . '?p=maquette') }}" alt="{{ $bouteille->nom }}">
                        @else
                                <img src="{{ url('glide/images/'. $bouteille->image_bouteille . '?p=maquette') }}" alt="{{ $bouteille->image_bouteille_alt }}">
                        @endif
                        </picture>
                        <section>
                            <a href="{{ route('bouteilles.show', $bouteille->id) }}"><h1>{{ $bouteille->nom }}</h1></a>
                            <div>
                                <div>
                                    <p>{{ $bouteille->couleur_fr }} | {{ $bouteille->format }} | {{ $bouteille->pays_fr }}</p>
                                </div>
                                <button type="button" class="btn btn-primary btn-details" onclick="openModal('{{ $bouteille->nom }}', '{{ $bouteille->id }}')">
                                    Ajouter
                                </button>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        @endforeach
            <nav class="pagination">
                @php
                    $pageCourante = $bouteilles->currentPage();
                    $dernierePage = $bouteilles->lastPage();
                @endphp
                {{-- Lien première page --}}
                @if ($bouteilles->onFirstPage())
                    <a class="pagination-link disabled">&laquo;</a>
                @else
                    <a href="{{ $bouteilles->url(1) }}" rel="prev" class="pagination-link">&laquo;</a>
                @endif

                {{-- Lien page précédente --}}
                @if ($bouteilles->onFirstPage())
                    <a class="pagination-link disabled">&lsaquo;</a>
                @else
                    <a href="{{ $bouteilles->previousPageUrl() }}" rel="prev" class="pagination-link">&lsaquo;</a>
                @endif
                {{-- page actuelle --}}
                <span class="active">{{ $pageCourante }}</span>

                {{-- Liens de pagination --}}


                {{-- Bouton sélecteur de page --}}
                <span class="boutonPage" data-derniere-page="{{ $dernierePage }}">&#x270E;</span>

                {{-- Lien page suivante --}}
                @if ($bouteilles->hasMorePages())
                    <a href="{{ $bouteilles->nextPageUrl() }}" rel="next" class="pagination-link">&rsaquo;</a>
                @else
                    <a class="pagination-link disabled">&rsaquo;</a>
                @endif

                {{-- Lien dernière page --}}
                @if ($pageCourante == $dernierePage)
                    <a class="pagination-link disabled">&raquo;</a>
                @else
                    <a href="{{ $bouteilles->url($dernierePage) }}" class="pagination-link">&raquo;</a>
                @endif
            </nav>
    @else
        <p>aucune bouteille trouvée</p>
    @endif


{{-- la boîte modale de navigation --}}
@include('components.modals.modale-pagination')
{{-- la boîte modale d'ajout de bouteilles au cellier --}}
@include('components.modals.modale-ajout-bouteille')
</main>

<script src="{{ asset('js/pagination.js') }}"></script>
@endsection