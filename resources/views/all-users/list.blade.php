<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('all_users_messages.all_users_title') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl min-h-screen mx-auto dark:bg-gray-800 text-gray-900 dark:text-white shadow-md border border-gray-100 dark:border-gray-700">
        <!-- Header Row -->
        <div class="py-2 flex flex-row items-center sm:px-6 lg:px-8 px-10 gap-4 font-semibold text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700">
            <div class="flex-1 text-lg flex items-center">
                {{ __('all_users_messages.user_name') }}
                <!-- Sort Button for User Name -->
                <button id="sort-user-name" class="ml-4">
                    @if($sort === 'last_name')
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
            <div class="flex-1 text-lg">
                {{ __('all_users_messages.email') }}
                <!-- Sort Button for Email -->
                <button id="sort-email" class="ml-4">
                    @if($sort === 'email')
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
            <div class="flex-1 text-lg">
                {{ __('all_users_messages.password') }}
            </div>
            <div class="flex-1 text-lg">
                {{ __('all_users_messages.actions') }}
            </div>
        </div>
        <div class="sm:px-6 lg:px-8 px-10">
            @foreach($users as $user)
            @include('all-users.partials.user-row', ['user' => $user])
            @endforeach
        </div>
    </div>

    @include('all-users.partials.edit-user-modal')

</x-app-layout>

<script>
    document.getElementById('sort-user-name').addEventListener('click', function() {
        const currentSort = '{{ $sort }}';
        const currentDirection = '{{ $direction }}';
        let newDirection = 'asc';
        if (currentSort === 'last_name' && currentDirection === 'asc') {
            newDirection = 'desc';
        }
        window.location.href = `{{ route('all-users.list') }}?sort=last_name&direction=${newDirection}`;
    });

    document.getElementById('sort-email').addEventListener('click', function() {
        const currentSort = '{{ $sort }}';
        const currentDirection = '{{ $direction }}';
        let newDirection = 'asc';
        if (currentSort === 'email' && currentDirection === 'asc') {
            newDirection = 'desc';
        }
        window.location.href = `{{ route('all-users.list') }}?sort=email&direction=${newDirection}`;
    });

    function handleSaveChanges(userId) {
        const email = document.getElementById(`email_${userId}`).value;
        let password = document.getElementById(`password_${userId}`).value;
        if (password === '****') {
            password = null;
        }

        fetch(`/all-users/quick-update/${userId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    email,
                    password
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(
                        'Success',
                        'Updated user successfully',
                        'success',
                        2,
                        'regular',
                        'same_one'
                    );
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function handleDeleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            fetch(`/all-users/delete/${userId}`, {
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

    function openEditUserModal(userId) {

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

        // Fetch user data and populate the modal form
        fetch(`/all-users/${userId}/edit`)
            .then(response => response.json())
            .then(data => {
                // Populate modal fields with user data
                document.getElementById('edit_user_id').value = data.id;
                document.getElementById('edit_first_name').value = data.first_name;
                document.getElementById('edit_last_name').value = data.last_name;
                document.getElementById('edit_email').value = data.email;
                document.getElementById('edit_birth_date').value = data.birth_date;
                document.getElementById('edit_city').value = data.city;
                document.getElementById('edit_country_code').value = data.country_code;
                document.getElementById('edit_school').value = data.school;

                // Open the modal
                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: 'edit-user-modal'
                }));
            })
            .catch(error => console.error('Error:', error));
    }

    function closeEditUserModal() {
        document.getElementById('editUserModal').classList.add('hidden');
    }

    function handleEditUserSave() {
        const userId = document.getElementById('edit_user_id').value;
        const firstName = document.getElementById('edit_first_name').value;
        const lastName = document.getElementById('edit_last_name').value;
        const email = document.getElementById('edit_email').value;
        const birthDate = document.getElementById('edit_birth_date').value;
        const city = document.getElementById('edit_city').value;
        const countryCode = document.getElementById('edit_country_code').value;
        const school = document.getElementById('edit_school').value;

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

        fetch(`/all-users/update/${userId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    first_name: firstName,
                    last_name: lastName,
                    email: email,
                    birth_date: birthDate,
                    city: city,
                    country_code: countryCode,
                    school: school
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
                        detail: 'edit-user-modal'
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