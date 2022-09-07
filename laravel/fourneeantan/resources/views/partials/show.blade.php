@extends('layouts.app')
@section('content')
<div class="w-full text-left pt-1 pl-8 mb-8 hidden lg:inline">
    @include('partials.filariane')
    <svg class="h4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
         </svg>
        <span class="bg-white">{{ $product->title}}</span>
</div>
<h1 class="h1 hidden lg:inline">{{ $product->title}}</h1>

{{-- select avec toutes les categories de produits --}}
<div class="w-full text-left pt-1 pl-8 mb-8 lg:hidden">
    @include('partials.selectCat')
</div>

@if (session()->has('message'))
<div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 mt-4 rounded">
      <div class="alert alert-success">
          {{ session('message') }}
      </div>
</div>
@endif


<div class="bg-white w-4/5 lg:w-2/3 h-4/5 lg:h-1/2 mt-4 lg:mt-20 border border-third shadow-sm rounded flex flex-col hover:shadow-2xl">
    <div class="flex w-full h-1/2 lg:h-2/3 justify-center flex-wrap">
        <div class="w-full lg:hidden text-2xl mt-4 p-4 police text-center">{{$product->title}}</div>
        <div class="w-1/2 h-full flex justify-center p-2 mt-4">
            <img src="{{ asset('projet/storage/app/public/'.$product->image)}}" alt="image du produit" class="w-auto h-32 lg:h-52 hover:shadow-2xl">
        </div>
        <div class="w-1/2 h-full flex flex-col content-center items-center">
            <div class="hidden lg:inline lg:text-3xl m-8 police">{{$product->title}}</div>
            <div class="text-lg lg:text-xl m-4">{{$product->subtitle}}</div>
            <div class="text-2xl text-red-700 mt-4">{{number_format($product->price,2,',','.')}} €</div>
        </div>
    </div>
    <div class="w-full h-1/2 lg:h-1/3 text-xl">
        <div class="p-8">
            {{$product->description}}
            </div>
        <div class="w-full flex justify-center">
            <form action="{{route('cart.store')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id}}">
                <input type="hidden" name="title" value="{{ $product->title}}">
                <input type="hidden" name="price" value="{{ $product->price}}">

                {{-- <button type="submit" class="btn mx-4 lg:mx-8 order-4"> --}}
                <button type="submit" class="btn w-full lg:w-auto px-4 py-2 mt-3">Ajouter au panier 
                    <svg class="h-8 w-8 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection