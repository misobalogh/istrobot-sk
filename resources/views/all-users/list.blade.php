<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    @foreach($users as $user)
        @include('all-users.partials.user-row', ['user' => $user])
    @endforeach
</x-app-layout>