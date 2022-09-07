<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <link rel="stylesheet" href="{{ asset('css/style.css')}}">
        {{-- icones --}}
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap" rel="stylesheet"> 
        <script src="https://kit.fontawesome.com/097058085d.js" crossorigin="anonymous"></script>
        {{-- icones fin--}}
        <style>
            [x-cloak] {display:none;}
        </style>
        <title>Fournée d'antan</title>

            <!-- Chargement de l'API Google Chart -->
            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <!-- Chargement du module visualization en version 1 avec en option le package corechart -->


        @livewireStyles
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        
        {{-- Fenetre modale de confirmation --}}
        <style>
            [x-cloak] {
                display: none;
            }
            .duration-300 {
                transition-duration: 300ms;
            }
            .ease-in {
                transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
            }
            .ease-out {
                transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
            .scale-90 {
                transform: scale(.9);
            }
            .scale-100 {
                transform: scale(1);
            }
        </style>

    </head>
    <body class="flex flex-col items-center" x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak>
    {{-- <body class="flex flex-col items-center"> --}}
        <div class="w-full">
            <!--ecran 1-->
            <div class="flex flex-col h-full">
                <header class="bg-black py-5">
                    <div class="w-full flex flex-wrap justify-center items-center content-center">
                            @guest
                            <div class="w-2/12 pl-8">
                                <img src="{{ asset('images/logofourneeantan.png')}}" alt="logo" class="w-24 h-24 inline">
                                Email : fourneeantan@site.fr | Tél : 03.20.20.20.20                                
                            </div>
                                <div class="w-10/12 px-4 text-right">
                                @include('partials.navlog')
                            </div>
                                @else
                                @if (auth()->user()->role_id==2)
                                        <div class="w-full lg:hidden px-4 text-center">
                                            @include('partials.navcoteAdm') 
                                        </div>
                                        <div class="w-1/4 text-center lg:w-2/12">
                                        <a href="{{ route ('home')}}"><img src="{{ asset('images/FourneeAntan_logo_noir.png')}}" alt="logo" class="w-24 h-24 inline"></a>
                                        {{-- <p>Email : fourneeantan@site.fr</p>
                                        <p>Tél : 03.20.20.20.20</p> --}}
                                    </div>
                                    <div class="w-3/4 lg:w-8/12 text-center"><a class="text-4xl text-secondary" href="/dashboard">Administration</a></div>
                                    <div class="w-full lg:w-2/12 px-4 text-right">
                                        @include('partials.navlog')
                                    </div>
                                @else
                                    <div class="w-2/12 pl-8">
                                        <img src="{{ asset('images/logofourneeantan.png')}}" alt="logo" class="w-24 h-24 inline">
                                            Email : fourneeantan@site.fr | Tél : 03.20.20.20.20 
                                    </div>
                                    <div class="w-10/12 px-4 text-right">
                                        @include('partials.navlog')
                                    </div>
                                @endif
                            @endguest    
                    </div>
                {{-- <div>
                    @include('partials.navbar')
                </div> --}}
                </header>
                <div class="flex bg-amber-50 min-h-screen h-full">
                    <div class="bg-black lg:w-2/12 border-r border-four hidden lg:flex">
                        @include('partials.navcoteAdm')                            
                    </div>
                    {{-- Contenu des pages --}}
                    <div class="bg-amber-50 flex flex-col items-center w-full lg:w-10/12 mt-4">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 w-full flex-wrap text-white flex justify-evenly content-center items-center h-auto">
            @include('partials.footerAdm')                            
        </div>
      @livewireScripts
    </body>
</html>
