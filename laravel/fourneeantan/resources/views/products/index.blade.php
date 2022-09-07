@extends('layouts.app')

@section('content')
    <div class="w-full text-left pt-1 pl-8 hidden lg:inline">
            @include('partials.filariane')
    </div>

    {{-- select avec toutes les categories de produits --}}
<div class="w-full text-left pt-1 pl-8 mb-8 lg:hidden">
    @include('partials.selectCat')
</div>


<h2 class="text-2xl lg:text-4xl mt-1 inline-block">{{ $filAriane['titlePage'] }}</h2>

    <div class="w-full lg:w-5/6 h-full flex flex-wrap justify-center content-start items-center">
        @if ($products->count())
            @foreach($products as $product)
            <a href="{{ route('products.show',$product->id) }}" class="w-full lg:w-1/4 h-72 m-8 p-4 inline-block">
                <div class="bg-white w-full h-72 border border-third shadow-sm rounded flex flex-col justify-center content-start items-center hover:shadow-2xl">
                    <div>
                        <img src="{{ asset('storage/'.$product->image)}}" alt="image du produit" class="w-auto h-36 inline hover:shadow-2xl">
                    </div>
                    <div class="text-2xl mt-2 p-1">{{$product->title}}</div>
                    <div class="text-xl p-1">{{$product->subtitle}}</div>
                    <div class="text-2xl text-red-700 p-1">{{number_format($product->price,2,',','.')}} €</div>
                </div>
            </a>
            @endforeach
        @else
        <div class="m-8">
            Désolé il n'y a pas de produits
        </div>    
        @endif
    </div>

@endsection

{{-- A voir --}}
{{-- Les 6 derniers produits --}}
{{-- produits mis en avant--}}
{{-- promotions --}}
{{-- produits les plus vendus--}}


{{-- Descritpion courte => subtitle --}}
