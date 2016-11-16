<?php

namespace Admin\Controller;

use Think\Controller;


class IndexController extends Controller
{

    /**
     * 后台首页视图
     */
    public function index(){
        $this->display();
    }

    public function top(){
        $adminInfo = session('ADMIN_INFO');
        $this->assign('admin',$adminInfo);
        $this->display();
    }

    public function menu(){
        $this->assign('menus',D('Menu')->getlist());
        $this->display();
    }

    public function main(){
        $this->display();
    }

}