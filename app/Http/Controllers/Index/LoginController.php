<?php

namespace App\Http\Controllers\Index;
use Illuminate\Support\Facades\Cache;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    public function send(){
        $email=request()->email;
//        $email='13366737021@163.com';
        $code=rand(100000,999999);
        $message="您正在注册全国最大珠宝会员，验证码:".$code;
        //发送邮件
        $res=$this->sendemail($email,$message);
        if($res=true){
            session(['code'=>$code]);
            return 'ok';
        }
    }

    public function sendemail($email,$message){
        \Mail::raw($message ,function($message)use($email){
            //设置主题
            $message->subject("欢迎注册滕浩有限公司");
            //设置接收方
            $message->to($email);
        });
        return true;
    }
    //登录页面
    public function login(){
        return view('index.user.login');
    }
    //登录方法
    public function logindo(){
        $post=request()->except('_token');
        if(empty($post['email'])){
            echo '账号不能为空';die;
        }
        if(empty($post['pwd'])){
            echo '密码不能为空';die;
        }
//        dd($post['pwd']);
        $where[]=[
            'email','=',$post['email'],
            'pwd','=',$post['pwd'],
        ];
        $email=$post['email'];
        $pwd=$post['pwd'];
        $res=DB::table('use_i')->where([
                ['email', '=', $email],
                ['pwd', '=', $pwd],
            ])->first();
//        dd($res);

//            ->where(['email'=>$post['email'],'pwd'=>$post['pwd']])->first();
        if(!empty($res)){
            session(['user'=>$res]);
            return redirect('/');
        }


    }

    //注册页面
    public function reg(){
        return view('index.user.reg');
    }
    //注册方法
    public function regdo(){
        $post=request()->except('_token');
        $code=session('code');
//        dd($code);
        if(empty($post['email'])){
            echo '账号不能为空';die;
        }
        if(empty(['code'])){
            echo '验证码不能为空';die;
        }else if(!($code==$post['code'])){
            echo '验证码有误';die;
        }
        if(empty($post['pwd'])){
            echo '密码不能为空';die;
        }
        if(empty($post['pwd_t'])){
            echo '确认密码不能为空';die;
        }
        if(!($post['pwd']==$post['pwd_t'])){
            echo '确认密码与密码不一致';die;
        }
        unset($post['pwd_t']);
        $res=DB::table('use_i')->insert($post);
        if($res){
            return redirect('/login');
        }


    }

    public function show(){
        return view("index.user.user");
    }


}
