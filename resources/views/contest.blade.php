<x-guest-layout>
    <!-- Right Content Area -->
    <div class="flex items-center space-y-4" style="background-color: lightgrey;">

        <div style="width: 10%; float: left;">

        </div>
        <div style="width: 90%; float: right;">

            <!-- First Div: Centered with Image -->
            <div id="top" class="flex justify-center items-center" style="margin-top: 15px;">
                <img src="{{ asset('img/basicLogo25.png') }}" width="600px" alt="YouTube Icon">
            </div>

            <!-- Second Div: Under the First Div -->
            <div class=" text-center text-xl mt-4">
                <!-- Content for the second div goes here -->
                <h1 style="font-size: 30px; color: rgb(6, 55, 74);margin-top: 20px;"><b>25. {{ __('contest_messages.competition_title') }}</b></h1>
                <h1 style="font-size: 35px; color: rgb(6, 55, 74);margin-top: 20px;"><b>??. ?. 2025 {{ __('contest_messages.competition_place') }}</b></h1>
            </div>

            <div id="news" class="w-full flex space-x-4" style="margin-top: 20px;">
                <!-- First Child div -->
                <div style="float: left; width: 25%;">
                    <img src="{{ asset('img/tp/rand/foto05.jpg') }}" alt="robot" style="height: 100%; object-fit: cover;" />
                </div>

                <!-- Right Child div that takes up the remaining space -->
                <div class=" p-6" style="float:right;background-color: rgb(75,75,75); width:75%; color: lightgrey">
                    <p class="text-lg" style="font-size: 30px; margin-top: 30px; margin-left: 20px;"><b>{{ __('contest_messages.istrobot') }} 2025</b></p>
                    <p class="text-lg" style="margin-top: 20px; margin-left: 20px;">{{ __('contest_messages.main_announcement') }}</p>
                    <h2 style="font-size: 30px; margin-top: 25px; margin-left: 20px;"><b>{{ __('contest_messages.important_dates') }}</b></h2>
                    <ul style="margin-top: 20px; margin-left: 20px; list-style: disc;">
                        <li style="margin-left: 40px;">2. 4. 2025 - {{ __('contest_messages.registration_deadline') }}</li>
                        <li style="margin-left: 40px;">apríl 2025 - {{ __('contest_messages.competition_day') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Kategorie a pravidla -->
            <div id="rules" class="w-full space-x-4" style="padding: 40px; background-color: rgb(6, 55, 74); color: lightgrey; font-size: 20px; height: 1100px;">
                <p style="font-size: 30px"><b>{{ __('contest_messages.categories_rules') }}</b></p>
                <p>{{ __('contest_messages.categories_intro') }}:</p>

                <!-- radek tabulky -->
                <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118); border-radius: 10px 10px 0px 0px;">
                    <!-- sloupec v radku -->
                    <div style="padding: 30px; width: 50%; float: left; border-style: solid; border-width: 1px; border-color: lightgrey; border-radius: 10px 0px 0px 0px;">
                        <div style="float: left; width: 20%; height: 200px">
                            <img src="{{ asset('img/icon/stoparICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                        </div>
                        <div style="float: right; width: 80%;">
                            <h1 style="font-size: 25px;"><b>{{ __('contest_messages.follower') }}</b></h1>
                            <p>{{ __('contest_messages.follower_description') }}</p>
                            <button onclick="openModal('follower-modal')" class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
                        </div>
                    </div>
                    <!-- sloupec v radku -->
                    <div style="padding: 30px; width: 50%; float: right; border-style: solid; border-width: 1px; border-color: lightgrey; border-radius: 0px 10px 0px 0px;">
                        <div style="float: left; width: 20%; height: 200px">
                            <img src="{{ asset('img/icon/stoparICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                        </div>
                        <div style="float: right; width: 80%;">
                            <h1 style="font-size: 25px;"><b>{{ __('contest_messages.ketchup_storage') }}</b></h1>
                            <p>{{ __('contest_messages.ketchup_description') }}</p>
                            <button onclick="openModal('ketchup-modal')" class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
                        </div>
                    </div>
                </div>

                <!-- radek tabulky -->
                <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118);">
                    <!-- sloupec v radku -->
                    <div style="padding: 30px; width: 50%; float: left; border-style: solid; border-width: 1px; border-color: lightgrey;">
                        <div style="float: left; width: 20%; height: 200px">
                            <img src="{{ asset('img/icon/sumoICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                        </div>
                        <div style="float: right; width: 80%;">
                            <h1 style="font-size: 25px;"><b>{{ __('contest_messages.lego_sumo') }}</b></h1>
                            <p>{{ __('contest_messages.lego_sumo_description') }}</p>
                            <button onclick="openModal('legosumo-modal')" class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
                        </div>
                    </div>
                    <!-- sloupec v radku -->
                    <div style="padding: 30px; width: 50%; float: right; border-style: solid; border-width: 1px; border-color: lightgrey;">
                        <div style="float: left; width: 20%; height: 200px">
                            <img src="{{ asset('img/icon/mysICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                        </div>
                        <div style="float: right; width: 80%;">
                            <h1 style="font-size: 25px;"><b>{{ __('contest_messages.mouse_in_labyrinth') }}</b></h1>
                            <p>{{ __('contest_messages.mouse_description') }}</p>
                            <button onclick="openModal('mousemaze-modal')" class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
                        </div>
                    </div>
                </div>

                <!-- radek tabulky -->
                <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118);padding: 30px; float: left; border-style: solid; border-width: 1px; border-color: lightgrey;">
                    <div style="float: left; width: 10%; height: 130px">
                        <img src="{{ asset('img/icon/walkICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                    </div>
                    <div style="float: right; width: 90%;">
                        <h1 style="font-size: 25px;"><b>{{ __('contest_messages.free_ride') }}</b></h1>
                        <p>{{ __('contest_messages.free_ride_description') }}</p>
                        <button onclick="openModal('freeride-modal')" class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
                    </div>
                </div>

                <!-- radek tabulky -->
                <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118);padding: 30px; float: left; border-style: solid; border-width: 1px; border-color: lightgrey; border-radius: 0px 0px 10px 10px ">
                    <div style="float: left; width: 10%; height: 130px">
                        <img src="{{ asset('img/icon/volnajazdaICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                    </div>
                    <div style="float: right; width: 90%;">
                        <h1 style="font-size: 25px;"><b>{{ __('contest_messages.common_rules') }}</b></h1>
                        <p>{{ __('contest_messages.rules_description') }}</p>
                        <button onclick="openModal('commonrules-modal')" class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
                    </div>
                </div>

            </div>

            <div class="w-full space-x-4" style="padding: 40px;  background-color: rgb(75, 75, 75); font-size: 20px; color: lightgrey">
                <b style="font-size:30px;">{{ __('contest_messages.gdpr') }}</b>
                <p>{{ __('contest_messages.gdpr_main_message') }}</p>
                <br />
                <p><b>{{ __('contest_messages.photos_videos') }}:</b>{{ __('contest_messages.photos_videos_message') }}</p>
            </div>
        </div>
    </div>

    <!-- Modal windows -->
    <div id="follower-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-80 max-w-sm" style="color: lightgrey; width: 40%">
            <h2 class="text-2xl font-bold mb-4">{{ __('contest_messages.modal_follower_title') }}</h2>
            <p>{{ __('contest_messages.modal_follower_body') }}</p>
            <button onclick="closeModal('follower-modal')" class="mt-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                {{ __('contest_messages.close_button') }}
            </button>
        </div>
    </div>
    <div id="ketchup-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-80 max-w-sm" style="color: lightgrey; width: 40%">
            <h2 class="text-2xl font-bold mb-4">{{ __('contest_messages.modal_ketchup_title') }}</h2>
            <p>{{ __('contest_messages.modal_ketchup_body') }}</p>
            <button onclick="closeModal('ketchup-modal')" class="mt-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                {{ __('contest_messages.close_button') }}
            </button>
        </div>
    </div>
    <div id="legosumo-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-80 max-w-sm" style="color: lightgrey; width: 40%">
            <h2 class="text-2xl font-bold mb-4">{{ __('contest_messages.modal_legosumo_title') }}</h2>
            <p>{{ __('contest_messages.modal_legosumo_body') }}</p>
            <button onclick="closeModal('legosumo-modal')" class="mt-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                {{ __('contest_messages.close_button') }}
            </button>
        </div>
    </div>
    <div id="mousemaze-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-80 max-w-sm" style="color: lightgrey; width: 40%">
            <h2 class="text-2xl font-bold mb-4">{{ __('contest_messages.modal_mouse_title') }}</h2>
            <p>{{ __('contest_messages.modal_mouse_body') }}</p>
            <button onclick="closeModal('mousemaze-modal')" class="mt-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                {{ __('contest_messages.close_button') }}
            </button>
        </div>
    </div>
    <div id="freeride-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-80 max-w-sm" style="color: lightgrey; width: 40%">
            <h2 class="text-2xl font-bold mb-4">{{ __('contest_messages.modal_freeride_title') }}</h2>
            <p>{{ __('contest_messages.modal_freeride_body') }}</p>
            <button onclick="closeModal('freeride-modal')" class="mt-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                {{ __('contest_messages.close_button') }}
            </button>
        </div>
    </div>
    <div id="commonrules-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-80 max-w-sm" style="color: lightgrey; width: 40%">
            <h2 class="text-2xl font-bold mb-4">{{ __('contest_messages.modal_common_rules_title') }}</h2>
            <p>{{ __('contest_messages.modal_common_rules_body') }}</p>
            <button onclick="closeModal('commonrules-modal')" class="mt-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                {{ __('contest_messages.close_button') }}
            </button>
        </div>
    </div>

</div>
</x-guest-layout>
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>