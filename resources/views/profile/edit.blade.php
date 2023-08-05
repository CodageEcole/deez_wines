@extends('layout.app')
@section('title', __('messages.log_in'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
@endpush
@section('content')
<main>
        <h2>
            {{ __('Profile') }}
        </h2>
    @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    @include('profile.partials.delete-user-form')

</main>
    @endsection