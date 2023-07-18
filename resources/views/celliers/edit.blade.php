@extends('layout.app')
@section('title', 'Modifier' . $cellier->nom)
@section('content')
<main>
    <form action="{{ route('celliers.update', $cellier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nom">Nom du cellier</label>
            <input type="text" name="nom" id="nom" value="{{ $cellier->nom }}">
        </div>
        <div>
            <button type="submit">Modifier</button>
        </div>
    </form>
</main>
@endsection