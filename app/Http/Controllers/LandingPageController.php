<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Product;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = ['sfkd','fdsds','fdsds'];
        return view('welcome',compact('products'));
    }
}
