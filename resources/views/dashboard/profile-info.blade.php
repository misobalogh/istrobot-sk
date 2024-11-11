<h3 class="font-semibold mb-4">
    {{ __('dashboard_messages.profile_info_title') }}
</h3>
<div class="flex items-center gap-4 p-4 rounded-lg">
    <div class="flex flex-col gap-2">
        <span class="font-semibold"> {{ __('dashboard_messages.name') }}:</span>
        <span class="font-semibold"> {{ __('dashboard_messages.email') }}:</span>
        @if (Auth::user()->school)
        <span class="font-semibold"> {{ __('dashboard_messages.school') }}:</span>
        @endif
        <span class="font-semibold"> {{ __('dashboard_messages.city') }}:</span>
        <span class="font-semibold"> {{ __('dashboard_messages.country') }}:</span>
    </div>
    <div class="flex flex-col gap-2">
        <span>{{ Auth::user()->first_name . " " . Auth::user()->last_name }}</span>
        <span>{{ Auth::user()->email }}</span>
        @if (Auth::user()->school)
        <span>{{ Auth::user()->school }}</span>
        @endif
        <span>{{ Auth::user()->city }}</span>
        <span>{{ Auth::user()->country_code }}</span>
    </div>
</div>