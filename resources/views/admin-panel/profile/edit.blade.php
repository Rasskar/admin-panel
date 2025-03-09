@extends('admin-panel.layouts.admin-panel')

{{--@push('styles')
    @vite(['resources/css/admin-panel/dashboard.css'])
@endpush

@push('scripts')
    @vite(['resources/js/admin-panel/dashboard.js'])
@endpush--}}

@section('header.title', 'Profile')

@section('content')
    <div class="profile-info-container">
        <div>
            <label for="name">{{ __("Name") }}</label>
            <input class="user-name" type="text" name="name" value="" required />
        </div>

        <div>
            <label for="email">{{ __("Email") }}</label>
            <input class="user-email" type="email" name="email" value="" required />
        </div>

        <div>

        </div>
    </div>

    <div class="profile-auth-update">

    </div>
@endsection
