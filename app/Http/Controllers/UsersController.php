<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{

    public function index(){

        return view('dashboard.user');


    }


    public function dataUsers(){
        $users = User::all();
        return datatables::of($users)->make(true);
    }
}
