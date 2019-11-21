<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Cache;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIndexPost;
use Illuminate\Http\Request;
use DB;
use Validator;

use App\Index;
use App\Cal;
use App\Brand;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $word=\request()->word;
        $page=request()->page;
        $data=Cache::get('data_'.$page.'_'.$word);
//        echo 'data_'.$page.'_'.$word;
        if(!$data){
//            echo 'mam';
            $word=\request()->word;
            $where=[];
            if($word){
                $where[]=['goods_name','like',"%$word%"];
            }
//        dump($query);
//        DB::connection()->enableQueryLog();
            $pagesize=config('app.pagesize');
            $data=Index::
            join('cate','cate.cate_id','=','goods.cate_id')
                ->join('brand','brand.brand_id','=','goods.brand_id')
                ->where($where)
                ->paginate($pagesize);
            Cache::put('data_'.$page.'_'.$word,$data,60);
        }
        $query = request()->query();
//        $logs = DB::getQueryLog();
        return view('admin.index.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date=Brand::all();
        $data=Cal::all();
//        dd($date);

        return view('admin/index/create',['date'=>$date,'data'=>$data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post=$request->except(['_token']);
//        dd($post);
        //第三种验证
        $validator = Validator::make($request->all(), [
            'goods_name' => 'required',
            'goods_price' => 'required',
            'goods_num' => 'required',
            'goods_desc' => 'required',
        ],[
            'goods_name.required'=>'商品名称必填',
            'goods_price.required'=>'商品价格必填',
            'goods_num.required'=>'商品库存必填',
            'goods_desc.required'=>'商品简介必填',
        ]);
        if ($validator->fails()) {
            return redirect('index/create')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('goods_img')){
            $post['goods_img']=$this->photo('goods_img');
        }

        $res=Index::insert($post);
        if(!empty($res)){
            return redirect('/index/index');
        }
    }

    //图片方法
    public function photo($filename)
    {
//        dd(request()->file($filename));
        if (request()->file($filename)->isValid()) {

            $photo = request()->file($filename);
            $store_result = $photo->store('photo');
            return $store_result;
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $date=Brand::all();
        $data=Cal::all();
        $info = DB::table('goods')->where('goods_id', $id)->first();
        return view('admin/index/update',['info'=>$info,'date'=>$date,'data'=>$data]);
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
//        dd($post);
        //文件是否上传
        if($request->hasFile('goods_img')){
            $post['goods_img']=$this->photo('goods_img');
        }

        //修改
        $data = Index::where('goods_id',$id)->update($post);

        return redirect('index/index');
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
        $res=Index::where('goods_id',$id)->delete();

        if($res){
            return redirect('admin/index/index');
        }
    }
}
