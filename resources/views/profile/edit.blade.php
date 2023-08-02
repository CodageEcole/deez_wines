@extends('layout.app')
@section('title', __('messages.profile_information'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
@endpush
@section('content')
<main class="login">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="">
            <div class="">
                <div class="">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="">
                <div class="">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="">
                <div class="">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</main>
    @endsection