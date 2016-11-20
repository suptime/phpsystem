<?php

namespace Home\Controller;


use Think\Controller;

class BaseController extends Controller
{

    /**
     * 初始化所有控制器的公共数据
     */
    public function _initialize(){
        $cates = D('GoodsCategory')->getGoodsCategory();
        //获取商品分类
        $this->assign('cates',$cates);

        //获取帮助文章栏目
        $article_cates = M('ArticleCategory')->where(array('is_help'=>1,'status'=>1))->order('sort')->select();
        $this->assign('article_cates',$article_cates);

        //获取帮助文章栏目下的文章;
        $articles = M('Article')->field('id,article_category_id,title')->where(array('status'=>1))->order('sort')->select();
        $this->assign('articles',$articles);

        //获得当前登陆用户的session
        $is_member_sess = session('MEMBER_LOGIN_INFOS');
        if(!$is_member_sess){
            $member = false;
        }else{
            $member = $is_member_sess;
        }
        $this->assign('member',$member);
    }
}