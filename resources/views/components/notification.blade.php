
<div
    x-data="{ show: false, message: '' }"
    x-on:open-notification.window="
        message = $event.detail;
        show = true;
        setTimeout(() => show = false, 3000);
    "
    x-on:keydown.escape.window="show = false"
    x-show="show"
    class="fixed inset-0 flex items-center justify-center px-4 py-6 sm:px-0 z-50"
>
    <div
        x-show="show"
        class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-sm w-full"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        <div class="px-4 py-2">
            <span x-text="message" class="text-gray-900 dark:text-white"></span>
        </div>
    </div>
</div>