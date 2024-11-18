<section>
    <h3 class="font-semibold">{{ __('dashboard_messages.emails_title') }}:</h3>

    <div class="flex">
        <div class="flex gap-4">
            <!-- Input for year -->
            <div>
                <x-input-label for="year" :value="__('dashboard_messages.year')" required="true" />
                <div class="flex flex-row">
                    <x-text-input id="year-emails" name="year" type="number" class="mt-1 block w-half" value="{{ old('year', $setYear) }}"
                        min="2000" max="2100" oninput="validateEmailsYear(this)" />
                    <x-input-error id="year-mail-error" class="ml-4 mt-3" style="display: none" :messages="['Year must be between 2000 and 2100']" />
                </div>
            </div>
            <!-- Button for fetching emails -->
            <x-secondary-button id="fetch-emails" class="mt-6">
                {{ __('dashboard_messages.get_emails') }}
            </x-secondary-button>
        </div>
    </div>

    <div class="email-list mt-4">
        <x-input-label for="email-list" :value="__('dashboard_messages.email_list')" />
        
        <!-- Text area to display the email list in CSV format -->
        <textarea id="email-list-textarea" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="5" readonly></textarea>
        
        <!-- Copy to Clipboard Button -->
        <x-secondary-button id="copy-to-clipboard-email-list" class="mt-4">
            <span id="copy-icon-email-list">{{ __('dashboard_messages.copy_to_clipboard') }}</span>
            <span id="checkmark-icon-email-list" class="hidden">{{ __('dashboard_messages.copied') }}</span>
        </x-secondary-button>
    </div>
</section>

<script>
    function validateEmailsYear(input) {
        const errorElement = document.getElementById('year-mail-error');
        const setButton = document.getElementById('fetch-emails');
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