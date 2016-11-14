<?php

namespace Admin\Controller;


use Think\Controller;
use Think\Verify;

class AdminController extends Controller
{

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

    public function add(){
        if (IS_POST) {
            $adminModel = D('Admin');
            //收集数据
            if ($adminModel->create('','reg') === false) {
                $this->error($adminModel->getError());
            }
            //插入数据
            if ($adminModel->addAdmin() === false) {
                $this->error('添加失败');
            }
            $this->success('添加管理员成功',U('index'));
        }else{
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
                $this->error($adminModel->getError());
            }
            //插入数据
            if ($adminModel->saveAdmin() === false) {
                $this->error('修改失败');
            }
            $this->success('修改管理员成功',U('index'));
        }else{
            $row = $adminModel->find($id);
            $this->assign($row);
            $this->display('add');
        }
    }


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
                $this->error($adminModel->getError());
            }
            //判断登陆是否成功
            if (!$adminModel->adminLogin()) {
                $this->error('用户名或密码错误');
            }
            //成功跳转
            $this->success('登陆成功,欢迎回来',U('Index/index'));
        }else{
            //判断session是否存在
            $userinfo = session('userinfo');
            if (isset($userinfo)) {
                $this->success('您已登录,无需再次登录',U('Index/index'));
                exit;
            }
            $this->display();
        }
    }

    /**
     * 生成一个验证码
     */
    public function captcha(){
        $config =	array(
            'fontSize'  =>  18,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'length'    =>  4,               // 验证码位数
            'bg'        =>  array(243, 251, 254),  // 背景颜色
            'reset'     =>  true,           // 验证成功后是否重置
        );

        $verify = new Verify($config);
        header('Content-Type:image/jpeg');
        $verify->entry();
    }

    public function logout()
    {
        session(null);
        cookie(null);
        //跳转url
        $url = U('Admin/login');
        redirect($url);
    }
}