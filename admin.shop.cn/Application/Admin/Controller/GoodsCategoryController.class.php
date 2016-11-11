<?php

namespace Admin\Controller;


use Think\Controller;

class GoodsCategoryController extends Controller
{

    private $_model;    //实例化的model保存为属性

    /**
     * 自定义初始化执行方法
     */
    public function _initialize(){
        //实例化商品分类模型
        $this->_model = D('GoodsCategory');
    }

    /**
     * 获取分类列表,列表页面
     */
    public function index(){
        //获取商品分类列表
        $lists = $this->_model->getList();
        //传递数据
        $this->assign('rows',$lists);
        //选择视图
        $this->display();
    }

    public function add(){
        if (IS_POST) {
            if($this->_model->create() === false){
                $this->error($this->_model->getError());
            }
            if($this->_model->addCategory() === false){
                $this->error($this->_model->getError());
            }
            $this->success('添加成功',U('index'));
        }else{
            //获得所有分类,用于选择父级菜单
            $this->_before_category();
            $this->display();
        }
    }

    /**
     * 修改商品分类
     * @param $id
     */
    public function edit($id){
        if (IS_POST) {
            //收集数据
            if ($this->_model->create() === false) {
                $this->error($this->_model->getError());
            }
            //保存分类
            if ($this->_model->saveCategory() === false) {
                $this->error($this->_model->getError());
            }
            //成功跳转
            $this->success('修改分类成功', U('index'));
        } else {
            //获取当前id的分类数据
            $row = $this->_model->find($id);
            $this->_before_category();
            $this->assign('row', $row);
            $this->display('add');
        }
    }

    /**
     * 删除分类。
     * @param integer $id
     */
    public function remove($id) {
        //判断删除是否成功
        if ($this->_model->deleteCategory($id) === false) {
            $this->error($this->_model->getError());
        }
        //成功跳转
        $this->success('删除分类成功', U('index'));
    }

    /**
     * 获取之前的分类列表
     */
    private function _before_category(){
        //获取商品分类列表
        $lists = $this->_model->getList();
        //传递数据
        $this->assign('cates',$lists);
    }
}