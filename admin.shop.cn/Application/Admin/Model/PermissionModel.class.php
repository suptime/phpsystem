<?php

namespace Admin\Model;


use Admin\Logic\MySQLORM;
use Admin\Logic\NestedSets;
use Think\Model;

class PermissionModel extends Model
{
    //批量验证开启
    protected  $patchValidate = true;
    //自动验证规则
    protected $_validate = array(
        array('name','require', '权限名称不能为空'),
        array('parent_id','require', '上级权限不能为空')
    );

    /**
     * 获得权限列表
     * @return mixed    成功返回数组,失败返回false
     */
    public function getListData(){
        return $this->order('lft')->select();
    }

    /**
     * 添加权限的方法
     * @return bool 成功返回true,失败返回false
     */
    public function addPermission(){
        //使用插件完成左右节点计算
        $orm = new MySQLORM();
        $nestedsets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');
        //使用nestedsets对象插入节点数据
        $result = $nestedsets->insert($this->data['parent_id'], $this->data, 'bottom');
        if (!$result) {
            $this->error = '添加权限失败';
            return false;
        }
        return true;
    }


    /**
     * 修改权限
     * @return bool 返回值,成功返回数据,失败返回false
     */
    public function savePermission($id){

        //获取传入的id获取parent_id进行判断
        $old_parent_id = $this->where(array('id'=>$this->data['id']))->getField('parent_id');

        //判断是否能够合法移动,parent_id相同,直接保存表单数据并返回
        if ($old_parent_id == $this->data['parent_id']) {
            //直接保存修改的数据
            $this->save();
            return true;
        }

        //使用NestedSets完成左右节点计算
        $orm = new MySQLORM();
        $nestedsets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');
        //使用nestedsets对象插入节点数据
        $result = $nestedsets->moveUnder($id,$this->data['parent_id'], 'bottom');

        //移动失败,返回false
        if (!$result) {
            $this->error = '修改失败,不能移动到自己或子集中';
            return false;
        }

        //保存基本信息
        return $this->save();
    }

    /**
     * 删除权限
     * @param $id   当前删除的权限id
     * @return bool 成功返回true,失败返回false
     */
    public function delPermission($id){
        //开启事务
        $this->startTrans();

        //根据删除的记录id获取子权限
        $row = $this->find($id);

        //查询子集集合
        $cond['lft']  = array('EGT',$row['lft']);
        $cond['rght']  = array('ELT',$row['rght']);

        //获得符合条件的子权限
        $data = $this->where($cond)->field('id as permission_id')->select();

        //根据权限id删除角色权限关联表中符合的数据
        $data['_logic'] = 'OR';     //使用or链接执行sql
        if (M('RolePermission')->where($data)->delete() === false) {
            $this->error = '删除角色权限关联失败';
            $this->rollback();
            return false;
        }

        //使用$NestedSets插件
        $orm = new MySQLORM();
        $NestedSets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');

        //使用nestedsets执行删除权限,失败发挥false
        if ($NestedSets->delete($id) === false) {
            $this->error = '删除权限失败';
            $this->rollback();
            return false;
        }

        //提交事务
        $this->commit();
        return true;
    }

    /**
     * 递归获取子权限和孙子权限
     * @param $rows 原始数据
     * @param $parent_id    父级id
     * @return array    返回数组
     */
    private function _getDelPermissionIds($rows,$parent_id){
        static $ids = array();
        foreach($rows as $row){
            if ($row['parent_id'] == $parent_id) {
                $ids[]=$row['id'];
                $this->_getDelPermissionIds($rows,$row['id']);
            }
        }
        return $ids;
    }

}