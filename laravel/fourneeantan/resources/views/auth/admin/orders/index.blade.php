@extends('layouts.appAdmin')
@section('content')
{{-- Test a faire l'utilisateur doit etre connecté --}}
{{-- <div class="bg-fonce text-center mt-8 flex flex-col justify-center content-start items-center"> --}}
    <h1 class="h1">Liste des commandes</h1>

    <div class="w-full lg:w-5/6 p-1 lg:p-4 h-full flex flex-wrap justify-center content-start items-center">
        <div class="w-full lg:w-auto h-auto flex justify-start flex-col border shadow m-1 lg:m-4 bg-white">
            <div class="flex justify-center w-full">
                {{-- Choix commandes terminées et actives --}}
                    <form class="mt-4" id="formCxActif" action="{{ route('OrderController.ordersShowAdminInCurse') }}" method="POST">
                    @csrf
                    <label class="font-semibold text-gray-700 mb-2 p-2" for="status">Statut :</label>
                    <select name="status" id="status" class="w-56 lg:w-96 text-center shadow border" onchange="this.form.submit();">
                        @if (isset($status))
                            @switch($status)
                            @case('En cours')
                            <option value="-1">Toutes les commandes</option>
                            <option value="En cours" selected>Commandes en cours</option>
                            <option value="Validee">Commandes validées</option>
                            <option value="Terminee">Commandes terminées</option>
                            @break
        
                            @case('Validee')
                            <option value="-1">Toutes les commandes</option>
                            <option value="En cours">Commandes en cours</option>
                            <option value="Validee" selected>Commandes validées</option>
                            <option value="Terminee">Commandes terminées</option>
                            @break

                            @case('Terminee')
                            <option value="-1">Toutes les commandes</option>
                            <option value="En cours">Commandes en cours</option>
                            <option value="Validee">Commandes validées</option>
                            <option value="Terminee" selected>Commandes terminées</option>
                            @break
        
                            @default
                            <option value="-1" selected>Toutes les commandes</option>
                            <option value="En cours">Commandes en cours</option>
                            <option value="Validee">Commandes validées</option>
                            <option value="Terminee">Commandes terminées</option>
                            @endswitch
                        @else
                            <option value="-1" selected>Toutes les commandes</option>
                            <option value="En cours">Commandes en cours</option>
                            <option value="Validee">Commandes validées</option>
                            <option value="Terminee">Commandes terminées</option>
                        @endif
                    </select>
                    </form>
                </div>

        <div class="w-full">
            {{-- Entete tableau --}}
            <div class="flex my-12 w-full lg:w-1008 bg-gray-800 text-white">
                <div class="w-20 lg:w-72 p-1 text-sm lg:text-xl text-center">Numéro commande</div>
                <div class="w-14 lg:w-40 p-1 text-sm lg:text-xl text-center">Date</div>
                <div class="w-20 lg:w-80 p-1 text-sm lg:text-xl text-center">Nom du client</div>
                <div class="w-16 lg:w-20 p-1 text-sm lg:text-xl text-center">Prix</div>
                <div class="w-8 lg:w-20 p-1 text-sm lg:text-xl text-center">Statut</div>
                <div class="hidden lg:inline w-10 lg:w-20 p-1 text-sm lg:text-xl text-center">Voir</div>
            </div>
        
        @if ($orders->count())
        {{-- boucle seule pour les produits --}}
            
            @foreach($orders as $order)
            <div class="flex mt-4 p-1 w-auto border">
                <div class="w-20 lg:w-72 p-1 break-words text-xs lg:text-base">{{ $order->Num_commande }}</div>
                <div class="w-14 lg:w-40 p-1 break-words text-sm lg:text-base">{{ date_format($order->created_at,"d/m/Y")}}</div>
                <div class="w-20 lg:w-80 p-1 text-xs lg:text-base text-center">{{ $order->user->name }}</div>
                <div class="w-16 lg:w-20 p-1 text-xs lg:text-base pr-2 text-right">{{ number_format($order->total, 2, ',', '.') }} €</div>
                <div class="w-8 lg:w-20 p-1 text-center">
                        @if ($order->status == "Terminee")
                            <span class="w-3 lg:w-5 h-3 lg:h-5 text-blue-900 far fa-calendar-check" title="Terminée"></span>                            
                        @elseif ($order->status == "En cours")
                            <span class="fas fa-hourglass-half w-3 lg:w-5 h-3 lg:h-5 text-blue-500" title="En cours"></span>
                        @elseif ($order->status == "Validee")
                            <span class="far fa-check-circle w-3 lg:w-5 h-3 lg:h-5 text-green-500" title="Validee"></span>
                        @endif
                </div>
                <div class="w-8 lg:w-20 p-1 text-center">
                    <a href="{{ route ('OrderController.showAdmin',$order->id)}}">
                        <span class="w-3 lg:w-5 h-3 lg:h-5 far fa-edit"></span></a>
                </div>

            </div>
                @endforeach
        @else
            Désolé vous n'avez pas encore de commandes
        @endif
    </div>
</div>
</div>

{{-- </div> --}}

@endsection