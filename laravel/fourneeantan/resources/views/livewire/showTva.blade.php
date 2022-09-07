<div class="flex flex-wrap w-full justify-center items-center content-center">
        {{-- @if ($tvas->count())
                @foreach ($tvas as $tva)
                <div>{{$tva->name}} : <div>{{$tva->valeur}}</div></div>
        @endforeach
        @else
            <h3>Il n'y a aucune Tva dans la base.</h3>
        @endif
        </div> --}}
        <div class="w-full m-10 text-center">
            <h2>Ajouter une Tva :</h2>
            <form id="form-create"  wire:submit.prevent="createTva"  class="w-full flex content-center items-center justify-center">
                {{-- @csrf --}}
                <input class="w-80 m-1 border border-gray-600 rounded p-2 text-four" wire:model="name" value="" name="name" placeholder="Description">
                @error('name') <span class="error">{{ $message }}</span> @enderror
                <input class="w-80 m-1 border border-gray-600 rounded p-2 text-four" wire:model="valeur" value="" name="valeur" placeholder="Inscrire le taux">
                @error('valeur') <span class="error">{{ $message }}</span> @enderror
                <button type="submit" class="btn w-74 m-2 h-10" title="Ajouter une tva">Ajouter une tva</button>
                </form>
</div>
