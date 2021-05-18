<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $order = Order::whereDay('created_at', date('d'))->count();
        return view('dashboard.dashboard',compact('user','product','categori','order'));
    }
}
