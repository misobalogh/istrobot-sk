<x-modal name="edit-user-modal" focusable>
    <form method="post" class="p-6">
        @csrf
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('all_users_messages.edit_user') }}
        </h2>

        <!-- Hidden User ID -->
        <input type="hidden" id="edit_user_id">

        <div class="flex gap-4 w-full">
            <!-- First Name -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_first_name" :value="__('all_users_messages.first_name')" required="true" />
                <x-text-input id="edit_first_name" class="block mt-1 w-full" type="text" name="first_name" required />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                <div id="error_first_name" class="text-red-500 text-sm error-message"></div>
            </div>

            <!-- Last Name -->
            <div class="mt-4 flex-1 w-full">
                <x-input-label for="edit_last_name" :value="__('all_users_messages.last_name')" required="true" />
                <x-text-input id="edit_last_name" class="block mt-1 w-full" type="text" name="last_name" required />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                <div id="error_last_name" class="text-red-500 text-sm error-message"></div>
            </div>
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="edit_email" :value="__('all_users_messages.email')" required="true" />
            <x-text-input id="edit_email" class="block mt-1 w-full" type="email" name="email" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            <div id="error_email" class="text-red-500 text-sm error-message"></div>
        </div>

        <!-- Birth Date -->
        <div class="mt-4">
            <x-input-label for="edit_birth_date" :value="__('all_users_messages.birth_date')" required="true" />
            <x-text-input id="edit_birth_date" class="block mt-1 w-full" type="date" name="edit_birth_date" required />
            <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
            <div id="error_birth_date" class="text-red-500 text-sm error-message"></div>
        </div>

        <!-- City -->
        <div class="mt-4">
            <x-input-label for="edit_city" :value="__('all_users_messages.city')" required="true" />
            <x-text-input id="edit_city" class="block mt-1 w-full" type="text" name="edit_city" required />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
            <div id="error_city" class="text-red-500 text-sm error-message"></div>
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
            <x-input-error class="mt-2" :messages="$errors->get('country_code')" />
            <div id="error_country_code" class="text-red-500 text-sm error-message"></div>
        </div>

        <!-- Optional School -->
        <div class="mt-4">
            <x-input-label for="edit_school" :value="__('all_users_messages.school')" />
            <x-text-input id="edit_school" class="block mt-1 w-full" type="text" name="edit_school" />
            <x-input-error class="mt-2" :messages="$errors->get('school')" />
            <div id="error_school" class="text-red-500 text-sm error-message"></div>
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