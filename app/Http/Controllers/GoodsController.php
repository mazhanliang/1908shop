<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 // use DB;
use App\GoodsClass;
use App\Goods;
use App\Pinpai;
use App\Http\Requests\StorePeoplePost;
use Validator;
use Illuminate\Validation\Rule;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize=config('app.pageSize');
        $cate=Goods::leftjoin('goods_class','goods.c_id','=','goods_class.c_id')
                    ->leftjoin('pinpai','goods.id','=','pinpai.id')
                    ->paginate($pageSize);
        
        return view('goods.index',['cate'=>$cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        $cate=GoodsClass::get();
        $cate=CreateTree($cate);
        $pinpai=Pinpai::get();
        
        return view('goods.create',['cate'=>$cate,'pinpai'=>$pinpai]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    public function store(request $request)
    {
       
        
        $data=$request->except('_token');
       $data['goods_huohao']=$this->CreateGoodshuohao();
        if($request->hasFile('goods_img')){
            $data['goods_img']=upload('goods_img');    
        }
    
        if($data['goods_imgs']){
            $photos=Moreupload('goods_imgs');
            $data['goods_imgs']= implode ('|',$photos);
        }
      
        $res=Goods::create($data);
        if($res){
            return redirect('/goodss/index');
        }
    }
    public  function CreateGoodshuohao(){
        return 'goods'.date('YmdHis').rand(1000,9999);
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
      
        $res=Goods::where('goods_id',$id)->first();
        $pinpai=pinpai::get();
        $cate=GoodsClass::get();
        $cate=CreateTree($cate);
        
        return view('goods.edit',['res'=>$res,'cate'=>$cate,'cate'=>$cate,'pinpai'=>$pinpai]);
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
         
        if($request->hasFile('goods_img')){
            $data['goods_img']=upload('goods_img');    
        }
    
        if($data['goods_imgs']){
            $photos=Moreupload('goods_imgs');
            $data['goods_imgs']= implode ('|',$photos);
        }
      
        $res=Goods::where('goods_id',$id)->update($data);
        if($res!==false){
            return redirect('/goodss/index');
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
        $res=Goods::where('goods_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}
