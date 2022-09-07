<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\hour_collect;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        
        $orders = Order::finish()->latest()->get();
        //$orders = Order::orderBy('created_at', 'DESC')->get();
        //$orders = Order::orderBy('created_at', 'ASC')->get();
        
        return view('user.orders', compact('orders'));
    }

    public function home()
    {
        $status = "Validee";
        // Status -1 correspond à tous les status
        if ($status == "Validee"){
            $orders = Order::finish()->orderBy('created_at', 'DESC')->where('status',$status)->get();
        } else {
            $orders = '';
        }
        return view('user.home', compact('orders','status'));
    }

    public function indexAdmin(){
        
        $orders = Order::with('user')->finishAll()->latest()->get();
        //$orders = Order::orderBy('created_at', 'DESC')->get();
        //$orders = Order::orderBy('created_at', 'ASC')->get();
        return view('auth.admin.orders.index', compact('orders'));
    }

    public function waiting(){
        
        $orders = Order::wait()->get();
        //$orders = Order::orderBy('created_at', 'ASC')->get();
        return view('user.orderswaiting', compact('orders'));
    }

    public function show(Order $id) {
        
        // Affichage du détail des commandes

        // table order, product et order_product
        $detail = Order::with('products')->orderBy('created_at', 'DESC')->get();
        $detail = Order::find($id->id);

        //dd($detail);
        return view('user.orderShow', compact('detail'));
    }

    public function showAdmin(Order $id) {
        
        // Affichage du détail des commandes

        // table order, product et order_product
        $detail = Order::with('products','user')->orderBy('created_at', 'DESC')->get();
        $detail = Order::find($id->id);

        $hour_collects = hour_collect::orderBy('valeur', 'ASC')->get();

        return view('auth.admin.orders.orderShow', compact('detail','hour_collects'));
    }

    public function showByStatus(Request $request)
    {
        $status = $request -> status;
        // Status -1 correspond à tous les status
        if ($status==-1){
            $orders = Order::finish()->orderBy('created_at', 'DESC')->get();
        } else {
            $orders = Order::finish()->orderBy('created_at', 'DESC')->where('status',$status)->get();
        }

        return view('user.orders', compact('orders','status'));

    }

    public function ordersShowAdminInCurse(Request $request)
    {
        $status = $request -> status;
        // Status -1 correspond à tous les status
        if ($status==-1){
            $orders = Order::finishAll()->latest()->get();
        } else {
            $orders = Order::finishAll()->orderBy('created_at', 'DESC')->where('status',$status)->get();
        }

        return view('auth.admin.orders.index', compact('orders','status'));
    }

    public function orderValidate(Request $request, $id) {
        
        $updateData = $request->validate([
            'date_retrait' => 'required|max:255',
            'heure_retrait' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        Order::whereId($id)->update($updateData);
        

        session()->flash('message', 'Commande validée avec succès');
        return back();
    }

    public function orderFinish(Request $request, $id) {
        
        $updateData = $request->validate([
            'retrait_order' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        Order::whereId($id)->update($updateData);
        

        session()->flash('message', 'Commande Terminée');
        return back();
    }
}
