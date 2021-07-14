<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order_detail;
use App\Order;
use DB;
use Illuminate\Support\Facades\App;

class LaporanController extends Controller
{
    public function index(){

        $data = Order::with('Order_detail')->where('status',2)->take(10)->get();

        return view('dashboard.laporanPenjualan',compact('data'));
    }

    public function filterTgl(request $request){

       if($request->tgl1 && $request->tgl2){

        $data = Order::whereBetween(DB::raw('DATE(updated_at)'),
        [$request->tgl1,$request->tgl2])->where('status',2)->get();

       }else{

        $data = Order::with('Order_detail')->where('status',2)->take(10)->get();

       }

        return view('dashboard.laporanPenjualan',compact('data'));

    }
}
