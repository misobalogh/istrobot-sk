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
    
    <div class="starting-list mt-4">
        <x-input-label for="starting-list" :value="__('Starting List')" />
        
        <!-- Text area to display the starting list in CSV format -->
        <textarea id="starting-list-textarea" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="5" readonly></textarea>
        
        <!-- Copy to Clipboard Button -->
        <x-secondary-button id="copy-to-clipboard" class="mt-4">
            <span id="copy-icon">Copy to Clipboard</span>
            <span id="checkmark-icon" class="hidden">✔ Copied!</span>
        </x-secondary-button>
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
                const startingList = document.getElementById('starting-list-textarea');
                startingList.value = ''; // Clear the text area

                if (data.length > 0) {
                    const robotEntries = data.map(item =>
                        `${item.robot_name};${item.robot_owner};${item.starting_number};${item.category_name}`
                    );
                    startingList.value = robotEntries.join('\n');
                } else {
                    startingList.value = 'No robots found.';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    // Copy to clipboard functionality
    document.getElementById('copy-to-clipboard').addEventListener('click', function () {
        const textarea = document.getElementById('starting-list-textarea');
        // textarea.select();
        // document.execCommand('copy');
        navigator.clipboard.writeText(textarea.value)
            .then(() => {
            // Change button to show checkmark
            const copyIcon = document.getElementById('copy-icon');
            const checkmarkIcon = document.getElementById('checkmark-icon');
            
            copyIcon.classList.add('hidden');
            checkmarkIcon.classList.remove('hidden');

            // After 2 seconds, show original message (Copy to Clipboard)
            setTimeout(() => {
                copyIcon.classList.remove('hidden');
                checkmarkIcon.classList.add('hidden');
            }, 2000); // 2 seconds
        })
    });
</script>