@extends('layouts.apphome')

@section('content')
<div class="bg-white h-screen w-full">
  <div class="h-5/6 flex flex-col bg-page-accueil bg-cover">
    <div class="hidden lg:inline h-1/4 w-full"></div>
    <div class="h-1/2 flex mt-8 lg:mt-0">
      <div class="hidden lg:inline lg:w-1/2"></div>
      <div class="w-full text-center lg:w-1/2 lg:pr-64">
        <h1 class="text-6xl md:text-6xl lg:text-7xl text-white">La Fournée d'Antan</h1>
        <h2 class="text-3xl md:text-3xl lg:text-4xl text-white">Boulangerie / Patisserie</h2>
      </div>
    </div>
    <nav class="lg:hidden mt-4">
      <ul class="flex justify-between items-center content-center text-xl">
        <li class="w-24 text-center"><a href="{{ route ('HomeController.about')}}" class="link1">La boulangerie</a></li>
        <li class="w-24 text-center"><a href="{{ route ('products.index')}}" class="link1">Nos produits</a></li>
        <li class="w-24 text-center "><a href="{{ route ('home')}}" class="link1">Mon compte</a></li>
        <li class="w-24 text-center"><a href="{{ route ('ContactController.index')}}" class="link1">Contact</a></li>
      </ul>
    </nav>
  </div>
    <div class="hidden lg:block -mt-24">
      <svg viewBox="0 0 200 30" xmlns="http://www.w3.org/2000/svg" class="bg-transparent">
        <path d="M 0,0 L 200,10 V 200,30 L0,20 Z" style="fill:#712E1E; stroke:none"/>
      </svg>
    </div>
</div>

<nav class="-mt-64 mb-64 hidden lg:block">
  <ul class="flex justify-center items-center content-center">
    <div class="h-24 w-36 mx-24 flex justify-center items-center content-center">
    <li class="btnAccueil"><a href="{{ route ('HomeController.about')}}"><img src="{{asset('images/bread-oven.svg')}}" alt="image 1"></></li>
    </div>
    <div class="h-24 w-36 mx-24 flex justify-center items-center content-center">
      <li class="btnAccueil"><a href="{{ route ('products.index')}}"><img src="{{asset('images/wheat.svg')}}" alt="image 2"></a></li>
    </div>
    <div class="h-24 w-36 mx-24 flex justify-center items-center content-center">
      <li class="btnAccueil"><a href="{{ route ('home')}}"><img src="{{asset('images/user.svg')}}" alt="image 3"></a></li>
    </div>
    <div class="h-24 w-36 mx-24 flex justify-center items-center content-center">
      <li class="btnAccueil"><a href="{{ route ('ContactController.index')}}"><img src="{{asset('images/contact.svg')}}" alt="image 4"></a></li>
  </div>
  </ul>
</nav>

<nav class="-mt-64 mb-64 hidden lg:block">
  <ul class="flex justify-center items-center content-center text-xl">
    <li class="text-white h-24 w-36 mx-24 text-center"><a href="{{ route ('HomeController.about')}}" class="link1">La boulangerie</a></li>
    <li class="text-white h-24 w-36 mx-24 text-center"><a href="{{ route ('products.index')}}" class="link1">Nos produits</a></li>
    <li class="text-white h-24 w-36 mx-24 text-center "><a href="{{ route ('home')}}" class="link1">Mon compte</a></li>
    <li class="text-white h-24 w-36 mx-24 text-center"><a href="{{ route ('ContactController.index')}}" class="link1">Contact</a></li>
  </ul>
</nav>


<div class="h-auto w-full flex flex-wrap justify-center items-center content-center lg:my-20">
  <h2 class="h3 text-center w-full mb-4">La boulangerie</h2>
  <div class="w-full lg:w-1/3 p-8">
      <img src="{{asset('images/vitrine2.jpg')}}" alt="image 1">
  </div>
  <div class="w-full lg:w-1/3 text-center">
    <p class="text-justify p-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non eros vitae erat pulvinar vestibulum eget vel nisi. Integer venenatis neque orci. Duis finibus pulvinar lectus ut vestibulum. Integer lobortis, justo id lacinia sodales, arcu erat finibus augue, ut faucibus eros velit vel sem. Vestibulum eu volutpat purus. Vivamus vel nulla volutpat ligula aliquet tempus. Sed tempor leo sit amet tellus interdum suscipit. Donec id leo luctus, elementum lorem nec, egestas ligula. Ut eu venenatis tellus. Vestibulum eget sem ultrices, dictum tortor ut, pellentesque enim.
    </p>
    <p class="text-justify p-8">Nulla tincidunt, neque at venenatis congue, felis sapien bibendum dui, vel hendrerit nisl augue sit amet nunc. Vivamus nec justo quis risus fermentum efficitur. Praesent at lorem vitae turpis sollicitudin porta. Maecenas dignissim id justo et ornare. Quisque facilisis eleifend iaculis. Vivamus in vulputate elit, in venenatis sem. Praesent porttitor porta molestie.
    </p>
    <a href="{{ route ('HomeController.about')}}" class="btn mx-4 lg:mx-8">En savoir plus</a>
  </div>
</div>

<div class="w-full h-32 text-center my-32">
  <h2 class="h3 text-center w-full">Nos produits phares</h2>
  <h2>Carroussel avec 4 produits les plus vendus ou au choix dans l'admin</h2>
  <p>Texte cours avec bouton de renvoi vers la boulangerie</p>
</div>

<div class="h-auto w-full flex flex-wrap justify-center items-center content-center lg:my-20">
  <h2 class="h3 text-center w-full mb-4 order-1">Les produits</h2>
  <div class="w-full text-center order-3 lg:w-1/3  lg:order-2">
    <p class="text-justify p-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non eros vitae erat pulvinar vestibulum eget vel nisi. Integer venenatis neque orci. Duis finibus pulvinar lectus ut vestibulum. Integer lobortis, justo id lacinia sodales, arcu erat finibus augue, ut faucibus eros velit vel sem. Vestibulum eu volutpat purus. Vivamus vel nulla volutpat ligula aliquet tempus.
    </p>
    <p class="text-justify p-8">Integer lobortis, justo id lacinia sodales, arcu erat finibus augue, ut faucibus eros velit vel sem. Vestibulum eu volutpat purus. Vivamus vel nulla volutpat ligula aliquet tempus. Sed tempor leo sit amet tellus interdum suscipit. Donec id leo luctus, elementum lorem nec, egestas ligula. Ut eu venenatis tellus. Vestibulum eget sem ultrices, dictum tortor ut, pellentesque enim.
    </p>
    <a href="{{ route ('products.index')}}" class="btn mx-4 lg:mx-8 order-4">En savoir plus</a>
  </div>
  <div class="w-full order-2 p-8 lg:w-1/3 lg:order-3">
    <img src="{{asset('images/vitrine3.jpg')}}" alt="image 3">
</div>
</div>

{{-- espacement bas --}}
<div class="h-40">
</div>
@endsection
