<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Ms5qXNxHPT+B0DnH6X60r0Z9Cxsijp5ecUTM/Lm5prMwQ7PJhqW8wDjhWcSLgG9m" crossorigin="anonymous">
    <link href=" {{ asset('css/layout-lr.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/root.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/messages.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
    @vite(['resources/js/app.js'])
</head>


<body>
    <header>
        <div class="blue-top"></div>
        <nav>
            <div class="logo">
                {{-- <img src="{{ asset('logos/deez_wines_logo_small.svg') }}" alt="Logo"> --}}
            </div>
            <ul>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if($localeCode != LaravelLocalization::getCurrentLocale())
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endif
                @endforeach
            </ul>
            @if(!isset($cacherLayout))
                <div class="search-more">
                    <a href="#">
                        <img src="{{ asset('icons/more_icon.svg') }}" alt="Plus">
                    </a>
                </div>
            @endif
        </nav>
        <div class="grey-top"></div>
    </header>

        @yield('content')

    <footer>
    @if(!isset($cacherLayout))
        <div class="footer-icon-tray">
            <a href="{{ route('profile.edit') }}">
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
    @endif
    </footer>
    @stack('scripts')
</body>
</html>