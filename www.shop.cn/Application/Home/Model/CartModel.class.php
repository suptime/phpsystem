<?php
/**
 * 购物车模型类.
 * User: Nano
 * Date: 2016/11/22
 * Time: 17:07
 */
namespace Home\Model;


use Think\Model;

class CartModel extends Model
{

    public function setAddToCart($goods_id,$amount){
        //根据session获取用户登陆状态
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
                if ($this->_model->where($cond)->setInc('amount', $amount) === false) {
                    $this->error = '修改商品数量失败';
                    return false;
                }
            } else {
                //需要插入购物车数据表的数据
                $rowData = array(
                    'goods_id' => $goods_id,
                    'member_id' => $member_id,
                    'amount' => $amount,
                );
                //将购物车中的商品插入到购物车表中
                if ($this->_model->add($rowData) === false) {
                    $this->error = '新增商品失败';
                    return false;
                }
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
        return true;
    }


    /**
     * 将cooke中的商品添加到数据库中
     * @return bool true|false
     */
    public function cookieToMySql()
    {
        if ($member_id = get_member_id()) {
            //判断cookie是否存在
            if ($cartData = cookie('GOODS_CART_INFO')) {    //cookie存在,读取cookie中的商品数据
                //组装查询条件
                $goods_ids = array_keys($cartData);
                //根据条件判断数据表中是否存在相同数据
                $rows = $this->where(array('member_id' => $member_id))->getField('goods_id', true);
                //遍历商品id
                foreach ($goods_ids as $v) {
                    if (in_array($v, $rows)) {
                        //如果商品id在数据库中已经存在,就将数据库中的商品数量替换为cookie中的数量
                        if ($this->where(array('member_id' => $member_id, 'goods_id' => $v))->setField('amount', $cartData[$v]) === false) {
                            $this->error = '替换商品数量失败';
                            return false;
                        }
                    } else {
                        //商品在数据库中不存在
                        //组装需要插入的数据
                        $data = array(
                            'member_id' => $member_id,
                            'goods_id' => $v,
                            'amount' => $cartData[$v],
                        );
                        //将购物车数据表中没有的商品添加到数据库中
                        if ($this->add($data) === false) {
                            $this->error = '合并商品失败';
                            return false;
                        }
                    }
                }
                //执行成功后执行清除购物车cookie
                cookie('GOODS_CART_INFO', null);
            }
        }
        //未登陆,直接返回
        return true;
    }


    /**
     * 获取购物车详细商品数据
     * @return array    返回数组
     */
    public function getCartGoodsData(){
        //获取session中的登陆用户id
        if($member_id = get_member_id()){
            //如果用户id存在,根据用户id查询出当前用户的购物车数据,并以键(goods_id)=>值(amount)返回
            $cartData = $this->where(array('member_id'=>$member_id))->getField('goods_id,amount');
        }else{
            //如果没有登陆,就将cookie中数据读取出来
            $cartData = cookie('GOODS_CART_INFO');
        }

        //获取商品的id列表
        $goods_ids = array_keys($cartData);
        //定义总价格默认值
        $total_price = 0.00;    //格式化的值
        //判断是否有数据并遍历
        if ($cartData) {
            //获取商品数据,返回以商品id为键名的二维数组
            $goodsList = D('Goods')->getGoodsList($goods_ids);
            //遍历数组
            foreach($goodsList as $key => $value){
                //获取单个商品的购买总数
                $value['amount']= $cartData[$key];
                //单个商品的小计: 商品数量 X 商品价格
                $value['s_total']= is_num_format($value['amount'] * $value['shop_price']);  //格式化的值
                //将商品信息添加到$cart数组中
                $cart[$key] = $value;
                //获取所有商品的总价
                $total_price += $value['s_total'];
            }
        }else{
            $cart = array();
        }

        //所有商品总价格式化
        $total_price = is_num_format($total_price);    //格式化的值

        //返回数据
        return array(
            'cart' => $cart,
            'total_price' => $total_price,
        );
    }

    /**
     * 修改发生改变后的购物车数据
     * @param $goods_id 商品id
     * @param $amount   商品数量
     * @return bool 返回 true|false
     */
    public function changeCartData($goods_id,$amount){
        //获取当前登陆用户id
        if($member_id = get_member_id()){
            //sql执行条件
            $cond = array(
                'goods_id'=>$goods_id,
                'member_id'=>$member_id,
            );
            //当删除购物车商品时,数量传递为0就删除数据库对应数据
            if($amount == 0){
                $this->where($cond)->delete();
            }
            //用户已登录
            if ($this->where($cond)->setField('amount',$amount) === false) {
                $this->error = '更改商品数量失败';
                return false;
            }
        }else{
            //用户未登陆
            //获取cookie中的商品信息
            $cart = cookie('GOODS_CART_INFO');
            //判断商品数量是否为0
            if ($amount == 0) {
                //商品数量为0 ,删除此商品
                unset($cart[$goods_id]);
            }else{
                //不为0,赋值新的数量
                $cart[$goods_id] = $amount;
            }
            //数据改动完成,生成新的cookie
            cookie('GOODS_CART_INFO', $cart, 9999999);
        }
        return true;
    }

    //获取订单基本信息
    public function getOrderBaseInfo(){

    }

    //获取商品列表
    public function getGoodsData(){

    }
}