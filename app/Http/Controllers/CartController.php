<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use Auth;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($status = null)
    {
        $carts = cart::where('user_id',Auth::user()->id)->get();

           return view('cart.index',compact('carts'));

    }

    public function store(request $request)
    {

        $duplicate = cart::where('product_id',$request->product_id)->first();

        if($duplicate)
        {
            return redirect('/cart')->with('delete','Barang sudah ada di cart');
        }

        cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'qty' => 1
        ]);

        return redirect('/cart');
    }

    public function update(request $request,$id)
    {
        cart::where('id',$id)->update([
            'qty' => $request->quantity
        ]);

        return response()->json();
    }

    public function delete($id)
    {
        cart::where('id',$id)->delete();
        return redirect('/cart')->with('delete','Data berhasil di hapus');
    }
}
