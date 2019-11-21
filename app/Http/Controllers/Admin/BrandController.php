<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use DB;
use Validator;

use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *显示列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        session(['user'=>'etrtjj']);
//        echo request()->session()->pull('user');
//        \request()->session()->put('name','etnyhfgbdfsv');
//        dump(session('name'));
//        dump(session('user')) ;die;
//        dump( request()->session()->all());die;
//        $data=DB::table('brands')->get();
        $word=\request()->word;
        $page=request()->page;
        $data=Cache::get('data_'.$page.'_'.$word);
        echo 'data_'.$page.'_'.$word;
        if(!$data){
            dump('mam');
            $pagesize=config('app.pagesize');
            $word=\request()->word;
            $where=[];
            if($word){
                $where[]=['brand_name','like',"%$word%"];
            }

            $data=Brand::where($where)->paginate($pagesize);
            Cache::put('data_'.$page.'_'.$word,$data,60);
        }
        $query = request()->query();
//        dump($query);
        return view('admin.admin.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *显示添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/admin/create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //第二种验证
//    public function store(StoreBrandPost $request)
    public function store(Request $request)
    {
        //验证一
//        $request->validate([
//            'brand_name' => 'required|unique:posts|max:255',
//            'brand_url' => 'required',
//        ],[
//            'brand_name.required'=>'品牌名称必填',
//            'brand_name.unique'=>'品牌名称已存在',
//            'brand_url.required'=>'品牌网址必填',
//        ]);

        //接收排除_token的值
        $post=$request->except(['_token']);

//        //第三种验证
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required',
            'brand_price' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_price.required'=>'品牌价格必填',
        ]);
        if ($validator->fails()) {
            return redirect('brand/create')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('goods_img')){
            $post['goods_img']=$this->photo('goods_img');
        }

//        $res=DB::table('brand')->insert($post);
//        dd($post);die;

        $res=Brand::insert($post);
        if($res){
            return redirect('admin/brand/index');
        }
    }

    //图片方法
    public function photo($filename)
    {
        if (request()->file($filename)->isValid()) {
            $photo = request()->file($filename);
            $store_result = $photo->store('photo');
            return $store_result;
        }
    }

    /**
     * Display the specified resource.
     *展示单条详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('brand')->where('brand_id', $id)->first();
        return view('admin/admin/update',['date'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBrandPost $request, $id)
    {
        $post=$request->except('_token');

        //文件是否上传
        if($request->hasFile('brand_logo')){
            $post['brand_logo']=$this->photo('brand_logo');
        }

        //修改
        $data = Brand::where('brand_id',$id)->update($post);

        return redirect('brand/index');

    }

    /**
     * Remove the specified resource from storage.
     *执行删除
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
        $res=Brand::where('brand_id',$id)->delete();

        if($res){
            return redirect('admin/brand/index');
        }


    }
}
