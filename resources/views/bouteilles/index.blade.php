@extends('layout.app')
@section('content')
@push('styles')
    <link href=" {{ asset('css/carte-vin-lr.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/paginate.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/cellier-show.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/recherche.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/filtres.css') }}" rel="stylesheet">
@endpush
<header class="rechercheConteneur">
    <input class="rechercheInput" type="text" name="query" id="searchInput" placeholder="@lang('messages.search_bar_message')">
</header>

<h3 class="resultats"></h3>

<div class="filtres-tris-conteneur">
    <div class="filtres-trigger">
        <img src="{{ asset('icons/filter.svg') }}" alt="filtres">
        <p>@lang('messages.filters')</p>
    </div>
    <div class="tris-trigger">
        <img src="{{ asset('icons/sort.svg') }}" alt="tri">
        <p>@lang('messages.sort')</p>
    </div>
</div>
<div class="zone-pillules">
</div>

<form class="filtres-side-bar" method="GET">
    @csrf
    <div id="couleurs" class="filtre">
        <label for="filtre-rouge">@lang('messages.red')</label>
        <input type="checkbox" name="filtre-rouge" id="filtre-rouge" value="rouge">
        <label for="filtre-blanc">@lang('messages.white')</label>
        <input type="checkbox" name="filtre-blanc" id="filtre-blanc" value="blanc">
        <label for="filtre-rose">@lang('messages.rose')</label>
        <input type="checkbox" name="filtre-rose" id="filtre-rose" value="rose">
        <label for="filtre-orange">@lang('messages.orange')</label>
        <input type="checkbox" name="filtre-orange" id="filtre-orange" value="orange">
    </div>
    <div class="filtre">
        <label for="filtre-pays">@lang('messages.country')</label>
        <select name="filtre-pays" id="filtre-pays">
            <option value="" selected>@lang('messages.all')</option>
            @foreach($pays as $p)
                <option id="filtre-{{$p->pays_fr}}" value="{{$p->pays_fr}}">{{$p->pays_fr}}</option>
            @endforeach
        </select>
    </div>
</form>
<main class="indexBouteilles">

</main>

@include('components.modals.modale-ajout-bouteille')
@push('scripts')
<script src="{{ asset('js/modal.js')}}"></script>
<script src="{{ asset('js/search.js')}}"></script>
@endpush
@endsection