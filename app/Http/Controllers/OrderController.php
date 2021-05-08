<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_detail;
use App\Cart;
use App\Payment_confirmation;
use Auth;
use Yajra\Datatables\Datatables;

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

    public function orderList(){

        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();

        return view('order.order_list',compact('orders'));

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
        $order = Order::where('id',$id)->first();
        $detailOrder = Order_detail::where('order_id',$id)->get();
        return view('order.order_detail',compact('detailOrder','order'));
    }


    public function order(){
        return view('dashboard.order');
    }

    public function dataOrder(){

        $order = Order::orderBy('created_at','DESC')->get();
        return Datatables::of($order)
        ->addColumn('status',function($data){

            switch($data->status){
                case 0: $data->status = "<span class='badge badge-pill badge-primary p-2'> Menunggu pembayaran </span>";
                break;
                case 1: $data->status = "<span class='badge badge-pill badge-warning p-2'> Pembayaran sedang di validasi </span>";
                break;
                case 2: $data->status ="<span class='badge badge-pill badge-success p-2'> Pembayaran Lunas </span>";
                break;
                default: $data->status = "<span class='badge badge-pill badge-danger p-2'> Pembayaran di tolak </span>";
            }
            return $data->status;
        })
        ->addColumn('action',function($data){
            // $button = "<a href='javascript:void(0)' class='btn btn-success btn-sm update' id='$data->id'> Update Status </a>";
            // $button .= '&nbsp;&nbsp;';
            $button =  "<a href='javascript:void(0)' class='btn btn-primary btn-sm detail' id='$data->id'> Detail Pesanan </a>";
            return $button;
        })

        ->addColumn('nama',function($data){
            $nama = $data->User->name;
            return $nama;
        })
        ->RawColumns(["status","action","nama"])
        ->addIndexColumn()
        ->make(true);
    }


    // public function edit($id){

    //     $post = Order::where('id',$id)->first();
    //     return response()->json($post);


    // }


    public function update(request $request){

        $post = Order::where('id',$request->id)->update([
            'status' => $request->status
        ]);;

        return response()->json($post);

    }


    public function detailPesanan($id){

        $payment = Payment_confirmation::where('order_id',$id)->first();
        $detailOrder = Order_detail::with('Product')->where('order_id',$id)->get();
        $order = Order::with('User')->where('id',$id)->first();

        return response()->json([
            'detail_order' => $detailOrder,
            'order' => $order,
            'payment' => $payment
        ]);
    }






}
