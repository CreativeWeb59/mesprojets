@extends('layouts.app')

@section('content')
<h1 class="text-3xl text-black mb-6 text-center mt-8">Completez vos informations</h1>
<form method="POST" action="{{ route('register') }}" class="form">
    @csrf
    <div class="mb-4">
        <label for="name" class="label">Nom d'utilisateur</label>
        <input id="name" type="text" name="name" class="input" value="{{ old('name') }}" autocomplete="name" placeholder="Nom d'utilisateur" autofocus>
       @error('name')
              <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
    </div>
    
    <div class="mb-4">
        <label for="email" class="label">Email</label>
        <input id="email" type="email" name="email" class="input" value="{{ old('email') }}" autocomplete="email" placeholder="Votre email" autofocus>
        @error('email')
            <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4">
        <label for="phone" class="label">Nunero de téléphone</label>
        <input id="phone" type="text" name="phone" class="input" value="{{ old('phone') }}" autocomplete="name" placeholder="Nom de téléphone" autofocus>
       @error('phone')
              <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4">
        <label for="code" class="label">Code postal</label>
        <input id="code" type="text" name="code" class="input" value="{{ old('code') }}" autocomplete="code" placeholder="Code postal" autofocus>
       @error('code')
              <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4">
        <label for="city" class="label">Ville</label>
        <input id="city" type="text" name="city" class="input" value="{{ old('city') }}" autocomplete="city" placeholder="Ville" autofocus>
       @error('city')
              <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="label">Mot de passe</label>
        <input id="password" type="password" name="password" class="input" value="{{ old('password') }}" autocomplete="password" placeholder="Votre mot de passe" autofocus>
        @error('password')
            <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="label">Confirmation du mot de passe</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="shadow border rounded w-full p-2" value="{{ old('password_confirmation') }}" autocomplete="password_confirmation" placeholder="Retapez votre mot de passe" autofocus>
    </div>



    <button type="submit" class="btn w-full">Créer mon compte</button>
</form>
<div class="h-32">

</div>
@endsection