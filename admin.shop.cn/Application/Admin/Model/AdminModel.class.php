<?php

namespace Admin\Model;


use Think\Model;
use Think\Page;

class AdminModel extends Model
{

    /**
     * 自动验证表单
     * @var array
     */
    protected $_validate = array(
        //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
        array('username','require','用户名不能为空','','',self::MODEL_INSERT),
        array('username','verifyUserName','用户名已存在','','callback',self::MODEL_INSERT),
        array('email','require','邮箱不能为空'),
        array('email','email','邮箱格式不正确'),
        array('email','verifyEmail','邮箱已存在',self::MUST_VALIDATE,'callback'),
        array('password','require','密码不能为空','','',self::MODEL_INSERT),
        array('password','6,18','密码在6-18位之间','','length',self::MODEL_INSERT),
        array('repassword','password','两次密码输入不一致',0,'confirm',self::MODEL_INSERT),
    );

    /**
     * 自动完成补齐数据
     * @var array
     */
    protected $_auto = array(
        //array(完成字段1,完成规则,[完成条件,附加规则]),
        array('add_time',NOW_TIME),
        array('last_login_time',NOW_TIME,3),
        array('last_login_ip','get_client_ip',3,'function'),
    );

    /**
     * 获取管理员列表
     */
    public function getList($keyword,$p=1){
        $cond = array();
        if (isset($keyword) && !empty($keyword)) {
            $cond['username'] = array('like','%'.$keyword.'%');
            $cond['email'] = array('like','%'.$keyword.'%');
            $cond['_logic'] = 'or';
        }

        $total = $this->where($cond)->count();
        $page = new Page($total,C('PAGES.PAGESIZE'));
        $pageHtml = $page->show();
        $rows = $this->where($cond)->order('id desc')->page(I('get.p'),C('PAGES.PAGESIZE'))->select();
        //var_dump($this->getLastSql());
        $msg = '';
        if (!$rows) {
            $msg = $this->getError();
        }
        return array(
            'pageHtml'=>$pageHtml,
            'list'=>$rows,
            'msg'=>$msg
        );
    }

    /**
     * 添加管理员
     * @return mixed
     */
    public function addAdmin(){
        //加密后的密码
        $arr = $this->createSaltStr($this->data['passowrd']);
        $this->data['password'] = $arr['password'];
        $this->data['salt'] = $arr['salt'];

        $this->data['token'] = md5(substr($arr['password'].$this->data['username'],0,10));      //token
        $this->data['token_create_time'] = NOW_TIME;        //token生成时间

        return $this->add();
    }


    public function saveAdmin(){
        //移除用户名
        unset($this->data['username']);
        $newPassword = $this->data['password'];

        if ($newPassword) {
            $arr = $this->createSaltStr($newPassword);
            $password = $arr['password'];
            $salt = $arr['salt'];
            //修改后的密码
            $this->data['password'] = $password;
            $this->data['salt'] = $salt;
        }else{
            unset($this->data['password']);
        }

        //操作数据库
        if (!$this->save()) {
            return false;
        }

        return true;
    }

    /**
     * 密码生成方法
     * @param $password     用户填写的密码字符串
     * @return array   返回一个一维数组
     */
    private function createSaltStr($password){
        $str = '1234567890QWERTYUIOPASDFGHJKLZXCVBNM';
        $shuffle_str = str_shuffle($str);
        $salt = substr($shuffle_str,5,6);     //6位加盐字符串
        return array(
            'salt'=>$salt,
            'password'=>md5(md5($password) . md5($salt))
        );
    }

    /**
     * 获取验证数据
     * @return mixed    二维数组
     */
    private function getVerifyData(){
        return $this->field('id,username,email')->select();
    }

    /**
     * 自动验证邮箱是否存在的回调方法
     * @param $email   输入的邮箱地址
     * @return bool 布尔值
     */
    protected function verifyEmail($email){
        $data = $this->getVerifyData();
        foreach($data as $v){
            if ($v['email'] == $email && $v['id'] != I('post.id')) {
                return false;
            }
        }
        return true;
    }

    /**
     * 自动验证用户名是否存在的回调方法
     * @param $username     输入的用户名
     * @return bool     布尔值
     */
    protected function verifyUserName($username){
        $data = $this->getVerifyData();
        foreach($data as $v){
            if ($v['username'] == $username) {
                return false;
            }
        }
        return true;
    }
}