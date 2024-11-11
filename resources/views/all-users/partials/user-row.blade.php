<div class="flex flex-row items-center mx-auto gap-4 py-2 px-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border-b" style="border-bottom: 1px solid transparent; border-image: linear-gradient(to right, rgba(55, 65, 81, 0) 0%, rgba(55, 65, 81, 1) 50%, rgba(55, 65, 81, 0) 100%) 1;">
    <!-- User Name -->
    <div class="flex-1 font-semibold truncate cursor-pointer"
         x-data=""
         x-on:click.prevent="openEditUserModal({{ $user->id }})">
        {{ $user->first_name }} {{ $user->last_name }}
    </div>

    <!-- Email Input -->
    <div class="flex-1">
        <x-text-input type="email" name="email_{{ $user->id }}" id="email_{{ $user->id }}" 
            class="block w-full p-2 rounded-md border border-gray-300 dark:border-gray-600"
            placeholder="Enter New E-mail" value="{{ $user->email }}" />
    </div>

    <!-- Password Input -->
    <div class="flex-1">
        <x-text-input type="password" name="password_{{ $user->id }}" id="password_{{ $user->id }}" 
            class="block w-full p-2 rounded-md border border-gray-300 dark:border-gray-600"
            placeholder="Enter New Password" value="****" />
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-1 justify-start">
        <!-- Save Changes Button -->
        <x-secondary-button type="button" class="mr-1" onclick="handleSaveChanges({{ $user->id }})">
            {{ __('all_users_messages.save_changes') }}
        </x-secondary-button>

        <!-- Delete User Button -->
        <x-danger-button type="button" class="ml-1" onclick="handleDeleteUser({{ $user->id }})">
            {{ __('all_users_messages.delete_user') }}
        </x-danger-button>
    </div>
</div>