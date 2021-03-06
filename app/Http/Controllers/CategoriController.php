<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categori;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\Datatables\Datatables;

class CategoriController extends Controller
{
    public function index(){
        return view('dashboard.categori');
    }

    public function dataCategori(){

        $dataCategori = Categori::all();

        return Datatables::of($dataCategori)
        ->addColumn('action',function($data){
            $button = "<a href='javascript:void(0)' class='btn btn-success btn-sm edit-categori' id='$data->id'> Edit </a> ";
            $button .= '&nbsp;&nbsp;';
            $button .= "<a href='javascript:void(0)' class='btn btn-danger btn-sm delete-categori' id='$data->id'> Delete </a> ";
            return $button;
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }


    public function store(request $request){


        $id = $request->id;

        $request->validate([
            'categori' => 'required'
        ]);

        $post = Categori::updateOrCreate(
            ['id' => $id],
            ['name' => $request->categori]
        );

        return response()->json($post);

    }



    public function edit($id){

        $post = Categori::where('id',$id)->first();
        return response()->json($post);

    }


    public function destroy($id){

        $post = Categori::where('id',$id)->delete();
        return response()->json($post);
    }

}
