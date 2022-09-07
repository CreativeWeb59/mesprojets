<div class="flex justify-center items-center content-center">
@guest
    <div class="mx-2">
        <a href="{{ route ('login')}}"><img src="{{asset('images/bonhom_blanc.png')}}" class="h-7" alt="image connexion" title="Se connecter"></a>
    </div>
    <div class="mx-2 relative">
        <a href="{{ route ('register')}}"><img src="{{asset('images/bonhom_blanc.png')}}" class="h-7" alt="image inscription" title="S'inscrire">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline text-white absolute left-2 top-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        </a>
    </div>    
@else
    {{-- <span class="pr-8">Bonjour {{ auth()->user()->name }}</span> --}}
    <a href="{{ route('home') }}" class="link1 mr-12" title="Mon compte">Bonjour {{ auth()->user()->name }}</a>    
    <a href="{{ route('logout') }}" class="link1" title="Se déconnecter" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();"><i class="fas fa-user-slash text-xl pt-2 mr-1"></i></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@endguest
</div>