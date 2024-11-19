<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 w-full fixed">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('navigation_messages.dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('navigation_messages.profile') }}
                    </x-nav-link>
                    <x-nav-link :href="route('robots.edit')" :active="request()->routeIs('robots.edit')">
                        {{ __('navigation_messages.my_robots') }}
                    </x-nav-link>
                    @if (Gate::allows('admin'))
                    <x-nav-link :href="route('all-users.list')" :active="request()->routeIs('all-users.list')">
                        {{ __('navigation_messages.all_users') }}
                    </x-nav-link>
                    <x-nav-link :href="route('all-robots.list')" :active="request()->routeIs('all-robots.list')">
                        {{ __('navigation_messages.all_robots') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.statistics')" :active="request()->routeIs('admin.statistics')">
                        {{ __('navigation_messages.statistics') }}
                    </x-nav-link>
                    @endif
                </div>
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 flex items-center gap-4">
                    @auth
                    <a href="{{ url('/') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('navigation_messages.home') }}</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <a href="#"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('navigation_messages.logout') }}
                        </a>
                    </form>
                    @endauth
                    <div class="relative">
                        <button id="languageSelection" class="flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                                <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7 0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7 7 0 0 0 13.745 12H11.91a9.3 9.3 0 0 1-.64 1.539 7 7 0 0 1-.597.933M8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855q.26-.487.468-1.068zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.7 13.7 0 0 1-.312 2.5m2.802-3.5a7 7 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7 7 0 0 0-3.072-2.472c.218.284.418.598.597.933M10.855 4a8 8 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M1.646 5.646a.5.5 0 011 0L8 11.293l5.354-5.647a.5.5 0 111 0l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z"/>
                            </svg>
                        </button>
                        <div id="languageOptions" class="hidden absolute right-0 mt-2 w-fit bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg z-20">
                            <a href="{{ route('lang.switch', 'en') }}" class="block font-semibold px-4 py-2 w-fit text-gray-600 hover:text-gray-900 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-white">EN</a>
                            <a href="{{ route('lang.switch', 'sk') }}" class="block font-semibold px-4 py-2 w-fit text-gray-600 hover:text-gray-900 dark:hover:bg-gray-700 dark:text-gray-400 dark:hover:text-white">SK</a>
                        </div>
                    </div>
                    <!-- Theme Toggle Button -->
                    <div class="relative">
                        <button id="theme-toggle" class="flex items-center text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline-none">
                            <!-- Sun Icon -->
                            <svg id="sun-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                            <!-- Moon Icon -->
                            <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('navigation_messages.dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('navigation_messages.profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('navigation_messages.logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Placeholder div to maintain the same layout even with fixed header -->
<div class="h-16"></div>

<script>
    document.getElementById('languageSelection').addEventListener('click', function() {
        var menu = document.getElementById('languageOptions');
        menu.classList.toggle('hidden');
    });

    // Theme toggle
    const themeToggleButton = document.getElementById('theme-toggle');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');

    function applyThemeOnLoad() {
        const savedTheme = localStorage.getItem('theme');
        const prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && prefersDarkMode)) { // if the user has set a dark theme or the system prefers dark mode
            document.documentElement.classList.add('dark'); // add the class to the HTML element (dark mode on)
            sunIcon.classList.remove('hidden'); // show the sun icon
        } else {
            document.documentElement.classList.remove('dark'); // remove the class from the HTML element (dark mode off)
            moonIcon.classList.remove('hidden'); // show the moon icon
        }
    }

    applyThemeOnLoad();

    themeToggleButton.addEventListener('click', function() {
        document.documentElement.classList.toggle('dark');
        sunIcon.classList.toggle('hidden');
        moonIcon.classList.toggle('hidden');

        if (document.documentElement.classList.contains('dark')) { // sets the theme preference in localStorage based on the current state (light/dark mode)
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });
</script>