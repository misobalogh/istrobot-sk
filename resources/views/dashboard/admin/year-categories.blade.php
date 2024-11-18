<section>
    <h3 class="font-semibold">{{ __('dashboard_messages.set_category_title') }}:</h3>

    <!-- Input for year -->
    <div>
        <x-input-label for="year" :value="__('dashboard_messages.year')" required="true" />
        <div class="flex flex-row">
            <x-text-input 
                id="categories-year" 
                name="year" 
                type="number" 
                class="mt-1 block w-half" 
                value="{{ old('year', $setYear) }}" 
                required
                min="2000" 
                max="2100" 
                oninput="validateCategoriesYear(this)"
            />
            <x-input-error id="year-error" class="ml-4 mt-3" style="display: none" :messages="['Year must be between 2000 and 2100']" />
        </div>
    </div>
    <div class="flex gap-4 mt-1">
        <!-- Category Checkboxes -->
        <div>
            <x-input-label for="category" :value="__('dashboard_messages.add_category_title')" required="true" />
            <div class="flex flex-col mt-1">
                @foreach($categories as $category)
                <div class="flex items-center">
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-checkbox h-5 w-5 rounded text-indigo-600" id="{{ $category->id }}">
                    <label for="{{ $category->id }}" class="ms-2">
                        {{ $category->name_EN }} ({{ $categories_count->find($category->id)->participations_count }})
                        @if($categories_count->find($category->id)->participations_count == 0)
                            <span class="text-red-500 ml-2 cursor-pointer" data-category-id="{{ $category->id }}">❌</span>
                        @endif
                    </label>
                </div>
                @endforeach
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('category')" />
        </div>
    </div>

    <!-- Button to set categories -->
    <x-secondary-button id="set-categories" class="mt-4">
        {{ __('dashboard_messages.set_categories') }}
    </x-secondary-button>
</section>

<script>
    function validateCategoriesYear(input) {
        const errorElement = document.getElementById('year-error');
        const setButton = document.getElementById('set-categories');
        const year = parseInt(input.value);
        
        if (year < 2000 || year > 2100 || isNaN(year)) {
            errorElement.style.display = 'block';
            setButton.disabled = true;
            setButton.classList.add('opacity-50', 'cursor-not-allowed');
            return false;
        } else {
            errorElement.style.display = 'none';
            setButton.disabled = false;
            setButton.classList.remove('opacity-50', 'cursor-not-allowed');
            return true;
        }
    }

    function fetchAndSetCategories(year) {
        fetch(`/admin/get-categories/${year}`, {
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            // Reset all checkboxes
            document.querySelectorAll('input[name="categories[]"]').forEach(cb => cb.checked = false);
            // Check the categories returned for the year
            data.categories.forEach(categoryId => {
                const checkbox = document.querySelector(`input[name="categories[]"][value="${categoryId}"]`);
                if (checkbox) checkbox.checked = true;
            });
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const yearInput = document.getElementById('categories-year');
        const defaultYear = yearInput.value;
        fetchAndSetCategories(defaultYear);
    });

    document.getElementById('set-categories').addEventListener('click', function() {

        const yearInput = document.getElementById('categories-year');
        const year = yearInput.value;

        // Collect checked categories
        const checkedCategories = Array.from(document.querySelectorAll('input[name="categories[]"]:checked'))
            .map(checkbox => checkbox.value); // Changed to get category IDs

        fetch(`/admin/set-categories/${year}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ categories: checkedCategories }) // Sends an array of IDs
            })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    alert('Categories successfully set for the competition.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    document.querySelectorAll('.text-red-500').forEach(function(icon) {
        icon.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category-id');
            if(confirm('Are you sure you want to delete this category?')) {
                fetch(`/admin/delete-category/${categoryId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        // Remove the category from the DOM
                        this.parentElement.parentElement.remove();
                    } else {
                        alert('Failed to delete the category.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });

    document.getElementById('categories-year').addEventListener('change', function() {
        if (!validateCategoriesYear(this)) return;
        const year = this.value;
        fetchAndSetCategories(year);
    });
</script>