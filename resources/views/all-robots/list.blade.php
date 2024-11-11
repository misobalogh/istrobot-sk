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
                <button id="sort-robot-name" class="ml-2 text-gray-500 dark:text-gray-300 focus:outline-none">
                    <span id="robot-arrow-up" class="hidden">▲</span>
                    <span id="robot-arrow-down">▼</span>
                </button>
            </div>
            <div class="flex-1 text-lg flex items-center">
                {{ __('all_robots_messages.author_name') }}
                <button id="sort-author-name" class="ml-2 text-gray-500 dark:text-gray-300 focus:outline-none">
                    <span id="author-arrow-up" class="hidden">▲</span>
                    <span id="author-arrow-down">▼</span>
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

    @include('all-robots.partials.edit-robot-modal')
    <x-bladewind::notification />

</x-app-layout>

<script>
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
        fetch(`/all-robots/${robotId}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit_robot_id').value = data.id;
                document.getElementById('edit_robot_name').value = data.name;
                document.getElementById('edit_author_first_name').value = data.author_first_name;
                document.getElementById('edit_author_last_name').value = data.author_last_name;

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
        const name = document.getElementById('edit_robot_name').value;
        const authorFirstName = document.getElementById('edit_author_first_name').value;
        const authorLastName = document.getElementById('edit_author_last_name').value;

        console.log(robotId, name, authorFirstName, authorLastName);
        fetch(`/all-robots/update/${robotId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    name,
                    author_first_name: authorFirstName,
                    author_last_name: authorLastName,
                }),
            })
            .then(response => response.json())
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
</script>