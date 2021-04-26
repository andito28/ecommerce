<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categori;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index(request $request,$id = null)
    {
        // $categoris = DB::table('categoris')->simplePaginate(8);
        $categoris = Categori::all()->random(9);
        $products  = Product::where('name','LIKE','%'.$request->search.'%')->simplePaginate(6);
        return view('shop.index',compact('products','categoris','id'));
    }

    public function show($id)
    {
        // $categoris = DB::table('categoris')->simplePaginate(8);
        $categoris = Categori::all()->random(9);
        $product = Product::where('id',$id)->first();
        return view('shop.show',compact('product','categoris'));
    }

    public function categori($id)
    {
        $products = Product::where('categori_id',$id)->simplePaginate(6);
        $categoris = Categori::all()->random(9);
        // $categoris = DB::table('categoris')->simplePaginate(8);
        return view('shop.index',compact('products','categoris','id'));
    }
}
