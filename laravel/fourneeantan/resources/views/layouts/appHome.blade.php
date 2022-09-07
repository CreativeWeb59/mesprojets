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
        <title>Fournée d'antan</title>
    </head>
    <body>
        <div class="bg-bg-amber-50 w-full">
            @yield('content')
        </div>
        <div class="bg-four w-full flex-wrap text-white flex justify-evenly content-center items-center h-auto">
            @include('partials.footer')                            
        </div>
    </body>
</html>
