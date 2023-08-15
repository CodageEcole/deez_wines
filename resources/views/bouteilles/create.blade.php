@extends('layout.app')
@section('title', __('messages.create'))
@push('styles')
    <link href=" {{ asset('css/cellier-show.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/form-full-size.css')}}">
@endpush
@section('content')
<main class="creerCellier">
    <form class="form-full-size" method="POST" action="{{ route('bouteilles.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-input">
            <label for="nom">@lang('messages.name')</label>
            <input type="text" id="nom" name="nom" placeholder="@lang('messages.place_name')">
        </div>
        <div class="form-input">
            <label for="description">@lang('messages.description')</label>
            <textarea id="description" name="description" placeholder="@lang('messages.place_desc')"></textarea>
        </div>
        <div class="form-input">
            <label for="pays">@lang('messages.country')</label>
            <input type="text" id="pays" name="pays" placeholder="@lang('messages.place_country')">
        </div>
        <div class="form-input">
            <label for="region">@lang('messages.region')</label>
            <input type="text" id="region" name="region" placeholder="@lang('messages.place_region')">
        </div>
        <div class="form-input">
            <label for="image_bouteille">@lang('messages.picture')</label>
            <input type="file" id="image_bouteille" name="image_bouteille" accept="image/png, image/jpeg">
        </div>
        <button class="boutonCellier espace" type="submit" value="Créer" aria-label="Parcourir">@lang('messages.create')</button>
    </form>
</main>
@endsection