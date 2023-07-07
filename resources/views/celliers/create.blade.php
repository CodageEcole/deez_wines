@extends('layout.app')
@section('title', 'Ajouter un cellier')
@section('content')
    <form action="{{ route('celliers.store') }}" method="POST">
        @csrf
        <div>
            <label for="nom">Nom du cellier</label>
            <input type="text" name="nom" id="nom">
        </div>
        <div>
            <button type="submit">Ajouter</button>
        </div>
    </form>
@endsection