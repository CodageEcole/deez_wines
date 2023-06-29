@extends('layout.app')
@section('content')
{{-- @if(count($erreurs) > 0)
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
@endif --}}
<h1 class="titre-principal"> INFOS SCRAPPER</h1>
@if(count($bouteilles) > 0)
  @php $bouteilles = array_slice($bouteilles, -10) @endphp
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
            @if($lang === "fr")
              @if(empty($bouteille['imagePastille_fr']))
                {{-- <p>cette bouteille n'a pas de pastille de goût</p> --}}
              @else
                  {{-- <p>{{$bouteille['imagePastille_fr']['alt']}}</p> --}}
                  <img src="{{asset('pastilles/' . $bouteille['imagePastille_fr']['url'])}}" alt="{{$bouteille['imagePastille_fr']['alt']}}" style="max-height: 65px">
              @endif
            @else
              @if(empty($bouteille['imagePastille_en']))
              <p>this bottle has no tasting tag</p>
              @else
                <p>{{$bouteille['imagePastille_en']['alt']}}</p>
                <img src="{{asset('pastilles/' . $bouteille['imagePastille_en']['url'])}}" alt="{{$bouteille['imagePastille_en']['alt']}}">
              @endif
            @endif
          </div>
          <div class="bouteille-image">
            {{-- <h3>image</h3> --}}
            @if($lang === "fr")
            <img src="{{ asset('images/Vin.png') }}" alt="{{ $bouteille['image_fr']['alt'] }}" style="max-height: 350px;">
            @else
            <img src="{{ asset('images/Vin.png') }}" alt="$bouteille['image_en']['alt']" style="max-height: 300px;">
            @endif
          </div>
        </div>
        <div class="title-desc">
          <div>
            {{-- <strong>{{ $loop->iteration }}</strong> --}}
            @if($lang === "fr")
              <h1>{{$bouteille['titre_fr']}}</h1>
            @else
              <h1>{{$bouteille['titre_en']}}</h1>
            @endif
          </div>
          <div class="localisation-box">
            <p>{{ $bouteille['attributs_fr']['Couleur'] }} | {{ $bouteille['attributs_fr']['Pays'] }}, {{ $bouteille['attributs_fr']['Région'] }}</p>
          </div>
          <div>
            {{-- <h3>Informations pertinentes</h3> --}}
            @if($lang === "fr")
              @if(empty($bouteille['texte_fr']))
                <p>cette bouteille n'a pas de texte descriptif</p>
              @else
                <p class="infos">{{$bouteille['texte_fr']}}</p>
              @endif
            @else
              @if(empty($bouteille['texte_en']))
                <p>this bottle has no descriptive text</p>
              @else
                <p class="infos">{{$bouteille['texte_en']}}</p>
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
            <p class="infos-detailles-text">{{ $bouteille['attributs_fr']['Pays'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Couleur </p>
            <p class="infos-detailles-text">{{ $bouteille['attributs_fr']['Couleur'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Région </p>
            <p class="infos-detailles-text">{{ $bouteille['attributs_fr']['Région'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Format </p>
            <p class="infos-detailles-text">{{ $bouteille['attributs_fr']['Format'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Désignation reglementée </p>
            <p class="infos-detailles-text">{{ $bouteille['attributs_fr']['Désignation réglementée'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Producteur </p>
            <p class="infos-detailles-text">{{ $bouteille['attributs_fr']['Producteur'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Cépage </p>
            @if (isset($bouteille['attributs_fr']['Cépage']))
                {{ $bouteille['attributs_fr']['Cépage'] }}
            @elseif (isset($bouteille['attributs_fr']['Cépages']))
                {{ $bouteille['attributs_fr']['Cépages'] }}
            @endif
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Agent Promotionnel </p>
            <p class="infos-detailles-text">{{ $bouteille['attributs_fr']['Agent promotionnel'] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Degrée d'Alcool </p>
            <p class="infos-detailles-text">{{ $bouteille['attributs_fr']["Degré d'alcool"] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Code SAQ </p>
            <p class="infos-detailles-text">{{ $bouteille['attributs_fr']["Code SAQ"] }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Taux de Sucre </p>
            <p class="infos-detailles-text">{{ isset($bouteille['attributs_fr']['Taux de sucre']) ? $bouteille['attributs_fr']['Taux de sucre'] : 'Non Disponible' }}</p>
          </div>
          <div class="infos-detailles-carte">
            <p class="infos-detailles-title"> Code CUP </p>
            <p class="infos-detailles-text">{{ $bouteille['attributs_fr']["Code CUP"] }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="custom-hr"></div>

  @endforeach
  @endif
  @endsection