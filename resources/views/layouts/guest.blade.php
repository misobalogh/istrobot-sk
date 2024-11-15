<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="w-[200px] bg-gray-800 text-white p-4 min-h-screen flex flex-col justify-center items-center" style="position: fixed; width: 10%;">
        <!-- Navbar content goes here -->
        <ul>
            @php
                $currentYear = session('contest_year', App\Models\Setting::where('key', 'competition_year')->first()->value);
            @endphp
            <a href="{{ route('contest.show', ['year' => $currentYear]) }}/#news">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Novinky</li>
            </a>

            <a href="{{ route('contest.show', ['year' => $currentYear]) }}/#rules">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Pravidla</li>
            </a>

            <a href="{{ route('registered-robots', ['year' => $currentYear]) }}">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Roboty</li>
            </a>

            <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Archiv</li>
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Dashboard</li>
            </a>
            @else
            <a href="{{ route('login') }}">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Log in</li>
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Register</li>
            </a>
            @endif
            @endauth
            @endif
            <a href="https://www.facebook.com/RobotikaSK">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded flex justify-center items-center"><img src="{{ asset('img/icon/fb.png') }}" width="30px"></li>
            </a>
            <a href="https://www.youtube.com/channel/UCZTEibKdgnHuZd-jmlg_IsQ">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded flex justify-center items-center"><img src="{{ asset('img/icon/yt.png') }}" width="30px"></li>
            </a>
            <a href="#top">
                <li class="text-center hover:bg-gray-700 rounded flex justify-center items-center"><img src="{{ asset('img/icon/scroll.png') }}" width="50px"></li>
            </a>
        </ul>
    </div>
    {{ $slot }}
</body>

</html>