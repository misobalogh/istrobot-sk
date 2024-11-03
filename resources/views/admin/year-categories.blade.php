<section>
    <h3 class="font-semibold">Yearly Categories:</h3>

    <div class="flex gap-4">
        <!-- Input for year -->
        <div>
            <x-input-label for="year" :value="__('Year')" required="true" />
            <x-text-input id="year-starting-list" name="year" type="number" class="mt-1 block w-half" value="{{ old('year', date('Y')) }}" required
                min="2000" max="2100" />
            <x-input-error class="mt-2" :messages="$errors->get('year')" />
        </div>

         <!-- Category Checkboxes -->
        <div>
            <x-input-label for="category" :value="__('Category')" required="true" />
            <div class="flex flex-col mt-1">
                <!-- Static categories TODO: remake into categories from database -->
                @foreach(range(1, 7) as $category)
                    <label class="inline-flex items-center mt-2">
                        <input type="checkbox" name="categories[]" value="{{ $category }}" class="form-checkbox h-5 w-5 text-indigo-600">
                        <span class="ml-2">{{ 'Category ' . $category }}</span>
                    </label>
                @endforeach
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('category')" />
        </div>

        <!-- New Category Input -->
        <div>
                    <x-input-label for="new-category" :value="__('Add New Category')" />
                    <x-text-input id="new-category" name="new_category" type="text" class="mt-1 block w-full" placeholder="Enter new category" />
                    <x-input-error class="mt-2" :messages="$errors->get('new_category')" />
        </div>
    </div>

    <!-- Button to generate yearly categories -->
    <x-secondary-button id="generate-yearly-categories" class="mt-4">
        Generate Yearly Categories
    </x-secondary-button>
    <div class="yearly-categories">
    </div>
</section>

<script>
    document.getElementById('generate-yearly-categories').addEventListener('click', function () {

        const yearInput = document.getElementById('year-starting-list');
        const year = yearInput.value;

        // Collect checked categories // TODO: případně změnit hodnoty co je potřeba vracet
        const checkedCategories = Array.from(document.querySelectorAll('input[name="categories[]"]:checked'))
            // .map(checkbox => checkbox.value);
            .map(checkbox => checkbox.nextElementSibling.innerText);

        // Get the new category input value
        const newCategoryInput = document.getElementById('new-category');
        const newCategory = newCategoryInput.value.trim();

        // Optionally add the new category to the categories array
        if (newCategory) {
            checkedCategories.push(newCategory);
        }

        console.log(checkedCategories);

        // TODO: add checked categories to the fetch as needed + create function for it
        fetch(`/admin/generate-yearly-categories/${year}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
            // body: JSON.stringify({ categories: checkedCategories }) // TODO: mohlo by být takhle?
        })
            .then(response => response.json())
            .then(data => {
                const yearlyCategories = document.querySelector('.yearly-categories');
                yearlyCategories.innerHTML = '';

                if (data.length > 0) {
                    // TODO: change robotEntry for whatever is needed, same for else
                    data.forEach(item => {
                        const robotEntry = `
                        <div class="bg-gray-800 text-white p-4 rounded-lg shadow-lg">
                            <h4 class="text-xl font-black">${item.robot_name}</h4>
                            <p class="mt-1"><span class="font-semibold">Owner: </span>${item.robot_owner}</p>
                            <p><span class="font-semibold">Starting Number: </span>${item.starting_number}</p>
                            <p><span class="font-semibold">Category: </span>${item.category_name}</p>
                        </div>
                        `;
                        yearlyCategories.innerHTML += robotEntry;
                    });
                } else {
                    yearlyCategories.innerHTML = '<p>No robots found.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>