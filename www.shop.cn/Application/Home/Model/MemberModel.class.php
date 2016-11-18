<?php

/**
 * 会员功能模型
 * createTime: 2016-11-17 17:33:44
 * author: by Nano
 */

namespace Home\Model;

use Org\Util\String;
use Think\Model;
use Think\Verify;

class MemberModel extends Model
{
    //开启批量验证
    protected $patchValidate = true;

    //自动验证
    protected $_validate = array(
        //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
        array('username','require','用户名不能为空'),
        array('username','','用户名已注册',self::EXISTS_VALIDATE,'unique','reg'),
        array('password','6-20','密码长度错误',self::EXISTS_VALIDATE,'length'),
        array('repassword','require','验证密码不能为空'),
        array('repassword','password','验证密码与原密码不一致',self::EXISTS_VALIDATE,'confirm'),
        array('email','require','邮箱不能为空'),
        array('email','','邮箱已被占用',self::EXISTS_VALIDATE,'unique','reg'),
        array('tel','/^1[34578]\d{9}$/','手机号码不正确'),
        array('sms','require','短信验证码不能为空'),
        array('sms','checkTelCode','验证码不正确或手机号码已更换',self::EXISTS_VALIDATE,'callback'),
        array('checkcode','require','验证码不能为空'),
        array('checkcode','verifyCode','验证码不正确',self::EXISTS_VALIDATE,'callback'),
    );

    protected $_auto = array(
        //array(完成字段1,完成规则,[完成条件,附加规则]),
        array('add_time',NOW_TIME,'reg'),
        array('salt','\Org\Util\String::randString','reg','function'),
    );

    /**
     * 验证验证码是否正确
     * @param $code 字段值
     * @return bool 成功返回true,失败返回false
     */
    protected function verifyCode($code){
        $verify = new Verify();
        return $verify->check($code);
    }

    /**
     * 检查短信验证码是否正确
     * @return bool 布尔值
     */
    protected function checkTelCode(){
        //读取SESSION
        $smsInfo = session('SMS_INFO');
        $smsCode = session('SMS_CODE');
        //如果短信验证码session为空,未发送验证码
        if (empty($smsCode)) {
            return false;
        }

        //验证码填写正确,手机对应
        if ((I('post.sms') != $smsCode) && ($smsInfo['tel'] != I('post.tel'))) {
            return false;
        }

        //重置SESSION值
        session('SMS_CODE',null) ;

        //验证码填写不正确,手机号码不对应.返回false
        return true;
    }


    /**
     * 会员注册添加数据方法
     * @return bool 布尔值
     */
    public function addMember() {
        //获得加盐加密后的密码
        $this->data['password'] = salt_mcrypt($this->data['password'],$this->data['salt']);

        //生成验证令牌
        $this->data['token'] = String::randString(32);
        //邮件验证token
        $this->data['active_token'] = $this->data['token'];

        //获取邮箱地址
        $address = $this->data['email'];

        //获取跳转激活地址
        $url = U('Member/active', array('active_token' => $this->data['active_token'], 'email' => $this->data['email'],'hash_equals'=>String::randString(64)), '', true);

        //邮件内容
        $subject = '拉邦购商城新会员激活邮件';  //主题
        $content = '<p>尊敬的'.$this->data['username'].'：</p><p style="text-indent:2em;">您好！</p><p>&nbsp;</p><p style="text-indent:2em;">感谢您注册拉邦购会员,账号需要激活才能使用,请 <a href="'.$url.'" style="color:#ff0000; font-weight:bold">点击激活账号</a> 完成您的会员账号激活.</p><p style="text-indent:2em;">如果无法点击,请复制下面的地址在浏览器中粘贴打开</p><p style="text-indent:2em;">'. $url .'</p><p>&nbsp;</p><p>拉邦购商城 http://www.labanggou.com</p><p>本邮件由系统自动发送，请勿回复!</p>';

        //添加会员数据
        if ($this->add() === false) {
            $this->error = '注册会员失败';
            return false;
        }

        //发送邮件
        $result = sendMail($address,$subject,$content);
        if (!$result) {
            $this-> error ='邮件发送失败,请登录账号后重新发送激活邮件';
        }

        //成功后返回true
        return true;
    }

}