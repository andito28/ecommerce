<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Cart;
use App\Transaction;
use App\Transaction_detail;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store()
    {
       $carts = Cart::where('user_id',Auth::user()->id);

       $cartUser = $carts->get();

       $transaction = Transaction::create([
            'user_id' => Auth::user()->id
        ]);


        foreach($cartUser as $cart)
        {
            Transaction_detail::create([
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
        $transactions = Transaction::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('checkout.index',compact('transactions'));
    }


    public function transactions_detail($id)
    {
        $transactions_detail = Transaction_detail::where('transaction_id',$id)->get();

        return view('checkout.transaction_detail',compact('transactions_detail'));

    }
}
