<div class="mb-6">
    <h3 class="text-lg font-bold mb-4">{{ __('statistics_messages.technologies_used') }}</h3>
    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">{{ __('statistics_messages.technology') }}</th>
                <th class="px-4 py-2">{{ __('statistics_messages.number_of_robots') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($technologies as $technology)
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <td class="border px-4 py-2">{{ $technology->name }}</td>
                    <td class="border px-4 py-2 text-center">{{ $technology->robots_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
