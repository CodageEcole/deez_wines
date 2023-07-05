@extends('layout.app')
@section('title', 'Créer une bouteille')
@section('content')

<form method="POST" action="{{ route('bouteilles.store')}}">
    @csrf
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" placeholder="Nom de la bouteille">
</form>

@endsection