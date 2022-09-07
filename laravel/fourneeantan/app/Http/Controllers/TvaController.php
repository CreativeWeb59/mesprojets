<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tva;

class TvaController extends Controller
{
    public function index()
    {
       $tvas = Tva::orderBy('name', 'ASC')->get();
        
        return view ('auth.admin.tvas.index',[
            'tvas' => $tvas
        ]);
    }

    public function create(Request $request)
    {
        $createData = $request->validate([
            'name' => 'required|max:255',
            'value' => 'required|max:255',
        ]);

        Tva::create($createData);
        session()->flash('message', 'Tva ajoutée avec succès');
        return back();
    }
    
    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'name' => 'required|max:255',
            'value' => 'required|max:255',
        ]);

        Tva::whereId($id)->update($updateData);

        session()->flash('message', 'Tva mis à jour avec succès');
        return back();
    }
    
    public function destroy($id)
    {
        $tvas = Tva::findOrFail($id);
        $tvas->delete();
        session()->flash('message', 'Tva supprimée avec succès');
        return back();
    }

}



