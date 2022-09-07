@extends('layouts.appAdmin')
@section('content')
    <h1 class="h1 text-center">Liste des categories et sous catégories</h1>

    @if (session()->has('message'))
    <div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 rounded">
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
    </div>
    @endif
    <div id="categorie" class="bg-white mt-4 border w-11/12 lg:w-1/2 lg-auto">
      <form id="form-create" action="{{ route('CategoryController.create') }}" method="POST" class="w-full flex content-center items-center">
          @csrf
          @method('PUT')
          <input class="w-48 lg:w-80 h-8 m-1 border border-gray-600 rounded p-2 text-four" value="" name="name" placeholder="Nouvelle catégorie">
          <input type="hidden" name="parent" value=0>
          <div class="hidden lg:inline">
             <button type="submit" class="btnCAdmin w-60" title="Ajouter une catégorie">Ajouter une catégorie</button>
          </div>
          <div class="lg:hidden">
            <button type="submit" class="btnCAdmin w-10 mx-1" title="Ajouter une catégorie">
            <svg class="w-4 h-4 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg></button>
         </div>
          </form>
    </div>
    <div id="categorie" class="bg-white mt-4 border w-11/12 lg:w-1/2">
        @foreach($categories as $category)
        <div class="w-full flex m-1 lg:m-4 text-center">
          <form id="form-maj-{{ $category->id }}" action="{{ route('CategoryController.updateRoot', $category->id) }}" method="POST">
              @csrf
              @method('PATCH')
              <input class="btnCAdmin w-48 lg:w-80 h-8" value="{{ $category->name }}" name="name">
          </form>
            {{-- Maj de la categorie root --}}
            <button class="btnCAdmin w-10 mx-1" onclick="event.preventDefault();
            document.getElementById('form-maj-{{ $category->id }}').submit();" title="Modifier la catégorie"><svg class="w-4 h-4 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg></button>

              {{-- Suppression de la categorie root --}}
              <form id="form-suprr-{{ $category->id }}" action="{{ route('CategoryController.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
              </form>
              <button class="btnCAdmin w-10" onclick="event.preventDefault();
              document.getElementById('form-suprr-{{ $category->id }}').submit();" title="Supprimer la catégorie"><svg class="w-4 h-4 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg></button>

        </div>
        <div id="sousCategorie">
            @foreach($category->children as $cats)
            <div class="m-1 lg:m-4 flex">
                <div class="bg-white w-11 lg:w-60 text-center"></div>

                <form id="form-maj-sc-{{ $cats->id }}" action="{{ route('CategoryController.updateRoot', $cats->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <input class="btnCAdmin w-48 lg:w-64 h-8" value="{{ $cats->name }}" name="name">
              </form>
                
                {{-- Maj de la sous-categorie --}}
              <button class="btnCAdmin w-10 ml-1" onclick="event.preventDefault();
              document.getElementById('form-maj-sc-{{ $cats->id }}').submit();" title="Modifier la sous catégorie"><svg class="w-4 h-4 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                  </svg></button>
              {{-- Suppression de la sous categorie categorie --}}
              <form id="form-suprr-ss-{{ $cats->id }}" action="{{ route('CategoryController.destroy', $cats->id) }}" method="POST">
                @csrf
                @method('DELETE')
              </form>
                <button class="btnCAdmin w-10 ml-1" onclick="event.preventDefault();
                document.getElementById('form-suprr-ss-{{ $cats->id }}').submit();" title="Supprimer la sous catégorie"><svg class="w-4 h-4 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg></button>

                <hr />
                {{-- @foreach($cats->children as $cat)
                <h5>{{$cat->name}}</h5>
                @endforeach --}}
            </div>
            @endforeach
            {{-- input pour ajouter sous categorie --}}
            <div class="m1- lg:m-4 mb-4 flex content-center items-center">
              <div class="bg-white w-11 lg:w-60 text-center"></div>
              <form id="form-create-{{ $category->id }}" action="{{ route('CategoryController.create') }}" method="POST">
                  @csrf
                  @method('PUT')
                  <input class="w-48 lg:w-80 h-8 m-1 border border-gray-600 rounded p-2 text-four" value="" name="name" placeholder="Nouvelle sous-catégorie">
                  <input type="hidden" name="parent" value="{{$category->id }}">
                </form>
                  <button class="btnCAdmin w-10 ml-1" onclick="event.preventDefault();
                  document.getElementById('form-create-{{ $category->id }}').submit();" title="Ajouter une sous catégorie"><svg class="w-4 h-4 ml-3"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg></button>
            </div>
            
        </div>
    @endforeach
      <div class="w-11/12 lg:1/2 my-4 text-center">
        <form id="form-create" action="{{ route('CategoryController.create') }}" method="POST" class="w-full flex content-center items-center">
            @csrf
            @method('PUT')
            <input class="w-48 lg:w-80 h-8 m-1 border border-gray-600 rounded p-2 text-four" value="" name="name" placeholder="Nouvelle catégorie">
            <input type="hidden" name="parent" value=0>
            <div class="lg:hidden">
              <button type="submit" class="btnCAdmin w-10 mx-1" title="Ajouter une catégorie">
              <svg class="w-4 h-4 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg></button>
           </div>
        </form>
      </div>
    </div>
@endsection