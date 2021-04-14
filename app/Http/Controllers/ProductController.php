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


    public function store(request $request){


        $post = Product::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->nameProduct,
                'categori_id' => $request->categori_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'desc' => $request->desc,
                'images' => $request->image

            ]
        );

        // $post = new Product;
        // $post->name = $request->nameProduct;
        // $post->categori_id = 1;
        // $post->price = '1';
        // $post->stock = '1';
        // $post->desc = 'ffgfgfghf';
        // $post->images = 'img.jpg';
        // $post->save();

        return response()->json($post);

        // $id = $request->id;

        // $post = Product::updateOrCreate(
        //     ['id' => $id],
        //     [
        //         'name' => $request->nameProduct,
        //         'kategori_id' => $request->kategori_id,
        //         'price' => $request->price,
        //         'stock' => $request->stock,
        //         'images' => $request->image

        //     ]
        // );

        // return response()->json($post);

    }
}
