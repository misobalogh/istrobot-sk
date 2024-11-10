<section>
    <h3 class="font-semibold">Set Year:</h3>

    <form method="post" action="{{ route('admin.setYear') }}" class="mt-6 space-y-6">
        @csrf
        <div class="flex gap-4">
            <!-- Input for year -->
            <div>
                <x-input-label for="year" :value="__('Year')" required="true" />
                <x-text-input id="year-setting" name="year" type="number" class="mt-1 block w-half" value="{{ old('year', $setYear) }}" required
                    min="2000" max="2100" />
                <x-input-error class="mt-2" :messages="$errors->get('year')" />
            </div>
            <!-- Button to set year -->
            <x-primary-button class="mt-6">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'year-set-successfuly')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>