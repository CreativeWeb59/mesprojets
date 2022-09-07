{{-- Partie lg --}}

<div class="hidden text-white justify-center content-center items-center lg:flex lg:flex-row flex-col">
  <div class="w-1/4 h-24 pl-4 flex flex-row justify-evenly content-center items-center">
    <img src="{{ asset('images/FourneeAntanlogo3.png')}}" alt="logo" class="w-24 h-24">
    <div class="w-max text-center">
    <h1 class="text-4xl">La Fournée d'Antan</h1>
    <h2 class="text-2xl">Boulangerie / Patisserie</h2>
    <h2>Téléphone : 03.20.20.20.20</h2>
  </div>
</div>
  <div class="flex flex-row items-center justify-end w-1/2">
    <nav class="w-max flex-grow pb-4 md:pb-0 hidden md:flex md:justify-center md:flex-row">
      <a class="mx-8 px-4 text-2xl text-white bg-transparent rounded-lg hover:bg-white hover:text-four focus:outline-none focus:shadow-outline" href="/">Accueil</a>
      <a class="mx-8 px-4 text-2xl text-white bg-transparent rounded-lg hover:bg-white hover:text-four" href={{ route ('HomeController.about')}}>La boulangerie</a>
      <a class="mx-8 px-4 text-2xl text-white bg-transparent rounded-lg hover:bg-white hover:text-four focus:outline-none focus:shadow-outline" href="{{ route ('products.index')}}">Nos produits</a>
      <a class="mx-8 px-4 text-2xl text-white bg-transparent rounded-lg hover:bg-white hover:text-four focus:outline-none focus:shadow-outline" href="{{ route ('ContactController.index')}}">Contact</a>
    </nav>
  </div>
  <div class="w-1/4 text-right flex justify-end items-center content-center pr-8">
    {{-- <livewire:search />
    <livewire:flash /> --}}

    {{-- Affichage du login/connexion --}}
    @guest
        @include('partials.navlog')
    @else
        @if (auth()->user()->role_id==2)
            <div class="w-1/3 text-center"><a class="text-secondary" href="/dashboard">Administration</a>
            </div>
            <div class="w-1/3 px-4 text-right">
                @include('partials.navlog')
            </div>
        @else
             @include('partials.navlog')

        @endif
    @endguest
<div class="relative">
    <a href="{{ route ('cart.index')}}" title="Mon panier">
      <svg class="h-8 w-8 pt-1 inline mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    @if (Cart::count()>0)
      <span class="text-white text-2xl absolute left-5 -top-6">{{ Cart::count() }}</span>
    @endif
  </a>
  <a href="{{ route('cart.empty') }}" title="Vider le panier" onclick="event.preventDefault();
    document.getElementById('panier-form').submit();">
    <svg class="h-8 w-8 pt-1 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
    </svg>
  </a>
  <form id="panier-form" action="{{ route('cart.empty') }}" method="POST" class="d-none">
      @csrf
  </form>
  </div>

</div>
</div>
{{-- Partie responsive --}}

<div class="w-full h-1/4 text-white flex justify-center content-center items-center lg:flex-row flex-col">
  <div class="w-full lg:hidden">
    <div x-data="{ open: false }" class="flex flex-col md:flex-row">
      <div class="flex flex-row ml-8 mb-4 w-1/4 md:w-full lg:hidden">
  
        {{-- <a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Fournée d'antan</a> --}}
        <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
          <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
            <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
        <nav :class="{'flex': open, 'hidden': !open}" class="w-max h-5/6 flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-center md:flex-row">
        <a class="mx-8 px-4 text-2xl leading-loose text-white bg-transparent rounded-lg hover:bg-white hover:text-four focus:outline-none focus:shadow-outline" href="/">Accueil</a>
        <a class="mx-8 px-4 text-2xl leading-loose text-white bg-transparent rounded-lg hover:bg-white hover:text-four" href="{{ route ('HomeController.about')}}">La boulangerie</a>
        <a class="mx-8 px-4 text-2xl leading-loose text-white bg-transparent rounded-lg hover:bg-white hover:text-four focus:outline-none focus:shadow-outline" href="{{ route ('products.index')}}">Nos produits</a>
        <a class="mx-8 px-4 text-2xl leading-loose text-white bg-transparent rounded-lg hover:bg-white hover:text-four focus:outline-none focus:shadow-outline" href="{{ route ('ContactController.index')}}">Contact</a>
        </nav>

    <div :class="{'flex': !open, 'hidden': open}" class="w-full lg:w-1/4 flex">
      <div class="w-1/4 h-24 hidden lg:block pl-4">
        <img src="{{ asset('images/FourneeAntanlogo3.png')}}" alt="logo" class="w-24 h-24">
      </div>
      <div class="w-max text-center pl-8 mb-8 lg:mb-0">
        <h1 class="text-4xl">La Fournée d'Antan</h1>
        <h2 class="text-2xl">Boulangerie / Patisserie</h2>
        <h2>Téléphone : 03.20.20.20.20</h2>
      </div>
    </div>

    <div :class="{'flex': !open, 'hidden': open}" class="w-full lg:w-1/4 text-right flex justify-end items-center content-center pr-8">
      {{-- <livewire:search />
      <livewire:flash /> --}}

      {{-- Affichage du login/connexion --}}
      @guest
          @include('partials.navlog')
      @else
          @if (auth()->user()->role_id==2)
              <div class="w-1/3 text-center"><a class="text-secondary" href="/dashboard">Administration</a>
              </div>
              <div class="w-1/3 px-4 text-right">
                  @include('partials.navlog')
              </div>
          @else
               @include('partials.navlog')

          @endif
      @endguest
<div class="relative">
      <a href="{{ route ('cart.index')}}" title="Mon panier">
        <svg class="h-8 w-8 pt-1 inline mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
      @if (Cart::count()>0)
        <span class="text-white text-2xl absolute left-5 -top-6">{{ Cart::count() }}</span>
      @endif
    </a>
    <a href="{{ route('cart.empty') }}" title="Vider le panier" onclick="event.preventDefault();
    document.getElementById('panier-form').submit();">
    <svg class="h-8 w-8 pt-1 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
    </svg>
  </a>
  <form id="panier-form" action="{{ route('cart.empty') }}" method="POST" class="d-none">
      @csrf
  </form>
    </div>

  </div>
</div>

  </div>
</div>
