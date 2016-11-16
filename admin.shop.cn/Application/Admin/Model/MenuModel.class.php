<?php

namespace Admin\Model;


use Admin\Logic\MySQLORM;
use Admin\Logic\NestedSets;
use Think\Model;

class MenuModel extends Model
{
    //开启批量验证
    protected $patchValidate = true;

    //自动验证规则
    protected $_validate = array(
        array('name','require','菜单名称不能为空！'),
        //array('path','require','菜单URL地址不能为空！'),
    );

    /**
     * 获取菜单列表
     * @return mixed    数组
     */
    public function getlist(){
        return $this->order('lft')->select();
    }

    /**
     * 添加菜单及权限
     * @return bool 成功返回true.失败返回false 并返回错误信息
     */
    public function addMenu(){

        //开启事务
        $this->startTrans();

        $orm = new MySQLORM();
        $nestedsets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');
        if (($id = $nestedsets->insert($this->data['parent_id'], $this->data, 'bottom')) === false) {
            $this->error = '添加菜单失败';
            $this->rollback();
            return false;
        }

        //获得权限id
        $permission_ids = I('post.permission_id');
        //权限为空,直接提交保存
        if (empty($permission_ids)) {
            $this->commit();
            return true;
        }

        //遍历权限id数组,组合成新数组
        $data = array();
        foreach($permission_ids as $permission_id){
            $data[] = array(
                'menu_id' => $id,
                'permission_id' => $permission_id,
            );
        }

        //批量添加到菜单权限关联表中
        if (M('MenuPermission')->addAll($data) === false) {
            $this->error = '添加菜单权限关联失败';
            $this->rollback();
            return false;
        }

        //提交事务
        $this->commit();
        return true;
    }

    /**
     * 修改菜单
     * @param $id
     * @return bool
     */
    public function saveMenu($id){

        //开启事务
        $this->startTrans();

        //获取原始父级id
        $old_parent_id = $this->where("id = $id")->getField('parent_id');

        //判断父级id与新提交的父级id是否相等,不相等执行以下代码
        if ($old_parent_id != $this->data['parent_id']) {
            $orm = new MySQLORM();
            $nestedsets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');
            if ($nestedsets->moveUnder($id,$this->data['parent_id'],'bottom') === false) {
                $this->error = '不能移动到自己或后代菜单中';
                $this->rollback();
                return false;
            }
        }

        //获得权限id
        $permission_ids = I('post.permission_id');
        if (empty($permission_ids)) {
            //保存其他数据包数据表
            if ($this->save() === false) {
                $this->error = '保存菜单URL地址失败';
                $this->rollback();
                return false;
            }

            $this->commit();
            return true;
        }

        //遍历权限id数组,组合成新数组
        $data = array();
        foreach($permission_ids as $permission_id){
            $data[] = array(
                'menu_id' => $id,
                'permission_id' => $permission_id,
            );
        }

        //删除旧的权限对应关系
        if (M('MenuPermission')->where(array('menu_id'=>$id))->delete() === false) {
            $this->error = '删除旧菜单权限关联失败';
            $this->rollback();
            return false;
        }

        //批量添加到菜单权限关联表中
        if (M('MenuPermission')->addAll($data) === false) {
            $this->error = '修改菜单权限关联失败';
            $this->rollback();
            return false;
        }

        //保存其他数据包数据表
        if ($this->save() === false) {
            $this->error = '保存菜单URL地址失败';
            $this->rollback();
            return false;
        }

        //提交事务
        $this->commit();
        return true;
    }


    /**
     * 删除菜单项
     * @param $id   当前id
     * @return bool 返回布尔值, true  false
     */
    public function delMenu($id){

        //开启事务
        $this->startTrans();

        $orm = new MySQLORM();
        $nestedsets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');

        //删除当前id菜单以及子菜单
        if ($nestedsets->delete($id) === false) {
            $this->rollback();
            $this->error = '删除菜单项失败';
            return false;
        }

        //删除菜单权限关联表数据
        $MPModel = M('MenuPermission');
        if($MPModel->where(['menu_id' => $id])->delete() === false){
            $this->error = '删除菜单权限关联失败';
            $this->rollback();
            return false;
        }

        //提交事务
        $this->commit();
        return true;
    }


    /**
     * 获取已选中保存在数据库中的权限id列表
     * @return mixed    已有的权限id数组
     */
    public function getMenuPermissionData(){
        //获取已选中的权限
        $menuPermissionModel = M('MenuPermission');
        $data = $menuPermissionModel->where(array('menu_id'=>$this->data['id']))->getField('permission_id',true);
        return $data;
    }

}