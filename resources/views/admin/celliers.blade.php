@extends('layout.app')
@section('title', __('messages.admin'))
@section('content')
    <main>
        @include('admin.partials.nav')

        <h2>Statistiques sur les celliers</h2>

        <p>Valeur totale des bouteilles dans tous les celliers : {{ $totalMontantCelliers }} $</p>

        <h2>Statistiques des celliers par usagers</h2>
        @foreach ($usersWithCelliers as $user)
            <h3>{{ $user->name }}</h3>
            <p>Nombre total de bouteilles détenues : {{ $user->totalBouteilles }}</p>
            <p>Valeur totale des celliers : {{ $user->totalMontant }} $</p>
            
            <table>
                <thead>
                    <tr>
                        <th>Cellier</th>
                        <th>Montant</th>
                        <th>Nombre de bouteilles</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->celliers as $cellier)
                        <tr>
                            <td>{{ $cellier->nom }}</td>
                            <td>{{ $montantsParUsagerCellier[$user->id][$cellier->id]['montant'] }} $</td>
                            <td>{{ $montantsParUsagerCellier[$user->id][$cellier->id]['nombre_bouteilles'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </main>

@endsection