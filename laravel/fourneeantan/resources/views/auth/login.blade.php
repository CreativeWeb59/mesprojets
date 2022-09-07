@extends('layouts.app')

@section('content')

<div class="h-16">
</div>
<h1 class="text-3xl text-black mb-6 text-center mb-8">Se connecter</h1>
<form method="POST" action="{{ route('login') }}" class="form">
    @csrf
    <div class="mb-4">
        <label for="email" class="label">Email</label>
        <input id="email" type="email" name="email" class="input" value="{{ old('email') }}" autocomplete="email" placeholder="Votre email" autofocus>
        @error('email')
            <span class="text-red-400 text-sm">
                <span>{{ $message }}</span>
            </span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="label">Mot de passe</label>
        <input id="password" type="password" name="password" class="input" value="{{ old('password') }}" autocomplete="password" placeholder="Votre mot de passe" autofocus>
       @error('password')
            <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn w-full">Se connecter</button>
</form>
{{-- espacement bas --}}
<div class="h-96">
</div>

@endsection