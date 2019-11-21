<?php

namespace App\Http\Controllers\Index;
use Illuminate\Support\Facades\Cache;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MainController extends Controller
{
    public function index(){
        $data=Cache::get('data');
//        echo 'data';
        if(!$data){
            $goodsInfo=DB::table('goods')->get();
            Cache::put('data',$data,60);
        }
        return view('index.index.index',['info'=>$goodsInfo]);
    }
}
