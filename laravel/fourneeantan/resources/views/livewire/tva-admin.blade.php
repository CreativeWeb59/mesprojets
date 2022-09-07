<div class="w-full m-10 text-center">
    <h2>Ajouter une Tva :</h2>
    <form id="form-create"  wire:submit.prevent="createTva"  class="w-full flex content-center items-center justify-center">
        {{-- @csrf --}}
        <input class="w-80 m-1 border border-gray-600 rounded p-2 text-four" wire:model="name" value="" name="name" placeholder="Description">
        <input class="w-80 m-1 border border-gray-600 rounded p-2 text-four" wire:model="valeur" value="" name="valeur" placeholder="Inscrire le taux">
        <button type="submit" class="btn w-74 m-2 h-10" title="Ajouter une tva">Ajouter une tva</button>
    </form>
    <div class="w-full">
        @error('name') <span class="error">{{ $message }}</span> @enderror
        @error('valeur') <span class="error">{{ $message }}</span> @enderror
    </div>
</div>
