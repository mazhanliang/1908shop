<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pinpai;
class Pinpaicontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=Pinpai::get();
        return view('pinpai/index',['data'=>$data]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pinpai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data=$request->except('_token');
        if($request->hasFile('logo')){
            $data['logo']=$this->upload('logo');    
        }
        $res=Pinpai::insert($data);
        if($res){
            return redirect('pinpai/index');
        }
    }

    public function upload($filename){
        if(request()->file($filename)->isvalid()){
            $photo = request()->file($filename);
            //上传
            $store_result=$photo->store('logo');
            return $store_result;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Pinpai::find($id);
        return view('pinpai.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $data=$request->except('_token');
         if($request->hasFile('logo')){
            $data['logo']=$this->upload('logo');    
        }
       
        $res=Pinpai::where('id',$id)->update($data);
        if($res!==false){
            return redirect('pinpai/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Pinpai::destroy($id);
        if($res){
            return redirect('pinpai/index');
        }
    }
}
