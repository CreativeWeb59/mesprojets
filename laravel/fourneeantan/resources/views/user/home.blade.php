@extends('layouts.app')
    @section('content')
{{-- Test a faire l'utilisateur doit etre connecté --}}

    <div class="h1 mt-8">Commandes à récupérer :</div>
    <div class="w-1008 h-auto flex justify-start flex-col border shadow m-8 p-8 bg-white">
        
    @if ($orders->count())
    {{-- boucle seule pour les produits --}}
        
        @foreach($orders as $order)
        <div class="flex mt-4 ">
            <div class="w-96">{{ $order->Num_commande }}</div>
            <div class="w-80">depuis le {{ $order->date_retrait }}</div>
            <div class="w-36  pr-2 text-right">{{ number_format($order->total, 2, ',', '.') }} €</div>
            <div class="w-20 text-center">
                @if ($order->status == "Terminee")
                <span class="w-5 h-5 text-blue-900 far fa-calendar-check" title="Terminée"></span>                            
            @elseif ($order->status == "En cours")
                <span class="fas fa-hourglass-half w-5 h-5 text-blue-500" title="En cours"></span>
            @elseif ($order->status == "Validee")
                <span class="far fa-eye w-5 h-5 text-green-500" title="Validee"></span>
            @endif
            </div>
            <div class="w-20 text-center">
                <a href="{{ route ('OrderController.show',$order->id)}}">
                    <span class="w-5 h-5 far fa-edit"></span></a>
            </div>
        </div>
        @endforeach

    @else
        <div class="text-center">
            Merci de votre visite
        </div>
    @endif
</div>
    @endsection