<?php

namespace Admin\Controller;

use Think\Controller;

class MenuController extends Controller
{
    private $_model = null;

    protected function _initialize() {
        $this->_model = D('Menu');
    }

    /**
     * 菜单列表
     */
    public function index(){
        //获得所有菜单列表
        $menus = $this->_model->getlist();
        $this->assign('menus',$menus);
        $this->display();
    }

    /**
     * 添加菜单
     */
    public function add(){
        if (IS_POST) {
            //接收数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            //添加菜单项
            if ($this->_model->addMenu() === false) {
                $this->error(get_error($this->_model));
            }
            //成功跳转
            $this->success('添加菜单成功',U('index'));
        }else{
            $this->_getPermissionMenus();
            $this->display();
        }
    }

    public function edit ($id){
        if (IS_POST) {
            //接收数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            //修改菜单项
            if ($this->_model->saveMenu($id) === false) {
                $this->error(get_error($this->_model));
            }
            //成功跳转
            $this->success('修改菜单成功',U('index'));
        }else{
            $row = $this->_model->find($id);
            $this->assign('row',$row);

            //获取回显的选中权限数据
            $power = $this->_model->getMenuPermissionData();
            $this->assign('power',$power);

            $this->_getPermissionMenus();
            $this->display('add');
        }
    }

    public function remove($id){
        //执行删除菜单方法
        if ($this->_model->delMenu($id) === false) {
            $this->error(get_error($this->_model));
        }
        //成功跳转
        $this->success('删除菜单成功',U('index'));
    }

    /**
     * 获取权限列表和顶级菜单列表视图数据
     * 输出:  $menus  分类列表
     *       $permissions   权限列表
     */
    private function _getPermissionMenus(){
        //获得所有菜单列表
        $menus = $this->_model->getlist();
        //加入顶级菜单项
        array_unshift($menus, array('id' => 0, 'name' => '顶级菜单'));
        $this->assign('menus',$menus);

        //获得所有的权限列表
        $permissions = D('Permission')->getListData();
        $this->assign('permissions',$permissions);
    }

}