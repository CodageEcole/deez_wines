@extends('layout.app')
@push('styles')
    <link href="{{ asset('css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('css/listeAchat.css') }}" rel="stylesheet">
@endpush
@section('content')
<main>
    @if (session('success'))
        <div class="alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <h2>Votre liste d'achat</h2>
    <div>
    @foreach($bouteilles as $bouteille)
        <div class="item-liste">
            <a href="{{ route('bouteilles.show', ['bouteille' => $bouteille->id]) }}"<p>{{ $bouteille->nom }}</a>
            <div>
                <div class="boutons" data-nom="{{ $bouteille->nom }}" data-id="{{ $bouteille->id }}" onclick='openModal("{{ $bouteille->nom }}","{{ $bouteille->id }}")'>
                    <p>@lang('messages.add')</p>
                    <img src="{{ asset('icons/plus_icon.svg') }}" alt="Plus">
                </div>
                <button><img src="{{ asset('icons/x.svg') }}" alt="Retirer une bouteille"></button>
            </div>
        </div>
    @endforeach
    </div>
</main>
@endsection
@include('components.modals.modale-ajout-bouteille')
@push('scripts')
<script src="{{ asset('js/messages.js') }}"></script>
<script src="{{ asset('js/modal.js') }}"></script>
@endpush