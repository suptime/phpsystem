<?php

namespace Common\Behaviors;

class CheckPermissionBehavior extends \Think\Behavior
{
    //行为执行入口
    public function run(&$param){

        //获得当前页面的URL地址
        $url = MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;
        //在配置文件中的后台公共可访问页面白名单中查询是否存在该URL
        if (in_array($url,C('LOGIN_AFTER_ADMIN'))) {
            return true;
        }

        //获取登陆时保存的SESSION
        if (!($adminInfo = session('ADMIN_INFO'))) {
            //session不存在就判断是否存在cookie
            //调用autoLogin去判断
            if ($adminInfo = D('Admin')->autoLogin() === false) {
                //如果自动登陆失败,重定向到登陆页面
                $url = U('Admin/login');
                redirect($url);
            }
        }

        //后台管理员登陆后能看到的公共页面
        if (in_array($url,C('LOGIN_BEFORE_ADMIN'))) {
            return true;
        }

        //过滤超级管理员的权限
        if ($adminInfo['id'] == 1) {
            return true;
        }

        //获取url,判断是否有权限
        $path = session('ADMIN_PERSISSION_PATHES');
        if (in_array($url,$path)) {
            return true;
        }

        $cssUrl = C('TMPL_PARSE_STRING.__CSS__');
        //定义一个字符串
        echo "<!DOCTYPE html><html><head><title></title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/><link href=\"$cssUrl/general.css\" rel=\"stylesheet\" type=\"text/css\"/></head><body class='error_msg'><div class=\"box_border\"><h1>对不起! 您无权限访问此页面.</h1></div></body></html>";
        exit;
    }
}