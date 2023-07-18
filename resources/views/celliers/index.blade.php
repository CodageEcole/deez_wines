@extends('layout.app')
@section('title', 'Vos Celliers')
@push('styles')
    <link href="{{ asset('css/celliers.css') }}" rel="stylesheet">
@endpush
@section('content')
<main class="celliers">
    @foreach($celliers as $cellier)
        <div class="cellier">
            <a href="{{ route('celliers.show', $cellier->id) }}"> <span>{{ $cellier->nom }}</span>
                <div class="infosCellier">
                    <span>Bouteilles : {{ $cellier->quantite_bouteilles }}</span>
                    @if($cellier->quantite_bouteilles > 0)
                    <div >
                        <hr>
                        <span>Rouge : {{ $cellier->quantiteBouteillesRouges() ?? 0 }} Rosé : {{ $cellier->quantiteBouteillesRoses() ?? 0 }} Blanc : {{ $cellier->quantiteBouteillesBlanches() ?? 0 }}</span>
                    </div>
                    @endif
                </div>
            </a>
        </div>
    @endforeach
    <div>
        <a href="{{ route('celliers.create') }}"><img src="{{ asset('icons/plus_icon.svg') }}" alt="Ajouter">Ajouter</a>
    </div>
</main>
@endsection