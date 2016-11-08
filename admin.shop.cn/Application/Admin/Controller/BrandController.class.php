<?php

namespace Admin\Controller;


use Think\Controller;

class BrandController extends Controller
{

    /**
     * 品牌列表
     */
    public function index(){
        //获取数据
        $brand = D('Brand');
        //获得搜索关键词
        $keyword = I('get.name');
        //获取数据
        $data = $brand->getList($keyword);
        //输出数据
        $this->assign('rows',$data['rows']);
        $this->assign('page',$data['page']);
        //选择视图
        $this->display();
    }

    public function add(){
        //判断是否提交数据
        if (IS_POST) {
            //实例化模型
            $brand = D('Brand');
            //接收数据,并判断
            if (!$brand->create()) {
                $this->error($brand->getError());
            }
            //保存数据,并判断
            if (!$brand->add()) {
                $this->error($brand->getError());
            }
            //跳转页面
            $this->success('添加品牌成功',U('index'));
        }else{
            //选择视图
            $this->display();
        }
    }

    /**
     * 修改品牌属性
     */
    public function edit($id=0){
        //实例化模型
        $brand = D('Brand');
        //判断是否提交数据
        if (IS_POST) {
            //接收数据,并判断
            if (!$brand->create()) {
                $this->error($brand->getError());
            }
            //保存数据,并判断
            if (!$brand->save()) {
                $this->error($brand->getError());
            }
            //跳转页面
            $this->success('修改成功',U('index'));
        }else{
            //查询一条数据
            $row = $brand->find($id);
            $this->assign($row);
            //选择视图
            $this->display('add');
        }
    }

    /**
     * 删除隐藏一个品牌
     * @param  int $id  品牌id
     */
    public function remove($id=0){
        //实例化模型
        $brand = D('Brand');
        $rs = $brand->where(array('id'=>$id))->setField('status',-1);
        //判断状态
        if (!$rs) {
            $this->error($brand->getError());
        }else{
            $this->success('删除成功',U('index'));
        }
    }
}