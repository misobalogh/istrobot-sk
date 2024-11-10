<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (Gate::allows('admin'))
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in as admin!") }}
                </div>
            </div>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("dashboard.profile-info")
                </div>
            </div>


            @if (Gate::allows('admin'))
            
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("dashboard.admin.set-year")
                </div>
            </div>
            
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-2xl text-gray-900 dark:text-gray-100">
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
            
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("dashboard.admin.starting-list", ['categories' => $categories])
                </div>
            </div>
            @endif


            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-900 dark:text-gray-100">
                    @include("dashboard.robot-register", [
                    'categoriesForSetYear' => $categoriesForSetYear,
                    'robots' => $robots,
                    'robotsParticipation' => $robotsParticipation
                    ])
                </div>
            </div>

            @if (session('success') === 'Registration updated successfully')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Registration updated.') }}</p>
            @endif
        </div>
    </div>
</x-app-layout>