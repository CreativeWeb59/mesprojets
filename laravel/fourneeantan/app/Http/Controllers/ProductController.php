<?php

namespace App\Http\Controllers;

use App\Models\{Product, Category};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        
        $products = Product::actif()->latest()->take(6)->get();
        $categories = Category::defaultOrder()->get()->toTree();

        // creation du fil d'ariane
        $filAriane = [
            'chemin0' => 'none',
            'chemin1' => 'none',
            'titlePage' => 'Les nouveautés',
        ];

        return view('products.index', compact('products', 'categories','filAriane'));
    }
    
    public function show(Product $id)
    {
        $categories = Category::defaultOrder()->get()->toTree();
        $product = Product::find($id->id);

         // creation du fil d'ariane
         $nameCat = Category::find($product->category_id)->name;
         $parent_id = Category::find($product->category_id)->parent_id;
         $nameParent = Category::find($parent_id)->name;
 
          // Maj du fil d'ariane
          $filAriane = [
              'chemin0' => $nameParent,
              'chemin1' => $nameCat,
              'titlePage' => 'Catégorie : '.$nameCat,
          ];

        return view('products.show', compact('product','categories','filAriane'));
    }

    public function showByCategory(Request $request)
    {

        // gestion de toutes les catégories :

        if($request->category_id == -1) {
            // envoi vers toutes les produits
            $products = Product::actif()->latest()->take(6)->get();
            $categories = Category::defaultOrder()->get()->toTree();

            $filAriane = [
                'chemin0' => 'none',
                'chemin1' => 'none',
                'titlePage' => 'Les nouveautés',
            ];
            return view('products.index', compact('products', 'categories','filAriane'));
        }
        // on recherche le caractere "-" dans le category_id
        $pos = strpos($request -> category_id, '-');

        if ($pos!=false) {
            $category_id =  strstr($request -> category_id, '-', true); // recupere debut de la chaine
            $parent_id =  substr($request -> category_id, $pos+1);
        } else {
            $category_id =  $request -> category_id;
            $parent_id = $request -> parent_id;
        }
        
        $nameCat = Category::nomSsCategory($category_id)->name;

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

            // Maj du fil d'ariane
            $filAriane = [
                'chemin0' => $nameCat,
                'chemin1' => 'none',
                'titlePage' => 'Catégorie : '.$nameCat,
            ];

        } else {
            // Status -1 correspond à tous les status
            if ($category_id== -1){
                $products = Product::with('category',)->orderBy('title', 'ASC')->get();
            } else {
                $products = Product::with('category')->orderBy('title', 'ASC')->where('category_id',$category_id)->get();

                //$nameParent = Category::nomSsCategory($request -> parent_id)->name;
                $nameParent = Category::nomSsCategory($parent_id)->name;
                // Maj du fil d'ariane
                $filAriane = [
                    'chemin0' => $nameParent,
                    'chemin1' => $nameCat,
                    'titlePage' => 'Catégorie : '.$nameCat,
                ];
            }
        }

        $categories = Category::defaultOrder()->get()->toTree();

        //dd($products);

        return view('products.index', compact('products', 'categories','category_id','filAriane'));

    }

    
}