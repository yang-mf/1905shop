<?php

namespace App\Http\Controllers\Index;
use Illuminate\Support\Facades\Cache;

use App\Http\Controllers\Controller;

use DB;

use Illuminate\Http\Request;

class GoodsController extends Controller
{
    //商品列表
    public function index(){
        return view("index.goods.prolist");
    }
    //购物车
    public function car(){
        $data=DB::table("cart")->join("goods","goods.goods_id","=","cart.goods_id")->get();
        $price=0;
        foreach ($data as $k=>$v){
            $price+=$v->goods_price*$v->buy_num;
            $num=$k;
        }
        $num=$num+1;
//        dd($price);
        return view("index.goods.car",['data'=>$data,'price'=>$price,'num'=>$num]);
    }
    //商品详情
    public function proinfo($goods_id){
        $data=Cache::get('data');
//        echo 'data';
        if(!$data){
            $goodsIngo=DB::table("goods")->where('goods_id',$goods_id)->first();
            Cache::put('data',$goodsIngo,60);
        }
//        $goodsIngo=DB::table("goods")->where('goods_id',$goods_id)->first();
        return view("index.goods.proinfo",['info'=>$goodsIngo]);
    }
    //购买
    public function buy(){
        $buy_num=request()->buy_num;
        $goods_id=request()->goods_id;
        $user=session('user');
        $us_id=$user->us_id;
        if(empty($us_id)){
            return redirect('/login');
        }
        $cartInfo=DB::table('cart')->where('goods_id',$goods_id)->first();
        if(!empty($cartInfo)){
            $num=$cartInfo->buy_num;
            $num=$num+$buy_num;
            $res=DB::table('cart')->where('goods_id',$goods_id)->update(['buy_num'=>$num]);
        }else{
            $arr['goods_id']=$goods_id;
            $user=session('user');
            $arr['buy_num']=$buy_num;
            $us_id=$user->us_id;
            $arr['us_id']=$us_id;
            $arr['add_time']=time();
            $res=DB::table("cart")->insert($arr);
        }
        if($res){
            return redirect('/car');
        }
    }

    //确认购买，结算
    public function pay(){
        $goods_id=\request()->goods_id;
//        $goods_id=explode($goods_id,',');
        $user=session('user');
        $us_id=$user->us_id;
        $data=DB::table('cart')->where('cart_id',$goods_id)->get();
        dd($data);
        return view('index.goods.pay');
    }
    //确认购买，支付
    public function success(){
        return view('index.goods.success');
    }

    //改变购买数量和总价
    public function changenum(){
        $cart_id=request()->cart_id;
        $new_num=request()->new_num;
        $res=DB::table("cart")->where('cart_id',$cart_id)->update(['buy_num'=>$new_num]);
        if($res!==false){
            echo '修改成功';
        }else{
            echo '修改失败';
        }
    }
    //修改小计
    public function getprice(){
        $cart_id=request()->cart_id;
//        print_r($cart_id);die;
//        $data=DB::table('cart')->whereIn($where)->get();
//        dd($data);

    }
    //去结算`
    public function jiesuan(){
        $cart_id=\request()->cart_id;
        if($cart_id){
            echo 1;
        }else{
            echo '请至少选择一件商品';
        }
    }
}
