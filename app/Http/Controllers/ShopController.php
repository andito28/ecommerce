<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categori;

class ShopController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index(request $request,$id = null)
    {
        $categoris = Categori::all();
        $products  = Product::where('name','LIKE','%'.$request->search.'%')->paginate(6);
        return view('shop.index',compact('products','categoris','id'));
    }

    public function show($id)
    {
        $categoris = Categori::all();
        $product = Product::where('id',$id)->first();
        return view('shop.show',compact('product','categoris'));
    }

    public function categori($id)
    {
        $products = Product::where('categori_id',$id)->paginate(6);
        $categoris = Categori::all();
        return view('shop.index',compact('products','categoris','id'));
    }
}
