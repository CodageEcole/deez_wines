@extends('layout.app')
@section('content')
@push('styles')
    <link href=" {{ asset('css/carte-vin.css') }}" rel="stylesheet">
@endpush
<main class="demo-liste">
  <h1 class="titre-principal"> Toutes les bouteilles!</h1>
  @if($bouteilles)
    @php $bouteilles = $bouteilles->slice(-50) @endphp
    @foreach ($bouteilles as $bouteille)
        <div class="carte-vin">
            <picture>
                {{--* Ici j'utilise le glide, le chemin est img/glide/images car c'est l'origine de l'image des bouteilles --}}
                {{--* Pour une pastille, ce serait img/glide/pastilles/ $image_pastille, environ --}}
                <img src="{{ url('glide/images/'. $bouteille->image_bouteille . '?p=xs') }}" alt="{{ $bouteille->image_bouteille_alt }}">
            </picture>
            <section>
                <h1>{{ $bouteille->nom }}</h1>
                <hr>
                <div>
                    <div>
                        <strong>{{ $bouteille->couleur_fr }} </strong>
                        <p>{{ $bouteille->pays_fr }}, {{ $bouteille->region_fr }}</p>
                    </div>
                    <button>Ajouter</button>
                </div>
            </section>
        </div>
    @endforeach
    @else
    <p>aucune bouteille trouvée</p>
    @endif
</main>
@endsection