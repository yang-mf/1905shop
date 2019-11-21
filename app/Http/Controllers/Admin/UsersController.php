<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Cache;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Http\Request;
use Validator;
use App\Users;
use DB;



class UsersController extends Controller
{
    //添加账号页面
    public function create()
    {
        $pagesize=config('app.pagesize');
//        echo 22;die;
        $data=Users::paginate($pagesize);
        return view('admin/users/create',['data'=>$data]);
    }
    //登录
    public function index(){
        $page=request()->page;
        $data=Cache::get('data_'.$page);
        echo 'data_'.$page;
        if(!$data) {
            echo 'mam';
            $pagesize = config('app.pagesize');
            $data = Users::paginate($pagesize);
            Cache::put('data_' . $page, $data, 60);
        }
        return view('admin/users/index',['data'=>$data]);
    }
    //添加数据库
    public function store(Request $request){
        $post=$request->except(['_token']);
        //第三种验证
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'pwd' => 'required',
        ],[
            'name.required'=>'账号必填',
            'pwd.required'=>'密码必填',
        ]);
        if ($validator->fails()) {
            return redirect('users/create')
                ->withErrors($validator)
                ->withInput();
        }
        //DB添加数据库
//        DB::table('users')->insert($post);
        //ORM
        $res=Users::insert($post);
        if($res){
            return redirect('admin/users/index');
        }
    }

    //删除
    public function delete($id){
        if(!$id){
            abort(404);
        }

        //DB删除
//        $res = DB::table('brands')->where('brand_id',$id)->delete();
        //ORM删除
//        $res= Brand::destroy($id);
        $res=Users::where('user_id',$id)->delete();

        if($res){
            return redirect('admin/users/index');
        }
    }

    //编辑
    public function edit($id){
        $data = DB::table('users')->where('user_id', $id)->first();
        return view('admin/users/update',['data'=>$data]);
    }
    //执行编辑
    public function update(Request $request, $id){
        $post=request()->except('_token');

        //修改
        $data = Users::where('user_id',$id)->update($post);

        return redirect('admin/users/index');
    }

}
