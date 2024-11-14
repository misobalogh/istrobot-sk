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

        <div class="flex gap-4 w-full">
            <!-- First Name -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_author_first_name" :value="__('all_robots_messages.author_first_name')" required="true" />
                <x-text-input id="edit_author_first_name" class="block mt-1 w-full" type="text" name="author_first_name" required />
            </div>

            <!-- Last Name -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_author_last_name" :value="__('all_robots_messages.author_last_name')" required="true" />
                <x-text-input id="edit_author_last_name" class="block mt-1 w-full" type="text" name="author_last_name" required />
            </div>
        </div>

        <!-- Coauthors -->
        <div class="mt-4">
            <x-input-label for="edit_coauthors" :value="__('all_robots_messages.coauthors')" />
            <x-text-input id="edit_coauthors" class="block mt-1 w-full" type="text" name="coauthors" />
        </div>

        <div class="flex gap-4 w-full">
            <!-- Processor -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_processor" :value="__('all_robots_messages.processor')" required="true" />
                <x-text-input id="edit_processor" class="block mt-1 w-full" type="text" name="processor" required />
            </div>

            <!-- Memory Size -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_memory_size" :value="__('all_robots_messages.memory_size')" />
                <x-text-input id="edit_memory_size" class="block mt-1 w-full" type="text" name="memory_size" :placeholder="__('all_robots_messages.placeholder_memory_size')" />
            </div>

            <!-- Frequency -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_frequency" :value="__('all_robots_messages.frequency')" required="true" />
                <x-text-input id="edit_frequency" class="block mt-1 w-full" type="text" name="frequency" :placeholder="__('all_robots_messages.placeholder_frequency')" required/>
            </div>
        </div>

        <!-- Sensors -->
        <div class="mt-4">
            <x-input-label for="edit_sensors" :value="__('all_robots_messages.sensors')" />
            <x-text-input id="edit_sensors" class="block mt-1 w-full" type="text" name="sensors" />
        </div>

        <div class="flex gap-4 w-full">
            <!-- Drive -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_drive" :value="__('all_robots_messages.drive')" />
                <x-text-input id="edit_drive" class="block mt-1 w-full" type="text" name="drive" />
            </div>

            <!-- Power Supply -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_power_supply" :value="__('all_robots_messages.power_supply')" />
                <x-text-input id="edit_power_supply" class="block mt-1 w-full" type="text" name="power_supply" />
            </div>
        </div>

        <div class="flex gap-4 w-full">
            <!-- Programming Language -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_programming_language" :value="__('all_robots_messages.programming_language')" required="true" />
                <x-text-input id="edit_programming_language" class="block mt-1 w-full" type="text" name="programming_language" required />
            </div>

            <!-- Technology -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_technology_id" :value="__('all_robots_messages.technology')" required="true" />
                <select id="edit_technology_id" name="technology_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    @foreach($technologies as $technology)
                    <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Website -->
        <div class="mt-4">
            <x-input-label for="edit_website" :value="__('all_robots_messages.website')" />
            <x-text-input id="edit_website" class="block mt-1 w-full" type="url" name="website" />
        </div>

        <!-- Interesting Facts -->
        <div class="mt-4">
            <x-input-label for="edit_interesting_facts" :value="__('all_robots_messages.interesting_facts')" />
            <textarea id="edit_interesting_facts" name="interesting_facts" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
        </div>

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="edit_description" :value="__('all_robots_messages.description')" />
            <textarea id="edit_description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
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