@extends('layout.app')
@section('title', __('admin.user_manage'))
@push('styles')
    <link href=" {{ asset('css/modal.css') }}" rel="stylesheet">
@endpush
@section('content')
<main>
    @include('admin.partials.nav')
    <h1>@lang('admin.user_manage')</h1>
    @if (session('success'))
        <div class="alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>@lang('admin.user_name')</th>
                <th>@lang('admin.user_id')</th>
                <th>@lang('admin.user_cellars_qty')</th>
                <th>@lang('admin.user_actions')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usagersAvecCelliers as $usager)
                <tr>
                    <td>{{ $usager->name }}</td>
                    <td>{{ $usager->id }}</td>
                    <td>{{ $usager->celliers_count }}</td>
                    <td>
                    <button class="boutonUpdate"
        data-userid="{{ $usager->id }}"
        data-username="{{ $usager->name }}"
        data-email="{{ $usager->email }}"
        onclick="openUpdateDialog(this)">Mettre à jour</button>
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
<!-- Boîte de dialogue de mise à jour -->
<dialog id="updateDialog">
    <h2>Mise à Jour du Profil</h2>
    <form id="updateForm" method="POST" action="{{ route('admin.update', ['user' => $usager->id]) }}">
        @csrf
        @method('PATCH')
        <input type="hidden" id="userId" name="userId">

        <label for="username">Nouveau Nom d'Utilisateur:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Nouvelle Adresse E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Mettre à Jour</button>
    </form>
    <button id="closeDialog">Fermer</button>
</dialog>
<script>
    const updateButtons = document.querySelectorAll('.boutonUpdate');
    const updateDialog = document.getElementById('updateDialog');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const userIdInput = document.getElementById('userId');
    const updateForm = document.getElementById('updateForm');

    updateButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const userId = event.target.getAttribute('data-userid');
            const username = event.target.getAttribute('data-username');
            const email = event.target.getAttribute('data-email');

            console.log(userId, username, email);
            updateForm.action = '{{ route("admin.update", ["user" => "__userId__"]) }}'.replace('__userId__', userId);
            userIdInput.value = userId;
            usernameInput.value = username;
            emailInput.value = email;
            updateDialog.showModal();
        });
    });

    updateForm.addEventListener('submit', (event) => {
        // Votre code pour gérer la soumission du formulaire
    });

    const closeDialogButton = document.getElementById('closeDialog');
    closeDialogButton.addEventListener('click', () => {
        updateDialog.close();
    });
</script>

@include('components.modals.modale-confirmer-suppression')
@endsection
@push('scripts')
    <script src="{{ asset('js/confirmerSupp.js')}}"></script>
@endpush