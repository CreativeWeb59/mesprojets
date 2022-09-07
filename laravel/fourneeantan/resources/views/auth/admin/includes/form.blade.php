    <div class="w-full flex flex-wrap">
        <div class="w-full lg:w-1/2 h-56 flex flex-wrap p-4 items-center content-center">
            <label class="font-semibold text-gray-700 mb-2 p-2 inline w-1/3" for="title">Nom du produit :</label>
            <input type="text" class="shadow border rounded p-2 w-2/3 h-10" name="title" id="title">
            {!! $errors->first('title','<p class="text-red-700 text-lg">:message</p>') !!}
    
            <label class="font-semibold text-gray-700 mb-2 p-2 inline w-1/3" for="title">Titre secondaire :</label>
            <input type="text" class="shadow border rounded p-2 w-2/3 h-10" name="subtitle" id="subtitle">
            {!! $errors->first('subtitle','<p class="text-red-700 text-lg">:message</p>') !!}

            <label class="font-semibold text-gray-700 mb-2 p-2 inline w-1/3" for="price">Prix</label>
            <input type="text" class="shadow border rounded p-2 w-2/3 h-10" name="price" id="price">
            {!! $errors->first('price','<p class="text-red-700 text-lg">:message</p>') !!} 
        </div>

        {{-- Affichage du select Catégories --}}
        <div class="w-full lg:w-1/2 flex flex-col items-center p-4">
            <label class="font-semibold text-gray-700 mb-2 p-2 inline" for="category_id">Séléctionner la catégorie :</label>
            <select name="category_id" id="category_id" class="block w-3/4 text-center">
            {{-- Liste des tvas --}}
            @if ($categories->count())
                {{-- boucle seule pour les produits --}}
                @foreach($categories as $category)
                    @foreach($category->children as $cats)
                        <option value="{{ $cats -> id}}">{{ $category -> name}} -> {{ $cats -> name}}</option>
                    @endforeach
                @endforeach
            @else
                Merci de créer au moins une catégorie et une sous-catégorie
            @endif
            </select>

        {{-- Affichage du select Tva --}}
            <label class="font-semibold text-gray-700 mb-2 p-2 inline" for="tva_id">Séléctionner la tva :</label>
            <select name="tva_id" id="tva_id" class="block w-3/4 text-center">
                {{-- Liste des tvas --}}
                @if ($tvas->count())
                {{-- boucle seule pour les produits --}}
                @foreach($tvas as $tva)
                <option value="{{ $tva -> id}}">{{ $tva -> name}} - {{ $tva -> value}}</option>
                @endforeach
                @else
                    Merci de créer au moins une tva
                @endif
            </select>
        </div>

    </div>
    <div class="class w-full mt-4 p-1 lg:flex lg:justify-center">
        <label class="font-semibold text-gray-700 mb-2 p-2 inline w-1/3 h-10" for="description">Description :</label>
        <textarea class="shadow border rounded w-full h-32 px-4 textarea" name="description" id="description" rows="10" cols="50"></textarea>
        {!! $errors->first('description','<p class="text-red-700 text-lg">:message</p>') !!} 
    </div>
    <div class="class w-full mt-4 lg:flex lg:justify-center p-1">
        <label class="font-semibold text-gray-700 mb-2 p-2 inline w-1/3" for="validatedCustomFile">Sélectionner l'image...</label>
        <input type="file" class="shadow border rounded p-2 w-full lg:w-2/3" name="image" id="validatedCustomFile">
    </div>

 