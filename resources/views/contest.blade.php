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
                <div class=" p-6" style="float:right;background-color: rgb(75,75,75); width:75%; padding-left 20px; color: lightgrey">
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
                <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118); border-radius: 10px 10px 10px 10px;">
                    <!-- sloupec v radku -->
                    <div style="padding: 30px; width: 50%; float: left; border-style: solid; border-width: 1px; border-color: lightgrey; border-radius: 10px 0px 0px 0px;">
                        <div style="float: left; width: 20%; height: 200px">
                            <img src="{{ asset('img/icon/stoparICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                        </div>
                        <div style="float: right; width: 80%;">
                            <h1 style="font-size: 25px;"><b>{{ __('contest_messages.follower') }}</b></h1>
                            <p>{{ __('contest_messages.follower_description') }}</p>
                            <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
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
                            <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
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
                            <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
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
                            <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
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
                        <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
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
                        <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('contest_messages.details_button') }}</button>
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
</x-guest-layout>