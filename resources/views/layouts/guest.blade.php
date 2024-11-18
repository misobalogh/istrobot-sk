<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ISTROBOT') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="bg-gray-800 text-white p-4 min-h-screen flex flex-col justify-center items-center fixed" style="min-width: 10vw;">
        <!-- Navbar content goes here -->
        <div class="relative w-full flex justify-center">
            <div class="relative">
                <button id="languageSelection" class="flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7 0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7 7 0 0 0 13.745 12H11.91a9.3 9.3 0 0 1-.64 1.539 7 7 0 0 1-.597.933M8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855q.26-.487.468-1.068zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.7 13.7 0 0 1-.312 2.5m2.802-3.5a7 7 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7 7 0 0 0-3.072-2.472c.218.284.418.598.597.933M10.855 4a8 8 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M1.646 5.646a.5.5 0 011 0L8 11.293l5.354-5.647a.5.5 0 111 0l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" />
                    </svg>
                </button>
                <div id="languageOptions" class="hidden absolute left-[100%] -top-0 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg z-20">
                    <a href="{{ route('lang.switch', 'en') }}" class="block font-semibold px-4 py-2 w-fit text-gray-600 hover:text-gray-900 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-white">EN</a>
                    <a href="{{ route('lang.switch', 'sk') }}" class="block font-semibold px-4 py-2 w-fit text-gray-600 hover:text-gray-900 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-white">SK</a>
                </div>
            </div>
        </div>
        <ul>
            @php
            $currentYear = session('contest_year', App\Models\Setting::where('key', 'competition_year')->first()->value);
            @endphp
            <a href="{{ route('contest.show', ['year' => $currentYear]) }}/#news">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">{{ __('guest_messages.news') }}</li>
            </a>

            <a href="{{ route('contest.show', ['year' => $currentYear]) }}/#rules">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">{{ __('guest_messages.rules') }}</li>
            </a>

            <a href="{{ route('registered-robots', ['year' => $currentYear]) }}">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">{{ __('guest_messages.robots') }}</li>
            </a>

            <a href="{{ route('archive') }}">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">{{ __('guest_messages.archive') }}</li>
            </a>


            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">{{ __('guest_messages.dashboard') }}</li>
            </a>
            @else
            <a href="{{ route('login') }}">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">{{ __('guest_messages.login') }}</li>
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">{{ __('guest_messages.register') }}</li>
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

<script>
    document.getElementById('languageSelection').addEventListener('click', function() {
        var menu = document.getElementById('languageOptions');
        menu.classList.toggle('hidden');
    });
</script>