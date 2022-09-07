@extends('layouts.app')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<h1 class="h1">Votre panier</h1>

@if (session()->has('message'))
  <div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 rounded">
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
  </div>
@endif

@if (session()->has('danger'))
  <div class="border border-red 700 text-red-700 bg-red-200 px-1 py-2 rounded">
        <div class="alert alert-success">
            {{ session('danger') }}
        </div>
  </div>
@endif

@if (Cart::count() >0)
<div class="w-full lg:w-1/2 m-8 bg-white">
            <!-- Shopping cart table -->
                  <div class="flex">
                    <div class="w-1/2 text-center font-bold">
                      <span class="py-2 text-center">Produit</span>
                    </div>
                    <div class="w-1/6 text-center font-bold">
                      <span class="hidden lg:inline py-2">Prix Unitaire</span>
                      <span class="py-2 lg:hidden">P.U.</span>
                    </div>
                    <div class="w-1/6 text-center font-bold">
                      <span class="hidden lg:inline py-2">Quantité</span>
                      <span class="py-2 lg:hidden">Q.</span>
                    </div>
                    <div class="w-1/6 text-center  font-bold">
                      <span class="hidden lg:inline py-2">Supprimer</span>
                      <span class="py-2 lg:hidden">S.</span>
                    </div>
                  </div>

                  @foreach (Cart::content() as $product)
                  <div class="flex my-8">
                      <div class="w-1/2 pl-4 flex">

                        <img src="{{ asset('storage/'.$product->model->image)}}" alt="photo article" class="img-fluid rounded shadow-sm inline w-1/3">
                        <div class="pl-1 lg:pl-4">
                          <span class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">{{ $product->model->title }}</a></span>
                        </div>
                      </div>
                      <div class="w-1/6 text-right pr-1 lg:pr-7 text-xs font-bold">
                        {{number_format($product->model->price,2,',','.')}} €
                      </div>
                      <div class="w-1/6 text-center pr-1 lg:pr-7 text-xs">
                          <form action="{{ route('cart.destroy', $product->rowId) }}" method="POST">
                            @csrf
                            @method('delete')
                        <input class="w-8 lg:w-16 font-bold" type="number" min="1" max="10" step="1" name="qty" id="qty" value="{{ $product->qty }}" data-id="{{ $product->rowId }}">
                      </div>
                      <div class="w-1/6 text-center">
                          <button type="submit" class="text-dark"><i class="fa fa-trash"></i></button>
                        </form>
                      </div>
                    </div>
                      @endforeach
                <!-- End -->
          </div>
        <div class="w-full lg:w-1/2 m-8py-5 p-4">
            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"><strong>Message pour le vendeur :</strong></div>
            <div class="p-4">
              <p class="font-italic mb-4">Merci de noter içi les informations supplémentaires en cas de besoin.</p>
              <form action="{{ route('checkout.index') }}" method="POST">
                @csrf
                @method('POST')
              <textarea name="infoCommande" class="w-full h-24 textarea" placeholder="Votre texte"></textarea>
              <input type="hidden" name="price_HT">
            </div>
          </div>
          <div class="w-full lg:w-1/2 m-8py-5 p-4 flex">
            <div class="px-4 w-2/3 text-right font-bold">Net à payer :</div>
            <div class="px-4 w-1/3 text-right font-bold">{{ Cart::total() }} €</div>
          </div>
          <div class="w-full lg:w-1/2 m-8 py-5 p-4 flex justify-center">
            <button type="submit" class="btn w-auto px-4 py-2 mt-3 inline">Payer la commande</button>
        </div>
            </form>
 @else
    <div>Votre panier est vide</div>
@endif
          {{-- espacement bas --}}
          <div class="h-96">
          </div>
@endsection

@section('extra-js')
<script>
  var qty = document.querySelectorAll('#qty');
  Array.from(qty).forEach((element) => {
    //console.log(element);
      element.addEventListener('change', function () {
          var rowId = element.getAttribute('data-id');
          var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          fetch(`/panier/${rowId}`,
              {
                  headers: {
                      "Content-Type": "application/json",
                      "Accept": "application/json, text-plain, */*",
                      "X-Requested-With": "XMLHttpRequest",
                      "X-CSRF-TOKEN": token
                  },
                  method: 'PATCH',
                  body: JSON.stringify({
                      qty: this.value
                  })
          }).then((data) => {
              console.log(data);
              location.reload();
          }).catch((error) => {
              console.log(error);
          });
      });
  });
</script>
@endsection

