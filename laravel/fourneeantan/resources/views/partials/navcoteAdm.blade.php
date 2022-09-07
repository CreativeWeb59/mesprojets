{{-- <div class="text-4xl text-secondary">Administration</div> --}}

<nav class="w-full mt-8 hidden lg:flex lg:content-center content-start items-baseline justify-center">
    <ul class="flex flex-col w-5/6">
        <li class="w-full my-4"><a class="btnAdmin" href="{{ route ('dashboard')}}">Accueil</a></li>
        <li class="w-full my-4"><a class="btnAdmin" href="{{ route ('ProductAdminController.index')}}">Produits</a></li>
        <li class="w-full my-4"><a class="btnAdmin" href="{{ route ('CategoryController.index')}}">Catégories</a></li>
        <li class="w-full my-4"><a class="btnAdmin" href="{{ route ('TvaController.index')}}">Tva</a></li>
        <li class="w-full my-4"><a class="btnAdmin" href="/admUsers">Clients</a></li>
        <li class="w-full my-4"><a class="btnAdmin" href="{{ route ('admOrders.indexAdmin')}}">Commandes</a></li>
        <li class="w-full my-4"><a class="btnAdmin" href="{{ route ('admStats.index')}}">Statistiques</a></li>
        {{-- <li class="w-full my-4"><a class="btnAdmin" href="/admAdmin">Administration</a></li> --}}
    </ul>
</nav>

<div x-data="{ open: false }" class="flex flex-col md:flex-row lg:hidden">
      <div class="flex flex-row ml-8 mb-4 w-1/4 md:w-full">
  
        {{-- <a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white  focus:outline-none focus:shadow-outline">Fournée d'antan</a> --}}
        <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
          <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6 text-white ">
            <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
        <nav :class="{'flex': open, 'hidden': !open}" class="w-full h-screen flex-col flex-grow pb-4 hidden md:flex justify-start content-center">
        <a class="text-2xl my-4 text-white  bg-transparent rounded-lg" href="{{ route ('dashboard')}}">Accueil</a>
        <a class="text-2xl my-4 text-white  bg-transparent rounded-lg" href="{{ route ('ProductAdminController.index')}}">Produits</a>
        <a class="text-2xl my-4 text-white  bg-transparent rounded-lg" href="{{ route ('CategoryController.index')}}">Catégories</a>
        <a class="text-2xl my-4 text-white  bg-transparent rounded-lg" href="{{ route ('TvaController.index')}}">Tva</a>
        <a class="text-2xl my-4 text-white  bg-transparent rounded-lg" href="/admUsers">Clients</a>
        <a class="text-2xl my-4 text-white  bg-transparent rounded-lg" href="{{ route ('admOrders.indexAdmin')}}">Commandes</a>
        <a class="text-2xl my-4 text-white  bg-transparent rounded-lg" href="{{ route ('admStats.index')}}">Statistiques</a>    
        {{-- <a class="text-2xl my-4 text-white  bg-transparent rounded-lg" href="/admAdmin">Administration</a>     --}}
    </nav>
</div>
