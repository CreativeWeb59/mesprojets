@extends('layouts.appAdmin')
@section('content')
    <h1 class="h1">Liste des produits</h1>

    @if (session()->has('message'))
    <div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 rounded">
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
    </div>
    @endif

<div class="flex justify-center flex-col border shadow m-2 p-2 lg:m-8 lg:p-8 bg-white w-full lg:w-4/5 items-center">
    <a class="text-four hover:text-secondary text-xl" href="{{ route ('ProductAdminController.create')}}">Créer un produit</a>
    <div class="flex justify-start w-full">
     @if ($categories->count())
    {{-- boucle seule pour les catégories parentes --}}
        <div class="m-4 flex flex-wrap w-full">
            <form class="px-1 lg:px-8" id="formCxCategory" action="{{ route('ProductAdminController.showByCategory') }}" method="POST">
            @csrf
            <label class="font-semibold text-gray-700 mb-2 p-2" for="category_id">Catégorie :</label>
            <select name="category_id" id="category_id" class="w-44 lg:w-96 text-center shadow border my-4 lg:my-0" onchange="this.form.submit()">";>
            {{-- Liste des Catégories --}}
            @if (isset($category_id))
                @if ($category_id == -1)
                    <option value="-1" selected>Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category -> id}}">{{ $category -> name}}</option>
                        @foreach($category->children as $cats)
                            <option value="{{ $cats -> id}}">{{ $category -> name}} -> {{ $cats -> name}}</option>
                        @endforeach
                    @endforeach
                @else
                    <option value="-1">Toutes les catégories</option>
                    @foreach($categories as $category)
                        @if ($category_id == $category->id)    
                            <option value="{{ $category -> id}}" selected>{{ $category -> name}}</option>
                        @else
                            <option value="{{ $category -> id}}">{{ $category -> name}}</option>
                        @endif
                            @foreach($category->children as $cats)
                                @if ($category_id == $cats->id)
                                    <option value="{{ $cats -> id}}" selected>{{ $category -> name}} -> {{ $cats -> name}}</option>
                                @else
                                    <option value="{{ $cats -> id}}">{{ $category -> name}} -> {{ $cats -> name}}</option>
                                @endif
                            @endforeach
                    @endforeach
                @endif
            @else
                <option value="-1" selected>Toutes les catégories</option>

                    @foreach($categories as $category)
                            <option value="{{ $category -> id}}">{{ $category -> name}}</option>
                        @foreach($category->children as $cats)
                            <option value="{{ $cats -> id}}">{{ $category -> name}} -> {{ $cats -> name}}</option>
                    @endforeach
                @endforeach
            @endif
            </select>
            </form>
    @else
        Merci de créer au moins une catégorie et une sous-catégorie
    @endif

            {{-- Choix actifs --}}
            <form class="px-1 lg:px-8" id="formCxActif" action="{{ route('ProductAdminController.showByActivity') }}" method="POST">
            @csrf
            <label class="font-semibold text-gray-700 mb-2 p-2" for="category_id">Statut :</label>
            <select name="status" id="category_id" class="w-48 lg:w-96 text-center shadow border" onchange="this.form.submit();">
                @if (isset($status))
                    @switch($status)
                    @case(1)
                    <option value="-1">Statut</option>
                    <option value="1" selected>Actifs</option>
                    <option value="0">Non - Actifs</option>
                    @break

                    @case(0)
                    <option value="-1">Statut</option>
                    <option value="1">Actifs</option>
                    <option value="0" selected>Non - Actifs</option>
                    @break

                    @default
                    <option value="-1" selected>Statut</option>
                    <option value="1">Actifs</option>
                    <option value="0">Non - Actifs</option>
                    @endswitch
                @else
                    <option value="-1" selected>Statut</option>
                    <option value="1">Actifs</option>
                    <option value="0">Non - Actifs</option>
                @endif
            </select>
            </form>
        </div>
    </div>
<div class="w-full">
    {{-- Entete tableau --}}
    <div class="mt-4 w-1008 hidden lg:flex">
        <div class="w-96 text-xl text-center">Nom de l'article</div>
        <div class="w-96 text-xl text-center">Titre cours</div>
        <div class="w-20 text-xl text-center">Prix</div>
        <div class="w-20 text-xl text-center">Statut</div>
        <div class="w-20 text-xl text-center">Action</div>
    </div>

@if ($products->count())
{{-- boucle seule pour les produits --}}
    
    @foreach($products as $product)
    <div class="flex mt-4 ">
        <div class="w-96 text-sm lg:text-xl">{{ $product->title }}</div>
        <div class="w-96 hidden lg:inline-block text-xl">{{ $product->subtitle }}</div>
        <div class="w-28 pr-2 text-right text-sm lg:text-xl lg:w-20">{{ number_format($product->price, 2, ',', '.') }} €</div>
        <div class="w-20 pl-6">
                @if ($product->status == 1)
                    <svg class="w-5 h-5 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @else
                    <svg class="w-5 h-5 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
                @endif
        </div>
        <div class="w-10 pl-2">
            <a href="{{ route ('ProductAdminController.show',$product->id)}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                  </svg></a>
        </div>
        <div class="hidden lg:inline w-10 pl-2">
        {{-- Suppression de l'article --}}
            <form id="form-suprr-{{ $product->id }}" action="{{ route('ProductAdminController.destroy', $product->id) }}" method="POST"
                onsubmit="return confirm('Vous êtes sur le point de supprimer une produit. Souhaitez-vous continuer ?')">
            @csrf
            @method('DELETE')
            </form>
            {{-- @livewire('adm-products', ['idDelete' => $product->id]) --}}
        </div>
        </div>
        @endforeach

    @else
        <h3 class="m-4">Il n'y a aucun produit dans la base.</h3>
    @endif

</div>
<a class="text-four hover:text-secondary text-xl m-8" href="{{ route ('ProductAdminController.create')}}">Créer un produit</a>
</div>


@if (isset($status))
    variable status = {{$status}}
@endif

@endsection

