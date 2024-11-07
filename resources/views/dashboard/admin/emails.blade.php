<section>
    <h3 class="font-semibold">Emails:</h3>

    <!-- Input for year -->
    <div>
        <x-input-label for="year" :value="__('Year')" required="true" />
        <x-text-input id="year-emails" name="year" type="number" class="mt-1 block w-half" value="{{ old('year', date('Y')) }}"
            min="2000" max="2100" />
        <x-input-error class="mt-2" :messages="$errors->get('year')" />
    </div>

    <!-- Button for fetching emails -->
    <x-secondary-button id="fetch-emails" class="mt-4">
        Get Emails
    </x-secondary-button>

    <div class="email-list mt-4">
        <!-- Fetched Emails -->
    </div>
</section>

<script>
    document.getElementById('fetch-emails').addEventListener('click', function () {
        const yearInput = document.getElementById('year-emails');
        const year = yearInput.value;
        const url = year ? `/admin/get-emails/${year}` : `/admin/get-emails`;

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
            .then(response => response.json())
            .then(data => {
                const emailList = document.querySelector('.email-list');
                emailList.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(email => {
                        const emailEntry = `<p>${email}</p>`;
                        emailList.innerHTML += emailEntry;
                    });
                } else {
                    emailList.innerHTML = '<p>No emails found.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const emailList = document.querySelector('.email-list');
                emailList.innerHTML = '<p>Error fetching emails.</p>';
            });
    });
</script>