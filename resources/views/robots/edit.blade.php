<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('my_robots_messages.my_robots_title') }}
        </h2>
    </x-slot>

    @include('robots.partials.update-robot-information-form')
</x-app-layout>