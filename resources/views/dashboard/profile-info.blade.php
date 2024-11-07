<h3 class="font-semibold mb-4">Profile information:</h3>
<div class="flex items-center gap-4 p-4 shadow rounded-lg">
    <div class="flex flex-col gap-2">
        <span class="font-semibold">Name:</span>
        <span class="font-semibold">Email:</span>
        <span class="font-semibold">City:</span>
        @if (Auth::user()->school)
        <span class="font-semibold">Country:</span>
        @endif
        <span class="font-semibold">School:</span>
    </div>
    <div class="flex flex-col gap-2">
        <span>{{ Auth::user()->first_name . Auth::user()->last_name }}</span>
        <span>{{ Auth::user()->email }}</span>
        <span>{{ Auth::user()->city }}</span>
        <span>{{ Auth::user()->country_code }}</span>
        @if (Auth::user()->school)
        <span>{{ Auth::user()->school }}</span>
        @endif
    </div>
</div>
