<?php

namespace Home\Controller;


use Think\Controller;

class CartController extends BaseController
{

    private $_model;

    public function _initialize(){
        parent::_initialize();
        $this->_model = D('Cart');
    }

    /**
     * 加入商品到购物车
     */
    public function addToCart(){
        
    }

    public function CartFirst(){

    }

    public function CartOrder(){

    }
}