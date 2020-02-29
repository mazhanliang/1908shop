<?php
/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */

 
 //无限极分类
 function CreateTree($data,$parent_id=0,$level=0){
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

//上传文件
  function upload($filename){
    if(request()->file($filename)->isvalid()){
        $photo = request()->file($filename);
        //上传
        $store_result=$photo->store('uploads');
        return $store_result;
    }
}

//多文件上传
function Moreupload($filename){
    $photo = request()->file($filename);
    if(!is_array($photo)){
        return;
    }

    foreach($photo as $k=>$v ){
        if($v->isvalid()){
            $store_result[]=$v->store('uploads');   
        }  
}
return $store_result;
}

//验证码
function sendSms($u_tel,$code){

    AlibabaCloud::accessKeyClient('LTAI4FvMaWpg24zs59a7WNWZ','DFhJARhWYDHs7kAFZLESOUj4KPmTIF')
                            ->regionId('cn-hangzhou')
                            ->asDefaultClient();

    try {
        $result = AlibabaCloud::rpc()
                              ->product('Dysmsapi')
                              // ->scheme('https') // https | http
                              ->version('2017-05-25')
                              ->action('SendSms')
                              ->method('POST')
                              ->host('dysmsapi.aliyuncs.com')
                              ->options([
                                            'query' => [
                                              'RegionId' => "cn-hangzhou",
                                              'PhoneNumbers' => $u_tel,
                                              'SignName' => "幸运的马良",
                                              'TemplateCode' => "SMS_184105154",
                                              'TemplateParam' => "{code:$code}",
                                            ],
                                        ])
                              ->request();
        return $result->toArray();
    } catch (ClientException $e) {
        return $e->getErrorMessage();
    } catch (ServerException $e) {
        return $e->getErrorMessage();
    }
}


?>