@extends('layouts.app')
@section('content')
    <div class="h1">Nos produits</div>
    <div class="flex flex-wrap w-full justify-center items-center content-center">

        @foreach ($products as $product)
            <livewire:product :product="$product"/>
        @endforeach
        
    </div>
@endsection