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
        <section class="update-profile-info-container">
            <h3>{{ __("Update Info") }}</h3>
            <form id="updateProfileInfoForm" method="POST" action="{{ route('profile.updateInfo') }}" novalidate>
                <div>
                    <label for="userRole" class="form-label">{{ __("Role") }}</label>
                    <select id="userRole" name="roleId">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{$role->name}}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div>
                    <label for="userName">{{ __("Name") }}</label>
                    <input id="userName" type="text" name="name" value="{{ $user->name }}" />
                    <div class="invalid-feedback"></div>
                </div>

                <div>
                    <label for="userEmail">{{ __("Email") }}</label>
                    <input id="userEmail" type="email" name="email" value="{{ $user->email }}" />
                    <div class="invalid-feedback"></div>
                </div>

                <div>
                    <label for="firstName">{{ __("First name") }}</label>
                    <input class="firstName" type="text" name="firstName" value="{{ $user->first_name }}" />
                    <div class="invalid-feedback"></div>
                </div>

                <div>
                    <label for="lastName">{{ __("Last name") }}</label>
                    <input class="lastName" type="text" name="lastName" value="{{ $user->last_name }}" />
                    <div class="invalid-feedback"></div>
                </div>

                <button type="submit" class="save-button">
                    <span class="btn-loader"></span>
                    <span class="btn-text">{{ __("Save") }}</span>
                </button>
                <span class="result-submit success"></span>
            </form>
        </section>

        <section class="update-profile-password-container">
            <h3>{{ __("Update Password") }}</h3>
            <form id="updateProfilePasswordForm" method="post" action="{{ route('profile.updatePassword') }}" novalidate>
                <div>
                    <label for="currentPassword">{{ __('Current Password') }}</label>
                    <input id="currentPassword" name="currentPassword" type="password" />
                    <div class="invalid-feedback"></div>
                </div>

                <div>
                    <label for="newPassword">{{ __('New Password') }}</label>
                    <input id="newPassword" name="newPassword" type="password" />
                    <div class="invalid-feedback"></div>
                </div>

                <div>
                    <label for="passwordConfirmation">{{ __('Confirm Password') }}</label>
                    <input id="passwordConfirmation" name="passwordConfirmation" type="password" />
                    <div class="invalid-feedback"></div>
                </div>

                <button type="submit" class="save-button">
                    <span class="btn-loader"></span>
                    <span class="btn-text">{{ __("Save") }}</span>
                </button>
                <span class="result-submit"></span>
            </form>
        </section>
    </div>
@endsection
