<x-modal name="edit-user-modal" focusable>
    <form method="post" class="p-6">
        @csrf
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('all_users_messages.edit_user') }}
        </h2>

        <!-- Hidden User ID -->
        <input type="hidden" id="edit_user_id">

        <!-- First Name -->
        <div class="mt-4">
            <x-input-label for="edit_first_name" :value="__('all_users_messages.first_name')" required="true" />
            <x-text-input id="edit_first_name" class="block mt-1 w-full" type="text" name="first_name" required />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="edit_last_name" :value="__('all_users_messages.last_name')" required="true" />
            <x-text-input id="edit_last_name" class="block mt-1 w-full" type="text" name="last_name" required />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="edit_email" :value="__('all_users_messages.email')" required="true" />
            <x-text-input id="edit_email" class="block mt-1 w-full" type="email" name="email" required />
        </div>

        <!-- Birth Date -->
        <div class="mt-4">
            <x-input-label for="edit_birth_date" :value="__('all_users_messages.birth_date')" required="true" />
            <x-text-input id="edit_birth_date" class="block mt-1 w-full" type="date" name="edit_birth_date" required />
        </div>

        <!-- City -->
        <div class="mt-4">
            <x-input-label for="edit_city" :value="__('all_users_messages.city')" required="true" />
            <x-text-input id="edit_city" class="block mt-1 w-full" type="text" name="edit_city" required />
        </div>

        <!-- Country Code -->
        <div class="mt-4">
            <x-input-label for="edit_country_code" :value="__('all_users_messages.country')" required="true" />
            <select id="edit_country_code" name="edit_country_code" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                @foreach($countries as $country)
                <option value="{{ $country->country_code }}" {{ auth()->user()->country_code == $country->country_code ? 'selected' : '' }}>
                    {{ $country->name_EN }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Optional School -->
        <div class="mt-4">
            <x-input-label for="edit_school" :value="__('all_users_messages.school')" />
            <x-text-input id="edit_school" class="block mt-1 w-full" type="text" name="edit_school" />
        </div>

        <!-- Modal Actions -->
        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('all_users_messages.cancel') }}
            </x-secondary-button>
            <x-primary-button type="button" class="ml-3" onclick="handleEditUserSave()">
                {{ __('all_users_messages.save') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>