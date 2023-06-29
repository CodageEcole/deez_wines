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
@if(count($bouteilles) > 0)
  @php $bouteilles = array_slice($bouteilles, -10) @endphp
  @foreach ($bouteilles as $bouteille)
    <div>
      <strong>{{ $loop->iteration }}</strong>
      @if($lang === "fr")
        <h1>{{$bouteille['titre_fr']}}</h1>
      @else
        <h1>{{$bouteille['titre_en']}}</h1>
      @endif
    </div>
    <div class="info-row">
      <div>
        <h3>prix</h3>
        <p>{{$bouteille['prix']}}</p>
      </div>
      <div>
        <h3>Pastille de goût</h3>
        @if($lang === "fr")
          @if(empty($bouteille['imagePastille_fr']))
            <p>cette bouteille n'a pas de pastille de goût</p>
          @else
              <p>{{$bouteille['imagePastille_fr']['alt']}}</p>
              <img src="{{asset('pastilles/' . $bouteille['imagePastille_fr']['url'])}}" alt="{{$bouteille['imagePastille_fr']['alt']}}">
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
      <div>
        <h3>image</h3>
        @if($lang === "fr")
          <img src="{{ asset('images/' . $bouteille['image_fr']['url']) }}" alt="{{ $bouteille['image_fr']['alt'] }}" style="max-height: 300px;">
        @else
          <img src="{{ asset('images/' . $bouteille['image_en']['url'])}}" alt="$bouteille['image_en']['alt']" style="max-height: 300px;">
        @endif
      </div>
      <div>
        <h3>Informations pertinentes</h3>
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
    </div>
    <div class="table-row">
      <table>
        <tbody>
          @if($lang === "fr")
            @if(empty($bouteille['attributs_fr']))
            <p>aucunes données à afficher</p>
            @else
              @foreach ($bouteille['attributs_fr'] as $index => $value)
              <tr>
                <td>{{ $index }}: </td>
                <td><strong>{{ $value }}</strong></td>
              </tr>
              @endforeach
            @endif
          @else
            @if(empty($bouteille['attributs_en']))
            <p>no data to display</p>
            @else
              @foreach ($bouteille['attributs_en'] as $index => $value)
              <tr>
                <td>{{ $index }}: </td>
                <td><strong>{{ $value }}</strong></td>
              </tr>
              @endforeach
            @endif
          @endif
        </tbody>
      </table>
      <table>
        <tbody>
          @if($lang === "fr")
            @if(empty($bouteille['tasting_fr']))
              <p>aucunes données à afficher</p>
            @else
              @foreach ($bouteille['tasting_fr'] as $index => $value)
              <tr>
                <td>{{ $index }}: </td>
                <td><strong>{{ $value }}</strong></td>
              </tr>
              @endforeach
            @endif
          @else
            @if(empty($bouteille['tasting_en']))
              <p>no data to display</p>
            @else
              @foreach ($bouteille['tasting_en'] as $index => $value)
              <tr>
                <td>{{ $index }}: </td>
                <td><strong>{{ $value }}</strong></td>
              </tr>
              @endforeach
            @endif
          @endif
        </tbody>
      </table>
    </div>
  @endforeach
@endif
@endsection