@extends('layout.app')
@section('title', 'Créer une bouteille')
@section('content')

<form method="POST" action="{{ route('bouteilles.store')}}">
    @csrf
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" placeholder="Nom de la bouteille">
    <label for="description">Description</label>
    <textarea id="description" name="description" placeholder="Description de la bouteille"></textarea>
    <label for="pays">Pays</label>
    <input type="text" id="pays" name="pays" placeholder="Pays de la bouteille">
    <label for="region">Région</label>
    <input type="text" id="region" name="region" placeholder="Région de la bouteille">
    <label for="image_bouteille">Image</label>
    <input type="file" id="image_bouteille" name="image_bouteille" accept="image/png, image/jpeg">
    <input type="submit" value="Créer">
</form>

@endsection