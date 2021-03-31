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

        $dataProduct = Product::all();
        return Datatables::of($dataProduct)
        ->addColumn('gambar',function($data){

            $url = asset('storage/images/'.$data->images);

            $image = "<img src='$url' style='width:100px;height:100px;'>";

            return $image;
        })
        ->addColumn('action',function($data){
            $button = "<a href='javascript:void(0)' data-id='$data->id' class='btn btn-success btn-sm edit-product'>Edit</a>";
            $button .= '&nbsp;&nbsp;';
            $button .= '<button type="button"  id="' . $data->id . '" class="btn btn-danger btn-sm delete-product">Delete</button>';
            return $button;
        })
        ->rawColumns(['gambar','action'])
        ->addIndexColumn()
        ->make(true);

    }
}
