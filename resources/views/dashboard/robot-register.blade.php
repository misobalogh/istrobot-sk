@php
    // TODO: testing data, not needed after connecting to database
    $robots = ['Bot 1', 'Bot 2', 'Bot 3'];
    $categories = ['Category 1', 'Category 2', 'Category 3', 'Category 4'];
@endphp

<section>
    <h3 class="font-semibold mb-4">Register your robots to categories:</h3>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 dark:bg-gray-800 shadow">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th class="px-4 py-2 border border-gray-200">Name</th>
                    <!-- To generate a header of categories from database -->
                    @foreach ($categories as $category)
                        <th class="px-4 py-2 border border-gray-200">{{ $category }}</th>
                    @endforeach
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody>
                @foreach ($robots as $robot)
                    <tr>
                        <td class="px-4 py-2 border border-gray-200">{{ $robot }}</td>
                        @foreach ($categories as $category)
                            <td class="px-4 py-2 border border-gray-200 text-center">
                                <!-- Checkbox for each robot-category pair, each has a unique name based on robot and category name -->
                                <input type="checkbox" 
                                       name="categories[{{ $robot }}][{{ $category }}]" 
                                       class="category-checkbox h-5 w-5 rounded text-indigo-600" 
                                       data-robot="{{ $robot }}" 
                                       data-category="{{ $category }}" />
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Button to save changes -->
    <x-secondary-button id="register-robots" class="mt-4">
        Register your robots
    </x-secondary-button>

    <!-- Hidden input to store selected categories -->
    <input type="hidden" id="selectedCategories" name="selectedCategories" />
</section>

<!-- Get selected data on button click -->
<script>
    document.getElementById('register-robots').addEventListener('click', function () {
        const selectedData = [];

        // Get info from all checked checkboxes and store it into an array
        document.querySelectorAll('.category-checkbox:checked').forEach(checkbox => {
            const robot = checkbox.dataset.robot;
            const category = checkbox.dataset.category;
            selectedData.push({ robot, category });
        });

        // Selected data will be stored here in JSON format to send all at once, after user submits it
        document.getElementById('selectedCategories').value = JSON.stringify(selectedData);

        console.log('Selected Data:', selectedData);

        // TODO: Submit
    });
</script>
