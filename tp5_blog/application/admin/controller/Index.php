<?php
namespace app\admin\controller;
use think\captcha\Captcha;
use think\Controller;
use think\Db;

class Index extends Controller{

    public function index(){

        //如果已经登录，跳转至后面主页面
        if (session('?admin')){
            $this->redirect('Main/index');die;
        }

        /*echo md5(md5('123'),'3Ax9#M');
        die;*/
        return $this->fetch();
    }

    public function login(){
        $usename = input('usename');
        $password = input('password');
        $code = input('code');
        $online = input('online',0);

        if (empty($usename) || empty($password)){
            $this->error('账号或密码为空',url('index'));die;
        }

        /*if (empty($code)){
            $this->error('验证码为空',url('index'));die;
        }
        if (!captcha_check($code)){
            $this->error('验证码为错误',url('index'));die;
        };*/

        //echo $usename;
        $row = db('admin')->where('usename',$usename)->find();
        if (empty($row)){
            $this->error('账号不存在',url('index'));die;
        }
        if ($row['password'] != md5(md5($password).$row['entry'])){
            $this->error('密码错误',url('index'));die;
        }
        //dump($row);

        //echo $row['password'];

        //处理记住密码


        //修改登陆的数据
        db('admin')->where('id',$row['id'])->update([
            'login_time'=>time(),
            'login_num'=>$row['login_num']+1,
            'login_ip'=>request()->ip()
        ]);


        //产生session
        session('admin',$row);

        //跳转页面
        $this->redirect('Main/index');

    }

    public function verify(){

        $config = [
            'length'=>4,
            'useNoise'=>false,
            'useCurve'=>false,
            'fontSize'=>16,
        ];

        $captcha = new \think\captcha\Captcha($config);
        return $captcha->entry();
    }
}