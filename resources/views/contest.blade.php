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
        <div class="w-[200px] bg-gray-800 text-white p-4 min-h-screen flex flex-col justify-center items-center" style="width: 500px;">
            <!-- Navbar content goes here -->
            <ul>
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Novinky</li>
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Pravidla</li>
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Přihláška</li>
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Roboty</li>
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Archiv</li>
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded">Roboty</li>                
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded flex justify-center items-center"><img src="{{ asset('img/icon/fb.png') }}" width="30px"></li>
                <li class="py-6 px-4 text-center hover:bg-gray-700 rounded flex justify-center items-center"><img src="{{ asset('img/icon/yt.png') }}" width="30px"></li>
            </ul>
        </div>

        <!-- Right Content Area -->
        <div class="flex flex-col items-center space-y-4" style="background-color: lightgrey">
            <!-- First Div: Centered with Image -->
            <div class="flex justify-center items-center" style="margin-top: 15px;">
                <img src="{{ asset('img/basicLogo25.png') }}" width="600px" alt="YouTube Icon">
            </div>

            <!-- Second Div: Under the First Div -->
            <div class=" text-center text-xl mt-4">
                <!-- Content for the second div goes here -->
                <h1 style="font-size: 30px; color: rgb(6, 55, 74);margin-top: 20px;"><b>25. ročník medzinárodnej súťaže robotov</b></h1>
                <h1 style="font-size: 35px; color: rgb(6, 55, 74);margin-top: 20px;"><b>??. ?. 2025 FEI STU Bratislava</b></h1>
            </div>

            <div class="w-full flex space-x-4" style="margin-top: 20px;">
                <!-- First Child div -->
                <div style="float: left; width: 25%;">
                    <img src="{{ asset('img/tp/rand/foto05.jpg') }}" alt="robot" />
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

            <div class="w-full space-x-4" style="padding: 40px; background-color: rgb(6, 55, 74); color: lightgrey; font-size: 20px">
                <p style="font-size: 30px"><b>Kategórie a pravidlá</b></p>
                <p>Roboty súťažia v nasledujúcich kategóriách:</p>

                <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118);">
                    <div style="padding: 30px; width: 50%; float: left; border-style: solid; border-width: 1px; border-color: lightgrey; border-radius: 10px 0px 0px 0px;">
                        <div style="float left; width: 20%;" > 
                            <img src="{{ asset('img/tp/rand/foto09.jpg') }}" alt="icon" width="80px" class="w-18 h-18 rounded-full" />
                        </div>
                        <div style="float right; width: 80%;" > 
                            
                        </div>
                    </div>
                    <div style="padding: 30px; width: 50%; float: right; border-style: solid; border-width: 1px; border-color: lightgrey; border-radius: 0px 10px 0px 0px;">

                    </div>
                
                </div>
                <div class="flex w-full space-x-4" style="background-color: rgb(77, 108, 118)">
                    <div style="padding: 30px; width: 50%; float: left; border-style: solid; border-width: 1px; border-color: lightgrey;">

                    </div>
                    <div style="padding: 30px; width: 50%; float: right; border-style: solid; border-width: 1px; border-color: lightgrey;">

                    </div>
                
                </div>
            </div>

        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu porttitor enim. Sed sed turpis dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam erat volutpat. Sed blandit rutrum rhoncus. Vestibulum volutpat ante ut nisi facilisis, quis accumsan purus vulputate. Suspendisse magna nunc, varius sed feugiat quis, venenatis non leo.

        Nam dolor turpis, cursus ac dictum id, elementum nec massa. Integer tempor nisi vel dui vulputate vehicula. Etiam vehicula volutpat tellus, in placerat justo cursus et. Nam vestibulum tristique sollicitudin. Nulla elementum consequat porta. Pellentesque nulla turpis, ultricies ac massa id, laoreet posuere massa. Proin non sem at velit tincidunt vulputate. Donec nec leo at nunc dignissim venenatis. Fusce fermentum velit non nunc feugiat, at posuere risus eleifend. Mauris eu nisl eget tellus vestibulum dictum.
        </div>
    </body>


</html>

    
