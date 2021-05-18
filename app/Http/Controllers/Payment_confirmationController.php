<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Order_detail;
use App\Product;
use App\Payment_confirmation;

class Payment_confirmationController extends Controller
{
    public function store(request $request){

            $order = Order::where('id',$request->order_id)->first();
            $order_detail = Order_detail::where('order_id',$request->order_id)->get();
            $stock = 0;
            foreach($order_detail as $detail){
                $product = Product::where('id',$detail->product_id)->first();
                $stock = ($product->stock - $detail->qty);
                $product->stock = $stock;
                $product->save();
            }

            $order->status = 1;
            $order->save();

            $payment = new Payment_confirmation;
            $payment->user_id = Auth::user()->id;
            $payment->order_id = $request->order_id;
            $payment->no_rekening = $request->noRek;
            $payment->nama_account = $request->name;
            $payment->tanggal_pembayaran = $request->tgl;
            $payment->save();

            return redirect('/orderList');

    }
}
