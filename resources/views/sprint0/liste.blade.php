@extends('layout.app')
@section('content')
<main class="demo-liste">
  <h1 class="titre-principal"> INFOS SCRAPPER</h1>
  @if(count($bouteilles) > 0)
    @php $bouteilles = $bouteilles->slice(-20) @endphp
    @foreach ($bouteilles as $bouteille)
      <div class="ensemble">
        <div class="info-row">
            <div class="pastilles-bouteilles-images">
              <div class="pastille-image">
                  <img src="{{asset('pastilles/' . $bouteille->image_pastille )}}" alt="{{ $bouteille->image_pastille_alt }}" style="max-height: 65px">
              </div>
              <div class="bouteille-image">
                <img src="{{ asset('images/'. $bouteille->image_bouteille) }}" alt="{{ $bouteille->image_bouteille_alt }}" style="max-height: 350px;">
              </div>
            </div>
            <div class="title-desc">
              <div>
                <h1>{{ $bouteille->nom }}</h1>
              </div>
              <div class="localisation-box">
                <p>{{ $bouteille->couleur_fr }} | {{ $bouteille->pays_fr }}, {{ $bouteille->region_fr }}</p>
              </div>
              <div>
                  <p class="infos">{{ $bouteille->texte_fr }}</p>
              </div>
              <div class="prix-box">
                <p>{{ $bouteille->prix }}</p>
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
                <p class="infos-detailles-text">{{ $bouteille->pays_fr }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Couleur </p>
                <p class="infos-detailles-text">{{ $bouteille->couleur_fr }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Région </p>
                <p class="infos-detailles-text">{{ $bouteille->region_fr }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Format </p>
                <p class="infos-detailles-text">{{ $bouteille->format }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Désignation reglementée </p>
                <p class="infos-detailles-text">{{ $bouteille->designation_reglementee }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Producteur </p>
                <p class="infos-detailles-text">{{ $bouteille->producteur }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Cépage </p>
                <p class="infos-detailles-text">{{ $bouteille->cepage }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Agent Promotionnel </p>
                <p class="infos-detailles-text">{{ $bouteille->agent_promotionnel }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Degrée d'Alcool </p>
                <p class="infos-detailles-text">{{ $bouteille->degree_alcool }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Code SAQ </p>
                <p class="infos-detailles-text">{{ $bouteille->code_SAQ }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Taux de Sucre </p>
                <p class="infos-detailles-text">{{ $bouteille->taux_sucre }}</p>
              </div>
              <div class="infos-detailles-carte">
                <p class="infos-detailles-title"> Code CUP </p>
                <p class="infos-detailles-text">{{ $bouteille->code_CUP }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="custom-hr"></div>
      </div>
    @endforeach
  @endif
@endsection
</main>