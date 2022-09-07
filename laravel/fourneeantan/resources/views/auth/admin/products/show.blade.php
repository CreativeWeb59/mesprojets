@extends('layouts.appAdmin')
@section('content')

    @if (session()->has('message'))
    <div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 rounded">
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
    </div>
    @endif
{{-- A mettre les categories en interractif --}}
    <div class="text-3xl text-four mb-8">
        <h1 class="h1 inline">
        {{ $product->title}}
        </h1>
        {{-- Suprrimer l'article --}}
        <form class="inline-block" id="form-supr-{{ $product->id }}" action="{{ route('ProductAdminController.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" value="{{ $product->status }}" name="status">
        </form>
        <button class="w-12 h-10 mx-2 mb-5" onclick="event.preventDefault();
        return confirm('Vous êtes sur le point de supprimer une poule. Souhaitez-vous continuer ?');
        document.getElementById('form-supr-{{ $product->id }}').submit();" title="Supprimer le produit">
        <svg class="w-8 h-8 text-red-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </button>    
    </div>

    <div class="w-11/12 lg:w-2/3 px-1 lg:px-3 py-5 h-auto shadow-sm hover:shadow-md rounded border-2 border-gray-300">
            <div class="flex w-full justify-center content-center flex-wrap">
                <div class="w-full lg:w-2/5 lg:h-full order-2 lg:order-1 text-center">
                    <img src="{{ asset('storage/'.$product->image)}}" alt="image du produit" class="w-auto h-28 lg:h-48 inline">
                     {{-- Maj de l'image --}}
                    <form id="form-maj-image-{{ $product->id }}" class="inline-block" action="{{ route('ProductAdminController.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="file" class="w-72 lg:w-auto shadow border rounded block mt-8" name="image" id="image">
                    </form>
                      <button class="w-8 h-10 mx-0 lg:mx-2 mb-5" onclick="event.preventDefault();
                      document.getElementById('form-maj-image-{{ $product->id }}').submit();" title="Modifier le nom"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg></button>             
                </div>
                <div class="w-full lg:w-3/5 h-full flex flex-wrap order-1 lg:order-2">
                    {{-- Nom article --}}
                    <form class="px-1 lg:px-6" id="form-maj-title-{{ $product->id }}" action="{{ route('ProductAdminController.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label for="title" class="text-sm lg:text-xl">Titre :&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                        <input type="text" class="shadow border rounded w-52 lg:w-96 text-center h-8 my-2 lg:m-2 text-sm lg:text-xl font-bold" value="{{ $product->title }}" 
                        name="title">
                    </form>
                      {{-- Maj du nom article --}}
                      <button class="w-6 h-8 my-2 lg:m-2" onclick="event.preventDefault();
                      document.getElementById('form-maj-title-{{ $product->id }}').submit();" title="Modifier le nom"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" 
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg></button>

                    {{-- Nom titre cours --}}
                    <form class="px-1 lg:px-6" id="form-maj-subtitle-{{ $product->id }}" action="{{ route('ProductAdminController.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label for="title" class="text-sm lg:text-xl">Titre cours :&nbsp; &nbsp;</label>
                        <input type="text" class="shadow border rounded w-52 lg:w-96 text-center h-8 my-2 lg:m-2" value="{{ $product->subtitle }}" name="subtitle">
                    </form>
                      {{-- Maj du nom titre cours --}}
                      <button class="w-6 h-8 my-2 lg:m-2" onclick="event.preventDefault();
                      document.getElementById('form-maj-subtitle-{{ $product->id }}').submit();" title="Modifier la description courte"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg></button>

                        {{-- Affichage du select Catégories --}}
                        <form class="px-1 lg:px-6" id="form-maj-category-{{ $product->id }}" action="{{ route('ProductAdminController.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label for="category_id" class="text-sm lg:text-xl">Catégorie :&nbsp; &nbsp; &nbsp;</label>
                        <select name="category_id" id="category_id" class="shadow border rounded w-52 lg:w-96 text-center my-2 lg:m-2 h-8">
                        @if ($categories->count())
                        {{-- boucle seule pour les produits --}}
                        @foreach($categories as $category)
                            @foreach($category->children as $cats)
                                <option value="{{ $cats -> id}}"   
                            @if ($product -> category_id == $cats -> id)
                            selected
                            @endif
                            >{{ $category -> name}} -> {{ $cats -> name}} </option>
                            @endforeach
                        @endforeach
                        @else
                            Problème de catégorie
                        @endif
                        </select>
                    </form>
                    {{-- Maj du nom titre cours --}}
                    <button class="w-6 h-8 my-2 lg:m-2" onclick="event.preventDefault();
                    document.getElementById('form-maj-category-{{ $product->id }}').submit();" title="Modifier la catégorie"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    </button>

            {{-- Affichage du select Tva --}}
            <form class="px-1 lg:px-6" id="form-maj-tva-{{ $product->id }}" action="{{ route('ProductAdminController.update', $product->id) }}" method="POST">
                @csrf
                @method('PATCH')
            <label for="tva_id" class="text-sm lg:text-xl">Tva :&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
            <select name="tva_id" id="tva_id" class="shadow border rounded w-52 lg:w-96 text-center h-8 my-2 lg:m-2">
                {{-- Liste des tvas --}}
                @if ($tvas->count())
                    {{-- boucle seule pour les produits --}}
                @foreach($tvas as $tva)
                <option value="{{ $tva -> id}}"   
                    @if ($product -> tva_id == $tva -> id)
                        selected
                    @endif
                    >{{ $tva -> name}} - {{ $tva -> value}}</option>    
                @endforeach
                @else
                    Problème de tva
                @endif
                </select>
                <input type="hidden" name="price" value={{ $product -> price }}>
            </form>
            <button class="w-6 h-8 my-2 lg:m-2" onclick="event.preventDefault();
            document.getElementById('form-maj-tva-{{ $product->id }}').submit();" title="Modifier la tva"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
            </button>

                    {{-- Statut article --}}
                    <form class="px-1 lg:px-6" id="form-maj-statut-{{ $product->id }}" action="{{ route('ProductAdminController.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label for="status" class="text-sm lg:text-xl">Etat :&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                        <span class="hidden lg:inline"> &nbsp;</span>
                        <select name="status" id="status" class="shadow border rounded w-52 lg:w-96 text-center h-8 my-2 lg:m-2">
                            {{-- Liste des status --}}
                            {{-- Option 1 => actif --}}
                            <option value="1"   
                                @if ($product -> status == 1)
                                    selected
                                @endif
                                >Actif
                            </option>
                            {{-- Option 2 => Non actif --}}
                            <option value="0"   
                                @if ($product -> status == 0)
                                    selected
                                @endif
                                >Non actif
                            </option>
                            </select>
                    </form>
                      {{-- Statut article --}}
                      <button class="w-6 h-8 my-2 lg:m-2" onclick="event.preventDefault();
                      document.getElementById('form-maj-statut-{{ $product->id }}').submit();" title="Modifier le statut"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg></button>
                    {{-- Prix article HT--}}
                    <div class="px-1 lg:px-6 flex justify-start content-center items-center">
                        <span class="text-sm lg:text-xl">Prix en € HT : &nbsp;</span>
                        <div class="shadow border rounded w-52 lg:w-96 text-center h-8 my-2 lg:m-2">{{ $product->priceHT }}</div>
                    </div>
                    {{-- Prix article TTC--}}
                    <form class="px-1 lg:px-6" id="form-maj-price-{{ $product->id }}" action="{{ route('ProductAdminController.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label for="price" class="text-sm lg:text-xl">Prix en € TTC :</label>
                        <input type="texte" class="shadow border rounded w-48 lg:w-96 text-center h-8 m-2" value="{{ $product->price }}" name="price">
                        <input type="hidden" name="valueTva" value={{ $product -> tva -> value }}>
                    </form>
                      <button class="w-6 h-8 my-2 lg:m-2" onclick="event.preventDefault();
                      document.getElementById('form-maj-price-{{ $product->id }}').submit();" title="Modifier le nom"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg></button>
                </div>
            </div>
            <div class="w-full h-40">
                {{-- Description --}}
                    <form id="form-maj-description-{{ $product->id }}" action="{{ route('ProductAdminController.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                        <label for="description" class="text-sm lg:text-xl">Description :&nbsp; &nbsp;</label>
                    <button class="w-6 h-8 my-2 lg:m-2" onclick="event.preventDefault();
                        document.getElementById('form-maj-description-{{ $product->id }}').submit();" title="Modifier la description"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                        <textarea name="description" id="description" cols="90" rows="30" class="shadow border rounded w-full h-32 px-4 textarea">{{ $product->description }}</textarea>
                     </form>
            </div>
        </div>

        <div class="m-8">
            <h3>Marche à suivre :</h3>
            <p class="mt-4">
                - Chaque champ est indépendant, on modifie le texte, ensuite, il suffit de cliquer sur le crayon pour prendre en compte la modification
                dans la base.
            </p>
            <p class="mt-4">
                - Passer un produit en statut inactif permet de l'enlever de la liste des produits en boutique sans le supprimer.
            </p>
        </div>
        <div class="h-40">

        </div>
@endsection

