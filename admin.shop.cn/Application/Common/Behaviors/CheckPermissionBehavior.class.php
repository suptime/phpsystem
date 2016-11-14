<?php

namespace Common\Behaviors;

class CheckPermissionBehavior extends \Think\Behavior
{
    //行为执行入口
    public function run(&$param){
        //定义排除url列表
        $debar = array(
            'Admin/Admin/login',
            'Admin/Admin/captcha',
        );

        $url = MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;
        if (in_array($url,$debar)) {
            return true;
        }
        //获取session
        $userinfo = session('USERINFO');
        //判断userinfo是否
        if (!$userinfo) {
            //session不存在就判断是否存在cookie
            //调用autoLogin去判断
            if (D('Admin')->autoLogin() == false) {
                //如果自动登陆失败,重定向到登陆页面
                $url = U('Admin/login');
                redirect($url);
            }
        }
        return true;
    }
}