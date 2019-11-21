@extends('layouts.app')
@section('title', '注册')
@section('content')
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>会员注册</h1>
        </div>
    </header>
    <div class="head-top">
        <img src={{asset('/static/index/images/head.jpg')}} />
    </div><!--head-top/-->
    <form action="{{url('/regdo')}}" method="get" class="reg-login">
        <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
        <div class="lrBox">
            <div class="lrList"><input type="text" name="email" placeholder="输入手机号码或者邮箱号"  id="lrList"/></div>
            <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /> <a href="javascript:;" id="aerdfg" >获取验证码</a> </div>
            <div class="lrList"><input type="text" name="pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
            <div class="lrList"><input type="text" name="pwd_t" placeholder="再次输入密码" /></div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="submit" value="立即注册" />
        </div>
    </form><!--reg-login/-->
    <div class="height1"></div>
    @include('index.public.footer');

</div><!--maincont-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src={{asset('/static/index/js/jquery.min.js')}}></script>
<script src="/static/jquery.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src={{asset('/static/index/js/bootstrap.min.js')}}></script>
<script src={{asset('/static/index/js/style.js')}}></script>

<script>
    $(document).ready(function () {
        $(document).on("click","#aerdfg",function () {
            var name=$("#lrList").val();
            $.ajax({
                method: "get",
                url: "{{url('/send')}}",
                data: { email:name }
            }).done(function( res ) {
                alert(res);
            });

        })
    })
</script>
@endsection