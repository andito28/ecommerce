<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = Product::take(3)->inRandomOrder()->get();
        return view('welcome',compact('products'));
    }
}
