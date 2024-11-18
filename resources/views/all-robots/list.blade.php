<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('all_robots_messages.all_robots_title') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl min-h-screen mx-auto dark:bg-gray-800 text-gray-900 dark:text-white shadow-md border border-gray-100 dark:border-gray-700">
        <!-- Header Row -->
        <div class="py-2 flex flex-row items-center sm:px-6 lg:px-8 px-10 gap-4 font-semibold text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700">
            <div class="flex-1 text-lg flex items-center">
                {{ __('all_robots_messages.robot_name') }}
                <!-- Sort Button for Robot Name -->
                <button id="sort-robot-name" class="ml-4">
                    @if($sort === 'name')
                    @if($direction === 'asc')
                    <x-sort-alphabetical-ascending class="fill-current" />
                    @else
                    <x-sort-alphabetical-descending class="fill-current" />
                    @endif
                    @else
                    <x-sort-alphabetical-ascending class="fill-current" />
                    @endif
                </button>
            </div>
            <div class="flex-1 text-lg flex items-center">
                {{ __('all_robots_messages.author_name') }}
                <!-- Sort Button for Author Name -->
                <button id="sort-author-name" class="ml-4">
                    @if($sort === 'author_first_name')
                    @if($direction === 'asc')
                    <x-sort-alphabetical-ascending class="fill-current" />
                    @else
                    <x-sort-alphabetical-descending class="fill-current" />
                    @endif
                    @else
                    <x-sort-alphabetical-ascending class="fill-current" />
                    @endif
                </button>
            </div>
            <div class="flex-1 text-right text-lg">
                {{ __('all_robots_messages.actions') }}
            </div>
        </div>
        <div class="sm:px-6 lg:px-8 px-10">
            @foreach($robots as $robot)
            @include('all-robots.partials.robot-row', ['robot' => $robot])
            @endforeach
        </div>
    </div>

    @include('all-robots.partials.edit-robot-modal', ['robot' => $robot, 'technologies' => $technologies])

</x-app-layout>

<script>
    document.getElementById('sort-robot-name').addEventListener('click', function() {
        const currentSort = '{{ $sort }}';
        const currentDirection = '{{ $direction }}';
        let newDirection = 'asc';
        if (currentSort === 'name' && currentDirection === 'asc') {
            newDirection = 'desc';
        }
        window.location.href = `{{ route('all-robots.list') }}?sort=name&direction=${newDirection}`;
    });

    document.getElementById('sort-author-name').addEventListener('click', function() {
        const currentSort = '{{ $sort }}';
        const currentDirection = '{{ $direction }}';
        let newDirection = 'asc';
        if ((currentSort === 'author_first_name' || currentSort === 'author_last_name') && currentDirection === 'asc') {
            newDirection = 'desc';
        }
        window.location.href = `{{ route('all-robots.list') }}?sort=author_first_name&direction=${newDirection}`;
    });

    // Toggle arrow direction for Robot Name
    document.getElementById('sort-robot-name').addEventListener('click', function() {
        const robotArrowUp = document.getElementById('robot-arrow-up');
        const robotArrowDown = document.getElementById('robot-arrow-down');

        // Toggle robot arrow visibility
        if (robotArrowUp.classList.contains('hidden')) {
            robotArrowUp.classList.remove('hidden');
            robotArrowDown.classList.add('hidden');
        } else {
            robotArrowUp.classList.add('hidden');
            robotArrowDown.classList.remove('hidden');
        }
    });

    // Toggle arrow direction for Author Name
    document.getElementById('sort-author-name').addEventListener('click', function() {
        const authorArrowUp = document.getElementById('author-arrow-up');
        const authorArrowDown = document.getElementById('author-arrow-down');

        // Toggle author arrow visibility
        if (authorArrowUp.classList.contains('hidden')) {
            authorArrowUp.classList.remove('hidden');
            authorArrowDown.classList.add('hidden');
        } else {
            authorArrowUp.classList.add('hidden');
            authorArrowDown.classList.remove('hidden');
        }
    });


    function openEditRobotModal(robotId) {
        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

        fetch(`/all-robots/${robotId}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit_robot_id').value = data.id;
                document.getElementById('edit_name').value = data.name;
                document.getElementById('edit_author_first_name').value = data.author_first_name;
                document.getElementById('edit_author_last_name').value = data.author_last_name;
                document.getElementById('edit_coauthors').value = data.coauthors;
                document.getElementById('edit_processor').value = data.processor;
                document.getElementById('edit_memory_size').value = data.memory_size;
                document.getElementById('edit_frequency').value = data.frequency;
                document.getElementById('edit_sensors').value = data.sensors;
                document.getElementById('edit_drive').value = data.drive;
                document.getElementById('edit_power_supply').value = data.power_supply;
                document.getElementById('edit_programming_language').value = data.programming_language;
                document.getElementById('edit_technology_id').value = data.technology_id;
                document.getElementById('edit_website').value = data.website;
                document.getElementById('edit_interesting_facts').value = data.interesting_facts;
                document.getElementById('edit_description').value = data.description;

                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: 'edit-robot-modal'
                }));
            })
            .catch(error => console.error('Error:', error));
    }

    function closeEditRobotModal() {
        document.getElementById('editRobotModal').classList.add('hidden');
    }

    function handleDeleteRobot(robotId) {
        if (confirm('Are you sure you want to delete this robot?')) {
            fetch(`/all-robots/delete/${robotId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function handleEditRobotSave() {
        const robotId = document.getElementById('edit_robot_id').value;
        const name = document.getElementById('edit_name').value;
        const authorFirstName = document.getElementById('edit_author_first_name').value;
        const authorLastName = document.getElementById('edit_author_last_name').value;
        const coauthors = document.getElementById('edit_coauthors').value;
        const processor = document.getElementById('edit_processor').value;
        const memorySize = document.getElementById('edit_memory_size').value;
        const frequency = document.getElementById('edit_frequency').value;
        const sensors = document.getElementById('edit_sensors').value;
        const drive = document.getElementById('edit_drive').value;
        const powerSupply = document.getElementById('edit_power_supply').value;
        const programmingLanguage = document.getElementById('edit_programming_language').value;
        const technologyId = document.getElementById('edit_technology_id').value;
        const website = document.getElementById('edit_website').value;
        const interestingFacts = document.getElementById('edit_interesting_facts').value;
        const description = document.getElementById('edit_description').value;

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

        fetch(`/all-robots/update/${robotId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    name: name,
                    author_first_name: authorFirstName,
                    author_last_name: authorLastName,
                    coauthors: coauthors,
                    processor: processor,
                    memory_size: memorySize,
                    frequency: frequency,
                    sensors: sensors,
                    drive: drive,
                    power_supply: powerSupply,
                    programming_language: programmingLanguage,
                    technology_id: technologyId,
                    website: website,
                    interesting_facts: interestingFacts,
                    description: description,
                }),
            })
            .then(async response => {
                if (response.ok) {
                    return response.json();
                } else if (response.status === 422) {
                    const errors = await response.json();
                    displayValidationErrors(errors.errors);
                } else {
                    throw new Error('An unexpected error occurred');
                }
            })
            .then(data => {
                if (data.success) {
                    window.dispatchEvent(new CustomEvent('close-modal', {
                        detail: 'edit-robot-modal'
                    }));
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function displayValidationErrors(errors) {
        for (const [field, messages] of Object.entries(errors)) {
            const errorElement = document.getElementById(`error_${field}`);
            if (errorElement) {
                errorElement.textContent = messages.join(', ');
            }
        }
    }
</script>