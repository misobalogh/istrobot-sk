<div class="flex">
    <!-- Sidebar -->
    <aside class="w-1/4 h-screen bg-gray-100 dark:bg-gray-800 p-4">
        <h2 class="text-lg font-semibold mb-4 text-white">Robots:</h2>
        <ul>
            @foreach ($robots as $index => $robot)
            <li class="mb-2">
                <button onclick="showForm({{ $index }})" class="w-full text-left px-2 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    {{ $robot->name }}
                </button>
            </li>
            @endforeach
            <li class="mb-2">
                <button id="add-robot-button" class="w-full text-left px-2 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    + Add New Robot
                </button>
            </li>
        </ul>
    </aside>

    <section class="w-3/4 p-6">
        @foreach ($robots as $index => $robot)
        <div id="robot-form-{{ $index }}" class="robot-form hidden">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 dark:bg-gray-900 rounded-lg shadow">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-2xl">
                        <div>
                            <form method="post" action="{{ route('robots.update', $robot->id) }}"
                                class="mt-6 space-y-6">
                                @csrf
                                @method('patch')
                                <div>
                                    <x-input-label for="name" :value="__('Name')" required="true" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                        :value="old('name', $robot->name)" required autocomplete="given-name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div class="flex flex-row gap-4 wrap">
                                    <div class="flex-initial w-full">
                                        <x-input-label for="author_first_name" :value="__('Author First Name')" required="true" />
                                        <x-text-input id="author_first_name" name="author_first_name" type="text" class="mt-1 block w-full"
                                            :value="old('author_first_name', $robot->author_first_name)" required autocomplete="given-author_first_name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('author_first_name')" />
                                    </div>
                                    <div class="flex-initial w-full">
                                        <x-input-label for="author_last_name" :value="__('Author Last Name')" required="true" />
                                        <x-text-input id="author_last_name" name="author_last_name" type="text" class="mt-1 block w-full"
                                            :value="old('author_last_name', $robot->author_last_name)" required autocomplete="given-author_last_name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('author_last_name')" />
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="coauthors" :value="__('coauthors')" />
                                    <x-text-input id="coauthors" name="coauthors" type="text" class="mt-1 block w-full"
                                        :value="old('coauthors', $robot->coauthors)" required
                                        autocomplete="given-coauthors" />
                                    <x-input-error class="mt-2" :messages="$errors->get('coauthors')" />
                                </div>

                                <div class="flex flex-row gap-4 wrap">
                                    <div class="flex-initial w-full">
                                        <x-input-label for="processor" :value="__('processor')" required="true" />
                                        <x-text-input id="processor" name="processor" type="text" class="mt-1 block w-full"
                                            :value="old('processor', $robot->processor)" required
                                            autocomplete="given-processor" />
                                        <x-input-error class="mt-2" :messages="$errors->get('processor')" />
                                    </div>

                                    <div class="flex-initial w-full">
                                        <x-input-label for="memory_size" :value="__('memory_size')" required="true" />
                                        <x-text-input id="memory_size" name="memory_size" type="text" class="mt-1 block w-full"
                                            :value="old('memory_size', $robot->memory_size)" required
                                            autocomplete="given-memory_size" />
                                        <x-input-error class="mt-2" :messages="$errors->get('memory_size')" />
                                    </div>

                                    <div class="flex-initial w-full">
                                        <x-input-label for="frequency" :value="__('frequency')" required="true" />
                                        <x-text-input id="frequency" name="frequency" type="text" class="mt-1 block w-full"
                                            :value="old('frequency', $robot->frequency)" required
                                            autocomplete="given-frequency" />
                                        <x-input-error class="mt-2" :messages="$errors->get('frequency')" />
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="sensors" :value="__('sensors')" required="true" />
                                    <x-text-input id="sensors" name="sensors" type="text" class="mt-1 block w-full"
                                        :value="old('sensors', $robot->sensors)" required autocomplete="given-sensors" />
                                    <x-input-error class="mt-2" :messages="$errors->get('sensors')" />
                                </div>

                                <div class="flex flex-row gap-4 wrap">
                                    <div class="flex-initial w-full">
                                        <x-input-label for="drive" :value="__('drive')" required="true" />
                                        <x-text-input id="drive" name="drive" type="text" class="mt-1 block w-full"
                                            :value="old('drive', $robot->drive)" required autocomplete="given-drive" />
                                        <x-input-error class="mt-2" :messages="$errors->get('drive')" />
                                    </div>

                                    <div class="flex-initial w-full">
                                        <x-input-label for="power_supply" :value="__('power_supply')" required="true" />
                                        <x-text-input id="power_supply" name="power_supply" type="text"
                                            class="mt-1 block w-full" :value="old('power_supply', $robot->power_supply)"
                                            required autocomplete="given-power_supply" />
                                        <x-input-error class="mt-2" :messages="$errors->get('power_supply')" />
                                    </div>
                                </div>

                                <div class="flex flex-row gap-4 wrap">
                                    <div class="flex-initial w-full">
                                        <x-input-label for="programming_language" :value="__('programming_language')" required="true" />
                                        <x-text-input id="programming_language" name="programming_language" type="text"
                                            class="mt-1 block w-full" :value="old('programming_language', $robot->programming_language)" required autocomplete="given-programming_language" />
                                        <x-input-error class="mt-2" :messages="$errors->get('programming_language')" />
                                    </div>

                                    <div class="flex-initial w-full">
                                        <x-input-label for="technology_id" :value="__('Technology')" required="true" />
                                        <select id="technology_id" name="technology_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            @foreach($technologies as $technology)
                                            <option value="{{ $technology->id }}" {{ $robot->technology_id == $technology->id ? 'selected' : '' }}>
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
                                        :value="old('website', $robot->website)" required autocomplete="given-website" />
                                    <x-input-error class="mt-2" :messages="$errors->get('website')" />
                                </div>

                                <div>
                                    <x-input-label for="interesting_facts" :value="__('interesting_facts')" />
                                    <textarea id="interesting_facts" name="interesting_facts" rows="4"
                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autocomplete="given-interesting_facts">{{ old('interesting_facts', $robot->interesting_facts) }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('interesting_facts')" />
                                </div>

                                <div>
                                    <x-input-label for="description" :value="__('description')" />
                                    <textarea id="description" name="description" rows="4"
                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autocomplete="given-description">{{ old('description', $robot->description) }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>

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
                        <!-- </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        @endforeach

        <!-- Button to create a new robot form -->
        <div id="new-robot-form" class="hidden max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 dark:bg-gray-900 rounded-lg shadow">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <form method="post" action="" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" required="true" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autocomplete="given-name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Name Fields Row TODO: -->
                        <div class="flex flex-row gap-4 wrap">
                            <div class="flex-initial w-full">
                                <x-input-label for="author_first_name" :value="__('Author First Name')" required="true" />
                                <x-text-input id="author_first_name" name="author_first_name" type="text" class="mt-1 block w-full" required autocomplete="given-author_first_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('author_first_name')" />
                            </div>
                            <div class="flex-initial w-full">
                                <x-input-label for="author_last_name" :value="__('Author Last Name')" required="true" />
                                <x-text-input id="author_last_name" name="author_last_name" type="text" class="mt-1 block w-full" required autocomplete="given-author_last_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('author_last_name')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="coauthors" :value="__('coauthors')" />
                            <x-text-input id="coauthors" name="coauthors" type="text" class="mt-1 block w-full" required autocomplete="given-coauthors" />
                            <x-input-error class="mt-2" :messages="$errors->get('coauthors')" />
                        </div>

                        <div class="flex flex-row gap-4 wrap">
                            <div class="flex-initial w-full">
                                <x-input-label for="processor" :value="__('processor')" required="true" />
                                <x-text-input id="processor" name="processor" type="text" class="mt-1 block w-full" required autocomplete="given-processor" />
                                <x-input-error class="mt-2" :messages="$errors->get('processor')" />
                            </div>

                            <div class="flex-initial w-full">
                                <x-input-label for="memory_size" :value="__('memory_size')" required="true" />
                                <x-text-input id="memory_size" name="memory_size" type="text" class="mt-1 block w-full" required autocomplete="given-memory_size" />
                                <x-input-error class="mt-2" :messages="$errors->get('memory_size')" />
                            </div>

                            <div class="flex-initial w-full">
                                <x-input-label for="frequency" :value="__('frequency')" required="true" />
                                <x-text-input id="frequency" name="frequency" type="text" class="mt-1 block w-full" required autocomplete="given-frequency" />
                                <x-input-error class="mt-2" :messages="$errors->get('frequency')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="sensors" :value="__('sensors')" required="true" />
                            <x-text-input id="sensors" name="sensors" type="text" class="mt-1 block w-full" required autocomplete="given-sensors" />
                            <x-input-error class="mt-2" :messages="$errors->get('sensors')" />
                        </div>

                        <div class="flex flex-row gap-4 wrap">
                            <div class="flex-initial w-full">
                                <x-input-label for="drive" :value="__('drive')" required="true" />
                                <x-text-input id="drive" name="drive" type="text" class="mt-1 block w-full" required autocomplete="given-drive" />
                                <x-input-error class="mt-2" :messages="$errors->get('drive')" />
                            </div>

                            <div class="flex-initial w-full">
                                <x-input-label for="power_supply" :value="__('power_supply')" required="true" />
                                <x-text-input id="power_supply" name="power_supply" type="text"
                                    class="mt-1 block w-full" required autocomplete="given-power_supply" />
                                <x-input-error class="mt-2" :messages="$errors->get('power_supply')" />
                            </div>
                        </div>

                        <div class="flex flex-row gap-4 wrap">
                            <div class="flex-initial w-full">
                                <x-input-label for="programming_language" :value="__('programming_language')" required="true" />
                                <x-text-input id="programming_language" name="programming_language" type="text"
                                    class="mt-1 block w-full" required autocomplete="given-programming_language" />
                                <x-input-error class="mt-2" :messages="$errors->get('programming_language')" />
                            </div>

                            <div class="flex-initial w-full">
                                <x-input-label for="technology_id" :value="__('Technology')" required="true" />
                                <select id="technology_id" name="technology_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="" disabled selected>Select a technology</option>
                                    @foreach($technologies as $technology)
                                    <option value="{{ $technology->id }}" {{ old('$robot->technology_id') == $technology->id ? 'selected' : '' }}>
                                        {{ $technology->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('technology_id')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="website" :value="__('website')" />
                            <x-text-input id="website" name="website" type="url" class="mt-1 block w-full" required autocomplete="given-website" />
                            <x-input-error class="mt-2" :messages="$errors->get('website')" />
                        </div>

                        <div>
                            <x-input-label for="interesting_facts" :value="__('interesting_facts')" />
                            <textarea id="interesting_facts" name="interesting_facts" rows="4"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autocomplete="given-interesting_facts"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('interesting_facts')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('description')" />
                            <textarea id="description" name="description" rows="4"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autocomplete="given-description"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Create') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Function to show the form corresponding to the clicked robot name
    function showForm(index) {
        document.querySelectorAll('.robot-form').forEach((form, i) => {
            form.classList.toggle('hidden', i !== index);
        });
        document.getElementById('new-robot-form').classList.add('hidden');
    }

    // Toggle visibility for new robot form
    document.getElementById('add-robot-button').addEventListener('click', () => {
        document.querySelectorAll('.robot-form').forEach(form => form.classList.add('hidden')); // Hide other forms
        document.getElementById('new-robot-form').classList.toggle('hidden'); // Toggle new robot form
    });

    // Initialize the first form as visible
    showForm(0);
</script>