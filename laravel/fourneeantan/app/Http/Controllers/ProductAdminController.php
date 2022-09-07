<?php

namespace App\Http\Controllers;

use App\Models\{Product, Category, Tva};
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function index()
    {
        $categories = Category::defaultOrder()->get()->toTree();
        $products = Product::with('category',)->orderBy('title', 'ASC')->get();
        return view('auth.admin.products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('tva')->where('id',$id)->firstOrFail();

        $categories = Category::defaultOrder()->get()->toTree();
        $tvas = Tva::all();

        return view('auth.admin.products.show', compact('categories','tvas'))->with('product',$product);
    }

    public function showByCategory(Request $request)
    {
        $category_id = $request -> category_id;

        // recupere les categories enfants
        $results = Category::descendantsOf($category_id);
        // Test si c'est une categorie root => on aura des résultats
        if ( !$results->isEmpty() ) {
            // plusieurs id dans un tableau
            // recherche avec where dans ce tableau
            $products = Product::with('category',)
            ->Where(function ($query) use($results) {
                foreach($results as $result) {
                    $query->orwhere('category_id',$result->id);
            }
            })
            ->orderBy('title', 'ASC')->get();
        } else {
            // Status -1 correspond à tous les status
            if ($category_id== -1){
                $products = Product::with('category',)->orderBy('title', 'ASC')->get();
            } else {
                $products = Product::with('category')->orderBy('title', 'ASC')->where('category_id',$category_id)->get();
            }
        }

        $categories = Category::defaultOrder()->get()->toTree();

        return view('auth.admin.products.index', compact('products', 'categories','category_id'));
    }

    public function showByActivity(Request $request)
    {
        $status = $request -> status;
        // Status -1 correspond à tous les status
        if ($status==-1){
            $products = Product::with('category')->orderBy('title', 'ASC')->get();
        } else {
            $products = Product::with('category')->orderBy('title', 'ASC')->where('status',$status)->get();
        }

        $categories = Category::defaultOrder()->get()->toTree();

        return view('auth.admin.products.index', compact('products', 'categories','status'));

    }

    public function update(Request $request, $id)
    {
        $updateData = Product::find($id);

        if(isset($request->title))
        {
            $updateData->title = $request->title;
        }
        
        if(isset($request->subtitle))
        {
            $updateData->subtitle = $request->subtitle;
        }

        if(isset($request->price))
        {
            // update du prix HT
            $updateData->priceHT = ($request->price) / (1 + ($request->valueTva));
            $updateData->price = $request->price;
        }
        
        if(isset($request->description))
        {
            $updateData->description = $request->description;
        }

        if(isset($request->image))
        {
            $updateData->image = $request->image;
            $this->storeImage($updateData);
        }

        if(isset($request->category_id))
        {
            $updateData->category_id = $request->category_id;
        }

        if(isset($request->tva_id))
        {
            // Modification du prix HT
            $valeurTva = tva::where('id',$request->tva_id)->firstOrFail();

            $updateData->tva_id = $request->tva_id;
            $updateData->priceHT = ($request->price) / (1 + ($valeurTva->value));
        }

        if(isset($request->status))
        {
            $updateData->status = $request->status;
        }

        $updateData->save();

        session()->flash('message', 'Produit mis à jour avec succès');
        return back();
    }

    
    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();

        $categories = Category::defaultOrder()->get()->toTree();
        $products = Product::with('category',)->orderBy('title', 'ASC')->get();
        
        session()->flash('message', 'Produit supprimé avec succès');
        return view('auth.admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::defaultOrder()->get()->toTree();
        $tvas = Tva::all();
        $product = new Product();

        return view('auth.admin.products.create', compact('categories','tvas'));
    }
 
    public function store()
    {
        $product = Product::create($this->validator());

        session()->flash('message', $product->title.' ajouté avec succès');
        $this->storeImage($product);
        return back();
    }

    private function storeImage(Product $product){
        if (request('image')){
            $product->update([
            'image'=> request('image')->store('products','public')
            ]);
        }
    }

    public function validator()
    {
        return request()->validate([
            'title'=>'required|min:3|max:100',
            'subtitle'=>'required|min:3|max:255',
            'price'=>'required|Numeric',
            'description'=>'required|min:3|max:500',
            'tva_id'=>'required|Numeric',
            'category_id'=>'required|Numeric',
            'image'=>'sometimes|image|max:5000',
        ]);
    }
}