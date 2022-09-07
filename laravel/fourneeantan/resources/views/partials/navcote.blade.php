<div class="h2 mb-8">
    <a href="{{ route ('products.index')}}">
    Tous les produits</a>
</div>
{{-- Affichage du menu --}}
<div class="bg-white w-4/5">
    @if (isset($categories))
        @foreach($categories as $category)
        <div id="categorie" class="bg-white mt-4 border" x-data="{ isOpen: false }">
            <div class="flex">
                <div class="w-4/5 text-center text-xl bg-four text-white h-8 svgLink" @click=" isOpen = !isOpen">
                    {{ $category->name }}
                </div>
                <div class="w-1/5 text-center text-xl bg-four text-white h-8" x-show="isOpen">
                    <button @click=" isOpen = !isOpen">
                        <svg class="svgLink h-10 w-10 pl-4 pb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
                <div class="w-1/5 text-center text-xl bg-four text-white h-8" x-show="!isOpen">
                    <button @click=" isOpen = !isOpen">
                        <svg class="svgLink h-10 w-10 pl-4 pb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="sousCategorie" class="p-2" x-show="!isOpen">
                <div class="h-8 text-center">
                    <form class="px-8" id="formCxCategory" action="{{ route('products.showByCategory') }}" method="POST">
                        @csrf
                        --
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <input type="submit" class="bg-white cursor-pointer" value="{{ $category->name }}">
                        <input type="hidden" name="select" value="non">
                        --
                    </form>
                    <hr>
                </div> 
                @foreach($category->children as $cats)
                <div class="h-8">
                    <form class="px-8" id="formCxCategory" action="{{ route('products.showByCategory') }}" method="POST">
                        @csrf
                        <input type="hidden" name="category_id" value="{{$cats->id}}">
                        <input type="hidden" name="parent_id" value="{{$cats->parent_id}}">
                        <input type="submit" class="bg-white cursor-pointer" value="{{ $cats->name }}">
                    </form>
                        @if (!$loop->last)
                            <hr>
                        @endif
                </div>    
                @endforeach
            </div>
        </div>
        @endforeach
    @endif
</div>
