<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Base extends Controller{

    public function _initialize(){
        if (!session('?admin')){
            $this->redirect('Index/index');die;
        }
    }
}