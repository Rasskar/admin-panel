@extends('admin-panel.layouts.admin-panel')

@push('styles')
    @vite(['resources/css/admin-panel/dashboard.css'])
@endpush

@push('scripts')
    @vite(['resources/js/admin-panel/dashboard.js'])
@endpush

@section('header.title', 'Dashboard')

@section('content')
    Hello world
@endsection


