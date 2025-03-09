@extends('admin-panel.layouts.admin-panel')

@push('styles')
    @vite(['resources/css/admin-panel/profile/style.css'])
@endpush

@push('scripts')
    @vite(['resources/js/admin-panel/profile/script.js'])
@endpush

@section('header.title', 'Profile')

@section('content')
    <div class="profile-container">
        <div class="update-profile-info-container">
            <h4>Update Info</h4>
            <form id="updateProfileInfoForm" method="post" action="{{--{{ route('profile.update') }}--}}">
                @csrf

                <div>
                    <label for="userRole" class="form-label">{{ __("Role") }}</label>
                    <select id="userRole" name="role">
                        <option value="1">Administrator</option>
                        <option value="2">Developer</option>
                        <option value="3">Manager</option>
                    </select>
                </div>

                <div>
                    <label for="userName">{{ __("Name") }}</label>
                    <input id="userName" class="error" type="text" name="name" value="{{ $user->name }}" required />
                </div>

                <div>
                    <label for="userEmail">{{ __("Email") }}</label>
                    <input id="userEmail" type="email" name="email" value="{{ $user->email }}" required />
                </div>

                <div>
                    <label for="firstName">{{ __("First name") }}</label>
                    <input class="firstName" type="text" name="firstName" value="" />
                </div>

                <div>
                    <label for="lastName">{{ __("Last name") }}</label>
                    <input class="lastName" type="text" name="lastName" value="" />
                </div>

                <button type="submit" class="save-button">Save</button>
            </form>
        </div>

        <section class="update-profile-password-container">
            <h4>Update Password</h4>
            <form id="updateProfilePasswordForm" method="post" action="{{--{{ route('password.update') }}--}}">
                @csrf

                <div>
                    <label for="currentPassword">{{ __('Current Password') }}</label>
                    <input id="currentPassword" name="currentPassword" type="password" />
                </div>

                <div>
                    <label for="newPassword">{{ __('New Password') }}</label>
                    <input id="newPassword" name="newPassword" type="password" />
                </div>

                <div>
                    <label for="passwordConfirmation">{{ __('Confirm Password') }}</label>
                    <input id="passwordConfirmation" name="passwordConfirmation" type="password" />
                </div>

                <button type="submit" class="save-button">Save</button>
            </form>
        </section>
    </div>
@endsection
