<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('statistics_messages.page_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("statistics.robots-in-categories", ['categories' => $categories, 'totalRobots' => $totalRobots])
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("statistics.countries", ['countries' => $countries])
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("statistics.technologies", ['technologies' => $technologies])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>