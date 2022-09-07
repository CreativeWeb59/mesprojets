<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('extra-meta')
        @yield('extra-script')
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        {{-- icones --}}
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap" rel="stylesheet"> 
        <script src="https://kit.fontawesome.com/097058085d.js" crossorigin="anonymous"></script>
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
    <body class="flex flex-col items-center">
        <div class="w-full">
            <!--ecran 1-->
            <div class="flex flex-col h-full">
                <header class="bg-primary border-b border-four py-5">
                    <div class="w-full flex flex-wrap justify-center items-center content-center">
                            @guest
                            <div class="w-1/2 pl-8">
                                <img src="{{ asset('images/logofourneeantan.png')}}" alt="logo" class="w-24 h-24 inline">
                                Email : fourneeantan@site.fr | Tél : 03.20.20.20.20                                
                            </div>
                                <div class="w-1/2 px-4 text-right">
                                @include('partials.navlog')
                            </div>
                                @else
                                @if (auth()->user()->role_id==2)
                                    <div class="w-1/3 pl-8">
                                        <img src="{{ asset('images/logofourneeantan.png')}}" alt="logo" class="w-24 h-24 inline">
                                        Email : fourneeantan@site.fr | Tél : 03.20.20.20.20
                                    </div>
                                    <div class="w-1/3 text-center"><a class="text-3xl text-secondary" href="/dashboard">Administration</a></div>
                                    <div class="w-1/3 px-4 text-right">
                                        @include('partials.navlog')
                                    </div>
                                @else
                                    <div class="w-1/2 pl-8">
                                        <img src="{{ asset('images/logofourneeantan.png')}}" alt="logo" class="w-24 h-24 inline">
                                            Email : fourneeantan@site.fr | Tél : 03.20.20.20.20 
                                    </div>
                                    <div class="w-1/2 px-4 text-right">
                                        @include('partials.navlog')
                                    </div>
                                @endif
                            @endguest    
                    </div>
                <div class="w-full">
                    @include('partials.navbar')
                </div>
                </header>
                <div class="flex h-screen bg-amber-50">
                    <div class="bg-amber-50 flex flex-col items-center w-2/12 border-r border-four py-5">
                        @include('partials.navcoteUser')                            
                    </div>
                    {{-- Contenu des pages --}}
                    <div class="bg-amber-50 flex flex-col items-center w-10/12">
                        @yield('content')
                    </div>
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
