<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 // use DB;
use App\GoodsClass;
use App\Http\Requests\StorePeoplePost;
use Validator;
use Illuminate\Validation\Rule;
class GoodsClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $cate=GoodsClass::get();
        $cate=CreateTree($cate);
        return view('gclass.index',['cate'=>$cate]);
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
        return view('gclass.create',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function CreateTree($data,$parent_id=0,$level=0){
        if(!$data){
            return;
        }
        static $newarray=[];
        foreach($data as $k=>$v){
            if($v->parent_id==$parent_id){
                $v->level=$level;
                $newarray[]=$v;

                CreateTree($data,$v->c_id,$level+1);
            }
        }
        return $newarray;
    }

    public function store(request $request)
    {
       // 第一种验证
        $request->validate([
            'c_name'=>'required',
        ],[ 
            'c_name.required'=>'分类名称不能为空',    
        ]);
        $data=$request->except('_token');
        //$res=DB::table('people')->insert($data);
       $res=GoodsClass::create($data);
      
        if($res){
            return redirect('/goods/index');
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
      
        $res=GoodsClass::where('c_id',$id)->first();
        $cate=GoodsClass::get();
        $cate=CreateTree($cate);
        return view('gclass.edit',['res'=>$res,'cate'=>$cate]);
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
        $request->validate([
            'c_name'=>'required',        
        ],[ 
            'c_name.required'=>'分类名称不能为空',    
        ]);

        $data=$request->except('_token');
         
        $res=GoodsClass::where('c_id',$id)->update($data);
        if($res!==false){
            return redirect('/goods/index');
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
        $res=GoodsClass::where('c_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}
