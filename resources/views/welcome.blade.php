@extends('layout.app')
@push('styles')
<link href=" {{ asset('css/welcome.css') }}" rel="stylesheet">
@endpush
@section('content')

    <header>
        <div class="top-banniere">

        </div>
        <nav class="top-menu">
            <div class="top-menu-container">
                <div class="top-menu-logo">
                    <img src="{{ asset('images/wine_bottle.png') }}" alt="Logo">
                    <p>DW</p>
                </div>
                <div class="sprint">
                    <a href="{{ route('sprint0.liste') }}">Sprint 0</a>
                </div>
                <div class="sprint">
                    <p>Sprint 1</p>
                </div>
                <div class="sprint">
                    <p>Sprint 2</p>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="main-logo">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </div>
    </main>

    <footer>
        <p>Projet Réalisé par : Philippe Malo, Émile Daigneault, Louis Roby et Fataki Nsimba</p>
        <p>Tous Droits Réservés © DW 2023</p>
    </footer>
</html>

@endsection
