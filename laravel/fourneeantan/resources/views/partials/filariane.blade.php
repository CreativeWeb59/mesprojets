<a class="bg-white "href="{{ route ('products.index')}}">Accueil</a>
    <svg class="h4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
    @if ($filAriane['chemin0'] != 'none')
    <a class="bg-white "href="{{ route ('products.index')}}">{{$filAriane['chemin0']}}</a>
        @if ($filAriane['chemin1'] != 'none')
            <svg class="h4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
             </svg>
             <a class="bg-white "href="{{ route ('products.index')}}">{{$filAriane['chemin1']}}</a>
        @endif
    @endif
