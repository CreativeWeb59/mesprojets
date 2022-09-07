<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        
     public function index(Request $request)
    {
       
        if (Cart::count() <= 0) {
            return redirect()->route('products.index');
        }

        //dd(intval(Cart::total())*100);
        $infoCommande = $request->infoCommande;

        Stripe::setApiKey('sk_test_51Iom7WFHaO8s4QhUFia0roiLjqCiXyzLboAm0Yzif22kVV7o3AO71fOEbqkppNVsfN9oXqBjxFjUxaVqzn9BlJcO00RorvhWir');
        $intent = PaymentIntent::create([
            'amount'   => str_replace('.', '', Cart::total()),
            'currency' => 'eur',
            'metadata' => [
                'reference' => Auth::user()->id,
                'customer' => Auth::user()->email
                ]
        ]);
        
        $clientSecret = Arr::get($intent,'client_secret');
        return view ('checkout.index',[
            'clientSecret'=> $clientSecret,
            'infoCommande'=> $infoCommande
        ]);
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

        $data = $request->json()->all();
        $totalHT = 0;
        // Calcul du total HT
        foreach(Cart::content() as $productHT){
            $totalHT =  $totalHT + ($productHT->model->priceHT) * ($productHT->qty);
        }

        $order = new Order();
        
        $order->payment_intend_id = $data['payment_intent']['id'];
        $order-> Num_commande  = $data['payment_intent']['id'];
        $order->total = Cart::total();
        $order->totalHT = $totalHT;
        $order->nom_client = Auth::user()->email;
        $order->user_id = Auth::user()->id;
        $order->city = Auth::user()->city;
        $order->item_count = Cart::count();
        $order->is_paid  = 1;
        $order->status  = "En cours";
        $order->payment_method = "Stripe";
        $order->informations = $data['infoCommande'];
        $order->save();
        $LastInsertId = $order->id;

        // table : detail_order
        // içi table detail_commandes
        $productOrder = Order::where('id',$LastInsertId)->first();

        foreach(Cart::content() as $product){
            $productOrder->products()->attach($product->model->id,['quantity' => $product->qty, 'price' =>$product->price]);
        }

        Cart::destroy();
        return $data['paymentIntent'];
    }

    public function thankYou()
    {
        
        session()->flash('message', 'Votre commande est validée');
        return view('checkout.thankYou');
        //return Session::has('success') ? view('checkout.thankYou') : redirect()->route('products.index');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
