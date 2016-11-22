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

        if (!empty($emtype) && $goods_id > 0) {

            $member_id = get_member_id();
            //SESSION存在,用户已登陆
            if ($member_id) {

                //查询条件,用于定位特定数据
                $cond = array(
                    'goods_id' => $goods_id,
                    'member_id' => $member_id,
                );

                //判断数据库中是不是已经有了此商品
                $haveAmount = $this->_model->where($cond)->getField('amount');

                //存在商品: 取出商品的数量并加上传入的数量
                if ($haveAmount) {
                    //setInc方法  给当前字段在其本身的数量上再加上传入的数量
                    $this->_model->where($cond)->setInc('amount', $amount);
                } else {
                    //需要插入购物车数据表的数据
                    $rowData = array(
                        'goods_id' => $goods_id,
                        'member_id' => $member_id,
                        'amount' => $amount,
                    );
                    //将购物车中的商品插入到购物车表中
                    $this->_model->add($rowData);
                }
            } else {
                //用户未登陆,获取cookie中的商品数据
                $cartGoods = cookie('GOODS_CART_INFO');
                //判断是否存在数据
                //此处取出以商品id为键名的数据   例如:(商品id=>数量) 2 => 5
                if ($cartGoods[$goods_id]) {
                    $cartGoods[$goods_id] += $amount;   //原来的键值+当前传入的数量
                } else {
                    $cartGoods[$goods_id] = $amount;    //不存在商品,将新商品加入到购物车cookie中
                }

                //数据改动完成,生成新的cookie
                cookie('GOODS_CART_INFO', $cartGoods, 9999999);
            }

            //数据判断改动完成,跳转到购物车页面
            $url = U('Cart/addToCart', array('goods_id' => $goods_id, 'amount' => $amount));
            redirect($url);
        }

        //如果没有传入商品id或者没传入商品数量
        if (!$goods_id || !$amount) {
            $this->error('选择的商品为空或数量为空','/');
        }

        //引入视图
        $this->display();
    }


    /**
     * 购物车商品列表
     */
    public function CartList()
    {
        //获取session中的登陆用户id
        if($member_id = get_member_id()){
            //如果用户id存在,根据用户id查询出当前用户的购物车数据

        }else{
            //如果没有登陆,就将cookie中数据读取出来
            $cookie = cookie('GOODS_CART_INFO');
        }

        //载入视图
        $this->display();
    }

    public function cartOrder()
    {

        $this->display();
    }
}