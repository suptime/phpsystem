<?php
/**
 * Created by PhpStorm.
 * User: Nano
 * Date: 2016/11/23
 * Time: 14:11
 */

namespace Admin\Model;


use Org\Util\String;
use Think\Model;
use Think\Page;

class MemberModel extends Model
{
    //开启批量验证
    protected $patchValidate = true;

    //自动验证规则
    protected $_validate = array(
        array('username','require','用户名不能为空'),
        array('username','','用户名已注册',self::EXISTS_VALIDATE,'unique','reg'),
        array('password','require','密码不能为空',self::EXISTS_VALIDATE,'','reg'),
        array('password','6,20','密码长度错误',self::VALUE_VALIDATE,'length'),
        array('repassword','require','请再输入一次密码',self::VALUE_VALIDATE,'','reg'),
        array('repassword','password','验证密码与原密码不一致',self::VALUE_VALIDATE,'confirm'),
        array('email','require','邮箱不能为空'),
        array('email','','邮箱已被占用',self::EXISTS_VALIDATE,'unique','reg'),
        array('tel','/^1[34578]\d{9}$/','手机号码不正确'),
    );

    //自动完成规则
    protected $_auto = array(
        array('add_time',NOW_TIME,'reg'),
        array('salt','\Org\Util\String::randString',self::MODEL_BOTH,'function'),
    );


    /**
     * 获取会员数据列表
     * @param $cond     搜索条件
     * @return array    array|null
     */
    public function getMemberList($cond){
        //数据总数
        $total = $this->where($cond)->count();
        $page = new Page($total,C('PAGES.PAGESIZE'));
        $pageHtml = $page->show();

        //获取数据列表
        $list = $this->where($cond)->page(I('get.p'),C('PAGES.PAGESIZE'))->select();

        //返回数据
        return array(
            'members' => $list,
            'pageHtml' => $pageHtml,
        );
    }

    /**
     * 添加会员方法
     * @return bool true|false
     */
    public function addMember(){
        //获得加盐加密后的密码
        $this->data['password'] = salt_mcrypt($this->data['password'],$this->data['salt']);

        //生成验证令牌
        $this->data['token'] = String::randString(32);

        if ($this->add() === false) {
            $this->error = '添加会员失败';
            return false;
        }

        return true;
    }


    /**
     * 根据会员id修改会员信息
     * @param $id   当前会员id
     * @return bool true|false
     */
    public function saveMember($id){
        //判断是否填写了密码
        $password = $this->data['password'];
        if (!$password) {
            //没有填写密码
            unset($this->data['password']);
            unset($this->data['salt']);
        }else{
            $this->data['password'] = salt_mcrypt($password,$this->data['salt']);
        }

        //判断密码或手机号码是否已经被当前用户之外的用户占用
        $condtion = array(
            'tel' => array('eq',$this->data['tel']),
            'email' => array('eq',$this->data['email']),
            '_logic' => 'OR',
        );

        //查询符合条件的数据
        if ($this->where(array($condtion,'id' => array('neq',$id)))->select()) {
            $this->error = '手机号码或邮箱已被占用';
            return false;
        }

        //数据修改失败
        if ($this->save() === false) {
            $this->error = '修改会员信息失败';
            return false;
        }
        return true;
    }
}