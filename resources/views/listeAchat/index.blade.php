@extends('layout.app')
@push('styles')
    <link href="{{ asset('css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('css/listeAchat.css') }}" rel="stylesheet">
@endpush
@section('title', __('messages.title_list'))
@section('content')
<main>
    @if (session('success'))
        <div class="alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <h2>@lang('messages.your_list')</h2>
    <div>
        @if($bouteilles->count() == 0)
            <p>@lang('messages.shopping_list')</p>
        @else
            @foreach($bouteilles as $bouteilleListe)
                <div class="item-liste">
                    <a href="{{ route('bouteilles.show', ['bouteille' => $bouteilleListe->bouteille->id]) }}" <p>{{ $bouteilleListe->bouteille->nom }}</p></a>
                    @if(count($celliers) > 0)
                    <div>
                        <div class="boutons" data-nom="{{ $bouteilleListe->bouteille->nom }}" data-id="{{ $bouteilleListe->bouteille->id }}" onclick='openModal("{{ $bouteilleListe->bouteille->nom }}","{{ $bouteilleListe->bouteille->id }}")'>
                            <p>@lang('messages.add')</p>
                            <img src="{{ asset('icons/plus_icon.svg') }}" alt="Plus">
                        </div>
                        <form class="formulaireDel" action="{{ route('liste_achat.destroy', $bouteilleListe->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="boutonSupp" type="submit"><img src="{{ asset('icons/x.svg') }}" alt=""></button>
                        </form>
                    </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</main>
@include('components.modals.modale-ajout-bouteille')
@include('components.modals.modale-confirmer-suppression')
@endsection

@push('scripts')
<script src="{{ asset('js/messages.js') }}"></script>
<script src="{{ asset('js/modal.js') }}"></script>
<script src="{{ asset('js/confirmerSupp.js')}}"></script>
@endpush