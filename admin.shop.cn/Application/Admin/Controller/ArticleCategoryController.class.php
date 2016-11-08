<?php

namespace Admin\Controller;

use Think\Controller;

class ArticleCategoryController extends Controller
{
    public function index(){
        //实例化model
        $articleCategory = D('ArticleCategory');
        $rows = $articleCategory->getCategorys();
        //判断是否数据存在
        if (!$rows) {
            $this->error($articleCategory->getError());
        }
        $this->assign('rows',$rows);
        //引入视图
        $this->display();
    }

    /**
     * 添加文章分类
     * @param int $id
     */
    public function add(){
        //实例化model
        $articleCategory = D('ArticleCategory');
        //判断是否是post
        if (IS_POST) {

            //接收数据
            if (!$articleCategory->create()) {
                //获取数据失败,返回错误信息
                $this->error($articleCategory->getError());
            }
            //保存数据
            if (!$articleCategory->add()) {
                //保存失败
                $this->error($articleCategory->getError());
            }
            //跳转
            $this->success('添加分类成功',U('index'));
        }else{
            //获得所有分类
            $rows = $articleCategory->getCategorys();
            //获得数据
            $this->assign('rows',$rows);
            //引入视图
            $this->display();
        }
    }

    /**
     * 修改文章分类
     * @param int $id
     */
    public function edit($id=0){
        //实例化模型
        $articleCategory = D('ArticleCategory');
        //判断是否是post
        if (IS_POST) {
            //接收数据
            if (!$articleCategory->create()) {
                //获取数据失败,返回错误信息
                $this->error($articleCategory->getError());
            }
            //保存数据
            if (!$articleCategory->save()) {
                //保存失败
                $this->error($articleCategory->getError());
            }
            //跳转
            $this->success('修改分类成功',U('index'));
        }else{
            //查询一条数据
            $row = $articleCategory->find($id);
            //判断取出数据是否成功
            if (!$row) {
                $this->error($articleCategory->getError());
            }
            //指定数据给视图
            $this->assign($row);
            $this->display('add');
        }
    }

    /**
     * 删除隐藏栏目
     * @param int $id
     */
    public function remove($id=0){
        //实例化model
        $articleCategory = D('ArticleCategory');
        //查询当前分类下是否存在文章,如果存在,禁止删除
        $articleModel = D('Article');
        $row = $articleModel->field('title')->where("article_category_id = $id")->limit(1)->select();
        //栏目存在文章
        if ($row) {
            $this->error('当前栏目下存在文章,不允许删除');
        }

        //查询子类数据,判断子类是否存在
        if ($articleCategory->where(array('parent_id'=>$id))->find()) {
            $this->error('当前分类存在子类,不允许删除');
        }
        //删除栏目
        $result = $articleCategory->where(array('id'=>$id))->delete();
        //如果删除不成功,返回错误
        if ($result) {
            $this->error($articleCategory->getError());
        }
        //删除成功跳转
        $this->success('删除分类成功',U('index'));
    }



}