<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        return view('user.index');
    }
    function index_do(Request $request){
       $data=$request->all();
       dd($data);
    }
    function add(){
        echo '商品详情页';
    }
    function adds(){
        return view('user.show');
    }
}
