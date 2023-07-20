@extends('layout.app')
@section('title', 'Créer une bouteille')
@push('styles')
    <link href=" {{ asset('css/cellier-show.css') }}" rel="stylesheet">
@endpush
@section('content')
<main class="creerCellier">
    <form method="POST" action="{{ route('bouteilles.store')}}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Nom de la bouteille">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Description de la bouteille"></textarea>
        </div>
        <div>
            <label for="pays">Pays</label>
            <input type="text" id="pays" name="pays" placeholder="Pays de la bouteille">
        </div>
        <div>
            <label for="region">Région</label>
            <input type="text" id="region" name="region" placeholder="Région de la bouteille">
        </div>
        <div>
            <label for="image_bouteille">Image</label>
            <input type="file" id="image_bouteille" name="image_bouteille" accept="image/png, image/jpeg">
        </div>
        <button class="boutonCellier espace" type="submit" value="Créer">Créer</button>
    </form>
</main>
@endsection