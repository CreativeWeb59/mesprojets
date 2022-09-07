<?php

namespace App\Http\Controllers;

//use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\{Product, Category};
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $product = Product::find($request->product_id);
        $categories = Category::defaultOrder()->get()->toTree();

        // creation du fil d'ariane Début
       $nameCat = Category::find($product->category_id)->name;
       $parent_id = Category::find($product->category_id)->parent_id;
       $nameParent = Category::find($parent_id)->name;

        $filAriane = [
            'chemin0' => $nameParent,
            'chemin1' => $nameCat,
            'titlePage' => 'Catégorie '.$nameCat,
        ];
        // Création du fil d'ariane Fin

        $duplicata = Cart::search(function ($cartItem, $rowId) use ($request){
            return $cartItem->id == $request->product_id;
        });
        

        Cart::add($product->id, $product->title, 1, $product->price)
            ->associate('App\Models\Product'); 

        session()->flash('message', 'Le produit à été ajouté au panier');

        return view('products.show', compact('product','categories','filAriane'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {

        $data = $request -> json()->all();

        $validator = Validator::make($request->all(), [
            'qty' => 'required|numeric|between:1,10'
        ]);

        if ($validator->fails()){
            session()->flash('danger', 'La quantité du produit doit être comprise entre 1 et 10, pour le supprimer, cliquez sur la corbeille.');
            return response()->json(['error'=> 'La quantité n\'a pas été modifiée']);
        }

        Cart::update($rowId, $data['qty']);
        session()->flash('message', 'La quantité est passée à '.$data['qty'].'.');
        return response()->json(['success'=> 'Mise à jour quantité effectuée']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        session()->flash('message', 'Le produit à été enlévé du panier');
        return view('cart.index');
    }

    public function empty()
    {
        Cart::destroy();
        session()->flash('message', 'Panier vidé');
        return view('cart.index');
    }
}
