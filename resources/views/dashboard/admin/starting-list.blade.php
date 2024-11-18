<section>
    <h3 class="font-semibold">{{ __('dashboard_messages.starting_list') }}:</h3>

    <div class="flex gap-4">
        <!-- Input for year -->
        <div>
            <x-input-label for="year" :value="__('dashboard_messages.year')" required="true" />
            <div class="flex flex-row">
                <x-text-input id="year-starting-list" name="year" type="number" class="mt-1 block w-half" value="{{ old('year', $setYear) }}" required
                    min="2000" max="2100" oninput="validateYear(this)" />
                <x-input-error id="year-starting-error" class="ml-4 mt-3" style="display: none" :messages="['Year must be between 2000 and 2100']" />
            </div>
        </div>

        <!-- Category Select -->
        <div>
            <x-input-label for="category" :value="__('dashboard_messages.category')" required="true" />
            <select id="category-select" name="category" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                <option value="" selected>{{ __('dashboard_messages.all_categories') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name_EN }}</option>
                @endforeach 
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category')" />
        </div>

        <!-- Button to generate starting list and the starting list -->
        <x-secondary-button id="generate-starting-list" class="mt-6">
            {{ __('dashboard_messages.generate_starting_list') }}
        </x-secondary-button>
    </div>
    
    <div class="starting-list mt-4">
        <x-input-label for="starting-list" :value="__('dashboard_messages.starting_list')" />

        <!-- Text area to display the starting list in CSV format -->
        <textarea id="starting-list-textarea" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="5" readonly></textarea>
        
        <!-- Copy to Clipboard Button -->
        <x-secondary-button id="copy-to-clipboard-starting-list" class="mt-4">
            <span id="copy-icon-starting-list">{{ __('dashboard_messages.copy_to_clipboard') }}</span>
            <span id="checkmark-icon-starting-list" class="hidden">{{ __('dashboard_messages.copied') }}</span>
        </x-secondary-button>
    </div>
</section>

<script>
    function validateYear(input) {
        const errorElement = document.getElementById('year-starting-error');
        const setButton = document.getElementById('generate-starting-list');
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
    document.getElementById('copy-to-clipboard-starting-list').addEventListener('click', function () {
        const textListArea = document.getElementById('starting-list-textarea');
        // textListArea.select();
        // document.execCommand('copy');
        navigator.clipboard.writeText(textListArea.value)
            .then(() => {
            // Change button to show checkmark
            const copyIconStartingList = document.getElementById('copy-icon-starting-list');
            const checkmarkIconStartingList = document.getElementById('checkmark-icon-starting-list');
            
            copyIconStartingList.classList.add('hidden');
            checkmarkIconStartingList.classList.remove('hidden');

            // After 2 seconds, show original message (Copy to Clipboard)
            setTimeout(() => {
                copyIconStartingList.classList.remove('hidden');
                checkmarkIconStartingList.classList.add('hidden');
            }, 2000); // 2 seconds
        })
    });
</script>