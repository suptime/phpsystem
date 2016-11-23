<?php
/**
 * Created by PhpStorm.
 * User: Nano
 * Date: 2016/11/23
 * Time: 15:39
 */

namespace Admin\Controller;


use Think\Controller;

class OrderController extends Controller
{
    //实例化的对象
    private $_model;

    //自定义初始化执行实例model方法
    protected function _initialize(){
        $this->_model = D('Order');
    }
    /**
     * 订单列表
     */
    public function index(){
        $rows = $this->_model->getOrderList();
        $this->display();
    }
}