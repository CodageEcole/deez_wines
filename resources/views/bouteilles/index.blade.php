@extends('layout.app')
@section('title', 'Recherche')
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
    <div class="filtre">
        <label for="filtre-prix"></label>
        <select name="filtre-prix" id="filtre-prix">
            <option value="" selected>@lang('messages.all')</option>
            <option id="filtre-00-10" value="00-10">00-10</option>
            <option id="filtre-10-20" value="10-20">10-20</option>
            <option id="filtre-20-30" value="20-30">20-30</option>
            <option id="filtre-30-40" value="30-40">30-40</option>
            <option id="filtre-40-50" value="40-50">40-50</option>
            <option id="filtre-50-60" value="50-60">50-60</option>
            <option id="filtre-60+" value="60+">60+</option>
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