<section>
    @foreach ($robots as $robot)
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">


                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ $robot->name }}
                            </p>
                            <div>
                                <form method="post" action="{{ route('robots.update', $robot->id) }}"
                                    class="mt-6 space-y-6">
                                    @csrf
                                    @method('patch')
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                        :value="old('name', $robot->name)" required autocomplete="given-name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />

                                    <x-input-label for="author_first_name" :value="__('Author First Name')" />
                                    <x-text-input id="author_first_name" name="author_first_name" type="text"
                                        class="mt-1 block w-full" :value="old('author_first_name', $robot->author_first_name)" required autocomplete="given-author_first_name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('author_first_name')" />

                                    <x-input-label for="author_last_name" :value="__('Author Last Name')" />
                                    <x-text-input id="author_last_name" name="author_last_name" type="text"
                                        class="mt-1 block w-full" :value="old('author_last_name', $robot->author_last_name)"
                                        required autocomplete="given-author_last_name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('author_last_name')" />

                                    <x-input-label for="coauthors" :value="__('coauthors')" />
                                    <x-text-input id="coauthors" name="coauthors" type="text" class="mt-1 block w-full"
                                        :value="old('coauthors', $robot->coauthors)" required
                                        autocomplete="given-coauthors" />
                                    <x-input-error class="mt-2" :messages="$errors->get('coauthors')" />

                                    <x-input-label for="processor" :value="__('processor')" />
                                    <x-text-input id="processor" name="processor" type="text" class="mt-1 block w-full"
                                        :value="old('processor', $robot->processor)" required
                                        autocomplete="given-processor" />
                                    <x-input-error class="mt-2" :messages="$errors->get('processor')" />

                                    <x-input-label for="memory_size" :value="__('memory_size')" />
                                    <x-text-input id="memory_size" name="memory_size" type="text" class="mt-1 block w-full"
                                        :value="old('memory_size', $robot->memory_size)" required
                                        autocomplete="given-memory_size" />
                                    <x-input-error class="mt-2" :messages="$errors->get('memory_size')" />

                                    <x-input-label for="frequency" :value="__('frequency')" />
                                    <x-text-input id="frequency" name="frequency" type="text" class="mt-1 block w-full"
                                        :value="old('frequency', $robot->frequency)" required
                                        autocomplete="given-frequency" />
                                    <x-input-error class="mt-2" :messages="$errors->get('frequency')" />

                                    <x-input-label for="sensors" :value="__('sensors')" />
                                    <x-text-input id="sensors" name="sensors" type="text" class="mt-1 block w-full"
                                        :value="old('sensors', $robot->sensors)" required autocomplete="given-sensors" />
                                    <x-input-error class="mt-2" :messages="$errors->get('sensors')" />

                                    <x-input-label for="drive" :value="__('drive')" />
                                    <x-text-input id="drive" name="drive" type="text" class="mt-1 block w-full"
                                        :value="old('drive', $robot->drive)" required autocomplete="given-drive" />
                                    <x-input-error class="mt-2" :messages="$errors->get('drive')" />

                                    <x-input-label for="power_supply" :value="__('power_supply')" />
                                    <x-text-input id="power_supply" name="power_supply" type="text"
                                        class="mt-1 block w-full" :value="old('power_supply', $robot->power_supply)"
                                        required autocomplete="given-power_supply" />
                                    <x-input-error class="mt-2" :messages="$errors->get('power_supply')" />

                                    <x-input-label for="programming_language" :value="__('programming_language')" />
                                    <x-text-input id="programming_language" name="programming_language" type="text"
                                        class="mt-1 block w-full" :value="old('programming_language', $robot->programming_language)" required autocomplete="given-programming_language" />
                                    <x-input-error class="mt-2" :messages="$errors->get('programming_language')" />

                                    <x-input-label for="website" :value="__('website')" />
                                    <x-text-input id="website" name="website" type="text" class="mt-1 block w-full"
                                        :value="old('website', $robot->website)" required autocomplete="given-website" />
                                    <x-input-error class="mt-2" :messages="$errors->get('website')" />

                                    <x-input-label for="interesting_facts" :value="__('interesting_facts')" />
                                    <x-text-input id="interesting_facts" name="interesting_facts" type="text"
                                        class="mt-1 block w-full" :value="old('interesting_facts', $robot->interesting_facts)" required autocomplete="given-interesting_facts" />
                                    <x-input-error class="mt-2" :messages="$errors->get('interesting_facts')" />

                                    <x-input-label for="description" :value="__('description')" />
                                    <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                        :value="old('description', $robot->description)" required
                                        autocomplete="given-description" />
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />

                                    <x-input-label for="technology_id" :value="__('Technology')" />
                                    <select id="technology_id" name="technology_id" class="mt-1 block w-full">
                                        @foreach($technologies as $technology)
                                        <option value="{{ $technology->id }}" {{ $robot->technology_id == $technology->id ? 'selected' : '' }}>
                                            {{ $technology->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('technology_id')" />

                                    <div class="flex items-center gap-4">
                                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                                        @if (session('status') === 'profile-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endforeach
</section>