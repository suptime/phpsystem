<?php

namespace Home\Controller;


use Think\Controller;

class CartController extends BaseController
{

    private $_model;

    public function _initialize()
    {
        parent::_initialize();
        $this->_model = D('Cart');
    }

    /**
     * 加入商品到购物车
     * @param $goods_id int 商品id
     * @param $amount int   商品总数
     */
    public function addToCart($goods_id=0, $amount=0, $emtype = '')
    {
        //1,判断用户是否登录了,如果登录了,存入mysql,否则存入cookie
        //2,以前已经将该商品放入购物车了,就加数量
        //3,以前购物车中没有此商品,就加记录
        //4,购物车中已经有了此商品,就加数量
        //5,将数据保存到cookie中
        //6,跳转到购物车页面,避免重复提交.
        if (IS_POST && !empty($emtype) && $goods_id > 0) {
            //添加商品到购物车
            if ($this->_model->setAddToCart($goods_id,$amount) === false) {
                $this->error(get_error($this->_model));
                return false;
            }

            //数据判断改动完成,跳转到购物车页面
            //$url = U('Cart/addToCart', array('goods_id' => $goods_id, 'amount' => $amount));
            $url = U('Cart/addToCart');
            redirect($url);
        }

        //如果没有传入商品id或者没传入商品数量
        /*if (!$goods_id || !$amount) {
            $this->error('选择的商品为空或数量为空','/');
        }*/
        //引入视图
        $this->display();
    }


    /**
     * 购物车商品列表
     */
    public function CartList()
    {
        //将cookie中的商品添加到数据库中
        if ($this->_model->cookieToMySql() === false) {
            $this->error(get_error($this->_model));
        }
        //获取购物车商品数据
        $cartData = $this->_model->getCartGoodsData();
        //输出数据给视图文件
        $this->assign('cart',$cartData['cart']);
        $this->assign('total_price',$cartData['total_price']);
        //载入视图
        $this->display();
    }


    public function createOrder()
    {

        //判断用户是否已登陆
        if (!$member_id = get_member_id()) {
            //将购物车地址生成cookie保存
            cookie('referer',__SELF__);
            $this->error('您还未登录',U('Member/login'));
        }

        //收货人信息
        //送货方式
        //支付方式
        //发票信息
        //商品清单
        $data = $this->_model->getOrderBaseInfo();
        $goods_data = $this->_model->getGoodsData();
        $this->display();
    }


    /**
     * 修改订单数据
     * @param $goods_id
     * @param $amount
     */
    public function changeAmount($goods_id,$amount){
        //执行更改数据方法
        if ($this->_model->changeCartData($goods_id,$amount) === false) {
            $this->error(get_error($this->_model->getError));
        }
        //返回信息
        $this->success('修改成功');
    }
}