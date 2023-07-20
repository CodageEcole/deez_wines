@extends('layout.app')
@section('title', 'Ajouter un cellier')
@push('styles')
    <link href=" {{ asset('css/cellier-show.css') }}" rel="stylesheet">
@endpush
@section('content')
<main class="creerCellier">
    <form action="{{ route('celliers.store') }}" method="POST">
        @csrf
        <div>
            <label for="nom">cellier</label>
            <input type="text" name="nom" id="nom">
        </div>
        <div>
            <button class="boutonCellier espace" type="submit">Ajouter</button>
        </div>
    </form>

</main>
@endsection