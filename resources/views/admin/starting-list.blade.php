<section>
    <h3 class="font-semibold">Starting List:</h3>

    <div class="flex gap-4">
        <!-- Input for year -->
        <div>
            <x-input-label for="year" :value="__('Year')" required="true" />
            <x-text-input id="year-starting-list" name="year" type="number" class="mt-1 block w-half" value="{{ old('year', date('Y')) }}" required
                min="2000" max="2100" />
            <x-input-error class="mt-2" :messages="$errors->get('year')" />
        </div>

        <!-- Category Select -->
        <div>
            <x-input-label for="category" :value="__('Category')" required="true" />
            <select id="category-select" name="category" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                <option value="" disabled selected>Select a category</option>
                <!-- přidat konkrétní kategorie TODO... -->
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category')" />
        </div>
    </div>

    <!-- Button to generate starting list and the starting list -->
    <x-secondary-button id="generate-starting-list" class="mt-4">
        Generate Starting List
    </x-secondary-button>
    <div class="starting-list">
    </div>
</section>

<script>
    document.getElementById('generate-starting-list').addEventListener('click', function () {

        const yearInput = document.getElementById('year-starting-list');
        // const categorySelect = document.getElementById('category-select');
        const year = yearInput.value;
        // const category = categorySelect.value;

        fetch(`/admin/generate-starting-list/${year}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
            .then(response => response.json())
            .then(data => {
                const startingList = document.querySelector('.starting-list');
                startingList.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(item => {
                        const robotEntry = `
                        <div class="bg-gray-800 text-white p-4 rounded-lg shadow-lg">
                            <h4 class="text-xl font-black">${item.robot_name}</h4>
                            <p class="mt-1"><span class="font-semibold">Owner: </span>${item.robot_owner}</p>
                            <p><span class="font-semibold">Starting Number: </span>${item.starting_number}</p>
                            <p><span class="font-semibold">Category: </span>${item.category_name}</p>
                        </div>
                        `;
                        startingList.innerHTML += robotEntry;
                    });
                } else {
                    startingList.innerHTML = '<p>No robots found.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>