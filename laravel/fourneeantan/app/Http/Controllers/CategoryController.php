<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\livewire\Flash;

class CategoryController extends Controller
{
    public function index()
    {
        //$categories = Category::paginate(10);
        //$categories = Category::get()->toFlatTree();
        $categories = Category::defaultOrder()->get()->toTree();
        return view('auth.admin.categories.index', compact('categories'));
    }


    public function updateRoot(Request $request,$id)
    {

        $updateData = $request->validate([
            'name' => 'required|max:255',
        ]);

        Category::whereId($id)->update($updateData);

        session()->flash('message', $request->name.' mis à jour avec succès');
        return back();
        //return view('auth.admin.categories.index', compact('categories'))->with('success', 'Catégorie mise à jour avec succèss');
    }

    public function create(Request $request)
    {
        // tester si la categorie existe deja
        // ajouter l'envoi de message : erreur, success, doublon...
        // test si le parent existe
        
        $parent = $request->parent;
        $storeData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $node = new Category($storeData);

        if ($parent>0){
            $node->parent()->associate($parent)->save();
        } else {
            // methode ajout pour nested set
            $node->save(); // Saved as root
        }
                
        session()->flash('message', $request->name.' ajouté avec succès');
        return back();
    }

 
    /*   public function store(CategoryRequest $request)
    {
        $params = $request->all();
        Category::create($params);
        return redirect()->route('categories.index');
    }*/


    public function edit($id)
    {

        $categories = Category::findOrFail($id);
        return view('edit', compact('categories'));

        
        /*$categories = Category::whereNull('category_id')
            ->with('childCategories')
            ->get();

        $productCategory->load('parentCategory');

        return view('admin.productCategories.edit', compact('categories', 'productCategory'));*/
    }


    public function show(Category $productCategory)
    {

        $productCategory->load('parentCategory');

        return view('admin.productCategories.show', compact('productCategory'));
    }

    public function destroy($id)
    {
        // empecher la suppression d'une categorie s'il y a des enfants
        // voir pour la re-affectation des produits appartenant aux catégories supprimées
        // pour ne pas avoir de produits sans catégorie
        
        $categories = Category::findOrFail($id);
        $categories->delete();
        session()->flash('message', 'Catégorie supprimée avec succès');
        return back();
    }

}
