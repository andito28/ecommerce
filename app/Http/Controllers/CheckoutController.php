<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\cart;
use App\transaction;
use App\transaction_detail;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store()
    {
       $carts = cart::where('user_id',Auth::user()->id);

       $cartUser = $carts->get();

       $transaction = transaction::create([
            'user_id' => Auth::user()->id
        ]);


        foreach($cartUser as $cart)
        {
            transaction_detail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty
            ]);

        }

        $carts->delete();

       return redirect('/incheck');
    }


    public function index()
    {
        $transactions = transaction::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('checkout.index',compact('transactions'));
    }


    public function transactions_detail($id)
    {
        $transactions_detail = transaction_detail::where('transaction_id',$id)->get();

        return view('checkout.transaction_detail',compact('transactions_detail'));

    }
}
