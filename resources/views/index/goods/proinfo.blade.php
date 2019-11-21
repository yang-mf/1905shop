@extends('layouts.app')
@section('title', '注册')
@section('content')
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>产品详情</h1>
        </div>
    </header>
    <div id="sliderA" class="slider">
        <img src={{env('PHOTO_URL')}}{{$info->goods_img}} />
        {{--<img src={{asset('/static/index/images/image2.jpg')}} />--}}
        {{--<img src={{asset('/static/index/images/image3.jpg')}} />--}}
        {{--<img src={{asset('/static/index/images/image4.jpg')}} />--}}
        {{--<img src={{asset('/static/index/images/image5.jpg')}} />--}}
    </div><!--sliderA/-->
    <table class="jia-len">
        <tr goods_num="{{$info->goods_num}}" goods_id="{{$info->goods_id}}" id="tr">
            <th><strong class="orange">{{$info->goods_price}}</strong></th>
            <td>
                <button style="width:25px;" class="jian">-</button>
                <input type="text"   style="width:30px;text-align:center;" name="buy_num" value="1" class="inp">
                <button style="width:25px;" class="jia">+</button>
            </td>
        </tr>
        <tr>
            <td>
                <strong>{{$info->goods_name}}</strong>
                <p class="hui">富含纤维素，平衡每日膳食</p>
            </td>
            <td align="right">
                <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
            </td>
        </tr>
    </table>
    <div class="height2"></div>
    <h3 class="proTitle">商品规格</h3>
    <ul class="guige">
        <li class="guigeCur"><a href="javascript:;">50ML</a></li>
        <li><a href="javascript:;">100ML</a></li>
        <li><a href="javascript:;">150ML</a></li>
        <li><a href="javascript:;">200ML</a></li>
        <li><a href="javascript:;">300ML</a></li>
        <div class="clearfix"></div>
    </ul><!--guige/-->
    <div class="height2"></div>
    <div class="zhaieq">
        <a href="javascript:;" class="zhaiCur">商品简介</a>
        <a href="javascript:;">商品参数</a>
        <a href="javascript:;" style="background:none;">订购列表</a>
        <div class="clearfix"></div>
    </div><!--zhaieq/-->
    <div class="proinfoList">
        <img src={{env('PHOTO_URL')}}{{$info->goods_img}} width="636" height="822" />
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息....
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息......
    </div><!--proinfoList/-->
    <table class="jrgwc">
        <tr>
            <th>
                <a href="{{url('/')}}"><span class="glyphicon glyphicon-home"></span></a>
            </th>
            <td><a id="a">加入购物车</a></td>
        </tr>
    </table>
</div><!--maincont-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src={{asset('/static/index/js/jquery.min.js')}}></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src={{asset('/static/index/js/bootstrap.min.js')}}></script>
<script src={{asset('/static/index/js/style.js')}}></script>
<!--焦点轮换-->
<script src={{asset('/static/index/js/jquery.excoloSlider.js')}}></script>
<script>
    $(function () {
        $("#sliderA").excoloSlider();
    });
</script>
<!--jq加减-->
<script src={{asset('/static/index/js/jquery.spinner.js')}}></script>
<script>
    $('.spinnerExample').spinner({});
</script>
<script>
    //点击加
    $(document).on('click','.jia',function(){
        var _this=$(this);
        var num=_this.parents("tr").attr('goods_num');
        var value=_this.prev('.inp').val();
        if(parseInt(value)>=parseInt(num)){
            _this.prev('.inp').val(num);
        }else{
            _this.prev('.inp').val(parseInt(value)+1);
        }
    })
    //点击减
    $(document).on('click','.jian',function(){
        var _this=$(this);
        var value=_this.next('.inp').val();
        if(value<=1){
            _this.next('.inp').val('1');
        }else{
            _this.next('.inp').val(parseInt(value)-1);
        }
    })
    //失去焦点
    $(document).on('blur','.inp',function(){
        var _this=$(this);
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
    })
</script>
<script>
    $(document).ready(function () {
        $(document).on("click","#a",function () {
            var _this=$(this);
            var goods_id=$("#tr").attr("goods_id");
            var buy_num=$(".inp").val();
            $.get(
                "{{url('/buy')}}",
                {goods_id:goods_id,buy_num:buy_num},
                function (res) {
                    if(res){
                        location.href="{{'/car'}}"
                    }
                }
            )
        })
    })
</script>
@endsection
</body>
</html>