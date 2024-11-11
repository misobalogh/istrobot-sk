<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('all_robots_messages.all_robots_title') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl min-h-screen mx-auto dark:bg-gray-800 text-gray-900 dark:text-white shadow-md border border-gray-100 dark:border-gray-700">
        <!-- Header Row -->
        <div class="py-2 flex flex-row items-center sm:px-6 lg:px-8 px-10 gap-4 font-semibold text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700">
            <!-- <div class="flex-1 flex flex-row"> if the robot name and author name should be closer -->
                <div class="flex-1 text-lg flex items-center">
                    {{ __('all_robots_messages.robot_name') }}
                    <button id="sort-robot-name" class="ml-2 text-gray-500 dark:text-gray-300 focus:outline-none">
                        <span id="robot-arrow-up" class="hidden">▲</span>
                        <span id="robot-arrow-down">▼</span>
                    </button>
                </div>
                <div class="flex-1 text-lg flex items-center">
                    {{ __('all_robots_messages.author_name') }}
                    <button id="sort-author-name" class="ml-2 text-gray-500 dark:text-gray-300 focus:outline-none">
                    <span id="author-arrow-up" class="hidden">▲</span>
                    <span id="author-arrow-down">▼</span>
                </button>
                </div>
            <!-- </div> -->
            <div class="flex-1 text-right text-lg">
                {{ __('all_robots_messages.actions') }}
            </div>
        </div>    
        <div class="sm:px-6 lg:px-8 px-10">
        @foreach($robots as $robot)
            @include('all-robots.partials.robot-row', ['robot' => $robot])
        @endforeach
        </div>
    </div>
</x-app-layout>

<script>
    // Toggle arrow direction for Robot Name
    document.getElementById('sort-robot-name').addEventListener('click', function() {
        const robotArrowUp = document.getElementById('robot-arrow-up');
        const robotArrowDown = document.getElementById('robot-arrow-down');
        
        // Toggle robot arrow visibility
        if (robotArrowUp.classList.contains('hidden')) {
            robotArrowUp.classList.remove('hidden');
            robotArrowDown.classList.add('hidden');
        } else {
            robotArrowUp.classList.add('hidden');
            robotArrowDown.classList.remove('hidden');
        }
    });

    // Toggle arrow direction for Author Name
    document.getElementById('sort-author-name').addEventListener('click', function() {
        const authorArrowUp = document.getElementById('author-arrow-up');
        const authorArrowDown = document.getElementById('author-arrow-down');
        
        // Toggle author arrow visibility
        if (authorArrowUp.classList.contains('hidden')) {
            authorArrowUp.classList.remove('hidden');
            authorArrowDown.classList.add('hidden');
        } else {
            authorArrowUp.classList.add('hidden');
            authorArrowDown.classList.remove('hidden');
        }
    });
</script>