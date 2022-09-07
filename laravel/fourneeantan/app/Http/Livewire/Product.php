<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Product extends Component
{
    public $product;

    public function addLike()
    {
        if(auth()->check()){
            auth()->user()->likes()->toggle($this->product->id);
        } else {
            $this->emit('flash','Merci de vous connecter pour ajouter un produit à vos favoris','error');
        }
        
    }

    public function render()
    {
        return view('livewire.product');
    }


}
