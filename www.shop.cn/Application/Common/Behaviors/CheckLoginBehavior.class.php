<?php

namespace Common\Behaviors;


use Think\Behavior;

class CheckLoginBehavior extends Behavior
{

    public function run(&$param){
        //获取当前页面url
        $url = MODULE_NAME .'/'. CONTROLLER_NAME .'/'. ACTION_NAME;

        //获取需要验证登陆的url列表
        $memberUrlList = C('MEMBER_URL_LIST');

        //判断url是否在验证列表中
        if (in_array($url,$memberUrlList)) {

            //在验证列表,判断登陆状态,没登陆就执行跳转
            if (D('Member')->memberAutoLogin() === false) {
                $url = U('Member/login');
                redirect($url);
            }
        }

    }
}