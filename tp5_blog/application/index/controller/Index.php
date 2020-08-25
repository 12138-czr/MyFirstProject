<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        $name = '张三';
        $stu = ['name'=>'张三','sex'=>'男','age'=>18];
        $student = [];
        for ($i=1;$i<=20;$i++){
            $student[] = ['name'=>'张三'.$i,'sex'=>mt_rand(0,2),'age'=>mt_rand(16,25),'add_time'=>time()-mt_rand(1000,10000)];
        }

        $this->assign('name',$name);
        $this->assign('stu',$stu);
        $this->assign('student',$student);
        //调用模板
        return $this->fetch();
    }

    public function login(){
        return $this->fetch();
    }
}
