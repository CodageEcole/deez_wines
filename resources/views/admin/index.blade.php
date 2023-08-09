@extends('layout.app')
@section('title', __('messages.admin'))
@section('content')
<main>
    <h2>Statistiques</h2>
    <p>Nombre total de bouteilles : {{ $totalBouteilles }}</p>
    <p>Nombre total d'usagers : {{ $totalUsagers }}</p>
    <h3>Usagers avec leurs celliers :</h3>
    @if (session('success'))
        <div class="alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Nom de l'usager</th>
                <th>id de l'usager</th>
                <th>Nombre de celliers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usagersAvecCelliers as $usager)
                <tr>
                    <td>{{ $usager->name }}</td>
                    <td>{{ $usager->id }}</td>
                    <td>{{ $usager->celliers_count }}</td>
                    <td>
                        <form action="{{ route('admin.stats.destroy', $usager->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection