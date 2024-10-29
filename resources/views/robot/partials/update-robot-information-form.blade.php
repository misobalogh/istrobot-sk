<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('My Robots') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update robots.") }}
        </p>
    </header>

    @foreach ($robots as $robot)

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ $robot->name }}
                </p>
            </div>
        </div>
    @endforeach
</section>