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

        //获取文章列表和文章栏目
        /*$article_cates = M('ArticleCategory')
            ->alias('ac')
            ->field('ac.id as cid, arc.id as aid, name,title')
            ->join("__ARTICLE__ as arc ON ac.id = arc.article_category_id")
            ->where(array('ac.is_help'=>1,'ac.status'=>1))
            ->order('ac.sort')
            ->select();*/

        $this->assign('title',mb_substr(C('WEB_TITLE'),3));
        $this->display();
    }



}