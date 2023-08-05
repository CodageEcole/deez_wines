@extends('layout.app')
@section('content')
@push('styles')
    <link href=" {{ asset('css/carte-vin-lr.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/paginate.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/cellier-show.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/recherche.css') }}" rel="stylesheet">
@endpush
<main class="indexBouteilles">
    <input type="text" name="query" id="searchInput" placeholder="Start typing to search">
    <div class="carte-vin-container">
        
    </div>
</main>
{{-- la boîte modale d'ajout de bouteilles au cellier --}}
@include('components.modals.modale-ajout-bouteille')
@push('scripts')
<script src="{{ asset('js/modal.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/search.js')}}"></script>
@endpush
@endsection