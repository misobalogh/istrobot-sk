<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex font-sans text-gray-900 antialiased min-h-screen">
        <!-- Left Sidebar (Navbar) -->
        <div class="w-[200px] bg-gray-800 text-white p-4 min-h-screen flex flex-col justify-center items-center" style="position: fixed; width: 10%;">
            <!-- Navbar content goes here -->
            <ul>
                <a href="#news"><li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Novinky</li></a>
                <a href="#rules"><li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Pravidla</li></a>
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Roboty</li>
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Archiv</li>
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Login</li>                
                <a href="https://www.facebook.com/RobotikaSK"><li class="py-6 px-4 text-center hover:bg-gray-700 rounded flex justify-center items-center"><img src="{{ asset('img/icon/fb.png') }}" width="30px"></li></a>
                <a href="https://www.youtube.com/channel/UCZTEibKdgnHuZd-jmlg_IsQ"><li class="py-6 px-4 text-center hover:bg-gray-700 rounded flex justify-center items-center"><img src="{{ asset('img/icon/yt.png') }}" width="30px"></li></a>                
                <a href="#top"><li class="text-center hover:bg-gray-700 rounded flex justify-center items-center"><img src="{{ asset('img/icon/scroll.png') }}" width="50px"></li></a>
            </ul>
        </div>

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
                    <h1 style="font-size: 30px; color: rgb(6, 55, 74);margin-top: 20px;"><b>25. ročník medzinárodnej súťaže robotov</b></h1>
                    <h1 style="font-size: 35px; color: rgb(6, 55, 74);margin-top: 20px;"><b>??. ?. 2025 FEI STU Bratislava</b></h1>
                </div>

                <div id="news" class="w-full flex space-x-4" style="margin-top: 20px;">
                    <!-- First Child div -->
                    <div style="float: left; width: 25%;">
                        <img src="{{ asset('img/tp/rand/foto05.jpg') }}" alt="robot" style="height: 100%; object-fit: cover;" />
                    </div>

                    <!-- Right Child div that takes up the remaining space -->
                    <div class=" p-6" style="float:right;background-color: rgb(75,75,75); width:75%; padding-left 20px; color: lightgrey">
                        <p class="text-lg" style="font-size: 30px; margin-top: 30px; margin-left: 20px;"><b>Istrobot 2025</b></p>
                        <p class="text-lg" style="margin-top: 20px; margin-left: 20px;">Aj v roku 2025 pre vás pripravíme ďalší ročník súťaže Istrobot. Presný dátum ešte riešime, ale bude to tak ako obvykle, v niektrorú aprílovú sobotu v Bratislave, v priestoroch FEI STU. Ostaneme aj pri minuloročných kategóriach Stopár, Myš v bludisku, Sklad kečupu a Voľná jazda, ako aj obľúbenbé LegoSumo.</p>
                        <h2 style="font-size: 30px; margin-top: 25px; margin-left: 20px;"><b>Dôležité termíny</b></h2>
                        <ul style="margin-top: 20px; margin-left: 20px; list-style: disc;">
                            <li style="margin-left: 40px;" >2. 4. 2025 - deadline prihlášok</li>
                            <li style="margin-left: 40px;" >apríl 2025 - súťažný deň</li>
                        </ul>
                    </div>
                </div>

                <!-- Kategorie a pravidla -->
                <div id="rules" class="w-full space-x-4" style="padding: 40px; background-color: rgb(6, 55, 74); color: lightgrey; font-size: 20px; height: 1100px;">
                    <p style="font-size: 30px"><b>Kategórie a pravidlá</b></p>
                    <p>Roboty súťažia v nasledujúcich kategóriách:</p>

                    <!-- radek tabulky -->
                    <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118); border-radius: 10px 10px 10px 10px;">
                        <!-- sloupec v radku -->
                        <div style="padding: 30px; width: 50%; float: left; border-style: solid; border-width: 1px; border-color: lightgrey; border-radius: 10px 0px 0px 0px;">
                            <div style="float: left; width: 20%; height: 200px" > 
                                <img src="{{ asset('img/icon/stoparICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                            </div>
                            <div style="float: right; width: 80%;" > 
                                <h1 style="font-size: 25px;"><b>Stopár</b></h1>
                                <p>Robot - stopár má čo najrýchlejšie prejsť zadanú dráhu a zdolať všetky jej nástrahy. Na dráhe sú umiestnené rozličné prekážky, napríklad prerušenie čiary alebo tehlička, ktorú treba obísť.</p>
                                <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"> PODROBNOSTI </button>
                            </div>
                        </div>
                        <!-- sloupec v radku -->
                        <div style="padding: 30px; width: 50%; float: right; border-style: solid; border-width: 1px; border-color: lightgrey; border-radius: 0px 10px 0px 0px;">
                            <div style="float: left; width: 20%; height: 200px" > 
                                    <img src="{{ asset('img/icon/stoparICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                            </div>
                            <div style="float: right; width: 80%;" > 
                                <h1 style="font-size: 25px;"><b>V sklade kečupu</b></h1>
                                <p>V tejto kategórii je úlohou zostrojiť robota, ktorý dokáže správne usporiadať konzervy s paradajkovým pretlakom v sklade. Súťažia vždy dva roboty, vyhráva ten, ktorý nazbiera viac plechoviek.</p>
                                <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"> PODROBNOSTI </button>
                            </div>
                        </div>                
                    </div>

                    <!-- radek tabulky -->
                    <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118);">
                        <!-- sloupec v radku -->
                        <div style="padding: 30px; width: 50%; float: left; border-style: solid; border-width: 1px; border-color: lightgrey;">
                            <div style="float: left; width: 20%; height: 200px" > 
                                <img src="{{ asset('img/icon/sumoICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                            </div>
                            <div style="float: right; width: 80%;" > 
                                <h1 style="font-size: 25px;"><b>LegoSumo</b></h1>
                                <p>Dva roboty sa vytláčajú z kruhového ringu a ten silnejší zvíťazí. V tejto kategórií súťažia len roboty z Lega.</p>
                                <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"> PODROBNOSTI </button>
                            </div>
                        </div>
                        <!-- sloupec v radku -->
                        <div style="padding: 30px; width: 50%; float: right; border-style: solid; border-width: 1px; border-color: lightgrey;">
                            <div style="float: left; width: 20%; height: 200px" > 
                                    <img src="{{ asset('img/icon/mysICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                            </div>
                            <div style="float: right; width: 80%;" > 
                                <h1 style="font-size: 25px;"><b>Myš v bludisku</b></h1>
                                <p>Autonómny robot - myš má čo najrýchlejšie nájsť cestu bludiskom. Pri hľadaní cesty bludiskom sa dá použiť pravidlo pravej, resp. ľavej ruky, ale takáto cesta nebude najkratšia.</p>
                                <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"> PODROBNOSTI </button>
                            </div>
                        </div>                
                    </div>

                    <!-- radek tabulky -->
                    <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118);padding: 30px; float: left; border-style: solid; border-width: 1px; border-color: lightgrey;">
                        <div style="float: left; width: 10%; height: 130px" > 
                            <img src="{{ asset('img/icon/walkICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                        </div>
                        <div style="float: right; width: 90%;" > 
                            <h1 style="font-size: 25px;"><b>Voľná jazda</b></h1>
                            <p>Táto kategória je určená na predvádzanie vašich robotov. Každý súťažiaci môže predviesť všetko, čo jeho robot dokáže. O víťazovi rozhodne porota na základe prezentácie robota a rozhovoru s autorom.</p>
                            <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"> PODROBNOSTI </button>
                        </div>
                    </div>

                    <!-- radek tabulky -->
                    <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118);padding: 30px; float: left; border-style: solid; border-width: 1px; border-color: lightgrey; border-radius: 0px 0px 10px 10px ">
                        <div style="float: left; width: 10%; height: 130px" > 
                            <img src="{{ asset('img/icon/volnajazdaICO.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                        </div>
                        <div style="float: right; width: 90%;" > 
                            <h1 style="font-size: 25px;"><b>Společné pravidlá</b></h1>
                            <p>Naďalej platia pre všetky kategórie spoločné pravidlá týkajúce sa hlavne bezpečnosti a použitých materiálov.</p>
                            <button class="px-4 mt-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"> PODROBNOSTI </button>
                        </div>
                    </div>

                </div>

                <div class="w-full space-x-4" style="padding: 40px;  background-color: rgb(75, 75, 75); font-size: 20px; color: lightgrey">
                    <b style="font-size:30px;">Ochrana osobných údajov (GDPR)</b>
                    <p>Registráciou a vyplnením prihlášky na súťaž Istrobot účastníci súhlasia so zverejnením svojich osobných údajov v podobe prihlášky, štartovej listiny a výsledkov na webe súťaže (istrobot.sk a robotika.sk). Mená víťazov sa môžu objaviť aj v tlačovej správe a médiach, ako aj na sociálnych sieťach (facebook, Instagram, YouTube). Súťažiaci súhlasí so zverejnením svojho videa na stránkach súťaže a sociálnych sieťach (napr. istrobot.sk, robotika.sk, facebook, Instagram, YouTube) samozrejme s uvedením autora.</p>
                    <br />
                    <p><b>Fotografovanie a video:</b> Naše podujatia sú verejné. Vaše osobné údaje v rozsahu fotografií a videozáznamov, týkajúce sa osoby účastníka alebo jeho prejavov osobnej povahy v súvislosti s vašou účasťou na podujatí, spracúvame za účelom ich získania (vyhotovenia) a použitia, a to formou ich zverejnenia na webovej stránke robotika.sk a istrobot.sk, na sociálnych sieťach, v tlačových správach a u spoluorganizátorov a na účel propagácie organizátorov a robotiky. Vezmite, prosím, na vedomie, že počas podujatia budú takéto záznamy vyhotovované a že účasťou vyjadrujete súhlas s týmto spracúvaním osobných údajov. V prípade nesúhlasu máte možnosť namietať proti vyhotovovaniu obrazového/obrazovo-zvukového záznamu svojej osoby u fotografa/kameramana.</p>
                </div>

            </div>
        </div>
    </body>


</html>

    
