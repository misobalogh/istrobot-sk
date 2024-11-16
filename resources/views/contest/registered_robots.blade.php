<x-guest-layout>
    <section>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="container text-gray-900 dark:text-white">
                <h1>{{ __('registered_robots_messages.registered_robots') }} - {{ $year }}</h1>
                @forelse ($registered_robots as $category => $robots)
                <h2 class="font-semibold mt-4">{{ $category }}</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="px-4 py-2 text-left">{{ __('registered_robots_messages.robot_name') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('registered_robots_messages.author') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($robots as $robot)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2">{{ $robot['name'] }}</td>
                                <td class="px-4 py-2">{{ $robot['author'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @empty
                <p>{{ __('registered_robots_messages.no_categories') }}</p>
                @endforelse
            </div>
        </div>
    </section>
</x-guest-layout>