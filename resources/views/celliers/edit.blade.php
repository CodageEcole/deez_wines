@extends('layout.app')
@section('title', 'Modifier' . $cellier->nom)
@push('styles')
    <link href=" {{ asset('css/cellier-show.css') }}" rel="stylesheet">
@endpush
@section('content')
<main class="creerCellier">
    <form action="{{ route('celliers.update', $cellier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nom">cellier</label>
            <input type="text" name="nom" id="nom" value="{{ $cellier->nom }}">
        </div>
        <div>
            <button class="boutonCellier espace" type="submit">Modifier</button>
        </div>
    </form>
</main>
@endsection