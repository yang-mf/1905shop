@extends('layouts.app')
@section('title', '注册')
@section('content')
<div class="maincont">
    <div class="userName">
        <dl class="names">
            <dt><img src={{asset('/static/index/images/user01.png')}} /></dt>
            <dd>
                <h3>天池不动峰</h3>
            </dd>
            <div class="clearfix"></div>
        </dl>
        <div class="shouyi">
            <dl>
                <dt>我的余额</dt>
                <dd>0.00元</dd>
            </dl>
            <dl>
                <dt>我的积分</dt>
                <dd>0</dd>
            </dl>
            <div class="clearfix"></div>
        </div><!--shouyi/-->
    </div><!--userName/-->

    <ul class="userNav">
        <li><span class="glyphicon glyphicon-list-alt"></span><a href="order.html">我的订单</a></li>
        <div class="height2"></div>
        <div class="state">
            <dl>
                <dt><a href="order.html"><img src={{asset('/static/index/images/user1.png')}} /></a></dt>
                <dd><a href="order.html">待支付</a></dd>
            </dl>
            <dl>
                <dt><a href="order.html"><img src={{asset('/static/index/images/user2.png')}}/></a></dt>
                <dd><a href="order.html">代发货</a></dd>
            </dl>
            <dl>
                <dt><a href="order.html"><img src={{asset('/static/index/images/user3.png')}} /></a></dt>
                <dd><a href="order.html">待收货</a></dd>
            </dl>
            <dl>
                <dt><a href="order.html"><img src={{asset('/static/index/images/user4.png')}} /></a></dt>
                <dd><a href="order.html">全部订单</a></dd>
            </dl>
            <div class="clearfix"></div>
        </div><!--state/-->
        <li><span class="glyphicon glyphicon-usd"></span><a href="quan.html">我的优惠券</a></li>
        <li><span class="glyphicon glyphicon-map-marker"></span><a href="add-address.html">收货地址管理</a></li>
        <li><span class="glyphicon glyphicon-star-empty"></span><a href="shoucang.html">我的收藏</a></li>
        <li><span class="glyphicon glyphicon-heart"></span><a href="shoucang.html">我的浏览记录</a></li>
        <li><span class="glyphicon glyphicon-usd"></span><a href="tixian.html">余额提现</a></li>
    </ul><!--userNav/-->

    <div class="lrSub">
        <a href="javascript:;">退出登录</a>
    </div>

    <div class="height1"></div>
    @include('index.public.footer');
</div><!--maincont-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src={{asset('/static/index/js/jquery.min.js')}}></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src={{asset('/static/index/js/bootstrap.min.js')}}></script>
<script src={{asset('/static/index/js/style.js')}}></script>
<!--jq加减-->
<script src={{asset('/static/index/js/jquery.spinner.js')}}></script>
<script>
    $('.spinnerExample').spinner({});
</script>
@endsection
</body>
</html>