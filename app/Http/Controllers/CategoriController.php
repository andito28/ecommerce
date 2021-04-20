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
            $button = "<a href='javascript:void(0)' class='edit-categori' id='$data->id'> Edit </a> ";
            return $button;
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }

}
