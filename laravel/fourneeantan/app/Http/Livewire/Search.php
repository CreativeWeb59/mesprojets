<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public String $query = '';
    public $products = [];
    public Int $selectedIndex = 0;

    public function incrementIndex()
    {
        if($this->selectedIndex === count($this->products)-1) {
            $this->selectedIndex = 0;
            return;
        }
        $this->selectedIndex ++;
    }

    public function decrementIndex()
    {
        if($this->selectedIndex === 0) {
            $this->selectedIndex = (count($this->products)-1);
            return;
        }
        $this->selectedIndex --;
    }

    public function showProduit()
    {
        if ($this->products && count($this->products)>0){
            return redirect()->route('products.show',[$this->products[$this->selectedIndex]['id']]);
        }
    }

    public function updatedQuery()
    {
        $words = '%' . $this->query . '%';

        if (strlen($this->query)>2){
            $this->products = Product::where('title','like',$words)
            -> orWhere('description','like',$words)
            ->get();
        }
    }

    public function resetIndex()
    {
        $this->reset('selectedIndex');
    }

    public function render()
    {
        return view('livewire.search');
    }
}
