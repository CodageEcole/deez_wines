@extends('layout.app')
@section('title', 'Vos Celliers')
@push('styles')
    <link href="{{ asset('css/celliers.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modal.css') }}" rel="stylesheet">
@endpush
@section('content')


@if (session('success'))
    <div class="alert-success" role="alert">{{ session('success') }}</div>
@endif
<main class="celliers">
    @foreach($celliers as $cellier)
        <div class="cellier">
            <a href="{{ route('celliers.show', $cellier->id) }}">
                <span>{{ ucfirst($cellier->nom) }}</span>
                <div class="infosCellier">
                    <span>Bouteilles : {{ $cellier->quantite_bouteilles }}</span>
                    @if($cellier->quantite_bouteilles > 0)
                    <div class="division-blanc"></div>
                    <div>
                        <span>Rouge : {{ $cellier->quantiteBouteillesRouges() ?? 0 }}</span><span>Rosé : {{ $cellier->quantiteBouteillesRoses() ?? 0 }}</span><span>Blanc : {{ $cellier->quantiteBouteillesBlanches() ?? 0 }}</span>
                    </div>
                    @endif
                </div>
            </a>
        </div>
    @endforeach
    <div>
        <button onclick="nouveauCellier()"><img src="{{ asset('icons/plus_icon.svg') }}" alt="Ajouter">@lang('messages.add')</button>
    </div>
</main>
@include('components.modals.modale-ajout-cellier')
@push('scripts')
<script src="{{ asset('js/messages.js') }}"></script>
<script src="{{ asset('js/modal.js') }}"></script>
@endpush
@endsection