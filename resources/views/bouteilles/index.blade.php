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
    @php 
        $currentpage = request('page') ?? 1;
        $pagination = $bouteilles->getUrlRange(max($currentpage - 1, 1), min($currentpage + 2, $bouteilles->lastPage()))
    @endphp
    {{-- @php $bouteilles = $bouteilles->slice(-10) @endphp --}}
    @foreach ($bouteilles as $bouteille)
        <div class="carte-vin">
                <picture>
                    {{--* Ici j'utilise le glide, le chemin est img/glide/images car c'est l'origine de l'image des bouteilles --}}
                    {{--* Pour une pastille, ce serait img/glide/pastilles/ $image_pastille, environ --}}
                    <img src="{{ url('glide/images/'. $bouteille->image_bouteille . '?p=xs') }}" alt="{{ $bouteille->image_bouteille_alt }}">
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
    @else
    <p>aucune bouteille trouvée</p>
    @endif
    <nav class="pagination">
        {{-- Lien précédent --}}
        @if ($bouteilles->onFirstPage())
            <a class="pagination-link disabled">&laquo;</a>
        @else
            <a href="{{ $bouteilles->previousPageUrl() }}" rel="prev" class="pagination-link">&laquo;</a>
        @endif

        {{-- Liens de pagination --}}
        @foreach ($pagination as $page => $url)
            @if ($page == $currentpage)
                <span class="pagination-link active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Lien suivant --}}
        @if ($bouteilles->hasMorePages())
            <a href="{{ $bouteilles->nextPageUrl() }}" rel="next" class="pagination-link">&raquo;</a>
        @else
            <span class="pagination-link disabled">&raquo;</span>
        @endif
    </nav>
    <div id="modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modal-title"></h2> 
            <form id="modal-form" method="POST" action="{{ route('cellier_quantite_bouteille.store') }}">
            @csrf
            <select name="cellier_id">
                @foreach ($celliers as $cellier)
                    <option value="{{ $cellier->id }}">{{ $cellier->nom }}</option>
                @endforeach
            </select>
            <div class="quantity-input">
                <span class="quantity-btn minus-btn" onclick="decrementQuantity()">&#8722;</span>
                <input name="quantite" type="number" id="quantity" value="1" min="1">
                <span class="quantity-btn plus-btn" onclick="incrementQuantity()">&#43;</span>
            </div>
            <input type="hidden" name="bouteille_id" id="bouteille-id">
            <div>
                <button type="submit" class="btn btn-primary btn-details">
                    Ajouter
                </button>
                <button type="button" class="btn btn-secondary btn-details" onclick="closeModal()">
                    Annuler
                </button>
            </div>
            </form>
        </div>
    </div>
</main>
@endsection