<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Ms5qXNxHPT+B0DnH6X60r0Z9Cxsijp5ecUTM/Lm5prMwQ7PJhqW8wDjhWcSLgG9m" crossorigin="anonymous">
    <link href=" {{ asset('css/layout-lr.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/root.css') }}" rel="stylesheet">
    <title>Layout</title>
</head>
{{-- {{ asset('images/icons/add_icon_white.svg') }} --}}
<body>

    <header>
        <div class="blue-top"></div>
        <nav>
            <div class="logo">
                <img src="{{ asset('logos/deez_wines_logo_small.svg') }}" alt="Logo">
            </div>
            <div class="search-more">
                <a href="#" id="search-icon">
                    <img src="{{ asset('icons/search_icon.svg') }}" alt="Recherche">
                </a>
                <a href="#">
                    <img src="{{ asset('icons/more_icon.svg') }}" alt="Plus">
                </a>
            </div>
        </nav>
        
        <nav id="search-bar" style="display: none;">
            <form action="{{ route('bouteilles.index') }}" method="GET">
                <button id="arrow-back" type="button" onclick=goBack()>
                    <img src="{{ asset('icons/search_icon.svg') }}" alt="Retour">
                </button>
                <input type="text" name="search" id="search" placeholder="Recherche">
                <button id="recherche" type="submit">
                    <img src="{{ asset('icons/search_icon.svg') }}" alt="Recherche">
                </button>
            </form>
        </nav>

        <div class="grey-top"></div>
    </header>

        @yield('content')

    <footer>
        <div class="footer-icon-tray">
            <a href="#">
                <img class="footer-icon-img" src="{{ asset('icons/profil_icon_white.svg') }}" alt="Profil">
                <p>Profil</p>
            </a>
            <a href="{{ route('bouteilles.index') }}">
                <img class="footer-icon-img" src="{{ asset('icons/catalogue_icon_white.svg') }}" alt="Catalogue">
                <p>Catalogue</p>
            </a>
            <a href="{{ route('celliers.index') }}">
                <img class="footer-icon-img" src="{{ asset('icons/cellier_icon_white.svg') }}" alt="Celliers">
                <p>Celliers</p>
            </a>
            <a href="#">
                <img class="footer-icon-img" src="{{ asset('icons/add_icon_white.svg') }}" alt="Ajouter">
                <p>Ajouter</p>
            </a>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>