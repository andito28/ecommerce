<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = Product::take(6)->inRandomOrder()->get();
        return view('welcome',compact('products'));
    }
}
