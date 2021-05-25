<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Banner;
use Yajra\DataTables\DataTables;

class BannerController extends Controller
{
    public function index(){
        $banner = Banner::all();
        return view('dashboard.banner',compact('banner'));
    }

    public function dataBanner(){
        $banner = Banner::all();
        return DataTables::of($banner)
        ->addColumn('action',function($data){
        $button = "<a href='javascript:void(0)' class='btn btn-success btn-sm editbanner' id='$data->id'> Edit </a>";
        $button .= '&nbsp;&nbsp;';
        $button.= "<a href='javascript:void(0)' class='btn btn-danger btn-sm deletebanner' id='$data->id'> Hapus </a>";
        return $button;
        })
        ->addColumn('image',function($data){
            $url = asset('storage/banner/'.$data->banner);
            $image = "<img src='$url' style='width:500px;height:120px;'>";
            return $image;
        })
        ->rawColumns(['image','action'])
        ->make(true);
    }

    public function store(request $request){

        $data = Banner::where('id',$request->id)->first();

        if($request->id == NULL){$request->validate([
            'banner' => 'required|image|mimes:jpeg,png,jpg,|max:2048',
            'url' => 'required'
        ]);
        }

        $banner = $request->file('banner');

        if($request->file('banner') !=NULL && $request->id == NULL){
            $file_name = date('YmdHis').".".$banner->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('public/banner/',$banner,$file_name);
        }elseif($request->file('banner') !=NULL && $data->id == $request->id){
            storage::delete('/public/banner/'.$data->banner);
            $file_name = date('YmdHis').".".$banner->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('public/banner/',$banner,$file_name);
        }else{
            $file_name = $data->banner;
        }

       $post = Banner::updateOrCreate(
                ['id' => $request->id,],
                ['banner' => $file_name,
                'url' => $request->url]
                );

        return response()->json($post);
    }

    public function edit($id){

        $post = Banner::where('id',$id)->first();
        return response()->json($post);
    }

    public function delete($id){

        $post = Banner::where('id',$id)->first();
        storage::delete('public/banner/'.$post->banner);
        $post->delete();

        return response()->json($post);
    }
}
