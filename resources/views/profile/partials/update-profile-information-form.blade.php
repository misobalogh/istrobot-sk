<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profile_messages.profile_info_title') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('profile_messages.profile_info_subtitle') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('profile_messages.first_name')" required="true" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                :value="old('first_name', $user->first_name)" required autocomplete="given-name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="last_name" :value="__('profile_messages.last_name')" required="true" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autocomplete="family-name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('profile_messages.email')" required="true" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('profile_messages.unverified_email') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('profile_messages.verification_resend') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('profile_messages.verification_sent') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Birth Date -->
        <div>
            <x-input-label for="birth_date" :value="__('profile_messages.birth_date')" required="true" />
            <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full"
                :value="old('birth_date', $user->birth_date)" required />
            <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
        </div>

        <!-- City -->
        <div>
            <x-input-label for="city" :value="__('profile_messages.city')" required="true" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <!-- Country Code -->
        <div>
            <x-input-label for="country_code" :value="__('profile_messages.country')" required="true" />
            <select id="country_code" name="country_code" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                @foreach($countries as $country)
                    <option value="{{ $country->country_code }}" {{ auth()->user()->country_code == $country->country_code ? 'selected' : '' }}>
                        {{ $country->name_EN }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('country_code')" />
        </div>

        <!-- Optional School -->
        <div>
            <x-input-label for="school" :value="__('profile_messages.school')" />
            <x-text-input id="school" name="school" type="text" class="mt-1 block w-full" :value="old('school', $user->school)" />
            <x-input-error class="mt-2" :messages="$errors->get('school')" />
        </div>

        <!-- Save Button and Status Message -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('profile_messages.save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('profile_messages.saved') }}</p>
            @endif
        </div>
    </form>
</section>