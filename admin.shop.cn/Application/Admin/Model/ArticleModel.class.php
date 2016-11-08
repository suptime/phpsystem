<?php

namespace Admin\Model;


use Think\Model;
use Think\Page;

class ArticleModel extends Model
{
    protected $_validate = array(
//        array('title','','标题已经存在！',0,'unique',1),
        array('title','require','文章标题不能为空'),
        array('sort','require','排序不能为空'),
        array('sort','number','排序必须是数字')
    );

    /**
     * 获取文章列表
     * @param string $keyword   搜索关键字
     */
    public function getArticles($cond){

        //数据表
        $article_table = C('DB_PREFIX').'article';     //文章表
        $category_table = C('DB_PREFIX').'article_category';    //分类表

        //数据总数
        $totalRows = $this->where($cond)->count();
        //分页
        $pages = new Page($totalRows,C('PAGES.PAGESIZE'));
        $pageHtml = $pages->show();
        $arr['pages'] = $pageHtml;

        //需要查询的字段
        $getFields = ("$article_table.id,$article_table.title,$article_table.intro,$article_table.status,$article_table.sort,$article_table.inputtime,$category_table.name");

        //查询需要的数据
        $data = $this->field($getFields)
            ->join("$category_table ON $article_table.article_category_id = $category_table.id")
            ->where($cond)
            ->order("$article_table.sort,$article_table.id desc")
            ->page(I('get.p'),C('PAGES.PAGESIZE'))
            ->select();

        //如果查询失败,输出错误信息
        if(!$data){
            $arr['error'] = $this->getError();
        }
        //获取数据
        $arr['rows'] = $data;

        //返回结果
        return $arr;
    }


    public function getRowArticleInfo($id){

        //数据表
        $article_table = C('DB_PREFIX').'article';     //文章表
        $content_table = C('DB_PREFIX').'article_detail';    //分类表

        $row = $this->join("$content_table ON $article_table.id = $content_table.article_id")->find($id);

        //对应数据不存在,返回false
        if (!$row) {
            return array(
                'article' => false,
                'msg' => '未找到符合要求的文章'
            );
            exit;
        }
        //查询到了数据,发挥数据
        return array(
            'article' => $row,
            'msg'=>''
        );
    }


}