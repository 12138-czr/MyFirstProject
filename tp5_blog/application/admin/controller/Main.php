<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Main extends Base {

    public function index(){
        //echo get_root();die;
        /*$admin = session('admin');
        $this->assign('admin',$admin);*/
        return $this->fetch();
    }

    public function welcome(){
        return $this->fetch();
    }

    public function logout(){
        session('admin',null);
        $this->redirect('Index/index');
    }
}


?>