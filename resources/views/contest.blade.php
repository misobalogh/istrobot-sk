<x-guest-layout>
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