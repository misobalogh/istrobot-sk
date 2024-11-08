<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl min-h-screen mx-auto dark:bg-gray-800 text-gray-900 dark:text-white shadow-md border border-gray-100 dark:border-gray-700">
        <!-- Header Row -->
        <div class="py-2 flex flex-row items-center sm:px-6 lg:px-8 px-10 gap-4 font-semibold text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700">
            <div class="flex-1 w-full text-lg">
                User Name
            </div>
            <div class="flex-1 w-full text-lg">
                Email
            </div>
            <div class="flex-1 w-full text-lg">
                Password
            </div>
            <div class="flex-1 w-full text-lg">
                Actions
            </div>
        </div>     
        <div class="sm:px-6 lg:px-8 px-10">
            @foreach($users as $user)
                @include('all-users.partials.user-row', ['user' => $user])
            @endforeach
        </div>
    </div>
</x-app-layout>