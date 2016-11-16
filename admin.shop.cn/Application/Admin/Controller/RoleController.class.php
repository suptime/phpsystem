<?php

namespace Admin\Controller;


use Think\Controller;

class RoleController extends Controller
{
    //实例化的Role对象
    private $_model;
    //初始化model
    protected function _initialize(){
        $this->_model = D('Role');
    }

    public function index(){
        //获取搜索关键字
        $keyword = trim(I('get.keyword'));

        //查询条件
        $condition = [];
        if ($keyword) {
            $condition['name'] = array('like','%'.$keyword.'%');
        }

        //获取角色列表
        if (($rows = $this->_model->getPageList($condition)) === false) {
            $this->error(get_error());
        }

        //获取分页后的角色数据
        $this->assign('rows',$rows['rows']);
        $this->assign('pageHtml',$rows['pageHtml']);
        $this->display();
    }

    /**
     * 添加角色权限绑定
     */
    public function add(){
        if (IS_POST) {
            //收集数据
            if ($this->_model->create() == false) {
                $this->error(get_error(get_error($this->_model)));
            }
            //添加角色
            if ($this->_model->addRole() == false) {
                $this->error(get_error(get_error($this->_model)));
            }
            //成功跳转
            $this->success('添加角色成功',U('index'));
        }else{
            //获得权限列表数据
            $this->assign('permissions',D('Permission')->getListData());
            $this->display();
        }
    }


    /**
     * 修改角色权限
     * @param $id   角色id
     */
    public function edit($id){
        if (IS_POST) {
            //收集数据
            if ($this->_model->create() === false) {
                echo 111;
                $this->error(get_error($this->_model));
            }
            //保存数据
            if ($this->_model->saveRole($id) === false) {
                $this->error(get_error($this->_model));
            }
            //成功跳转
            $this->success('修改角色成功',U('index'));
        }else{
            //获取角色与角色权限关联数据
            $row = $this->_model->getRoleInfo($id);
            //基本信息输出
            $this->assign('row',$row);

            //绑定的角色权限
            $this->assign('permissionCurrent',$row['permissions']);

            //获得所有权限列表数据
            $this->assign('permissions',D('Permission')->getListData());
            $this->display('add');
        }
    }

    /**
     * 删除角色和权限关联
     * @param $id   当前角色id
     */
    public function remove($id){
        //删除角色和权限关联
        if ($this->_model->delRole($id) === false) {
            $this->error(get_error($this->_model));
        }
        //删除角色权限成功
        $this->success('删除角色成功',U('index'));
    }
}