    <div class="px-3 py-5 mb-3 shadow-sm hover:shadow-md rounded border-2 border-four w-1/4 m-4 bg-white flex flex-col justify-center items-center content-center">
        <div class="flex justify-between">
            <div class="h2">{{ $product->title}}</div>
            <button class="h-5 w-5 text-gray-600 focus:outline-none" wire:click="addLike">
                <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $product->isLiked() ? 'white' :'red'}}" viewBox="0 0 24 24" stroke="red">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </button>
        </div>
        <img src="{{ asset('images/'.$product->image)}}" alt="image du produit" class="w-auto h-36 inline">
        <div class="alltexts">{{ $product->subtitle}}</div>
        <div class="flex items-center">
            <span class="h-2 w-2 bg-four rounded-full mr-1 mt-1"></span>
            <a href="{{ route('products.show',$product->id) }}">Consulter le produit</a>
        </div>
        <span class="text-sm text-gray-600">{{ number_format($product->sale_price,2,',','.')}} €</span>
    </div>

