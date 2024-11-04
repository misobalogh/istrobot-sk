<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 dark:bg-gray-900 rounded-lg shadow">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-2xl">
            <form method="post" action="{{ $actionUrl }}" class="mt-6 space-y-6">
                @csrf
                @if(isset($method))
                @method($method)
                @endif
                <div>
                    <x-input-label for="name" :value="__('Name')" required="true" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        :value="old('name', $robot->name ?? '')" required autocomplete="given-name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="flex flex-row gap-4 wrap">
                    <div class="flex-initial w-full">
                        <x-input-label for="author_first_name" :value="__('Author First Name')" required="true" />
                        <x-text-input id="author_first_name" name="author_first_name" type="text" class="mt-1 block w-full"
                            :value="old('author_first_name', $robot->author_first_name ?? '')" required autocomplete="given-author_first_name" />
                        <x-input-error class="mt-2" :messages="$errors->get('author_first_name')" />
                    </div>
                    <div class="flex-initial w-full">
                        <x-input-label for="author_last_name" :value="__('Author Last Name')" required="true" />
                        <x-text-input id="author_last_name" name="author_last_name" type="text" class="mt-1 block w-full"
                            :value="old('author_last_name', $robot->author_last_name ?? '')" required autocomplete="given-author_last_name" />
                        <x-input-error class="mt-2" :messages="$errors->get('author_last_name')" />
                    </div>
                </div>

                <div>
                    <x-input-label for="coauthors" :value="__('coauthors')" />
                    <x-text-input id="coauthors" name="coauthors" type="text" class="mt-1 block w-full"
                        :value="old('coauthors', $robot->coauthors ?? '')"
                        autocomplete="given-coauthors" />
                    <x-input-error class="mt-2" :messages="$errors->get('coauthors')" />
                </div>

                <div class="flex flex-row gap-4 wrap">
                    <div class="flex-initial w-full">
                        <x-input-label for="processor" :value="__('processor')" required="true" />
                        <x-text-input id="processor" name="processor" type="text" class="mt-1 block w-full"
                            :value="old('processor', $robot->processor ?? '')" required
                            autocomplete="given-processor" />
                        <x-input-error class="mt-2" :messages="$errors->get('processor')" />
                    </div>

                    <div class="flex-initial w-full">
                        <x-input-label for="memory_size" :value="__('memory_size')" />
                        <x-text-input id="memory_size" name="memory_size" type="text" class="mt-1 block w-full"
                            :value="old('memory_size', $robot->memory_size ?? '')"
                            autocomplete="given-memory_size" />
                        <x-input-error class="mt-2" :messages="$errors->get('memory_size')" />
                    </div>

                    <div class="flex-initial w-full">
                        <x-input-label for="frequency" :value="__('frequency')" required="true" />
                        <x-text-input id="frequency" name="frequency" type="text" class="mt-1 block w-full"
                            :value="old('frequency', $robot->frequency ?? '')" required
                            autocomplete="given-frequency" />
                        <x-input-error class="mt-2" :messages="$errors->get('frequency')" />
                    </div>
                </div>

                <div>
                    <x-input-label for="sensors" :value="__('sensors')" />
                    <x-text-input id="sensors" name="sensors" type="text" class="mt-1 block w-full"
                        :value="old('sensors', $robot->sensors ?? '')" autocomplete="given-sensors" />
                    <x-input-error class="mt-2" :messages="$errors->get('sensors')" />
                </div>

                <div class="flex flex-row gap-4 wrap">
                    <div class="flex-initial w-full">
                        <x-input-label for="drive" :value="__('drive')" />
                        <x-text-input id="drive" name="drive" type="text" class="mt-1 block w-full"
                            :value="old('drive', $robot->drive ?? '')" autocomplete="given-drive" />
                        <x-input-error class="mt-2" :messages="$errors->get('drive')" />
                    </div>

                    <div class="flex-initial w-full">
                        <x-input-label for="power_supply" :value="__('power_supply')" />
                        <x-text-input id="power_supply" name="power_supply" type="text"
                            class="mt-1 block w-full" :value="old('power_supply', $robot->power_supply ?? '')"
                            autocomplete="given-power_supply" />
                        <x-input-error class="mt-2" :messages="$errors->get('power_supply')" />
                    </div>
                </div>

                <div class="flex flex-row gap-4 wrap">
                    <div class="flex-initial w-full">
                        <x-input-label for="programming_language" :value="__('programming_language')" required="true" />
                        <x-text-input id="programming_language" name="programming_language" type="text"
                            class="mt-1 block w-full" :value="old('programming_language', $robot->programming_language ?? '')" required autocomplete="given-programming_language" />
                        <x-input-error class="mt-2" :messages="$errors->get('programming_language')" />
                    </div>

                    <div class="flex-initial w-full">
                        <x-input-label for="technology_id" :value="__('Technology')" required="true" />
                        <select id="technology_id" name="technology_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            @foreach($technologies as $technology)
                            <option value="{{ $technology->id }}" {{ ( ($robot->technology_id ?? old('technology_id')) == $technology->id) ? 'selected' : '' }}>
                                {{ $technology->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('technology_id')" />
                    </div>
                </div>

                <div>
                    <x-input-label for="website" :value="__('website')" />
                    <x-text-input id="website" name="website" type="url" class="mt-1 block w-full"
                        :value="old('website', $robot->website ?? '')" autocomplete="given-website" />
                    <x-input-error class="mt-2" :messages="$errors->get('website')" />
                </div>

                <div>
                    <x-input-label for="interesting_facts" :value="__('interesting_facts')" />
                    <textarea id="interesting_facts" name="interesting_facts" rows="4"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="given-interesting_facts">{{ old('interesting_facts', $robot->interesting_facts ?? '') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('interesting_facts')" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('description')" />
                    <textarea id="description" name="description" rows="4"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="given-description">{{ old('description', $robot->description ?? '') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ $buttonText }}</x-primary-button>
                    @if (session('status') === 'robot-updated' || session('status') === 'robot-created')
                    <p x-data="{ show: true }" x-show="show" x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>