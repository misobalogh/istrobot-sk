@props([
    'disabled' => false,
    'maxLength' => null,
    'showCounter' => false,
    'name' => ''
])

<div>
    <input name="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}
        @if($maxLength)
                    maxlength="{{ $maxLength }}"
                    oninput="validateInputLength(this, '{{ $name }}_error')"
                @endif
        >
        @if($maxLength && $showCounter)
            <span id="{{ $name }}_error" class="text-sm text-red-600 dark:text-red-400"></span>
        @endif
</div>

<script>
function validateInputLength(input, errorId) {
    const maxLength = input.maxLength;
    const currentLength = input.value.length;
    const errorElement = document.getElementById(errorId);
    
    if (!errorElement) return;

    if (currentLength >= maxLength) {
        input.value = input.value.substring(0, maxLength);
        errorElement.textContent = `Maximum length is ${maxLength} characters`;
    } else if (currentLength >= maxLength - 5) {
        errorElement.textContent = `${maxLength - currentLength} characters remaining`;
    } else {
        errorElement.textContent = '';
    }
}
</script>