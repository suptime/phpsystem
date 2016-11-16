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
        $this->display();
    }

    public function menu(){
        $this->display();
    }

    public function main(){
        $this->display();
    }

}