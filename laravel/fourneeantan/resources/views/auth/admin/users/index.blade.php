@extends('layouts.appAdmin')
@section('content')
    <h1 class="h1">Liste des clients</h1>

    @if (session()->has('message'))
    <div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 rounded">
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
    </div>
    @endif
    <div id="categorie" class="bg-white mt-4 border">
        @if ($users->count())
            {{-- <div class="w-full flex text-center flex-row bg-secondary text-four"> --}}
            <div class="w-full hidden lg:flex text-center flex-row bg-gray-800 text-white justify-center">
                <div class="w-72 m-1 p-2">Nom </div>
                <div class="w-72 m-1 p-2">Email</div>
                <div class="w-36 m-1 p-2">Téléphone</div>
                <div class="w-20 m-1 p-2">C. P.</div>
                <div class="w-48 m-1 p-2">Ville</div>
                <div class="w-10 m-1 p-2"></div>
                <div class="w-10 m-1 p-2"></div>
            </div>
                @foreach ($users as $user)
                <div class="w-full flex my-4 text-center flex-row flex-wrap justify-center content-center items-center">
                    <form id="form-maj-{{ $user->id }}" action="{{ route('TvaController.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input class="w-60 lg:w-72 h-8 m-1 border border-gray-600 rounded p-2 text-black" value="{{ $user->name }}" name="name">
                        <input class="w-60 lg:w-72 h-8 m-1 border border-gray-600 rounded p-2 text-black" value="{{ $user->email }}" name="email">
                        <input class="w-60 lg:w-36 h-8 m-1 border border-gray-600 rounded p-2 text-black" value="{{ $user->phone }}" name="phone">
                        <input class="w-60 lg:w-20 h-8 m-1 border border-gray-600 rounded p-2 text-black" value="{{ $user->code }}" name="code">
                        <input class="w-60 lg:w-48 h-8 m-1 border border-gray-600 rounded p-2 text-black" value="{{ $user->city }}" name="city">
                    </form>
                      {{-- Maj de la tva root --}}
                      <div class="hidden lg:inline">
                        <button class="btnCAdmin w-10 mx-1" onclick="event.preventDefault();
                      document.getElementById('form-maj-{{ $user->id }}').submit();" title="Modifier le client"><svg class="w-4 h-4 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg></button>
                    </div>
                    <button type="submit" class="inline btnCAdmin w-28 lg:hidden m-1" title="Supprimer la Tva">Modifer</button>
                        {{-- Suppression de la tva --}}
                    <form id="form-suprr-{{ $user->id }}" action="{{ route('TvaController.destroy', $user->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                    </form>
                    <div class="hidden lg:inline">
                        <button class="btnCAdmin w-10 mx-1" onclick="event.preventDefault();
                    document.getElementById('form-suprr-{{ $user->id }}').submit();" title="Supprimer le client"><svg class="w-4 h-4 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg></button>
                </div>
                <button type="submit" class="inline btnCAdmin w-28 lg:hidden m-1" title="Supprimer la Tva">Supprimer</button>
                </div>
        @endforeach
        @else
            <h3>Il n'y a aucun client dans la base.</h3>
        @endif
        </div>
@endsection