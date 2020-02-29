<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//前台
Route::get('/','Index\IndexController@index');

Route::view('/login','index.login');
Route::get('/reg','Index\LoginsController@reg');
Route::post('/reg_do','Index\LoginsController@reg_do');
Route::post('/logindo','Index\LoginsController@logindo');
Route::get('/send','Index\LoginsController@ajaxsend');
Route::get('/setcookie','Index\IndexController@setcookie');
Route::get('/list','Index\IndexController@list');
Route::get('/proinfo{id}','Index\IndexController@proinfo');
Route::get('/car{id}','Index\IndexController@car');
Route::get('/pay','Index\IndexController@pay');
Route::get('/address','Index\IndexController@address');
Route::get('/success','Index\IndexController@success');

//邮件
Route::get('/sendemail','Index\LoginsController@sendemail');




Route::prefix('people')->group(function(){
Route::get('create','PeopleController@create');
Route::post('store','PeopleController@store');
Route::get('index','PeopleController@index');
Route::get('edit{id}','PeopleController@edit');
Route::post('update{id}','PeopleController@update');
Route::get('destroy{id}','PeopleController@destroy');
});
// Route::view('/login','login');
// Route::post('/logindo','LoginController@logindo');





Route::get('/create','ClassController@create');
Route::post('/store','ClassController@store');
Route::get('/index','ClassController@index');
Route::get('/destroy{id}','ClassController@destroy');
Route::get('/edit{id}','ClassController@edit');
Route::post('/update{id}','ClassController@update');
//品牌
Route::get('pinpai/create','PinpaiController@create');
Route::post('pinpai/store','PinpaiController@store');
Route::get('pinpai/index','PinpaiController@index');
Route::get('pinpai/destroy{id}','PinpaiController@destroy');
Route::get('pinpai/edit{id}','PinpaiController@edit');
Route::post('pinpai/update{id}','PinpaiController@update');

Route::prefix('guanli')->group(function(){
    Route::get('create','GuanliController@create');
    Route::post('store','GuanliController@store');
    Route::get('index','GuanliController@index');
    Route::get('edit{id}','GuanliController@edit');
    Route::post('update{id}','GuanliController@update');
    Route::get('destroy{id}','GuanliController@destroy');
    Route::get('weiyi','GuanliController@weiyi');
    
    });
    // Route::view('/login','login');
    // Route::post('/logindo','LoginController@logindo');
    
//商品的分类
    Route::prefix('goods')->group(function(){
        Route::get('create','GoodsClassController@create');
        Route::post('store','GoodsClassController@store');
        Route::get('index','GoodsClassController@index');
        Route::get('edit{id}','GoodsClassController@edit');
        Route::post('update{id}','GoodsClassController@update');
        Route::get('destroy{id}','GoodsClassController@destroy');
        });
//商品
        Route::prefix('goodss')->middleware('CheckLogin')->group(function(){
            Route::get('create','GoodsController@create');
            Route::post('store','GoodsController@store');
            Route::get('index','GoodsController@index');
            Route::get('edit{id}','GoodsController@edit');
            Route::post('update{id}','GoodsController@update');
            Route::get('destroy{id}','GoodsController@destroy');
            });
//管理员
Route::prefix('admin')->group(function(){
    Route::get('create','AdminController@create');
    Route::post('store','AdminController@store');
    Route::get('index','AdminController@index');
    Route::get('edit{id}','AdminController@edit');
    Route::post('update{id}','AdminController@update');
    Route::get('destroy{id}','AdminController@destroy');
    });  
    
    
    Route::prefix('ku')->group(function(){
        Route::get('create','KuguanliController@create');
        Route::post('store','KuguanliController@store');
        Route::get('index','KuguanliController@index');
        Route::get('index1','KuguanliController@index1');
        Route::get('edit{id}','KuguanliController@edit');
        Route::post('update{id}','KuguanliController@update');
        Route::get('destroy{id}','KuguanliController@destroy');
        });
     Route::view('/login1','ku/login');
     Route::post('/logindo1','LoginController@logindo');










// Route::get('/show', function () {
//        echo '这是商品详情页';
// });
// Route::get('/shows','UserController@add');


// Route::get('/User','UserController@index');
// Route::post('/index_do','UserController@index_do')->name('do');

// Route::get('/show/{id}', function ($id) {
//      echo '商品id是'.$id;
// });


// Route::get('/show/{id}/{name}', function ($id,$name) {
//     echo '商品id是：'.$id; 
//     echo  '关键字是：'.$name;
// })->where('name','[a-z]+');

// Route::view('/brand','user.show');
// Route::get('/brands','UserController@adds');

// Route::get('/cetegory', function () {
//     $fid='服装';
//     return view('user.index',['fid'=>$fid]);
// });  
  

