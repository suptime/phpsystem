<?php

namespace Admin\Model;


use Admin\Logic\MySQLORM;
use Admin\Logic\NestedSets;
use Think\Model;

class GoodsCategoryModel extends Model
{

    /**
     * 获取分类列表
     * @return mixed
     */
    public function getList(){
        return $this->order('lft')->select();
    }

    /**
     * 添加新分类
     * @return false|int
     */
    public function addCategory(){
        unset($this->data['id']);
        $orm = new MySQLORM();
        $NestedSets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');
        return $NestedSets->insert($this->data['parent_id'], $this->data, 'bottom');
    }

    /**
     * 保存修改的商品分类
     * @return bool
     */
    public function saveCategory(){
        //获取原来的父级分类
        $old_parent_id = $this->where(['id'=>$this->data['id']])->getField('parent_id');
        //判断是否修改了父级分类
        if ($old_parent_id != $this->data['parent_id']) {
            //需要计算左右节点和层级 使用nestedsets
            $orm = new MySQLORM();
            $NestedSets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');
            //判断是否移动到本类或者子类
            if ($NestedSets->moveUnder($this->data['id'], $this->data['parent_id'],'bottom') === false) {
                $this->error = '移动失败,非法操作';
                return false;
            }
        }
        //执行保存其他信息sql
        return $this->save();
    }


    /**
     * 删除分类及其子分类
     * @param $id
     * @return bool
     */
    public function deleteCategory($id){
        $orm = new MySQLORM();
        $NestedSets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');
        if ($NestedSets->delete($id) === false) {
            $this->error = '删除失败';
            return false;
        }
        return true;
    }
}