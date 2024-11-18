<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="text-gray-900 dark:text-white">
            <div class="grid grid-cols-4 gap-4">
                @for ($year = now()->year; $year >= 2001; $year--)
                <a href="{{ "https://robotika.sk/contest/$year/" }}" class="block p-6 bg-gray-200 hover:bg-gray-300 rounded text-center text-xl">
                    {{ $year }}
                </a>
                @endfor
            </div>
        </div>
    </div>
</x-guest-layout>