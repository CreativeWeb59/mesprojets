@extends('layouts.appAdmin')
    @section('content')
{{-- Test a faire l'utilisateur doit etre connecté --}}
@if (session()->has('message'))
<div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 rounded">
      <div class="alert alert-success">
          {{ session('message') }}
      </div>
</div>
@endif
    @if ($detail->count())

        <h1 class="h1">Détail de la commande :</h1>    
            <p><strong>n° {{ $detail->Num_commande}}</strong></p>
            <p><strong>du {{ date_format($detail->created_at,"d/m/Y")}}</strong></p><br>
            <p><strong>Nom du client : {{ $detail->user->name}}</strong></p>
            <p><strong>Adresse email : {{ $detail->user->email}}</strong></p>
            <p><strong>Ville : {{ $detail->user->city}}</strong></p>

        <div class="w-11/12 lg:w-4/5 flex justify-center content-center items-center flex-col mt-8 lg:mt-0">
            {{-- Entete tableau --}}
            <div class="mt-12 hidden lg:w-1008 h-16 lg:flex justify-center content-center items-center border">
                <div class="w-36 h-full text-xl">&nbsp;</div>
                <div class="w-120 h-full text-xl text-center border-l-2"><strong>Description</strong></div>
                <div class="w-28 h-full text-xl text-center border-l-2 border-r-2"><strong>Prix unitaire</strong></div>
                <div class="w-28 h-full text-xl text-center"><strong>Quantité</strong></div>
                <div class="w-28 h-full text-xl text-center border-l-2"><strong>Total</strong></div>
            </div>

            <div class="w-full lg:w-1008 border">
            @foreach($detail->products as $product)
                <div class="flex justify-center content-center items-center flex-wrap">
                    <div class="w-1/3 lg:w-36 h-20 py-2 text-xl text-center">
                        <img src="{{ asset('storage/'.$product->image)}}" alt="photo article" class="object-contain h-16 w-full rounded shadow-sm inline">
                    </div>
                    <div class="w-2/3 lg:w-120 h-20 py-2 text-center lg:border-l-2">
                        <a href="#" class="text-dark d-inline-block align-middle">{{ $product->title }}</a><br>
                        {{ $product->subtitle }}
                    </div>
                    <div class="w-1/3 lg:w-28 h-20 py-2 text-right pr-4 lg:border-l-2">
                        {{number_format($product->price,2,',','.')}} €
                    </div>
                    <div class="w-1/3 lg:w-28 h-20 py-2 text-right pr-4 lg:border-l-2">
                     <span class="lg:hidden">x </span>
                        {{ $product->pivot->quantity }}
                    </div>
                    <div class="w-1/3 lg:w-28 h-20 py-2 text-right pr-4 lg:border-l-2">
                        <strong>{{ number_format(($product->pivot->price) * ($product->pivot->quantity),2,',','.') }} €</strong>
                    </div>
                </div>
                <div class="w-full">
                    <hr>
                </div>
          @endforeach
            </div>
            {{-- Ligne total --}}
            <div class="w-full lg:w-1008 flex justify-end content-center items-center border">
                <div class="w-56 h-12 pt-2 text-center"><strong>Net à payer :</strong></div>
                <div class="w-32 h-12 pt-2 text-right pr-10"><strong>{{number_format($detail->total,2,',','.')}} €</strong></div>
            </div>
            {{-- Payée --}}
            <div class="w-full lg:w-1008 flex justify-center content-center items-center border">
                <div class="w-full h-12 pt-2 text-center pr-4"><strong>
                @if ($detail->is_paid === 1 )
                    Facture payée par {{ $detail->payment_method }}, le {{ date_format($detail->created_at,"d/m/Y")}}
                @else
                    Facture à régler
                @endif
                </strong></div>
            </div>
            <div class="w-full mt-16">
                {{-- Formulaire uniquement si commande en attente --}}
                @if ($detail->status === 'En cours')
                    <form action="{{ route ('OrderController.orderValidate',$detail->id)}}" method="POST" class="w-full lg:w-1008 flex justify-around content-center items-center flex-wrap lg:flex-nowrap">
                        @csrf
                        @method('PATCH')
                        <label class="w-56 mx-4" for="date_retrait">Commande disponible, le :</label>
                        <input class="w-56 mx-4" type="date" name="date_retrait" id="">
                        <input type="hidden" name="status" value="Validee">

                            @if (isset($hour_collects))
                                <label class="w-28 mx-4 my-4" for="heure_retrait">à partir de :</label>
                                <select name="heure_retrait" id="heure_retrait" class="w-32 mx-4 text-center shadow border">
                                    @foreach($hour_collects as $hour_collect)
                                        <option value="{{ $hour_collect->valeur }}">{{ $hour_collect->description }}</option>
                                    @endforeach
                            </select>
                                @else
                                veuillez renseigner au moins un horaire
                            @endif
                        <input type="submit" value="Valider la commande" class="mx-4 w-48">
                    </form>
                @elseif ($detail->status === 'Validee')
                    <p class="text-center">Commande validée le : {{$detail->updated_at}}</p>
                    <p class="text-center">Date de retrait prévu le : {{$detail->date_retrait}} à {{$detail->heure_retrait}}</p>
                    <form action="{{ route ('OrderController.orderFinish',$detail->id)}}" method="POST" class="w-full lg:w-1008 flex justify-around content-center items-center flex-wrap">
                        @csrf
                        @method('PATCH')
                        <label class="w-64 mx-4 my-4" for="date_retrait">Commande retirée, le :</label>
                        <input class="w-64 mx-4" type="date" name="retrait_order">
                        <input type="hidden" name="status" value="Terminee">
                        <input type="submit" value="Retrait de la commande" class="mx-4 w-48 my-8">
                    </form>
                @elseif ($detail->status === 'Terminee')
                    <p class="text-center">Commande retirée le : {{$detail->retrait_order}}</p>
                @endif
            </div>
        </div>
          @else
        Problème
    @endif
    <div class="h-screen lg:h-96 w-full">
        &nbsp; <br><br><br><br>
    </div>
    @endsection