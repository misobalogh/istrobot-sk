<x-guest-layout>
    <x-auth-card>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <div>
                <x-input-label for="first_name" :value="__('register_messages.first_name')" required="true" />
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                    :value="old('first_name')" required autofocus autocomplete="given-name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div>
                <x-input-label for="last_name" :value="__('register_messages.last_name')" required="true" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                    :value="old('last_name')" required autocomplete="family-name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('register_messages.email')" required="true" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Birth Date -->
            <div class="mt-4">
                <x-input-label for="birth_date" :value="__('register_messages.birth_date')" required="true" />
                <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date"
                    :value="old('birth_date')" required />
                <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
            </div>

            <!-- City -->
            <div class="mt-4">
                <x-input-label for="city" :value="__('register_messages.city')" required="true" />
                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <!-- Country Code -->
            <div class="mt-4">
                <x-input-label for="country_code" :value="__('register_messages.country')" required="true" />
                <select id="country_code" name="country_code" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                    <option value="" disabled selected>{{ __('register_messages.select_your_country') }}</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->country_code }}" {{ old('country_code') == $country->country_code ? 'selected' : '' }}>
                        @if(App::getLocale() == 'en')
                            {{ $country->name_EN }}
                        @else
                            {{ $country->name_SK }}
                        @endif
                    </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('country_code')" class="mt-2" />
            </div>

            <!-- Optional School -->
            <div class="mt-4">
                <x-input-label for="school" :value="__('register_messages.school')" />
                <x-text-input id="school" class="block mt-1 w-full" type="text" name="school" :value="old('school')" />
                <x-input-error :messages="$errors->get('school')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('register_messages.password')" required="true" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('register_messages.confirm_password')" required="true" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Registration Button and Login Link -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('register_messages.already_registered') }}
                </a>
                <x-primary-button class="ms-4">
                    {{ __('register_messages.register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>