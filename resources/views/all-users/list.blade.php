<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-10 dark:bg-gray-800 text-gray-900 dark:text-white shadow-md border border-gray-100 dark:border-gray-700">
        @foreach($users as $user)
            @include('all-users.partials.user-row', ['user' => $user])
        @endforeach
    </div>
</x-app-layout>