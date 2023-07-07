@extends('layout.app')
@section('title', 'Vos Celliers')
@section('content')
    <div>
        @foreach($celliers as $cellier)
            <div>
                <a href="{{ route('celliers.show', $cellier->id) }}">{{ $cellier->nom }}</a>
            </div>
        @endforeach
    </div>
    <a href="{{ route('celliers.create') }}">Ajouter un cellier</a>
@endsection