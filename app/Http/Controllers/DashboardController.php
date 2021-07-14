<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Categori;
use App\Product;
use App\Order;
use App\User;


class DashboardController extends Controller
{
    public function index(){
        $user = User::count();
        $product = Product::count();
        $categori = Categori::count();
        $order = Order::whereDate('created_at', date('Y-m-d'))->count();


        return view('dashboard.dashboard',compact('user','product','categori','order'));

    }
}
