<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tva;

class TvaAdmin extends Component
{
    public $name;
    public $valeur;

    public function render()
    {
        return view('livewire.tva-admin');
    }

    public function createTva()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6',
            'valeur' => 'required'
        ]);
   
        Tva::create($validatedData);
        $this->emit('flash','Merci de vous connecter pour ajouter un produit à vos favoris','error');
        //session()->flash('message', 'Tva ajoutée avec succès');
        return back();
    }
}
