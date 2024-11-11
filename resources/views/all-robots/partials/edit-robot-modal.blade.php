<x-modal name="edit-robot-modal" focusable>
    <form method="post" class="p-6">
        @csrf
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('all_robots_messages.edit_robot') }}
        </h2>

        <!-- Hidden robot ID -->
        <input type="hidden" id="edit_robot_id">

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="edit_robot_name" :value="__('all_robots_messages.robot_name')" required="true" />
            <x-text-input id="edit_robot_name" class="block mt-1 w-full" type="text" name="robot_name" required />
        </div>

        <!-- First Name -->
        <div class="mt-4">
            <x-input-label for="edit_author_first_name" :value="__('all_robots_messages.author_first_name')" required="true" />
            <x-text-input id="edit_author_first_name" class="block mt-1 w-full" type="text" name="author_first_name" required />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="edit_author_last_name" :value="__('all_robots_messages.author_last_name')" required="true" />
            <x-text-input id="edit_author_last_name" class="block mt-1 w-full" type="text" name="author_last_name" required />
        </div>

        <!-- Modal Actions -->
        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('all_robots_messages.cancel') }}
            </x-secondary-button>
            <x-primary-button type="button" class="ml-3" onclick="handleEditRobotSave()">
                {{ __('all_robots_messages.save') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>