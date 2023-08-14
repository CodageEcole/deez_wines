@extends('layout.app')
@section('title', __('admin.admin'))
@push('styles')
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
@endpush
@section('content')
<main>
    @include('admin.partials.nav')
    {{-- <h2>Statistiques</h2>
    <p>Nombre total de bouteilles : {{ $totalBouteilles }}</p>
    <p>Nombre total d'usagers : {{ $totalUsagers }}</p>--}}

    <h1>@lang('admin.stats')</h1>

    <h2>@lang('admin.user_stats')</h2>
    <p>@lang('admin.total_users') : {{ $totalUsagers }}</p>
    <p>@lang('admin.new_users') : {{ $nouveauxUsagers }}</p>

    <h2>@lang('admin.cellars_stats')</h2>
    <p>@lang('admin.total_cellars') : {{ $totalCelliers }}</p>

    <h2>@lang('admin.users_cellars_stats')</h2>
    <p>@lang('admin.avg_user_cellars') : {{ $moyenneCelliersParUsager }}</p>
    <p>@lang('admin.avg_bottles_cellar') : {{ $moyenneBouteillesParCellier }}</p>
    <p>@lang('admin.avg_bottles_user') : {{ $moyenneBouteillesParUsager }}</p>

    <h2>@lang('admin.bottle_stats')</h2>
    <p>@lang('admin.total_bottles') : {{ $totalBouteilles }}</p>
    <p>@lang('admin.new_bottles_30_days') : {{ $totalBouteillesAjoutees }}</p>
    <p>@lang('admin.total_value_bottles') : {{ $totalMontantBouteilles }} $</p>
</main>
@include('components.modals.modale-confirmer-suppression')
@endsection
@push('scripts')
    <script src="{{ asset('js/confirmerSupp.js')}}"></script>
@endpush