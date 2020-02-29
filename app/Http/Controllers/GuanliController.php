<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 // use DB;
use App\Guanli;
use App\Http\Requests\StorePeoplePost;
use Validator;
use Illuminate\Validation\Rule;
class GuanliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biaoti=Request()->biaoti??'';
        $fenlei=Request()->fenlei??'';
        $where=[];
        if($biaoti){
            $where[]=['biaoti','like',"%$biaoti%"];
        }
        if($fenlei){
            $where[]=['fenlei','like',"%$fenlei%"];
        }
         
        $pageSize=config('app.pageSize');
        $data=Guanli::where($where)->orderby('w_id','desc')->paginate($pageSize);
        return view('guanli.index',['data'=>$data,'biaoti'=>$biaoti,'fenlei'=>$fenlei]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guanli.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
       // 第一种验证
        $request->validate([
            'biaoti'=>'required|unique:guanli|regex:/^[\x{4e00}-\x{9fa5}[A-Za-z0-9_-]{2,12}$/u',
            'fenlei' => 'required',
            'zhongyaoxing' => 'required',
            'shifou' => 'required',
        ],[ 
            'biaoti.required'=>'名字不能为空',
            'biaoti.unique'=>'名字已存在',
            'biaoti.regex'=>'名字由中文 字母 数字 下划线组成',
            
            'fenlei.required'=>'分类不能为空',
            'zhongyaoxing.required'=>'是否显示不能为空',
            'shifou.required'=>' 文章重要性不能为空',
        ]);


        $data=$request->except('_token');

        
        $data['time']=time();
        if($request->hasFile('img')){
            $data['img']=$this->upload('img');    
        }
        //$res=DB::table('people')->insert($data);
       $res=Guanli::create($data);
      
        if($res){
            return redirect('/guanli/index');
        }
    }
    //上传文件
    public function upload($filename){
        //判断上传过程是否有错误
        if(request()->file($filename)->isvalid()){
            //接受值
            $photo = request()->file($filename);
            //上传
            $store_result=$photo->store('uploads');
            return $store_result;
        }
        exit('上传文件出现错误或没有上传文件');
    }

        public function weiyi(){
            $biaoti=request()->biaoti;
            $where=[];
            if($biaoti){
                $where[]=['biaoti','=',$biaoti];
            }
            $id=request()->id;
            if($id){
                $where[]=['w_id','!=',$id];
            }
            $count=Guanli::where($where)->count();
            echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
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
        $res=Guanli::where('w_id',$id)->first();
        return view('guanli.edit',['res'=>$res]);
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
            'biaoti'=>['required',
            'regex:/^[\x{4e00}-\x{9fa5}[A-Za-z0-9_-]{2,12}$/u',
            Rule::unique('guanli')->ignore($id,'w_id'),
        ],
            'fenlei' => 'required',
            'zhongyaoxing' => 'required',
            'shifou' => 'required',
        ],[ 
            'biaoti.required'=>'名字不能为空',
            'biaoti.unique'=>'名字已存在',
            'biaoti.regex'=>'名字由中文 字母 数字 下划线组成',
            
            'fenlei.required'=>'分类不能为空',
            'zhongyaoxing.required'=>'是否显示不能为空',
            'shifou.required'=>' 文章重要性不能为空',
        ]);
         $data=$request->except('_token');
         if($request->hasFile('img')){
            $data['img']=$this->upload('img');    
        }
     
        $res=Guanli::where('w_id',$id)->update($data);
        if($res!==false){
            return redirect('/guanli/index');
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
        $res=Guanli::where('w_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}
