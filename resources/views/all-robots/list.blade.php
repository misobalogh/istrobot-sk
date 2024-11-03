<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Robots') }}
        </h2>
    </x-slot>

    @foreach($robots as $robot)
        @include('all-robots.partials.robot-row', ['robot' => $robot])
    @endforeach
</x-app-layout>