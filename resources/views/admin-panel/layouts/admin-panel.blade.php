<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    @vite(['resources/css/admin-panel/style.css'])

    @stack('styles')
</head>
<body>
    <div class="admin-panel-container">
        @include('admin-panel.components.sidebar')

        <header class="header-container">
            <h3>@yield('header.title', '')</h3>
        </header>

        <main class="main-container">
            @yield('content')
        </main>
    </div>

    @vite(['resources/js/admin-panel/scripts.js'])

    @stack('scripts')
</body>
</html>
