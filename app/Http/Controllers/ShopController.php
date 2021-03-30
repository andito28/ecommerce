<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\categori;

class ShopController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index(request $request,$id = null)
    {
        $categoris = categori::all();
        $products  = product::where('name','LIKE','%'.$request->search.'%')->paginate(6);
        return view('shop.index',compact('products','categoris','id'));
    }

    public function show($id)
    {
        $categoris = categori::all();
        $product = product::where('id',$id)->first();
        return view('shop.show',compact('product','categoris'));
    }

    public function categori($id)
    {
        $products = product::where('categori_id',$id)->paginate(6);
        $categoris = categori::all();
        return view('shop.index',compact('products','categoris','id'));
    }
}
