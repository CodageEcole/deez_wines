@extends('layout.app')
@section('content')
@push('styles')
    <link href=" {{ asset('css/carte-vin.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/paginate.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
@endpush
<main class="demo-liste">
    <h1 class="titre-principal"> Toutes les bouteilles!</h1>
    @if($bouteilles)
        @foreach ($bouteilles as $bouteille)
            <div class="carte-vin">
                    <picture>
                        {{--* Ici j'utilise le glide, le chemin est img/glide/images car c'est l'origine de l'image des bouteilles --}}
                        {{--* Pour une pastille, ce serait img/glide/pastilles/ $image_pastille, environ --}}
                    @if($bouteille->est_personnalisee)
                        <img src="{{ url('glide/imagesPersonnalisees/'. $bouteille->image_bouteille . '?p=xs') }}" alt="{{ $bouteille->nom }}">
                    @else
                            <img src="{{ url('glide/images/'. $bouteille->image_bouteille . '?p=xs') }}" alt="{{ $bouteille->image_bouteille_alt }}">
                    @endif
                    </picture>
                    <section>
                        <a href="{{ route('bouteilles.show', $bouteille->id) }}"><h1>{{ $bouteille->nom }}</h1></a>
                        <hr>
                        <div>
                            <div>
                                <strong>{{ $bouteille->couleur_fr }} </strong>
                                <p>{{ $bouteille->pays_fr }}, {{ $bouteille->region_fr }}</p>
                            </div>
                            <button type="button" class="btn btn-primary btn-details" onclick="openModal('{{ $bouteille->nom }}', '{{ $bouteille->id }}')">
                                Ajouter
                            </button>
                        </div>
                    </section>
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

@if(count($bouteilles) > 30)
    {{-- la boîte modale de navigation --}}
    @include('components.modals.modale-pagination')
@endif
{{-- la boîte modale d'ajout de bouteilles au cellier --}}
@include('components.modals.modale-ajout-bouteille')
</main>

@if(count($bouteilles) > 30)
    <script src="{{ asset('js/pagination.js') }}"></script>
@endif
@endsection