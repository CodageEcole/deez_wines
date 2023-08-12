@extends('layout.app')
@section('title', __('messages.admin'))
@push('styles')
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
@endpush
@section('content')
<main>
    @include('admin.partials.nav')
    <h1>Gestion des usagers</h1>
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
                        @if($usager->role != 'admin')
                        <form class="formulaireDel" action="{{ route('admin.destroy', $usager->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="boutonSupp" type="submit" onclick="openModal()">@lang('messages.delete_account')</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
@include('components.modals.modale-confirmer-suppression')
@endsection
@push('scripts')
    <script src="{{ asset('js/confirmerSupp.js')}}"></script>
@endpush