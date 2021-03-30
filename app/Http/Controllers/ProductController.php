<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    public function index(){

        return view('dashboard.product');
    }


    public function dataProduct(){

        return Datatables::of(Product::query())->make(true);

    }
}
