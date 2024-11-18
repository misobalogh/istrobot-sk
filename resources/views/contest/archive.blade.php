<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6 sm:pt-0 bg-gray-100 dark:bg-gray-900" style="margin-left: 10vw;">
        <div class="w-full max-w-screen-lg text-gray-900 dark:text-white">
            @php
                $years = range(now()->year, 2001);
                $yearChunks = array_chunk($years, 4);
            @endphp
            @foreach($yearChunks as $chunk)
                <div class="flex mb-4">
                    @foreach($chunk as $year)
                        <a href="{{ "https://robotika.sk/contest/$year/" }}" class="flex-1 p-6 bg-gray-200 hover:bg-gray-300 rounded text-center text-xl">
                            {{ $year }}
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>