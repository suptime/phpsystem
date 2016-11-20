<?php

namespace Home\Controller;


use Think\Controller;

class GoodsController extends BaseController
{
    private $_model;

    public function _initialize(){
        parent::_initialize();
        $this->_model = D('Goods');
    }

    /**
     * 商品详情展示
     */
    public function show($id){

        //根据主键获取一条相关数据
        $row = $this->_model->getRowByPk(trim($id));
        if (!$row) {
            //没有找到符合条件的数据,返回错误信息并跳转
            //这个id不存在商品
            $this->error(get_error($this->_model),U('Index/index'));
        }

        //将图片地址更改成远程绝对地址
        $row['base_info']['content'] = str_replace('/Uploads/image/','http://admin.shop.cn/Uploads/image/',$row['base_info']['content']);

        //输出商品信息
        $this->assign('row',$row['base_info']);
        $this->assign('gallery',$row['gallery']);
        $this->assign('title',$row['base_info']['name'] . C('WEB_TITLE'));
        $this->display();
    }



    /**
     * 商品分类列表
     */
    public function category($id,$brand='',$price=''){

        //搜索条件
        $data = $this->_model->getGoodsListData($id,$brand,$price);
        if ($data === false) {
            $this->error(get_error($this->_model));
        }

        $this->assign('goods',$data['goodsList']);
        $this->assign('pageHtml',$data['pageHtml']);
        $this->assign('cateInfo',$data['current_category']);
        $this->assign('title',$data['current_category']['name'] . C('WEB_TITLE'));
        $this->display();
    }

}