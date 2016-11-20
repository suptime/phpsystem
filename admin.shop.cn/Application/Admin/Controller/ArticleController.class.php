<?php

namespace Admin\Controller;

use Think\Controller;

class ArticleController extends Controller
{

    /**
     * 文章列表展示
     */
    public function index(){
        $cond = array();
        //获取搜索参数
        if(I('get.title')!= ''){
            $cond['title'] = array('like','%'.I('get.title').'%');
        }
        //判断是否选择了分类
        if(I('get.article_category_id') != 0){
            $cond['article_category_id'] = array('eq',I('get.article_category_id'));
        }

        //实例化文章类
        $article = D('Article');
        //调用model数据
        $articles = $article->getArticles($cond);
        //如果查询失败,返回错误信息
        if (!$articles) {
            $this->error($articles['error']);
        }

        //实例化文章栏目model
        $articleCategory = D('ArticleCategory');
        $cates = $articleCategory->select();
        //输出数据到视图
        $this->assign('cates',$cates);
        $this->assign('articles',$articles['rows']);
        $this->assign('pages',$articles['pages']);
        //选择视图
        $this->display();
    }

    /**
     * 添加文章
     */
    public function add(){
        if (IS_POST) {
            //验证是否正确选择文章栏目
            if(I('post.article_category_id') == 0){
                $this->error('请选择要发布文章的栏目');
                exit;
            }

            //实例化文章模型
            $articleModel = D('Article');
            $articleDetailModel = M('ArticleDetail');

            //开启事务
            $articleModel->startTrans();

            //发布时间
            $_POST['inputtime'] = NOW_TIME;
            //收集数据
            if (!$articleModel->create()) {
                $this->error($articleModel->getError());
            }

            //文章主表数据添加并返回文章id
            $id = $articleModel->add();

            //判断插入是否成功
            if (!$id) {
                $articleModel->rollback();
                $this->error($articleModel->getError().'主表');
            }

            //副表收集数据
            $data['article_id'] = $id;
            $data['content'] = I('post.content','',false);

            //文章内容表保存数据
            if (($articleDetailModel->add($data)) === false) {
                $articleModel->rollback();
                $this->error($articleDetailModel->getError().'副表');
            }

            //提交事务
            $articleModel->commit();
            //发布成功,跳转
            $this->success('发布文章成功',U('index'));

        }else{
            //实例化文章栏目model
            $articleCategory = D('ArticleCategory');
            $cates = $articleCategory->select();
            //如果分类查询错误
            if (!$cates) {
                $this->error($articleCategory->getError());
            }
            //给视图分配数据
            $this->assign('cates',$cates);
            //选择视图
            $this->display();
        }
    }

    /**
     * 文章修改方法
     * @param int $id  文章id
     */
    public function edit($id){
        //实例化文章模型
        $articleModel = D('Article');
        if (IS_POST) {
            //验证是否正确选择文章栏目
            if(I('post.article_category_id') == 0){
                $this->error('请选择要发布文章的栏目');
                exit;
            }
            //post来的文章id
            $aid = I('post.id');

            //开启事务
            $articleModel->startTrans();

            //收集数据
            if (!$arcInfo = $articleModel->create()) {
                $this->error($articleModel->getError());
            }

            //保存文章信息    主表
            if ($articleModel->save() === false) {
                $articleModel->rollback();
                $this->error($articleModel->getError().'主表');
            }

            //副表收集数据
            $articleDetailModel = M('ArticleDetail');
            $data['article_id'] = $aid;
            $data['content'] = I('post.content','',false);

            //文章内容表保存数据
            if ($articleDetailModel->save($data) === false) {
                $articleModel->rollback();
                $this->error($articleDetailModel->getError().'副表');
            }

            //提交事务
            $articleModel->commit();
            //发布成功,跳转
            $this->success('修改文章成功',U('index'));

        }else{
            //实例化文章栏目model
            $articleCategory = D('ArticleCategory');
            $cates = $articleCategory->select();
            //如果分类查询错误
            if (!$cates) {
                $this->error($articleCategory->getError());
            }

            //实例化文章模型
            $articleModel = D('Article');
            $row = $articleModel->getRowArticleInfo($id);
            //获取数据失败
            if ($row['article'] == false) {
                $this->error($row['msg']);
            }

            //给视图分配数据
            $this->assign('cates',$cates);
            $this->assign('article',$row['article']);
            //选择视图
            $this->display('add');
        }
    }

    /**
     * 删除指定id文章
     * @param int $id   文章id
     */
    public function remove($id){

        //实例化模型
        $articleModel = D('Article');
        $articleDetailModel = M('ArticleDetail');

        //附表主键id,文章id
        $article_id = $id;

        //开启事务
        $articleModel->startTrans();

        //删除主表失败
        if (!($articleModel->delete($id))) {
            $articleModel->rollback();

            $this->error($articleModel->getError().'主表');
        }

        //删除附表失败
        if (!$articleDetailModel->delete($article_id)) {
            $articleModel->rollback();
            $this->error($articleDetailModel->getError().'附表');
        }

        //提交事务
        $articleModel->commit();

        //删除成功,跳转
        $this->success('删除文章成功',U('index'));
    }
}