<?php

namespace Home\Model;


use Think\Model;
use Think\Page;

class GoodsModel extends Model
{

    /**
     * 获取新品,精品,热销 5条商品
     * @param  string   $flag     状态标识
     * @return array    返回对应的5条数据,以数组形式返回
     */

    public function getGoods($flag){

        //查询已上架并且商品数量不为0的商品
        $cond['is_on_sale'] = array('eq',1);
        $cond['goods_status'] = array('gt',0);
        $cond['stock'] = array('gt',0);

        //根据条件查询符合的数据并保存
        $data = $this->field('id,name,logo,shop_price,goods_status')->where($cond)->order("id desc")->select();

        //精品新品热销空数组
        $hotGoods = array();
        $newGoods = array();
        $bestGoods = array();

        //遍历查询出来的数据
        foreach ($data as $value) {
            if($value['goods_status'] & 1){
                $bestGoods[] = $value;
            }

            if($value['goods_status'] & 2){
                $newGoods[] = $value;
            }

            if($value['goods_status'] & 4){
                $hotGoods[] = $value;
            }
        }

        //根据不同flag标识返回不同类型数据
        if($flag == 'hot'){
            //截取5条热销商品的数据返回
            return array_slice($hotGoods,0,4,true);

        }elseif($flag == 'new'){
            //截取5条新品商品的数据返回
            return array_slice($newGoods,0,4,true);

        }elseif($flag == 'best'){
            //截取5条精品商品的数据返回
            return array_slice($bestGoods,0,4,true);
        }
    }


    /**
     * 获得单个商品数据
     * @param $id   商品id
     * @return bool|mixed
     */
    public function getRowByPk($id){
        //基本信息
        if (!($goods_data['base_info'] = $this->find($id))) {
            $this->error = '没有找到符合条件的商品';
            return false;
        }else{
            //查询条件
            $cond = array('goods_id'=>$id);
            //内容详情介绍
            $goods_data['base_info']['content'] = M('GoodsIntro')->where($cond)->getField('content');
            //相册
            $goods_data['gallery'] = M('GoodsGallery')->where($cond)->getField('path',true);


            //品牌id
            $brand_id = $goods_data['base_info']['brand_id'];
            //获取品牌
            $goods_data['base_info']['brand'] = M('Brand')->where(array('id'=>$brand_id))->getField('name');
        }

        //返回数据
        return $goods_data;
    }


    /**
     * 获取当前栏目以及子栏目的商品列表
     * @param $id   当前栏目id
     * @param $brand    品牌id
     * @param $price    价格
     * @return bool    返回结果 true|false
     */
    public function getGoodsListData($id,$brand,$price){

        $GoodsCategory = D('GoodsCategory');
        //获取当前栏目的所有子栏目id
        $category_ids = $GoodsCategory->getChildCates($id);

        //获取当前栏目的数据
        $goodsData['current_category'] = $GoodsCategory->getCurrentCateInfo($id);

        //判断子栏目是否为空
        if(!$category_ids){
            //为空,直接将当前栏目id设置为素组元素
            $category_ids = array($id);
        }else{
            //把当前栏目id添加到栏目id数组中备用
            array_unshift($category_ids,$id);
        }

        //组装查询条件
        $cond['goods_category_id'] = array('in',$category_ids);

        //分页代码
        $total = count($this->where($cond)->select());  //数据总条数
        $page = new Page($total,C('PAGE.PAGESIZE'));
        $pageHtml = $page->show();
        $goodsData['pageHtml'] = $pageHtml;

        //根据栏目id查询对应数据
        if (($goodsData['goodsList'] = $this->where($cond)->page(I('get.p'),C('PAGE.PAGESIZE'))->select()) === false) {
            $this->error ='获取商品数据失败';
            return false;
        }

        //返回分页和商品列表数据
        return $goodsData;
    }


    /**
     * 根据商品id数组获取商品列表数据
     * @param $ids  商品id数组
     * @return mixed    array|null 成功返回数组,没有返回null
     */
    public function getGoodsList($ids){
        //获取已上架并且在销售的商品
        return $this->where(array('id'=>array('in',$ids),'status'=>1,'is_on_sale'=>1))->getField('id,name,logo,shop_price');
    }

}