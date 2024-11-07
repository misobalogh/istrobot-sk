<section>
    <h3 class="font-semibold mt-6">Add New Category:</h3>
    <form id="create-category-form" method="POST" action="{{ route('admin.create-category') }}">
        @csrf
        @method('POST')
        <div class="flex gap-4 mt-2">
            <!-- Category Name (EN) -->
            <div>
                <x-input-label for="name_EN" :value="__('Category Name (EN)')" required="true" />
                <x-text-input id="name_EN" name="name_EN" type="text" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('name_EN')" />
            </div>
            <!-- Category Name (SK) -->
            <div>
                <x-input-label for="name_SK" :value="__('Category Name (SK)')" required="true" />
                <x-text-input id="name_SK" name="name_SK" type="text" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('name_SK')" />
            </div>
            <!-- Type of Evaluation -->
            <div>
                <x-input-label for="type_of_evaluation" :value="__('Type of Evaluation')" required="true" />
                <select id="type_of_evaluation" name="type_of_evaluation" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                    <option value="" disabled selected hidden>Select Evaluation Type</option>
                    <option value="score">Score</option>
                    <option value="time">Time</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('type_of_evaluation')" />
            </div>
            <!-- Submit Button -->
            <div class="flex items-end">
                <x-primary-button type="submit" class="mt-6">
                    Create Category
                </x-primary-button>
            </div>
        </div>
    </form>
</section>

<script>
    document.getElementById('create-category-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    form.reset();

                    // Append the new category to the categories list
                    const categoriesDiv = document.querySelector('div.flex.flex-col.mt-1');
                    const newCategory = data.category;

                    const div = document.createElement('div');
                    div.classList.add('flex', 'items-center');

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'categories[]';
                    checkbox.value = newCategory.id;
                    checkbox.classList.add('form-checkbox', 'h-5', 'w-5', 'rounded', 'text-indigo-600');
                    checkbox.id = `category-${newCategory.id}`;

                    const label = document.createElement('label');
                    label.htmlFor = `category-${newCategory.id}`;
                    label.classList.add('ms-2');
                    label.textContent = newCategory.name_EN;

                    div.appendChild(checkbox);
                    div.appendChild(label);
                    categoriesDiv.appendChild(div);
                } else {
                    alert('Failed to create category.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred.');
            });
    });
</script>