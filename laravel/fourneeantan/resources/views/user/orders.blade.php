@extends('layouts.app')
    @section('content')
{{-- Test a faire l'utilisateur doit etre connecté --}}
<div class="bg-fonce text-center mt-8">
    <div class="h1">Liste de mes commandes</div>

    test

    <div class="w-5/6 h-full flex flex-wrap justify-center content-start items-center">
        <div class="h-3/4 flex justify-start flex-col border shadow m-8 p-8 bg-white">
            <div class="flex justify-end w-full">
                {{-- Choix commandes terminées et actives --}}
                    <form class="px-4" id="formCxActif" action="{{ route('OrderController.showByStatus') }}" method="POST">
                    @csrf
                    <label class="font-semibold text-gray-700 mb-2 p-2" for="status">Statut :</label>
                    <select name="status" id="status" class="w-96 text-center shadow border" onchange="this.form.submit();">
                        @if (isset($status))
                            @switch($status)
                            @case('En cours')
                            <option value="-1">Toutes les commandes</option>
                            <option value="En cours" selected>Commandes en cours</option>
                            <option value="Validee">Commandes à récupérer</option>
                            <option value="Terminee">Commandes terminées</option>
                            @break
        
                            @case('Validee')
                            <option value="-1">Toutes les commandes</option>
                            <option value="En cours">Commandes en cours</option>
                            <option value="Validee" selected>Commandes à récupérer</option>
                            <option value="Terminee">Commandes terminées</option>
                            @break

                            @case('Terminee')
                            <option value="-1">Toutes les commandes</option>
                            <option value="En cours">Commandes en cours</option>
                            <option value="Validee">Commandes à récupérer</option>
                            <option value="Terminee" selected>Commandes terminées</option>
                            @break
        
                            @default
                            <option value="-1" selected>Toutes les commandes</option>
                            <option value="En cours">Commandes en cours</option>
                            <option value="Validee">Commandes à récupérer</option>
                            <option value="Terminee">Commandes terminées</option>
                            @endswitch
                        @else
                            <option value="-1" selected>Toutes les commandes</option>
                            <option value="En cours">Commandes en cours</option>
                            <option value="Validee">Commandes à récupérer</option>
                            <option value="Terminee">Commandes terminées</option>
                        @endif
                    </select>
                    </form>
                </div>

        <div class="w-full">
            {{-- Entete tableau --}}
            <div class="flex my-12 w-1008">
                <div class="w-96 text-xl text-center">Numéro commande</div>
                <div class="w-96 text-xl text-center">Date</div>
                <div class="w-20 text-xl text-center">Prix</div>
                <div class="w-20 text-xl text-center">Statut</div>
                <div class="w-20 text-xl text-center">Voir</div>
            </div>
        
        @if ($orders->count())
        {{-- boucle seule pour les produits --}}
            
            @foreach($orders as $order)
            <div class="flex mt-4 ">
                <div class="w-96">{{ $order->Num_commande }}</div>
                <div class="w-96">{{ date_format($order->created_at,"d/m/Y")}}</div>
                <div class="w-20  pr-2 text-right">{{ number_format($order->total, 2, ',', '.') }} €</div>
                <div class="w-20 text-center">
                    @if ($order->status == "Terminee")
                    <span class="w-5 h-5 text-blue-900 far fa-calendar-check" title="Terminée"></span>                            
                @elseif ($order->status == "En cours")
                    <span class="fas fa-hourglass-half w-5 h-5 text-blue-500" title="En cours"></span>
                @elseif ($order->status == "Validee")
                    <span class="far fa-check-circle w-5 h-5 text-green-500" title="Validee"></span>
                @endif
                </div>
                <div class="w-20 text-center">
                    <a href="{{ route ('OrderController.show',$order->id)}}">
                        <span class="w-5 h-5 far fa-eye"></span></a>
                </div>
            </div>
                @endforeach

        @else
            Désolé vous n'avez pas encore de commandes
        @endif
    </div>
</div>
</div>

</div>

    @endsection