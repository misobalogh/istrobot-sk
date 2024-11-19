<div class="mb-6">
    <h3 class="text-lg font-bold mb-4">{{ __('statistics_messages.countries') }}</h3>
    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">{{ __('statistics_messages.country') }}</th>
                <th class="px-4 py-2">{{ __('statistics_messages.number_of_participants') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <td class="border px-4 py-2">
                        @if(App::getLocale() == 'en')
                            {{ $country['name_EN'] }}
                        @else
                            {{ $country['name_SK'] }}
                        @endif
                    </td>
                    <td class="border px-4 py-2 text-center">{{ $country['count'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
