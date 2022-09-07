@extends('layouts.app')
@section('content')
    <h1 class="text-3xl text-green-500 mb-3">{{ $product->title}}</h1>

        <div class="px-3 py-5 mb-3 shadow-sm hover:shadow-md rounded border-2 border-gray-300">
            <h2 class="text-xl font-bold text-green-800">{{ $product->title}}</h2>
            <p class="text-md text-gray-800">{{ $product->description}}</p>
            <div class="flex items-center">
                <span class="h-2 w-2 bg-green-300 rounded-full mr-1 mt-1"></span>
            </div>
            <span class="text-sm text-gray-600">{{ number_format($product->sale_price,2,',','.')}} €</span>

        </div>
@endsection