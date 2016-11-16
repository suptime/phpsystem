<?php

namespace Common\Behaviors;

class CheckPermissionBehavior extends \Think\Behavior
{
    //行为执行入口
    public function run(&$param){
        //定义排除url列表
        $debar = array(
            'Admin/Admin/login',
            'Admin/Captcha/code',
        );

        //获得当前页面的URL地址
        $url = MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;
        if (in_array($url,$debar)) {
            return true;
        }

        //获取session
        $userinfo = session('ADMIN_INFO');

        //判断userinfo是否
        if (!$userinfo) {
            //session不存在就判断是否存在cookie
            //调用autoLogin去判断
            if ($userinfo = D('Admin')->autoLogin() === false) {
                //如果自动登陆失败,重定向到登陆页面
                $url = U('Admin/login');
                redirect($url);
            }
        }

        //超级管理员
        if ($userinfo['id'] == 1) {
            return true;
        }



        if (in_array($url,$urls) == false) {
            return false;
        }

        return true;
    }
}