@extends('layouts.app')

@section('content')
        <h2 class="h2 my-8">Nous contacter</h2>
        
<div class="w-full lg:w-2/3 h-full lg:h-4/6 flex justify-center items-center flex-col lg:flex-row">
  <div class="w-4/5 lg:w-1/2 border shadow lg:m-16 p-4">
    <form id="form-create" action="{{ route('ContactController.store') }}" method="POST" class="flex flex-col">
      @csrf
      @method('POST')
      <label class="font-semibold text-gray-700 ml-2" for="nom">Votre nom : </label>
      <input type="text" class="shadow border rounded my-2 h-10" name="nom" id="nom" value="{{ old('nom') }}">
      {!! $errors->first('nom','<p class="text-red-700 text-lg">:message</p>') !!}


      
      <label class="font-semibold text-gray-700 ml-2" for="telephone">Numéro de téléphone :</label>
      <input type="text" class="shadow border rounded my-2 h-10" name="telephone" id="telephone" value="{{ old('telephone') }}">
      {!! $errors->first('telephone','<p class="text-red-700 text-lg">:message</p>') !!}

      <label class="font-semibold text-gray-700 ml-2" for="email">Adresse email :</label>
      <input type="email" class="shadow border rounded my-2 h-10" name="email" id="email">
      {!! $errors->first('email','<p class="text-red-700 text-lg">:message</p>') !!}

      <label class="font-semibold text-gray-700 ml-2 h-10" for="description">Votre message :</label>
      <textarea class="shadow border rounded w-full h-32 px-4 textarea" name="description" id="description" rows="10" cols="50"></textarea>
      {!! $errors->first('description','<p class="text-red-700 text-lg">:message</p>') !!} 
      <button type="submit" class="btn w-auto px-4 py-2 mt-3 inline" title="Envoyer le message">Envoyer</button>
      
    </form>
  </div>
  <div class="w-1/2 h-4/6 flex m-16">
    <iframe class="w-full h-full border shadow" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20323.789566767064!2d3.2656899091523472!3d50.450903186417094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c2c34fb4a0dd8f%3A0x53ab32e31accdf62!2s59310%20Beuvry-la-For%C3%AAt!5e0!3m2!1sfr!2sfr!4v1621592013915!5m2!1sfr!2sfr" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>
</div>
@endsection
