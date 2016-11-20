<?php

/**
 * 前台会员功能控制器
 * createTime: 2016-11-17 17:33:44
 * author: by Nano
 */
namespace Home\Controller;

use Org\Util\String;
use Think\Controller;

class MemberController extends BaseController
{
    private $_model;

    public function _initialize(){
        parent::_initialize();
        $this->_model = D('Member');
    }


    /**
     * 会员中心首页
     */
    public function index(){
        //$this->_model->memberAutoLogin();
        $this->display('main');
    }


    /**
     * 会员注册方法
     */
    public function register(){
        if (IS_POST) {
            if ($this->_model->create('', 'reg') === false) {
                $this->error(get_error($this->_model));
            }
            if ($this->_model->addMember() === false) {
                $this->error(get_error($this->_model));
            }
            $this->success('注册成功,账号激活邮件已发送',U('login'));

        } else {
            $this->assign('title', '用户注册');
            $this->display();
        }
    }

    /**
     * 会员登陆功能
     */
    public function login(){
        if (IS_POST) {
            //收集数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            //用户登陆
            if ($this->_model->loginMember() === false) {
                $this->error(get_error($this->_model));
            }
            //成功跳转
            $this->success('登陆成功',U('index'));

        } else {
            //判断是否已登陆,如果已登陆就自动登陆
            if ($this->_model->memberAutoLogin()) {
                $this->success('您已经登录过了,无需重复登录',U('Member/index'));
                exit;
            }

            $this->assign('title', '用户登陆');
            $this->display();
        }
    }

    /**
     * 会员退出
     */
    public function logout(){
        session('MEMBER_LOGIN_INFOS',null);
        cookie('MEMBER_LOGIN_COOKIE',null);
        $url = U('Index/index');
        redirect($url);
    }


    /**
     * 用户注册成功邮件验证页面
     * @param $active_token 激活验证token
     * @param $email    注册的邮箱地址
     */
    public function active($active_token,$email){
        $result = $this->_model->where(array('active_token'=>$active_token,'email'=>$email,'status'=>0))->setField('status',1);
        //如果已经激活
        if ($this->_model->where(array('active_token'=>$active_token,'email'=>$email,'status'=>1))->count()) {
            $this->error('您的账号已经激活',U('Member/login'),1);
        }
        //账号激活失败
        if (!$result) {
            $this->error('账号激活失败,请登录会员中心重新发送激活邮件',U('Member/login'));
        }
        //激活成功,跳转到登陆页面
        $this->success('账号激活成功',U('Member/login'));
    }

    /**
     * ajax请求判断资料是否已存在
     */
    public function verifyParam(){
        if (IS_AJAX) {
            $get = I('get.');
            if ($this->_model->where($get)->count()) {
                $this->ajaxReturn(false);
            }else{
                $this->ajaxReturn(true);
            }
        }
        //返回fase
        $this->ajaxReturn(false);
    }

    /**
     * 发送短信验证码
     * @param $tel  传入的电话号码, GET
     */
    public function sendSms($tel){
        //判断是否是ajax请求
        if (IS_AJAX) {

            //验证电话号码是否合法
            if(preg_match('/^1[34578]\d{9}$/',$tel) == false){
                $this->ajaxReturn(array('status'=> false,'msg'=>'您输入的手机号码格式不正确','num'=>session('SEND_SMS_NO')));
                exit;
            }

            //引入短信Alidayu
            vendor('Alidayu.TopSdk');
            date_default_timezone_set('Asia/Shanghai');

            //获得实例对象
            $c = new \TopClient;
            $c ->appkey = (string)C('SMS.appkey');
            $c ->secretKey = C('SMS.secret') ;

            //获得发送验证码对象
            $req = new \AlibabaAliqinFcSmsNumSendRequest;

            //基本信息
            $create_tel_ip = array(
                'tel'=>$tel,
                'client_ip'=>get_client_ip(),
            );

            //先读取session
            $read_sms_info = session('SMS_INFO');

            //电话号码和ipsession如果不存在,就生成一个session
            if (!isset($read_sms_info)) {
                session('SMS_INFO',$create_tel_ip);     //*****SMS_INFO*****
            }

            //如果sessionip与当前ip不相等
            if ($create_tel_ip['client_ip'] != $read_sms_info['client_ip']) {
                session('SMS_INFO',$create_tel_ip);     //*****SMS_INFO*****
            }

            //获得短信发送间隔时间
            $time = NOW_TIME-session('SMS_SEND_TIME');

            //生成短信验证码
            $create_sms_code = String::randNumber(100000,999999);

            //如果短信发送失败
            if ($time < 300 && $read_sms_info['tel'] == I('get.tel')) {
                //获得session里面的code,生成短信验证码
                $create_sms_code = session('SMS_CODE');
            }

            //生成短信验证码session
            session('SMS_CODE',$create_sms_code);  //*****SMS_CODE*****

            //更新或生成时间session
            session('SMS_SEND_TIME',NOW_TIME);  //*****SMS_SEND_TIME*****
            session('SMS_INFO',$create_tel_ip);    //*****SMS_INFO*****

            //验证是否重复发送验证码
            if ($this->_checkRepeatSms() === false) {
                $this->ajaxReturn(array('status'=> false,'msg'=>'发送验证码次数过多','num'=>session('SEND_SMS_NO')));
            }

            //发送的消息内容
            $messege_content = array(
                'name' => '拉邦购新用户',
                'webname' => C('SMS.webname'),
                'verfiycode' => $create_sms_code,
            );

            $req ->setExtend( "" );
            $req ->setSmsType( "normal" );
            $req ->setSmsFreeSignName( C('SMS.autograph') );    //阿里大于短信应用签名
            $req ->setSmsParam( json_encode($messege_content) ); //发送内容
            $req ->setRecNum( $tel );   //接收手机号码
            $req ->setSmsTemplateCode( C('SMS.TemplateCode') );     //短信模板编号

            //执行发送验证码
            $resp = $c ->execute( $req );

            //判断执行状态
            if (isset($resp->result->success)) {
                $this->ajaxReturn(array('status'=> true,'msg'=>'短信验证码发送成功,请注意查收','num'=>session('SEND_SMS_NO')));
            }
        }

        //不是直接返回false报错
        $this->ajaxReturn(array('status'=> false,'msg'=>'短信验证码发送失败','num'=>session('SEND_SMS_NO')));
    }


    /**
     * 验证是否是重复发送手机验证码
     */
    private function _checkRepeatSms(){
        //判断发送验证码次数是否大于规定次数
        $smsInfo = session('SMS_INFO');

        //获取session里面的ip
        $ip = $smsInfo['client_ip'];
        $now_client_ip = get_client_ip();    //当前用户ip
        $tel_no = $smsInfo['tel'];    //当前用户ip

        //获取短息已发次数
        $sendSmsNo = session('SEND_SMS_NO');
        //如果session不存在,创建session并给默认值0
        if (!isset($sendSmsNo)) {
            //初始化创建SESSION
            session('SEND_SMS_NO',0);
        }

        //如果ip不相等,重置session的值为0
        if ($ip != $now_client_ip) {
            session('SEND_SMS_NO',0);
        }

        //判断是否次数和ip符合条件
        if ($sendSmsNo > 2 && $ip == $now_client_ip && $tel_no == I('get.tel')) {
            //返回的数据
            return false;
            exit;
        }

        //执行+1操作
        session('SEND_SMS_NO',$sendSmsNo+1);
        return true;
    }



}