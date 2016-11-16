<?php

namespace Admin\Model;


use Think\Model;
use Think\Page;

class RoleModel extends Model
{

    /**
     * 获取角色列表数据
     * @param $condition    搜索查询条件
     * @return array    返回数组
     */
    public function getPageList($condition){
        //获取分页数据
        $total = $this->where($condition)->count();
        $page = new Page($total,C('PAGES.PAGESIZE'));
        $pageHtml = $page->show();

        //分页后数据显示
        $rows = $this->where($condition)->page(trim(I('get.p')),C('PAGES.PAGESIZE'))->select();

        if (!$rows) {
            $this->error = '获取角色列表失败';
        }

        //返回数组
        return compact('rows', 'pageHtml');
    }

    /**
     * 添加角色权限关联
     * @return bool 返回布尔值, 成功true,失败false
     */
    public function addRole(){
        //开启事务
        $this->startTrans();

        //保存基本信息,成功返回role_id
        $role_id = $this->add();
        if ($role_id == false) {
            $this->error = '添加数据失败';
            $this->rollback();  //回滚数据
            return false;
        }

        //保存关联关系
        $permissions = I('post.permission_id');
        //如果是顶级权限分类,可不用选择权限
        if (empty($permissions)) {
            $this->commit();    //提交事务
            return true;
        }

        //获取到所有的权限到中间表, 角色-权限    表
        $role_permission = [];
        //遍历获得的数据
        foreach($permissions as $v){
            $role_permission[] = array(
                'role_id' => $role_id,
                'permission_id' => $v
            );
        }

        //将权限对应数据插入到    角色-权限   表
        if (M('RolePermission')->addAll($role_permission) == false) {
            $this->error = '添加角色权限关联失败';
            $this->rollback();  //回滚数据
            return false;
        }

        $this->commit();    //提交事务
        //全部执行成功,返回true
        return true;
    }


    /**
     * 修改角色权限
     * @param $id   默认角色id
     * @return bool 成功返回true,失败返回false
     */
    public function saveRole($id){
        //开启事务
        $this->startTrans();

        //保存基本信息
        if ($this->save() === false) {
            $this->error = '保存失败';
            $this->rollback();
            return false;
        }

        //保存权限关联
        $RPModel = M('RolePermission');

        //先删除旧的权限关联
        $result = $RPModel->where(array('role_id'=>$id))->delete();
        if ($result === false) {
            $this->error = '删除角色权限关联失败';
            $this->rollback();
            return false;
        }

        //接收数据
        $permissions = I('post.permission_id');

        //如果是空角色权限,不勾选也可以通过
        if (empty($permissions)) {
            $this->commit();    //提交事务
            return true;
        }

        //构建角色-权限关联数据
        $RPData = [];
        //遍历获得的权限id
        foreach($permissions as $p_id){
            $RPData[] = array(
                'role_id' => $id,
                'permission_id' => $p_id
            );
        }

        //保存权限数据
        if ($RPModel->addAll($RPData) === false) {
            $this->error = '保存新角色权限关联数据失败';
            $this->rollback();
            return false;
        }

        $this->commit();    //提交事务
        return true;
    }


    /**
     * 删除角色,角色权限关联数据
     * @param $id   角色id
     * @return bool 成功返回true,失败返回false
     */
    public function delRole($id){
        //开启事务
        $this->startTrans();

        //删除角色表数据
        if ($this->where("id = $id")->delete() === false) {
            $this->error = '删除角色失败';
            $this->rollback();
            return false;
        }

        //删除角色,权限关联表数据
        $RPModel = M('RolePermission');
        if($RPModel->where(['role_id' => $id])->delete() === false){
            $this->error = '删除角色权限关联失败';
            $this->rollback();
            return false;
        }

        $this->commit();    //提交事务
        return true;
    }

    /**
     * 获取角色与角色权限关联数据
     * @param $id   当前角色id
     * @return mixed    返回数组
     */
    public function getRoleInfo($id){
        //获得角色基本信息
        $row = $this->find($id);
        $row['permissions'] = M('RolePermission')->where(array('role_id'=>$id))->getField('permission_id',true);
        return $row;
    }

    /**
     * 获取所有的角色
     * @return type 数组
     */
    public function getList() {
        return $this->order('sort')->select();
    }
}
