@extends('layout.app')
@section('content')
@push('styles')
    <link href=" {{ asset('css/carte-vin-lr.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/paginate.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
@endpush
<main class="demo-liste">
    {{-- <h1 class="titre-principal"> Toutes les bouteilles!</h1> --}}
    @if($bouteilles)
        @foreach ($bouteilles as $bouteille)

            <div class="carte-vin-container">
                @if($bouteille->image_pastille_alt == "Pastille de goût : Fruité et vif")
                    <div class="bande-de-gout-fv"> <span>Fruité et Vif</span> </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Aromatique et charnu")
                    <div class="bande-de-gout-ac"> <span>Aromatique et Charnu</span> </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Aromatique et rond")
                    <div class="bande-de-gout-ar"> <span>Aromatique et Rond</span> </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Aromatique et souple")
                    <div class="bande-de-gout-as"> <span>Aromatique et Souple</span> </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Délicat et léger")
                    <div class="bande-de-gout-dl">  <span>Délicat et Léger</span></div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Fruité et doux")
                    <div class="bande-de-gout-fd"> <span>Fruité et Doux</span> </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Fruité et généreux")
                    <div class="bande-de-gout-fg"> <span>Fruité et Généreux</span> </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Fruité et léger")
                    <div class="bande-de-gout-fl"> <span>Fruité et Léger</span> </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Fruité et vif")
                    <div class="bande-de-gout-fv"> <span>Fruité et Vif</span> </div>
                @elseif($bouteille->image_pastille_alt == "Pastille de goût : Fruité et extra-doux")
                    <div class="bande-de-gout-fed"> <span>Fruité et Extra-Doux</span></div>
                @endif

                <div class="carte-vin @if(!$bouteille->image_pastille_alt) no-pastille @endif">
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
                            <a href="{{ route('bouteilles.show', $bouteille->id) }}"><h2>{{ $bouteille->nom }}</h2></a>
                            <div>
                                <div>
                                    <p>{{ $bouteille->couleur_fr }}  |  {{ $bouteille->format }}  |  {{ $bouteille->pays_fr }}</p>
                                </div>
                                {{-- <button type="button" class="btn btn-primary btn-details" onclick="openModal('{{ $bouteille->nom }}', '{{ $bouteille->id }}')">
                                    Ajouter
                                </button> --}}
                            </div>
                            <div class="overlap" onclick="openModal('{{ $bouteille->nom }}', '{{ $bouteille->id }}')">
                                <p class="invisible-385px">Ajouter</p><img src="{{ asset('icons/plus_icon.svg') }}" alt="Plus">
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        @endforeach
            @if(count($bouteilles) < 30)
            <nav class="pagination" style="display: none">
            @else
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
            @endif
    @else
        <p>aucune bouteille trouvée</p>
    @endif

@if(count($bouteilles) >= 30)
    {{-- la boîte modale de navigation --}}
    @include('components.modals.modale-pagination')
    @push('scripts')
        <script src="{{ asset('js/pagination.js') }}"></script>
    @endpush
@endif
{{-- la boîte modale d'ajout de bouteilles au cellier --}}
@include('components.modals.modale-ajout-bouteille')
@push('scripts')
<script src="{{ asset('js/modal.js')}}"></script>
@endpush
</main>
@endsection