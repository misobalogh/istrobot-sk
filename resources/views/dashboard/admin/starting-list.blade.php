<section>
    <h3 class="font-semibold">Starting List:</h3>

    <div class="flex gap-4">
        <!-- Input for year -->
        <div>
            <x-input-label for="year" :value="__('Year')" required="true" />
            <x-text-input id="year-starting-list" name="year" type="number" class="mt-1 block w-half" value="{{ old('year', $setYear) }}" required
                min="2000" max="2100" />
            <x-input-error class="mt-2" :messages="$errors->get('year')" />
        </div>

        <!-- Category Select -->
        <div>
            <x-input-label for="category" :value="__('Category')" required="true" />
            <select id="category-select" name="category" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                <option value="" selected>All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name_EN }}</option>
                @endforeach 
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
        const categorySelect = document.getElementById('category-select');
        const year = yearInput.value;
        const category = categorySelect.value;

        fetch(`/admin/generate-starting-list/${year}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ category: category })
        })
            .then(response => response.json())
            .then(data => {
                const startingList = document.querySelector('.starting-list');
                startingList.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(item => {
                        const robotEntry = `
                        <div class="bg-gray-800 text-white p-4 rounded-lg shadow-lg">
                            <p class="mt-1">${item.robot_name};${item.robot_owner};${item.starting_number};${item.category_name}</p>
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