<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends BaseController
{

    /**
     * 网站首页
     */
    public function index(){
        //获得精品,新品,热销商品
        $hotGoods = D('Goods')->getGoods('hot');
        $newGoods = D('Goods')->getGoods('new');
        $bestGoods = D('Goods')->getGoods('best');

        $this->assign('hotGoods',$hotGoods);
        $this->assign('newGoods',$newGoods);
        $this->assign('bestGoods',$bestGoods);

        //获取banner列表
        $banners = $this->getBanners();

        $this->assign('title',mb_substr(C('WEB_TITLE'),3));
        $this->assign('banners',$banners);
        $this->display();
    }

    /**
     * 获取符合展示条件的轮播图
     * @return mixed   return array|null
     */
    private function getBanners(){
        $field = 'picture,url,title';
        $cond = array(
            is_show => 1,
            end_time => array('egt',NOW_TIME),
        );
        //获取数据
        return M('Banner')->field($field)->where($cond)->limit(6)->order('sort')->select();
    }



}