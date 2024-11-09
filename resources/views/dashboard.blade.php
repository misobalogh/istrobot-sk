<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @if (Gate::allows('admin'))
                    {{ __("You're logged in as admin!") }}
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("dashboard.admin.starting-list", ['categories' => $categories])
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("dashboard.admin.add-category")
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("dashboard.admin.year-categories", ['categories' => $categories])
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("dashboard.admin.emails")
                </div>
            </div>
                    @else
                    <!-- TODO: Remove later -->
                    {{ __("You're logged in!") }} 
                    @endif
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                        @include("dashboard.profile-info")
                    </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("dashboard.robot-register", [
                        'categoriesForSetYear' => $categoriesForSetYear,
                        'robots' => $robots,
                        'robotsParticipation' => $robotsParticipation
                        ]) 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>