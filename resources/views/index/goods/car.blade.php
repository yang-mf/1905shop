@extends('layouts.app')
@section('title', '注册')
@section('content')
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>购物车</h1>
        </div>
    </header>
    <div class="head-top">
        <img src={{asset('/static/index/images/head.jpg')}} />
    </div><!--head-top/-->
    <table class="shoucangtab">
        <tr>
            <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$num}}</strong>件商品</span></td>
            <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">
                <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
            </td>
        </tr>
    </table>
    <table class="dingdanlist">
        <tr>
            <td width="4%" rowspan="4"><a href="javascript:;"><input type="checkbox" name="1" class="allbox" /> 全选</a></td>
        </tr>
    </table>
@foreach($data as $v)
    <div class="dingdanlist">
        <table>

            <tr goods_num="{{$v->goods_num}}" cart_id="{{$v->cart_id}}">
                <td width="4%"><input type="checkbox" name="1" class="box" /></td>
                <td class="dingimg" width="15%"><img src={{env('PHOTO_URL')}}{{$v->goods_img}} /></td>
                <td width="50%">
                    <h3>{{$v->goods_name}}</h3>
                    <time>{{date('Y-m-d h:i:s',$v->add_time)}}</time>
                </td>
                <td align="right">
                    <button style="width:25px;" class="jian">-</button>
                    <input type="text"   style="width:30px;text-align:center;" value="{{$v->buy_num}}" class="inp">
                    <button style="width:25px;" class="jia">+</button>
                </td>
            </tr>
            <tr>
                <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
            </tr>
        </table>
    </div><!--dingdanlist/-->
@endforeach
    <div class="height1"></div>
    <div class="gwcpiao">
        <table>
            <tr>
                <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
                <td width="50%">总计：<strong class="orange" id="price">¥{{$price}}</strong></td>
                <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
            </tr>
        </table>
    </div><!--gwcpiao/-->
</div><!--maincont-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src={{asset('/static/index/js/jquery.min.js')}}></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src={{asset('/static/index/js/bootstrap.min.js')}}></script>
<script src={{asset('/static/index/js/style.js')}}></script>
<!--jq加减-->
<script src={{asset('/static/index/js/jquery.spinner.js')}}></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        //点击加
        $(document).on('click','.jia',function(){
            var _this=$(this);
            var cart_id=_this.parents("tr").attr("cart_id");
            var num=_this.parents("tr").attr('goods_num');
            var value=_this.prev('.inp').val();
            if(parseInt(value)>=parseInt(num)){
                _this.prev('.inp').val(num);
                var new_num=_this.prev('.inp').val();
            }else{
                _this.prev('.inp').val(parseInt(value)+1);
                var new_num=_this.prev('.inp').val();
            }
//            changenum(cart_id,new_num);
            getchecked(_this);
            getprice();

        })
        //点击减
        $(document).on('click','.jian',function(){
            var _this=$(this);
            var cart_id=_this.parents("tr").attr("cart_id");
            var value=_this.next('.inp').val();
            if(value<=1){
                _this.next('.inp').val('1');
            }else{
                _this.next('.inp').val(parseInt(value)-1);
            }
            var new_num=_this.next('.inp').val();
//            changenum(cart_id,new_num);
            getchecked(_this);
            getprice();

        })
        //失去焦点
        $(document).on('blur','.inp',function(){
            var _this=$(this);
            var cart_id=_this.parents("tr").attr("cart_id");

            var value=_this.val();
            var num=_this.parents("tr").attr('goods_num');
            var reg=/^[\d]{1,5}$/;
            if(!reg.test(value)){
                _this.val('1');return false;
            }
            if(value=='0'){
                _this.val('1');return false;
            }
            if(parseInt(value)>parseInt(num)){
                _this.val(num);return false;
            }
            _this.val(parseInt(value));
            var new_num=_this.val();
//            changenum(cart_id,new_num);
            getchecked(_this);
            getprice();

        })
        //点击加上选中
        function getchecked(_this) {
            _this.parents("tr").find(".box").prop("checked",true);
        }
        //点击多选
        $(document).on("click",".allbox",function () {
            var style=$(".allbox").is(":checked");
            $(".box").prop("checked",style);
        })
        //点击加入购物车
        $(document).on("click",".jiesuan",function () {
            var _box=$(".box:checked");
            var cart_id="";
            _box.each(function(index){
                cart_id+=$(this).parents("tr").attr('cart_id')+',';
            });
            cart_id=cart_id.substr(0,cart_id.length-1);
            console.log(cart_id);
//            console.log(cart_id);return
            $.post(
                "{{url('/jiesuan')}}",
                {cart_id:cart_id},
                function (res) {
                    if(res==1) {
                        window.location.href="{{url('/pay/')}}?cart_id="+goods_id;
                        {{--location.href = "{{url('/pay/')}}?cart_id="+goods_id;--}}
                    }else{
                        alert(res);
                    }
                }
            )
        })
        
        //重新获取总价，被选中的
        function getprice() {
            var _box=$(".box:checked");
//            console.log(_box);return
            var cart_id="";
            _box.each(function(index){
                cart_id+=$(this).parents("tr").attr('cart_id')+',';
            });
            cart_id=cart_id.substr(0,cart_id.length-1);
//            console.log(cart_id);return
            $.post(
                "{{url('/getprice')}}",
                {cart_id:cart_id},
                function (res) {
                    console.log(res);
                }
            )
        }
        //修改购买数量
        function changenum(cart_id,new_num) {
            $.post(
                "{{url('/changenum')}}",
                {cart_id:cart_id,new_num:new_num},
//                function (res) {
//                    alert(res);
//                }
            )
        }


    })
    
</script>



@endsection
