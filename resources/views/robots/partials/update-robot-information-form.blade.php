<div class="flex">
    <!-- Sidebar -->
    <aside class="w-1/4 min-h-screen bg-gray-100 dark:bg-gray-800 p-4">
        <h2 class="text-lg font-semibold mb-4 text-white">{{ __('my_robots_messages.robots') }}:</h2>
        <ul>
            @foreach ($robots as $index => $robot)
            <li class="mb-2">
                <button onclick="showForm({{ $index }})" 
                    class="w-full text-left px-2 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 border-b hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                    id="robot-button-{{ $index }}"
                    style="border-bottom: 1px solid transparent; border-image: linear-gradient(to right, rgba(55, 65, 81, 0) 0%, rgba(55, 65, 81, 1) 50%, rgba(55, 65, 81, 0) 100%) 1;">
                    {{ $robot->name }}
                </button>
            </li>
            @endforeach
            <li class="mb-2">
                <button id="add-robot-button" 
                    class="w-full text-left px-2 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 border-b hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                    style="border-bottom: 1px solid transparent; border-image: linear-gradient(to right, rgba(55, 65, 81, 0) 0%, rgba(55, 65, 81, 1) 50%, rgba(55, 65, 81, 0) 100%) 1;">
                    {{ __('my_robots_messages.add_robot') }}
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
                    buttonText="{{ __('my_robots_messages.save') }}"
                />
            </div>
        @endforeach
        <div id="new-robot-form" class="hidden">
            <x-robot-form
                :technologies="$technologies"
                :actionUrl="route('robots.store')"
                buttonText="{{ __('my_robots_messages.create') }}"
            />
        </div>
    </section>
</div>

<script>
    let selectedRobot = 0;

    // Function to show the form corresponding to the clicked robot name
    function showForm(index) {
        document.querySelectorAll('.robot-form').forEach((form, i) => {
            form.classList.toggle('hidden', i !== index);
        });
        document.getElementById('new-robot-form').classList.add('hidden');

        // Update the selected button's styling
        document.querySelectorAll('[id^="robot-button-"]').forEach((button, i) => {
            if (i === index) {
                button.classList.add('bg-gray-300', 'dark:bg-gray-700');
                button.classList.remove('bg-gray-100', 'dark:bg-gray-800');
            } else {
                button.classList.add('bg-gray-100', 'dark:bg-gray-800');
                button.classList.remove('bg-gray-300', 'dark:bg-gray-700');
            }
        });
        
        // Set the selected index
        selectedIndex = index;
    }

    // Toggle visibility for new robot form
    document.getElementById('add-robot-button').addEventListener('click', () => {
        // if new-robot-form is already selected, don't hide it when clicked again
        if (!document.getElementById('new-robot-form').classList.contains('hidden')) {
            return;
        }
        document.querySelectorAll('.robot-form').forEach(form => form.classList.add('hidden')); // Hide other forms
        document.getElementById('new-robot-form').classList.toggle('hidden'); // Toggle new robot form

        // Deselect all buttons when "Add New Robot" is clicked
        document.querySelectorAll('[id^="robot-button-"]').forEach(button => {
            button.classList.add('bg-gray-100', 'dark:bg-gray-800');
            button.classList.remove('bg-gray-300', 'dark:bg-gray-700');
        });
    });

    // Initialize the first form as visible
    showForm(0);
</script>