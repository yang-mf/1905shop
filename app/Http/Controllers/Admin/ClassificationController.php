<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Cache;

use App\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassPost;
use DB;
use Validator;
use App\Cal;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page=request()->page;
        $data=Cache::get('data_'.$page);
//        echo 'data_'.$page;
        if(!$data){
//            echo 'mam';
            $pagesize=config('app.pagesize');
            $data=Cal::paginate($pagesize);
            Cache::put('data_'.$page,$data,60);
        }

       return view('admin/class/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Cal::all();
        $data=getCateInfo($data);
//        print_r($data);die;
        if(!empty($data)){
            return view('admin/class/create',['data'=>$data]);
        }else{
            return view('admin/class/create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd('562');
        $post=$request->except(['_token']);
        //第三种验证
//        dd($post);
        $validator = Validator::make($request->all(), [
            'cate_name' => 'required',
        ],[
            'cate_name.required'=>'分类名称必填',
        ]);
        if ($validator->fails()) {
            return redirect('class/create')
                ->withErrors($validator)
                ->withInput();
        }

        $res=Cal::insert($post);
        if($res){
            return redirect('admin/class/index');
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
        $data=Cal::all();
        $date = DB::table('cate')->where('cate_id', $id)->first();
//        dd($data);
        return view('admin/class/update',['date'=>$date,'data'=>$data]);
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
        $post=$request->except('_token');
        //修改
        $data = Cal::where('cate_id',$id)->update($post);

        return redirect('admin/class/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$id){
            abort(404);
        }
        //DB删除
//        $res = DB::table('brands')->where('brand_id',$id)->delete();
        //ORM删除
//        $res= Brand::destroy($id);
        $res=Cal::where('cate_id',$id)->delete();

        if($res){
            return redirect('admin/class/index');
        }
    }
}
