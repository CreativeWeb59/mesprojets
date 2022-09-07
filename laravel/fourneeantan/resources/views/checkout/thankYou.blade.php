@extends('layouts.app')

@section('content')

@if (session()->has('message'))
  <div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 rounded">
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
  </div>
@endif


<h1 class="h1 m-8">Merci de votre commande</h1>

<div class="w-full lg:w-1/2 m-8 p-4 bg-white">
        <p class="lead"><strong>Votre commande a été traitée avec succès</strong></p>
        <hr>
        <p class="lead my-4">Vous rencontrez un problème? <a href="{{ route ('ContactController.index')}}">Nous contacter</a></p>
        <p class="lead text-center">
            <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}" role="button">Continuer vers la boutique</a>
        </p>
</div>           

@endsection



