<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Verify;

class CaptchaController extends Controller
{

    /**
     * 生成一个验证码
     */
    public function code(){
        //实例化验证码类
        $verify = new Verify(C('CAPTCHA'));
        //设置头信息
        header('Content-Type:image/jpeg');
        //输出验证码
        $verify->entry();
    }
}