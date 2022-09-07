<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Product, Category};

class AdmProducts extends Component
{
    public $confirmProductDeletion = false;
    public $confirming='';
    public $idDelete = 0;

    /**
     * Write code on Method
     *
     * @return response()
     */

     public function render()
    {
        return view('livewire.adm-products', [

            'products' => Product::with('category','tva')->orderBy('title', 'ASC')->take(20)->get(),
            'categories' => Category::defaultOrder()->get()->toTree()
        ])
        ->extends('layouts.appAdmin')
        ->section('content');
    }
    //return view('auth.admin.products.index', compact('products', 'categories'));


    public function confirmDelete($idDelete)
    {

        $this->confirming = $idDelete;
    }

    public function delete($idDelete)
    {
        // Product::destroy($idDelete);
        // Product::find($this->confirmProductDeletion)->delete();

        $products = Product::findOrFail($idDelete);
        $products->delete();
        session()->flash('message', 'Produit supprimé avec succès');
        
        $categories = Category::defaultOrder()->get()->toTree();
        $products = Product::with('category','tva')->orderBy('title', 'ASC')->get();
        return view('auth.admin.products.index', compact('products', 'categories'));
    }

}


