<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('extra-meta')
        @yield('extra-script')
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <link rel="stylesheet" href="{{ asset('css/caroussel.css')}}">
        <link rel="stylesheet" href="{{ asset('css/style.css')}}">
        {{-- icones --}}
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap" rel="stylesheet"> 
        <script src="https://kit.fontawesome.com/097058085d.js" crossorigin="anonymous"></script>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Reggae+One&display=swap" rel="stylesheet"> 

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
        
        {{-- icones fin--}}
        
        {{-- <style>
            [x-cloak] {display:none;}
        </style> --}}
        <title>Fournée d'antan</title>
        @livewireStyles
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        {{-- <style>
            [x-cloak] {display:none;}
        </style> --}}
    </head>
    <body class="flex flex-col items-center h-full">
        <div class="w-full">
            <!--ecran 1-->
            <div class="flex flex-col h-full">
                <header class="bg-four border-b border-four py-5">
                <div class="w-full">
                    @include('partials.navbar')
                </div>
                </header>
                <div class="bg-bg-amber-50 flex min-h-screen">
                    {{-- @if ((Route::currentRouteName() == 'ContactController.index')|| (Route::currentRouteName() == 'ContactController.store') || (Route::currentRouteName() == 'HomeController.about') || (Route::currentRouteName() == 'cart.index') || (Route::currentRouteName() == 'checkout.index')|| (Route::currentRouteName() == 'checkout.thankYou')|| (Route::currentRouteName() == 'login')|| (Route::currentRouteName() == 'panier')) --}}
                    @if ((Route::currentRouteName() != 'products.index') && (Route::currentRouteName() != 'products.show') && (Route::currentRouteName() != 'products.showByCategory') && (Route::currentRouteName() != 'cart.store'))
                        <div class="bg-amber-50 flex flex-col items-center w-full">
                            @yield('content')
                        </div>
                    @else
                    <div class="bg-amber-50 hidden lg:flex flex-col items-center w-2/12 py-5">
                    {{-- <div class="bg-amber-50 flex flex-col items-center w-2/12 border-r border-four py-5"> --}}
                            @include('partials.navcote')
                        </div>
                        {{-- Contenu des pages --}}
                        <div class="bg-amber-50 flex flex-col items-center w-full lg:w-10/12">
                            @yield('content')
                        </div>
                    @endif
                </div>
        </div>
    </div>
        <div class="bg-four w-full flex-wrap text-white flex justify-evenly content-center items-center h-auto">
            @include('partials.footer')                            
        </div>
      @livewireScripts
      @yield('extra-js')
    </body>
</html>
