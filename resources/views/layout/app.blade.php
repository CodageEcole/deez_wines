<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @push('scripts')
        @vite(['resources/js/app.js'])
        <script src="{{ asset('js/hamburger.js')}}"></script>
    @endpush
    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Ms5qXNxHPT+B0DnH6X60r0Z9Cxsijp5ecUTM/Lm5prMwQ7PJhqW8wDjhWcSLgG9m" crossorigin="anonymous">
    <link href=" {{ asset('css/layout-lr.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/hamburger.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/root.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/messages.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>


<body>
    <header>
        <div class="blue-top"></div>
        <nav>
            <div class="logo">
                {{-- <img src="{{ asset('logos/deez_wines_logo_small.svg') }}" alt="Logo"> --}}
            </div>
            
            @if(!isset($cacherLayout))
                <div class="search-more">
                    {{-- <a href="#">
                        <img src="{{ asset('icons/more_icon.svg') }}" alt="Plus">
                    </a> --}}
                </div>
                <a class="hamburger">
                    <img src="{{ asset('icons/more_icon.svg') }}" alt="Plus">
                </a>
            @endif
        </nav>
        <div class="grey-top"></div>
    </header>
    <section class="mobile-nav">
        <div class="deconnexion-div">
            <div class="deconnexion-button">
                <a href="{{ route('logout') }}">Déconnexion</a>
            </div>
        </div>
        <div class="deconnexion-menu">
            <a href="{{ route('profile.edit') }}">Profil</a>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('admin.index') }}">@lang('admin.admin')</a>
            @endif
            <a href="{{ route('liste_achat.show', ['liste_achat' => '1']) }}">Liste d'achat</a>
            <a href="#">Changer vos infos personnelles</a>
            <a href="#">Changer votre mot de passe</a>
            <a href="#">Ajouter une bouteille au répertoire</a>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                @if($localeCode != LaravelLocalization::getCurrentLocale())
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                @endif
            @endforeach
        </div>

        <div class="deconnexion-app-info">
            <div>
                <p>DW © Tous Droits Réservés</p>
            </div>
            <div>
                <p>App Version 0.1</p>
            </div>
        </div>
    </section>
    <div class="overlay-grey"></div>

        @yield('content')

    <footer class="footer">
    @if(!isset($cacherLayout))
        <div class="footer-icon-tray">
            <a href="{{ route('profile.edit') }}">
                <img class="footer-icon-img" src="{{ asset('icons/profil_icon_white.svg') }}" alt="Profil">
                <p>@lang('messages.profile')</p>
            </a>
            <a href="{{ route('bouteilles.index') }}">
                <img class="footer-icon-img" src="{{ asset('icons/catalogue_icon_white.svg') }}" alt="Catalogue">
                <p>@lang('messages.search')</p>
            </a>
            <a href="{{ route('celliers.index') }}">
                <img class="footer-icon-img" src="{{ asset('icons/cellier_icon_white.svg') }}" alt="Celliers">
                <p>@lang('messages.cellars')</p>
            </a>
            <a href="#">
                <img class="footer-icon-img" src="{{ asset('icons/add_icon_white.svg') }}" alt="Ajouter">
                <p>@lang('messages.add')</p>
            </a>
        </div>
    @endif
    </footer>
    @stack('scripts')
</body>
</html>