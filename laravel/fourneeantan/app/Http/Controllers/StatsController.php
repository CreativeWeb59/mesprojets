<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index() {
        // Stats de la journée en cours
        $orders = $this->showDay();
        $periode = "Journée en cours";
        $cxDate = "day";

        $date_jour = date('Y-m-d');
        
        // creation du json pour le graphique
        $res[] = ['caHT', 'nbOrders'];
        foreach($orders as $key => $value) {
            $res[++$key] = [$value->caHT, $value->nbOrders];
        }

        // Ligne des totaux
        $totauxOrders = $orders;
        $population = $orders;

        return view('auth.admin.stats.ca', compact('orders','totauxOrders','periode','cxDate'))->with('population', json_encode($res));
    }

    public function show(request $request) {
        
        //dd($request->typeStats);

        $cxTable = 'Order';

        // Switch suivant la valeur du select
        $cxDate = $request->cxDate;
        $date_mois = date('Y-m');

//        dd($date_mois);
        // date du premier jour de la semaine
        $fDayWeek = now()->startOfWeek()->format('Y-m-d');
        $lDayWeek = now()->startOfWeek()->subDays(7)->format('Y-m-d');

        switch($cxDate){
            case('day'):
                $orders = $this->showDay();
                $periode = "Journée en cours";
                $totauxOrders = $orders;
                break;
            case('yesterday'):
                $orders = $this->showYesterday();
                $periode = "Hier";
                $totauxOrders = $orders;
                break;
            case('week'):
                $orders = $this->showWeek($fDayWeek);

                // Ligne des totaux
                $totauxOrders = Order::select([
                    DB::raw('COUNT(id) as nbOrders'),
                    DB::raw('SUM(item_count) as quantity'),
                    DB::raw('SUM(total) as caTTC'),
                    DB::raw('SUM(totalHT) as caHT')
                ])
                ->where('status', '=', 'Terminee')
                ->where('created_at', '>=', $fDayWeek.'-%')
                ->get();
                $periode = "Semaine";
                break;
            case('lastWeek'):
                $orders = $this->showLastWeek($lDayWeek, $fDayWeek);
                // Ligne des totaux
                $totauxOrders = Order::select([
                    DB::raw('COUNT(id) as nbOrders'),
                    DB::raw('SUM(item_count) as quantity'),
                    DB::raw('SUM(total) as caTTC'),
                    DB::raw('SUM(totalHT) as caHT')
                ])
                ->where('status', '=', 'Terminee')
                ->where('created_at', '>=', $lDayWeek.'-%')
                ->where('created_at', '<', $fDayWeek.'-%')
                ->get();
                $periode = "Semaine";
                break;
            case('month'):
                $orders = $this->showMonth($date_mois);
                // Ligne des totaux
                $totauxOrders = Order::select([
                    DB::raw('COUNT(id) as nbOrders'),
                    DB::raw('SUM(item_count) as quantity'),
                    DB::raw('SUM(total) as caTTC'),
                    DB::raw('SUM(totalHT) as caHT')
                ])
                ->where('status', '=', 'Terminee')
                ->where('created_at', 'like', $date_mois.'-%')
                ->get();

                $periode = "Mois";
                break;
            case('year'):
                $orders = $this->showYear();
                        // Ligne des totaux
                $totauxOrders = Order::select([
                    DB::raw('COUNT(id) as nbOrders'),
                    DB::raw('SUM(item_count) as quantity'),
                    DB::raw('SUM(total) as caTTC'),
                    DB::raw('SUM(totalHT) as caHT')
                ])
                ->where('status', '=', 'Terminee')
                ->get();
                $periode = "Année";
                break;                                
            default:
                $orders = $this->showDay();
                $totauxOrders = $orders;
                $periode = "Tous";
            }

        // Affichage par mois
        // DB::raw("DATE_FORMAT(created_at, '%d') as month"),
        // ->groupBy('month')
        
            // creation du json pour le graphique
            $res[] = ['periode', 'caHT'];
            foreach($orders as $key => $value) {
                $res[++$key] = [ $value->periode, $value->caHT];
            }

        $population = $orders;
        return view('auth.admin.stats.ca', compact('orders','totauxOrders','cxDate','periode'))->with('population', json_encode($res));
    }

    public function showDay(){
        // Retourne le tri sur la journée en cours
        $date_jour = date('Y-m-d');
        
        return Order::select([
            DB::raw('COUNT(id) as nbOrders'),
            DB::raw('SUM(item_count) as quantity'),
            DB::raw('SUM(total) as caTTC'),
            DB::raw('SUM(totalHT) as caHT')
             ])
             ->where('status', '=', 'Terminee')
             ->where('created_at', 'LIKE', $date_jour.'%')
             ->get();
    }

    public function showYesterday(){
        // Retourne le tri sur la journée en cours
//        $date_jour = date('Y-m-d');

        $date_jour = Carbon::yesterday()->format('Y-m-d');

        return Order::select([
            DB::raw('COUNT(id) as nbOrders'),
            DB::raw('SUM(item_count) as quantity'),
            DB::raw('SUM(total) as caTTC'),
            DB::raw('SUM(totalHT) as caHT')
             ])
             ->where('status', '=', 'Terminee')
             ->where('created_at', 'LIKE', $date_jour.'%')
             ->get();
    }

    public function showMonth($date_mois){
        // Retourne jour par jour de le mois en cours
        return Order::select([
            DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y') as periode"),
//            DB::raw("MONTH(created_at) as periode"),
            DB::raw('COUNT(id) as nbOrders'),
            DB::raw('SUM(item_count) as quantity'),
            DB::raw('SUM(total) as caTTC'),
            DB::raw('SUM(totalHT) as caHT')
             ])
             ->where('status', '=', 'Terminee')
             ->where('created_at', 'like', $date_mois.'-%')
             ->groupBy('periode')
             ->groupBy(DB::raw("MONTH(created_at)"))
            ->get();

    }

    public function showYear(){
        // Retourne mois par mois de l'année en cours
        
        return Order::select([
            DB::raw("DATE_FORMAT(created_at, '%m-%Y') as periode"),
   //         DB::raw("year(created_at) as year"),
            DB::raw('COUNT(id) as nbOrders'),
            DB::raw('SUM(item_count) as quantity'),
            DB::raw('SUM(total) as caTTC'),
            DB::raw('SUM(totalHT) as caHT')
             ])
             ->where('status', '=', 'Terminee')
             ->groupBy('periode')
             ->get();
    }

    public function showWeek($fDayWeek){
        
        return Order::select([
            DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y') as periode"),
            DB::raw('COUNT(id) as nbOrders'),
            DB::raw('SUM(item_count) as quantity'),
            DB::raw('SUM(total) as caTTC'),
            DB::raw('SUM(totalHT) as caHT')
             ])
             ->where('status', '=', 'Terminee')
             ->where('created_at', '>=', $fDayWeek.'-%')
             ->groupBy('periode')
             ->get();
    }

    public function showLastWeek($lDayWeek, $fDayWeek){
        return Order::select([
            DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y') as periode"),
            DB::raw('COUNT(id) as nbOrders'),
            DB::raw('SUM(item_count) as quantity'),
            DB::raw('SUM(total) as caTTC'),
            DB::raw('SUM(totalHT) as caHT')
             ])
             ->where('status', '=', 'Terminee')
             ->where('created_at', '>=', $lDayWeek.'-%')
             ->where('created_at', '<', $fDayWeek.'-%')
             ->groupBy('periode')
             ->get();
    }
}


