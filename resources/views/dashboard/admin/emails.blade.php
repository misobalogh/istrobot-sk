<section>
    <h3 class="font-semibold">Emails:</h3>

    <!-- Input for year -->
    <div>
        <x-input-label for="year" :value="__('Year')" required="true" />
        <x-text-input id="year-emails" name="year" type="number" class="mt-1 block w-half" value="{{ old('year', $setYear) }}"
            min="2000" max="2100" />
        <x-input-error class="mt-2" :messages="$errors->get('year')" />
    </div>

    <!-- Button for fetching emails -->
    <x-secondary-button id="fetch-emails" class="mt-4">
        Get Emails
    </x-secondary-button>

    <div class="email-list mt-4">
        <x-input-label for="email-list" :value="__('Email List')" />
        
        <!-- Text area to display the email list in CSV format -->
        <textarea id="email-list-textarea" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="5" readonly></textarea>
        
        <!-- Copy to Clipboard Button -->
        <x-secondary-button id="copy-to-clipboard-email-list" class="mt-4">
            <span id="copy-icon-email-list">Copy to Clipboard</span>
            <span id="checkmark-icon-email-list" class="hidden">✔ Copied!</span>
        </x-secondary-button>
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
                const emailList = document.getElementById('email-list-textarea');
                emailList.value = ''; // Clear the text area

                if (data.length > 0) {
                    const emailEntries = data.map(email => 
                        `${email}`
                    );
                    emailList.value = emailEntries.join('\n');
                } else {
                    emailList.value = 'No emails found.';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    // Copy to clipboard functionality
    document.getElementById('copy-to-clipboard-email-list').addEventListener('click', function () {
        const textEmailArea = document.getElementById('email-list-textarea');
        // textEmailArea.select();
        // document.execCommand('copy');
        navigator.clipboard.writeText(textEmailArea.value)
            .then(() => {
            // Change button to show checkmark
            const copyIconEmailList = document.getElementById('copy-icon-email-list');
            const checkmarkIconEmailList = document.getElementById('checkmark-icon-email-list');
            
            copyIconEmailList.classList.add('hidden');
            checkmarkIconEmailList.classList.remove('hidden');

            // After 2 seconds, show original message (Copy to Clipboard)
            setTimeout(() => {
                copyIconEmailList.classList.remove('hidden');
                checkmarkIconEmailList.classList.add('hidden');
            }, 2000); // 2 seconds
        })
    });
</script>