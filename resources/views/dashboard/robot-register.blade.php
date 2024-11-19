<section>
    <h3 class="font-semibold mb-4">{{ __('dashboard_messages.register_robots_title') }}:</h3>
    <form method="post" action="{{ route('dashboard.updateRegistration') }}" class="mt-6 space-y-6">
        @csrf
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 dark:bg-gray-800 shadow">
                <!-- Table Header -->
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-gray-200">{{ __('dashboard_messages.name') }}</th>
                        @foreach ($categoriesForSetYear as $category)
                        <th class="px-4 py-2 border border-gray-200">
                            @if(App::getLocale() == 'en')
                                {{ $category->name_EN }}
                            @else
                                {{ $category->name_SK }}
                            @endif
                        </th>
                        @endforeach
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($robots as $robot)
                    <tr>
                        <td class="px-4 py-2 border border-gray-200">{{ $robot->name }}</td>
                        @foreach ($categoriesForSetYear as $category)
                        <td class="px-4 py-2 border border-gray-200 text-center">
                            <!-- Checkbox for each robot-category pair, each has a unique name based on robot and category name -->
                            <input type="checkbox"
                                name="categories[{{ $robot->id }}][{{ $category->id }}]"
                                class="category-checkbox h-5 w-5 rounded text-indigo-600"
                                data-robot="{{ $robot->id }}"
                                data-category="{{ $category->id }}"
                                {{ isset($robotsParticipation[$robot->id]) && in_array($category->id, $robotsParticipation[$robot->id]) ? 'checked' : '' }} />
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Button to save changes -->
        <x-primary-button id="register-robots">{{ __('dashboard_messages.update_registration') }}</x-primary-button>

        @if (session('status') === 'Registration updated successfully')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600 dark:text-gray-400">{{ __('dashboard_messages.registration_updated') }}</p>
        @endif

        <!-- Hidden input to store selected categories -->
        <input type="hidden" id="selectedCategories" name="selectedCategories" />
        <input type="hidden" id="unselectedCategories" name="unselectedCategories" />

        <script>
            document.getElementById('register-robots').addEventListener('click', function(event) {
                event.preventDefault();
                const selectedCategories = [];
                const unselectedCategories = [];

                document.querySelectorAll('.category-checkbox').forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedCategories.push({
                            robot: checkbox.dataset.robot,
                            category: checkbox.dataset.category
                        });
                    } else {
                        unselectedCategories.push({
                            robot: checkbox.dataset.robot,
                            category: checkbox.dataset.category
                        });
                    }
                });

                document.getElementById('selectedCategories').value = JSON.stringify(selectedCategories);
                document.getElementById('unselectedCategories').value = JSON.stringify(unselectedCategories);
                this.closest('form').submit();
            });
        </script>
    </form>
</section>