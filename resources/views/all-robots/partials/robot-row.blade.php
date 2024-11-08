<div class="flex flex-row items-center mx-auto gap-4 py-2 px-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border-b" style="border-bottom: 1px solid transparent; border-image: linear-gradient(to right, rgba(55, 65, 81, 0) 0%, rgba(55, 65, 81, 1) 50%, rgba(55, 65, 81, 0) 100%) 1;">
    <!-- <div class="flex-1 flex flex-row"> if the robot name and author name should be closer -->
        <div class="flex-1 font-semibold truncate">
            {{ $robot->name }}
        </div>

        <!-- Author Name -->
        <div class="flex-1 font-semibold truncate">
            {{ $robot->author_first_name }} {{ $robot->author_last_name }}
        </div>
    <!-- </div> -->

    <!-- Action Button -->
    <div class="flex gap-2 flex-1 justify-end">
        <!-- Hide Button -->
        <x-primary-button type="button" onclick="handleHideRobot({{ $robot->id }})">
            Hide
        </x-primary-button>
    </div>
</div>