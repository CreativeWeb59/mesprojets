<form id="form-create"  action="{{ route('CategoryController.create') }}" method="POST" class="w-full flex content-center items-center justify-center">
                @csrf
                @method('PUT')
                <input class="w-80 m-1 border border-gray-600 rounded p-2 text-four" value="" name="name" placeholder="Description">
                <input class="w-80 m-1 border border-gray-600 rounded p-2 text-four" value="" name="name" placeholder="Inscrire le taux">
                <input type="hidden" name="parent" value=0>
                <button type="submit" class="btn w-74 m-2 h-10" title="Ajouter une tva">Ajouter une tva</button>
</form>