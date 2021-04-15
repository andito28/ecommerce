<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Yajra\Datatables\Datatables;
use Storage;

class ProductController extends Controller
{
    public function index(){

        return view('dashboard.product');
    }


    public function dataProduct(){

        $dataProduct = Product::all();
        return Datatables::of($dataProduct)
        ->addColumn('gambar',function($data){

            $url = asset('storage/Product/'.$data->images);

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


        $request->validate([
            'images' => 'image|mimes:jpeg,png,jpg,|max:2048'
        ]);


        $id_product = $request->id;
        $files = $request->file('image');
        $file_name = date('YmdHis') . "." . $files->getClientOriginalExtension();

        if($id_product == NULL){

            storage::disk('local')->putFileAs('public/product',$files , $file_name);
        }

        // if($request->file('image')){
        //     Storage::disk('local')->putFileAs('public/images/'.$request->image);
        // }


        $post = Product::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->nameProduct,
                'categori_id' => $request->categori_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'desc' => $request->desc,
                'images' =>$file_name

            ]
        );

        return response()->json($post);

    }
}
