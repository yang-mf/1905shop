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

//Route::get('/a', function () {
//    return view('welcome');
//});
//
////必填
//Route::get('ee/{id}',function($id){
//    echo $id;
//});
//
////可选
//Route::get('ww/{id?}',function($id=2){
//    echo $id;
//});

//cookie
Route::get('/setcookie',function (){
    //队列设置cookie
//    Cookie::queue(Cookie::make('name','fdgdf',2));
    Cookie::queue('name','edsfgf',3);

    //获取
//    echo request()->cookie('name');
//    $name=Illuminate\Support\Facades\Cookie::get('name');
//    echo $name;
    //设置
//    return response('欢迎来到 Laravel 学院')->cookie('name', '学院君');
});
Route::get('/getcookie',function (){
    //队列设置cookie
//    Cookie::queue(Cookie::make('name','fdgdf',2));
//    Cookie::queue('name','edsfgf',3);

    //获取
//    echo request()->cookie('name');
    $name=Illuminate\Support\Facades\Cookie::get('name');
    echo $name;
    //设置
//    return response('欢迎来到 Laravel 学院')->cookie('name', '学院君');
});



//admin后台
Route::domain('lava.com')->group(function () {
    Route::prefix('brand')->group(function () {
        //品牌
        Route::get('create','Admin\BrandController@create');
        Route::post('store','Admin\BrandController@store');
        Route::get('index','Admin\BrandController@index');
        Route::get('delete/{id}','Admin\BrandController@destroy');
        Route::get('edit/{id}','Admin\BrandController@edit');
        Route::post('update/{id}','Admin\BrandController@update');
    });

    //index后台
    Route::prefix('index')->group(function () {
        //商品
        Route::get('create','Admin\IndexController@create');
        Route::post('store','Admin\IndexController@store');
        Route::get('index','Admin\IndexController@index');
        Route::get('delete/{id}','Admin\IndexController@destroy');
        Route::get('edit/{id}','Admin\IndexController@edit');
        Route::post('update/{id}','Admin\IndexController@update');
    });

    //分类classification
    Route::prefix('class')->group(function () {
        //分类
        Route::get('create','Admin\ClassificationController@create');
        Route::post('store','Admin\ClassificationController@store');
        Route::get('index','Admin\ClassificationController@index');
        Route::get('delete/{id}','Admin\ClassificationController@destroy');
        Route::get('edit/{id}','Admin\ClassificationController@edit');
        Route::post('update/{id}','Admin\ClassificationController@update');
    });

    //用户
    Route::prefix('users')->group(function (){
        //注册用户
        Route::get('create','Admin\UsersController@create');
        //用户登录
        Route::get('index','Admin\UsersController@index');
        Route::post('store','Admin\UsersController@store');
        Route::get('delete/{id}','Admin\UsersController@delete');
        Route::get('edit/{id}','Admin\UsersController@edit');
        Route::post('update/{id}','Admin\UsersController@update');
    });
});

//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
//考试{
Route::get('test/login','Test\TestController@login');
Route::get('test/login_d','Test\TestController@login_d');

Route::prefix('test')->middleware('check')->group(function (){

    Route::get('create','Test\TestController@create');//->middleware('check');
    Route::get('title','Test\TestController@title');//->middleware('check');
    Route::post('store','Test\TestController@store');//->middleware('check');
    Route::get('index','Test\TestController@index');//->middleware('check');
//    Route::get('delete/{id}','Test\TestController@destroy');
    Route::post('delete','Test\TestController@delete');//->middleware('check');
    Route::get('edit/{id}','Test\TestController@edit');//->middleware('check');
    Route::post('update/{id}','Test\TestController@update');//->middleware('check');
});
//}


//前台
Route::get('/','Index\MainController@index');
Route::get('/login','Index\LoginController@login');
Route::get('/logindo','Index\LoginController@logindo');
Route::get('/reg','Index\LoginController@reg');
Route::get('/user','Index\LoginController@show');

Route::get('/prolist','Index\GoodsController@index');
Route::get('/proinfo/{goods_id}','Index\GoodsController@proinfo');
Route::get('/car','Index\GoodsController@car');
Route::get('/pay','Index\GoodsController@pay');
Route::get('/success','Index\GoodsController@success');
Route::get('/buy','Index\GoodsController@buy');
Route::post('/changenum','Index\GoodsController@changenum');
Route::post('/jiesuan','Index\GoodsController@jiesuan');
Route::post('/getprice','Index\GoodsController@getprice');
Route::get('/send','Index\LoginController@send');



Route::get('/test/index','Test\StudentController@index');
















