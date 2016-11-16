<?php

namespace Admin\Controller;


use Think\Controller;

class PermissionController extends Controller
{
    //实例化的对象
    private $_model;
    //自定义初始化执行实例model方法
    protected function _initialize(){
        $this->_model = D('Permission');
    }

    /**
     * 权限列表方法
     */
    public function index(){
        //获取权限列表数据
        $rows = $this->_model->getListData();
        //分配数据
        $this->assign('rows',$rows);
        //选择视图
        $this->display();
    }

    /**
     * 添加新的权限方法
     */
    public function add(){
        if (IS_POST) {
            //收集表单数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            //添加数据
            if ($this->_model->addPermission() === false) {
                $this->error(get_error($this->_model));
            }
            //添加成功后跳转
            $this->success('添加权限成功',U('index'));
        }else{
            //获取全部权限列表
            $this->getPermissionsData();
            $this->display();
        }
    }


    /**
     * 修改权限
     * @param $id   当前修改权限数据的id主键
     */
    public function edit($id){
        if (IS_POST) {
            //收集表单数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            //保存修改后的权限
            if ($this->_model->savePermission($id) === false) {
                $this->error(get_error($this->_model));
            }
            //成功跳转提示
            $this->success('修改权限成功',U('index'));
        }else{
            //查找到当前id数据
            $row = $this->_model->find($id);
            $this->assign('row',$row);
            //获取全部权限列表
            $this->getPermissionsData();
            //引入视图
            $this->display('add');
        }
    }

    /**
     * 删除权限
     * @param $id   传入的权限数据id
     */
    public function remove($id){
        //删除指定权限
        if ($this->_model->delPermission($id) === false) {
            $this->error(get_error($this->_model));
        }
        //删除权限成功跳转
        $this->success('删除权限成功',U('index'));
    }

    /**
     * 获取权限数据列表
     */
    private function getPermissionsData(){
        //获取已有权限列表
        $permissions = $this->_model->getListData();
        //在获得的数组顶部插入一个数组
        array_unshift($permissions, array('id' => 0, 'name' => '顶级权限'));
        //输出json字符串
        //$this->assign('permissions', json_encode($permissions));
        $this->assign('permissions', $permissions);
    }
}