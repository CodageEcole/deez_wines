@extends('layout.app')
@section('content')
@if(count($erreurs) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($erreurs as $erreur)
                <li>{{ $erreur }}</li>
            @endforeach
        </ul>
    </div>
@endif
<p>Nombre de codes SAQ traités : {{ $codesTraites }}</p>
@if(empty($erreurs))
  <p>Aucune erreur détectée!</p>
@endif
<h1 class="titre-principal"> INFOS SCRAPPER</h1>
@if(count($bouteilles) > 0)
  @php $bouteilles = $bouteilles->slice(-10) @endphp
  @foreach ($bouteilles as $bouteille)
    <div class="ensemble">
      <div class="info-row">
        {{-- <div class="prix-box">
          <h3>prix</h3>
          <p>{{$bouteille['prix']}}</p>
        </div> --}}
        <div class="pastilles-bouteilles-images">
          <div class="pastille-image">
            {{-- <h3>Pastille de goût</h3> --}}
            @if(empty($bouteille['image_pastille']))
              {{-- <p>cette bouteille n'a pas de pastille de goût</p> --}}
            @else
                {{-- <p>{{$bouteille['image_pastille_alt']}}</p> --}}
                <img src="{{asset('pastilles/' . $bouteille['image_pastille']) }}" alt="{{$bouteille['image_pastille_alt']}}" style="max-height: 65px">
            @endif
          </div>
          <div class="bouteille-image">
            {{-- <h3>image</h3> --}}
            <img src="{{ asset('images/' . $bouteille['image_bouteille']) }}" alt="{{ $bouteille['image_bouteille_alt'] }}" style="max-height: 350px;">
          </div>
        </div>
        <div class="title-desc">
          <div>
            {{-- <strong>{{ $loop->iteration }}</strong> --}}
              <h1>{{$bouteille['nom']}}</h1>
          </div>
          <div class="localisation-box">
            <p>{{ $bouteille['couleur_fr'] }} | {{ $bouteille['pays_fr'] }}, {{ $bouteille['region_fr'] }}</p>
          </div>
          <div>
            {{-- <h3>Informations pertinentes</h3> --}}
            @if($lang === "fr")
              @if(empty($bouteille['description_fr']))
                <p>cette bouteille n'a pas de texte descriptif</p>
              @else
                <p class="infos">{{$bouteille['description_fr']}}</p>
              @endif
            @else
              @if(empty($bouteille['description_en']))
                <p>this bottle has no descriptive text</p>
              @else
                <p class="infos">{{$bouteille['description_en']}}</p>
              @endif
            @endif
          </div>
          <div class="prix-box">
            <p>{{$bouteille['prix']}}</p>
          </div>
        </div>
      </div>
      <div class="infos">
        <div class="infos-title">
          <h3>infos Détaillés</h3>
        </div>
        <div class="infos-detailles">
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Pays </p>
            <p class="infos-detailles-text">{{ $bouteille['pays_fr'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Couleur </p>
            <p class="infos-detailles-text">{{ $bouteille['couleur_fr'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Région </p>
            <p class="infos-detailles-text">{{ $bouteille['region_fr'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Format </p>
            <p class="infos-detailles-text">{{ $bouteille['format'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Désignation reglementée </p>
            <p class="infos-detailles-text">{{ $bouteille['designation_reglementee_fr'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Producteur </p>
            <p class="infos-detailles-text">{{ $bouteille['producteur'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Cépage </p>
            @if (isset($bouteille['cepage']))
                {{ $bouteille['cepage'] }}
            @endif
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Agent Promotionnel </p>
            <p class="infos-detailles-text">{{ $bouteille['agent_promotionnel'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Degrée d'Alcool </p>
            <p class="infos-detailles-text">{{ $bouteille['degree_alcool'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Code SAQ </p>
            <p class="infos-detailles-text">{{ $bouteille['code_SAQ'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Taux de Sucre </p>
            <p class="infos-detailles-text">{{ isset($bouteille['taux_de_sucre']) ? $bouteille['taux_de_sucre'] : 'Non Disponible' }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Code CUP </p>
            <p class="infos-detailles-text">{{ $bouteille['code_CUP'] }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="custom-hr"></div>

  @endforeach
  @endif
  @endsection