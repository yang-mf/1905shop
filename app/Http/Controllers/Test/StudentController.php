<?php

namespace App\Http\Controllers\Test;

use DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $page=request()->page;
//        $data=Cache::get('data_'.$page);
        $data=Redis::get('data_'.$page);
        dump($data);
        if(!$data){
            echo 'mam';
            $data=DB::table('new_student')->paginate(2);
//            Cache::put('data_'.$page,$data,10);
            $data=serialize($data);
            dump($data);
            Redis::set('data_'.$page,$data);
        }
        $data=unserialize($data);
        return view('test.index',['data'=>$data]);
    }
}
