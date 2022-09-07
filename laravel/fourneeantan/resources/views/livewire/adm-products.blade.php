@if($confirming===$idDelete)
    <button wire:click="delete({{ $idDelete }})"
    class="bg-red-800 text-white w-32 px-4 py-1 hover:bg-red-600 rounded border">Certain ?</button>
@else
    <button wire:click="confirmDelete({{ $idDelete }})"  title="Supprimer l'article">
    <svg class="w-5 h-5 text-red-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
    </button>
@endif
