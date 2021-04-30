<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Payment_confirmation;

class Payment_confirmationController extends Controller
{
    public function store(request $request){

            $order = Order::where('id',$request->order_id)->first();
            $order->status = 1;
            $order->save();

            $payment = new Payment_confirmation;
            $payment->user_id = Auth::user()->id;
            $payment->no_rekening = $request->noRek;
            $payment->nama_account = $request->name;
            $payment->tanggal_pembayaran = $request->tgl;
            $payment->save();

            return redirect('/orderList');

    }
}
