<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::defaultOrder()->get()->toTree();
        return view('pages.home', compact('categories'));
    }

    public function dashboard()
    {
        $status = "En cours";
        $orders = Order::with('user')->finishAll()->orderBy('created_at', 'ASC')->where('status',$status)->get();
        return view('auth.admin.adminDashboard', compact('orders','status'));
    }

    public function about()
    {

        return view('pages.about');
    }
}