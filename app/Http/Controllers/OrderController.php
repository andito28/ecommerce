<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_detail;
use App\Cart;
use Auth;

class OrderController extends Controller
{
    public function index(){

        $cart = Cart::where('user_id',Auth::user()->id)->get();

        if($cart->count() < 1){
            return redirect()->route('shop');
        }else{
            return view('order.index',compact('cart'));
        }

    }

    public function store(request $request){

        $carts = Cart::where('user_id',Auth::user()->id);

        $cart_user = $carts->get();

        $request->validate([
            'recipient_name' => 'required' ,
            'recipient_address' =>'required',
            'number_tlp' => 'required'
        ]);


        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->number_tlp = $request->number_tlp;
        $order->recipient_name = $request->recipient_name;
        $order->recipient_address = $request->recipient_address;
        $order->status = '0';
        $order->save();

        foreach($cart_user as $cart){

            $order_detail = new Order_detail;
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $cart->product_id;
            $order_detail->qty = $cart->qty;
            $order_detail->save();
        }

        $carts->delete();

        return redirect()->route('detailOrder',['id' => $order->id]);
    }



    public function detail($id){

        $detailOrder = Order_detail::where('order_id',$id)->get();
        return view('order.order_detail',compact('detailOrder'));
    }






}
