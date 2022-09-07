@extends('layouts.appAdmin')
@section('content')
    <h1 class="h1">Statistiques</h1>
    
    <div class="flex flex-wrap w-full justify-center items-center content-center">
    Statistiques de vente : ca + nb produits => ok <br>
    Statistiques par produit <br>
    Statistiques par catégorie <br>
    Statistiques par client <br>
    {{-- Fin d'année => cloture ? => orders

    Besoin des tables : orders, products, users
    + table pivot : orders_products --}}

    </div>
    
    {{-- Inclus la selection période --}}
    @include('partials.SelectPeriode')

    <div class="w-1008 h-auto flex justify-start items-start content-start flex-col shadow mt-16 bg-white border-r border-black">
    
        <nav class="w-full m-2 hidden lg:flex lg:content-center content-start items-baseline justify-center">
            <ul class="flex w-full">
                <li class="w-full m-4"><a class="btnAdmin" href="{{ route ('dashboard')}}">Chiffre d'affaire</a></li>
                <li class="w-full m-4"><a class="btnAdmin" href="{{ route ('ProductAdminController.index')}}">Produits</a></li>
                <li class="w-full m-4"><a class="btnAdmin" href="{{ route ('CategoryController.index')}}">Catégories</a></li>
                <li class="w-full m-4"><a class="btnAdmin" href="{{ route ('TvaController.index')}}">Client</a></li>
            </ul>
        </nav>

        <div class="flex w-1008 h-16 border-b border-l border-t  border-r border-black divide-x divide-black">
            <div class="w-64 text-xl text-center">Période</div>
            <div class="w-32 text-xl text-center">Nb Commandes</div>
            <div class="w-96 text-xl text-center">Quantité</div>
            <div class="w-28 text-xl text-center">Prix</div>
            <div class="w-32 text-xl text-center">CA</div>
        </div>
        <div class="flex w-1008 flex-wrap divide-x divide-black">
            @if ($orders->count())
                @foreach($orders as $order)
                    <div class="w-64 text-xl text-center border-l border-black">
                        @isset($order->periode)
                            {{$order->periode}}        
                        @else
                            @isset($periode)
                                {{$periode}} 
                            @endisset
                        @endisset
                    </div>
                    <div class="w-32 text-xl text-center">{{$order->nbOrders}}</div>
                    <div class="w-96 text-xl text-center">{{$order->quantity}}</div>
                    <div class="w-28 text-xl text-center">{{$order->caTTC}} €</div>
                    <div class="w-32 text-xl text-center">{{$order->caHT}} €</div>
                @endforeach
        </div>
        <div class="flex w-1008 flex-wrap border-t border-b border-black divide-x divide-black">
            @foreach($totauxOrders as $totauxOrder)
                    <div class="w-64 text-xl text-center border-l border-black">Totaux</div>
                    <div class="w-32 text-xl text-center">{{$totauxOrder->nbOrders}}</div>
                     <div class="w-96 text-xl text-center">{{$totauxOrder->quantity}}</div>
                    <div class="w-28 text-xl text-center">{{$totauxOrder->caTTC}} €</div>
                    <div class="w-32 text-xl text-center">{{$totauxOrder->caHT}} €</div>
            @endforeach
            @endif 
        </div>

    </div>
        <!-- Début script JavaScript -->
        <div id="linechart" class="w-full h-full"></div>

        <script type="text/javascript">
            var population = <?php echo $population; ?>;
            console.log(population);

            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(lineChart);
    
            function lineChart() {
                var data = google.visualization.arrayToDataTable(population);
                var options = {
                    title : 'Statistique des ventes',
                    vAxis: {title: "Période"},
                    hAxis: {title: "Chiffre d'affaires Hors Taxe"},
                    seriesType: 'bars',
                    series: {3: {type: 'line'}}
                };
                var chart = new google.visualization.ComboChart(document.getElementById('linechart'));

                try {
                    chart.draw(data, options);
                } catch (err) {
                    console.log('Pas de données à afficher');
                }
            }        
        </script>
        

        @endsection