<div class="mb-6">
    <h3 class="text-lg font-bold mb-4">{{ __('statistics_messages.robots_in_categories') }}</h3>
    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">{{ __('statistics_messages.category') }}</th>
                <th class="px-4 py-2">{{ __('statistics_messages.number_of_robots') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <td class="border px-4 py-2">{{ $category['name'] }}</td>
                    <td class="border px-4 py-2 text-center">{{ $category['count'] }}</td>
                </tr>
            @endforeach
            <tr class="bg-gray-200 dark:bg-gray-800 font-semibold">
                <td class="border px-4 py-2">{{ __('statistics_messages.total') }}</td>
                <td class="border px-4 py-2 text-center">{{ $totalRobots }}</td>
            </tr>
        </tbody>
    </table>
</div>
