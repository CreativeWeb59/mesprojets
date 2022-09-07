@extends('layouts.appAdmin')
@section('content')
    <h1 class="h1">Liste des tva</h1>
    @if (session()->has('message'))
    <div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 rounded">
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
    </div>
    @endif
    <div id="categorie" class="w-11/12 lg:w-1/2 bg-white mt-8 border">
        @if ($tvas->count())
            <div class="w-full hidden lg:flex text-center flex-row bg-gray-800 text-white justify-center">
                <div class="w-80 m-1 p-2">Nom de la Tva</div>
                <div class="w-60 m-1 p-2">Taux en pourcentage</div>
                <div class="w-20 mx-2 p-2"></div>
            </div>
                @foreach ($tvas as $tva)
                <div class="w-full flex my-4 text-center flex-row flex-wrap justify-center content-center items-center">
                    <form id="form-maj-{{ $tva->id }}" action="{{ route('TvaController.update', $tva->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label class="font-semibold text-gray-700 p-2 lg:hidden" for="description">Nom :</label>
                        <input class="w-60 lg:w-80 h-8 m-1 border border-gray-600 rounded p-2 text-black" value="{{ $tva->name }}" name="name">
                        <label class="font-semibold text-gray-700 p-2 lg:hidden" for="description">Taux :</label>
                        <input class="w-60 lg:w-60 h-8 m-1 border border-gray-600 rounded p-2 text-black" value="{{ $tva->value }}" name="value">
                    </form>
                      {{-- Maj de la tva root --}}
                      <div class="hidden lg:inline">
                        <button class="btnCAdmin w-10 mx-1" onclick="event.preventDefault();
                      document.getElementById('form-maj-{{ $tva->id }}').submit();" title="Modifier la tva">
                            <svg class="w-4 h-4 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                    </div>
                        <button type="submit" class="inline btnCAdmin w-28 lg:hidden m-1" title="Mettre à jour la Tva">Mettre à jour</button>

                        {{-- Suppression de la tva --}}
                    <form id="form-suprr-{{ $tva->id }}" action="{{ route('TvaController.destroy', $tva->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                    </form>
                    <div class="hidden lg:inline">
                    <button class="btnCAdmin w-10 mx-1" onclick="event.preventDefault();
                    document.getElementById('form-suprr-{{ $tva->id }}').submit();" title="Supprimer la tva"><svg class="w-4 h-4 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
                    </div>
                <button type="submit" class="inline btnCAdmin w-28 lg:hidden m-1" title="Supprimer la Tva">Supprimer</button>
                </div>
        @endforeach
        @else
            <h3>Il n'y a aucune Tva dans la base.</h3>
        @endif
        </div>
        <div class="w-11/12 lg:w-1/2 m-10 text-center">
            <h2>Ajouter une Tva :</h2>
            <form id="form-create"  action="{{ route('TvaController.create') }}" method="POST"  class="w-full flex flex-wrap content-center items-center justify-center">
                @csrf
                @method('PUT')
                <input class="w-48 lg:w-80 h-8 m-1 border border-gray-600 rounded p-2 text-four" value="" name="name" placeholder="Description">
                @error('name') <span class="error">{{ $message }}</span> @enderror
                <input class="w-48 lg:w-20 h-8 m-1 border border-gray-600 rounded p-2 text-four"  value="" name="valeur" placeholder="Taux">
                @error('valeur') <span class="error">{{ $message }}</span> @enderror
                <button type="submit" class="btnCAdmin w-60 m-4 lg:m-0" title="Ajouter une tva">Ajouter une tva</button>
                </form>
</div>
@endsection