<div class="my-4 flex flex-wrap w-full">
@if ($categories->count())
{{-- boucle seule pour les catégories parentes --}}
        <form class="px-1" id="formCxCategory" action="{{ route('products.showByCategory') }}" method="POST">
        @csrf
        <label class="font-semibold text-gray-700 mb-2 p-2" for="category_id">Catégorie :</label>
        <select name="category_id" id="category_id" class="w-56 text-center shadow border" onchange="this.form.submit()">";>
        {{-- Liste des Catégories --}}
        @if (isset($category_id))
            @if ($category_id == -1)
                <option value="-1" selected>Toutes les catégories</option>
                @foreach($categories as $category)
                    <option value="{{ $category -> id}}">{{ $category -> name}}</option>
                    @foreach($category->children as $cats)
                        <option value="{{ $cats->id.'-'.$cats -> parent_id}}">{{ $category -> name}} -> {{ $cats -> name}}</option>
                    @endforeach
                @endforeach
            @else
                <option value="-1">Toutes les catégories</option>
                @foreach($categories as $category)
                    @if ($category_id == $category->id)    
                        <option value="{{ $category -> id}}" selected>{{ $category -> name}}</option>
                    @else
                        <option value="{{ $category -> id}}">{{ $category -> name}}</option>
                    @endif
                        @foreach($category->children as $cats)
                            @if ($category_id == $cats->id)
                                <option value="{{ $cats->id.'-'.$cats -> parent_id}}" selected>{{ $category -> name}} -> {{ $cats -> name}}</option>
                            @else
                                <option value="{{ $cats->id.'-'.$cats -> parent_id}}">{{ $category -> name}} -> {{ $cats -> name}}</option>
                            @endif
                        @endforeach
                @endforeach
            @endif
        @else
            <option value="-1" selected>Toutes les catégories</option>

                @foreach($categories as $category)
                        <option value="{{ $category -> id}}">{{ $category -> name}}</option>
                    @foreach($category->children as $cats)
                        <option value="{{ $cats->id.'-'.$cats -> parent_id}}">{{ $category -> name}} -> {{ $cats -> name}}</option>
                @endforeach
            @endforeach
        @endif
        </select>
        </form>
@else
    Désolé, il n'existe pas de catégories
@endif
</div>