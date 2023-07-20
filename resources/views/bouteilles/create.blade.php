@extends('layout.app')
@section('title', 'Créer une bouteille')
@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form-full-size.css') }}">
@endpush

<form class="form-full-size" method="POST" action="{{ route('bouteilles.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-input">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" placeholder="Nom de la bouteille">
    </div>
    <div class="form-input">
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Description de la bouteille"></textarea>
    </div>
    <div class="form-input">
        <label for="pays">Pays</label>
        <input type="text" id="pays" name="pays" placeholder="Pays de la bouteille">
    </div>
    <div class="form-input">
        <label for="region">Région</label>
        <input type="text" id="region" name="region" placeholder="Région de la bouteille">
    </div>
    <div class="form-input">
        <label for="image_bouteille">Image</label>
        <input type="file" id="image_bouteille" name="image_bouteille" accept="image/png, image/jpeg">
    </div>
    <input class="form-submit" type="submit" value="Créer">
</form>

@endsection