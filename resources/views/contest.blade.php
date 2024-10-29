<x-guest-layout>
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
    <div class="container mx-auto px-4">
        {{-- Display Categories --}}
        <div class="mt-8">
            <h1 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Categories in {{ $year }}</h1>
            @include('contest.categories', ['categories' => $categories])
        </div>

        {{-- Display Registered Robots --}}
        <div class="mt-8">
            <h1 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Registered Robots for {{ $year }}</h1>
            @include('contest.registered_robots', ['categories' => $registered_robots])
        </div>
    </div>
</x-guest-layout>