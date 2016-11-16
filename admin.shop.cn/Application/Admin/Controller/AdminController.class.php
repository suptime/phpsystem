<?php

namespace Admin\Controller;


use Think\Controller;
use Think\Verify;

class AdminController extends Controller
{

    /**
     * 管理员列表
     * @param string $keyword   传入的搜索关键词
     */
    public function index($keyword=''){
        $adminModel = D('Admin');
        //判断是否获取数据成功
        if (!($list = $adminModel->getList($keyword))) {
            $this->error($adminModel->$list['msg']);
        }
        $this->assign('list',$list['list']);
        $this->assign('page',$list['pageHtml']);
        $this->display();
    }

    /**
     * 添加管理员操作
     */
    public function add(){

        $adminModel = D('Admin');
        if (IS_POST) {
            //收集数据
            if ($adminModel->create('','reg') === false) {
                $this->error(get_error($adminModel));
            }
            //插入数据
            if ($adminModel->addAdmin() === false) {
                $this->error(get_error($adminModel));
            }
            $this->success('添加管理员成功',U('index'));
        }else{
            //获得角色列表
            $this->getRoleList();
            $this->display();
        }
    }

    /**
     * 修改管理员
     * @param $id   当前用户id
     */
    public function edit($id){

        $adminModel = D('Admin');
        if (IS_POST) {

            //收集数据
            if ($adminModel->create() === false) {
                $this->error(get_error($adminModel));
            }

            //修改数据
            if ($adminModel->saveAdmin($id) === false) {
                $this->error(get_error($adminModel));
            }

            //修改成功跳转
            $this->success('修改管理员成功',U('index'));
        }else{
            $row = $adminModel->find($id);
            $this->assign($row);

            //获得角色列表
            $this->getRoleList();

            //角色权限关联数据
            $admin_role = M('adminRole')->where("admin_id = $id")->getField('role_id',true);
            if (!$admin_role) {
                $admin_role =array();
            }

            $this->assign('roleCurrent',$admin_role);

            $this->display('add');
        }
    }


    /**
     * 管理员登陆
     */
    public function login(){
        if (IS_POST) {
            $adminModel = D('Admin');
            //判断验证码是否输入正确
            $verify = new Verify();
            $code = trim(I('post.captcha'));
            if (!$verify->check($code)) {
                $this->error('验证码错误');
                exit;
            }
            //判断收集数据是否成功
            if (!$adminModel->create()) {
                $this->error(get_error($adminModel));
            }
            //判断登陆是否成功
            if (!$adminModel->adminLogin()) {
                $this->error('用户名或密码错误');
            }
            //成功跳转
            $this->success('登陆成功,欢迎回来',U('Index/index'));
        }else{
            //判断session是否存在
            $userinfo = session('ADMIN_INFO');
            if (isset($userinfo)) {
                $this->success('您已登录,无需再次登录',U('Index/index'));
                exit;
            }
            $this->display();
        }
    }

    /**
     * 退出登陆
     */
    public function logout()
    {
        session(null);
        cookie(null);
        //跳转url
        $url = U('Admin/login');
        redirect($url);
    }

    private function getRoleList(){
        //获取所有的角色
        $roles = D('Role')->getList();
        $this->assign('roles', $roles);
    }
}