@extends('layouts.app')
    @section('content')
{{-- Test a faire l'utilisateur doit etre connecté --}}

    @if ($detail->count())

        <div class="h1 text-center my-8">Détail de la commande :</div>
            <h2 class="font-serif"><strong>n° {{ $detail->Num_commande}}</strong></h2>
            <h2><strong>du {{ date_format($detail->created_at,"d/m/Y")}}</strong></h2>

        <div class="w-4/5 flex justify-center content-center items-center flex-col">
            <div class="mt-8 w-1/3 text-center">
                @if ($detail->status === 'En cours')
                    <strong>Merci de patienter, votre commande est<br>en cours de préparation</strong>
                @elseif ($detail->status === 'Validee')
                    <strong>Votre commande est prête, vous pouvez venir la récupérer à partir du : {{$detail->date_retrait}} à {{$detail->heure_retrait}}</strong>
                @elseif ($detail->status === 'Terminee')
                    <strong>Commande retirée le : {{$detail->retrait_order}}</strong>
                @endif
            </div>
            {{-- Entete tableau --}}
            <div class="mt-12 w-1008 h-16 flex justify-center content-center items-center border">
                <div class="w-48 h-full text-xl">&nbsp;</div>
                <div class="w-120 h-full text-xl text-center border-l-2"><strong>Description</strong></div>
                <div class="w-28 h-full text-xl text-center border-l-2 border-r-2"><strong>Prix unitaire</strong></div>
                <div class="w-28 h-full text-xl text-center"><strong>Quantité</strong></div>
                <div class="w-28 h-full text-xl text-center border-l-2"><strong>Total</strong></div>
            </div>

            <div class="w-1008 border">
            @foreach($detail->products as $product)
                <div class="flex justify-center content-center items-center">
                    <div class="w-48 h-20 py-2 text-xl text-center">
                        <img src="{{ asset('storage/'.$product->image)}}" alt="photo article" class="object-contain h-16 w-full rounded shadow-sm inline">
                    </div>
                    <div class="w-120 h-20 py-2 text-center border-l-2">
                        <a href="#" class="text-dark d-inline-block align-middle">{{ $product->title }}</a><br>
                        {{ $product->subtitle }}
                    </div>
                    <div class="w-28 h-20 py-2 text-right pr-4 border-l-2">
                        {{number_format($product->price,2,',','.')}} €
                    </div>
                    <div class="w-28 h-20 py-2 text-right pr-4 border-l-2">
                        {{ $product->pivot->quantity }}
                    </div>
                    <div class="w-28 h-20 py-2 text-right pr-4 border-l-2">
                        <strong>{{ $product->pivot->price * $product->pivot->quantity }} €</strong>
                    </div>
                </div>
                <div class="w-full">
                    <hr>
                </div>
          @endforeach
            </div>
            {{-- Ligne total --}}
            <div class="w-1008 flex justify-end content-center items-center border">
                <div class="w-56 h-12 pt-2 text-center border-l-2 border-r-2"><strong>Net à payer :</strong></div>
                <div class="w-28 h-12 pt-2 text-right pr-4"><strong>{{number_format($detail->total,2,',','.')}} €</strong></div>
            </div>
            {{-- Payée --}}
            <div class="w-1008 flex justify-center content-center items-center border">
                <div class="w-full h-12 pt-2 text-center pr-4"><strong>
                @if ($detail->is_paid === 1 )
                    Facture payée par {{ $detail->payment_method }}, le {{ date_format($detail->created_at,"d/m/Y")}}
                @else
                    Facture à régler
                @endif
                </strong></div>
            </div>
        </div>
          @else
        Problème
    @endif
    @endsection