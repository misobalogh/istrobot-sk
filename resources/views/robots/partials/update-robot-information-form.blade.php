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
                <x-robot-form
                    :robot="$robot"
                    :technologies="$technologies"
                    :actionUrl="route('robots.update', $robot->id)"
                    method="patch"
                    buttonText="{{ __('Save') }}"
                />
            </div>
        @endforeach
        <div id="new-robot-form" class="hidden">
            <x-robot-form
                :technologies="$technologies"
                :actionUrl="route('robots.store')"
                buttonText="{{ __('Create') }}"
            />
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