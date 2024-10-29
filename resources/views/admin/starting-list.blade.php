<section>
    <h3 class="font-semibold">Starting List:</h3>

    <!-- Input for year -->
    <div>
        <x-input-label for="year" :value="__('Year') . '*'" />
        <x-text-input id="year-starting-list" name="year" type="number" class="mt-1 block w-half" value="{{ old('year', date('Y')) }}" required
            min="2000" max="2100" />
        <x-input-error class="mt-2" :messages="$errors->get('year')" />
    </div>

    <!-- Button to generate starting list and the starting list -->
    <x-secondary-button id="generate-starting-list" class="mt-4">
        Generate Starting List
    </x-secondary-button>
    <div class="starting-list">
    </div>
</section>

<script>
    document.getElementById('generate-starting-list').addEventListener('click', function () {

        const yearInput = document.getElementById('year-starting-list');
        const year = yearInput.value;

        fetch(`/admin/generate-starting-list/${year}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
            .then(response => response.json())
            .then(data => {
                const startingList = document.querySelector('.starting-list');
                startingList.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(item => {
                        const robotEntry = `<p>${item.robot_name} (Owner: ${item.robot_owner}, Starting Number: ${item.starting_number}. ${item.category_name})</p>`;
                        startingList.innerHTML += robotEntry;
                    });
                } else {
                    startingList.innerHTML = '<p>No robots found.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>