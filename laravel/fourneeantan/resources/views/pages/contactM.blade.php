@extends('layouts.app')

@section('content')
        <h2 class="text-4xl my-8 text-center">Merci de votre confiance,<br>vous recevrez une réponse très rapidement.</h2>

        <div class="mt-8">
           <a href="{{ route ('products.index')}}">Retours vers notre boutique</a>
        </div>
@endsection