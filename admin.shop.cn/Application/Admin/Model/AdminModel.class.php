<?php

namespace Admin\Model;


use Org\Util\String;
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
        array('username','verifyUserName','用户名已存在','','callback','reg'),
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
        $this->startTrans();

        //生成加盐加密密码和盐
        $arr = $this->createSaltStr($this->data['passowrd']);
        $this->data['password'] = $arr['password']; //生成后的密码
        $this->data['salt'] = $arr['salt']; //盐
        $this->data['add_time'] = NOW_TIME;

        //添加管理员到数据表
        if (!$admin_id = $this->add()) {
            $this->error = '添加管理员失败';
            $this->rollback();
            return false;
        }

        //获得角色列表
        $role_ids = I('post.role_id');
        //未选中角色,直接返回true
        if (empty($role_ids)) {
            $this->commit();
            return true;
        }

        //遍历角色id并保存到数组中
        $adminRoles = [];
        foreach($role_ids as $role_id){
            $adminRoles[] = array(
                'admin_id' => $admin_id,
                'role_id' => $role_id,
            );
        }

        //保存角色,管理员到,角色-管理员关联表
        if (M('AdminRole')->addAll($adminRoles) == false) {
            $this->error = '添加管理员角色关联数据失败';
            $this->rollback();
            return false;
        }

        $this->commit();
        return true;
    }

    /**
     * 修改管理员
     * @return bool
     */
    public function saveAdmin($id){
        //移除用户名
        unset($this->data['username']);
        $newPassword = $this->data['password'];

        //判断用户是否输入了新密码
        if ($newPassword) {
            $arr = $this->createSaltStr($newPassword);
            $password = $arr['password'];
            $salt = $arr['salt'];
            //修改后的密码
            $this->data['password'] = $password;
            $this->data['salt'] = $salt;
        }else{
            //用户未填写修改密码,删除password字段
            unset($this->data['password']);
        }

        //开启事务
        $this->startTrans();

        //获得角色列表
        $role_ids = I('post.role_id');

        //未选中角色,直接返回true
        if (empty($role_ids)) {
            $this->commit();
            return true;
        }

        //遍历角色id并保存到数组中
        $adminRoles = [];
        foreach($role_ids as $role_id){
            $adminRoles[] = array(
                'admin_id' => $id,
                'role_id' => $role_id,
            );
        }

        //先删除管理员角色关联表中的数据
        $adminRoleModel = M('AdminRole');
        //查询关联数据存在时才执行删除数据操作
        $admin_role_data = $adminRoleModel->where("admin_id = $id")->limit(1)->select();

        if ($admin_role_data) {
            if ($adminRoleModel->where("admin_id = $id")->delete() === false) {
                $this->error = '删除角色关联数据失败';
                $this->rollback();
                return false;
            }
        }

        //保存角色,管理员到,角色-管理员关联表
        if ($adminRoleModel->addAll($adminRoles) === false) {
            $this->error = '添加管理员角色关联数据失败';
            $this->rollback();
            return false;
        }

        //操作数据库
        if (!$this->save()) {
            $this->rollback();
            $this->error = '更新管理员资料失败';
            return false;
        }

        $this->commit();    //提交事务
        return true;
    }

    /**
     * 密码生成方法
     * @param $password     用户填写的密码字符串
     * @return array   返回一个一维数组
     */
    private function createSaltStr($password,$salt=''){
        if (empty($salt)) {
            $str = '1234567890QWERTYUIOPASDFGHJKLZXCVBNM';
            $shuffle_str = str_shuffle($str);
            $salt = substr($shuffle_str,5,6);     //6位加盐字符串
        }
        //返回加密后的密码和随机字符串
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


    /**
     * 管理员登陆
     */
    public function adminLogin(){
        $username = $this->data['username'];
        $passowrd = $this->data['password'];
        //查询出登陆用户数据
        if (!($admin = $this->getByUsername($username))) {
            return false;
        }

        //返回密码和盐的数组
        $login_password = $this->createSaltStr($passowrd,$admin['salt']);

        //如果密码不相等
        if ($login_password['password'] !== $admin['password']) {
            //var_dump($login_password,$admin['password']);die;
            return false;
        }

        //生成session
        session('ADMIN_INFO',$admin);
        //生成权限session
        $this->_getPermissions();

        //判断是否勾选了remember
        if (I('post.remember')) {
            $remember = true;
        }
        //生成cookie和token
        $tokenData = $this->_createToken($admin,$remember);
        //获得最后登陆时间ip的数据
        $data = array(
            'id'=>$admin['id'],
            'last_login_time'=>NOW_TIME,
            'last_login_ip'=>get_client_ip(),
        );

        //修改最后登陆时间和登陆ip
        $this->save($data);
        return true;
    }

    /**
     * 生成token和cookie
     * @return array
     */
    private function _createToken($admin,$remember=false){
        //生成token
        $token = String::randString(32);
        $token_create_time = NOW_TIME;  //token生成时间

        //token数据
        $tokenData = array(
            'id'=>$admin['id'],
            'token' => $token,
            'token_create_time' => $token_create_time
        );

        //判断remember是否勾选
        if ($remember) {
            //生成cookie
            cookie('ADMIN_LOGIN_INFO',$tokenData,60*60*24+NOW_TIME);
        }

        //保存新token到数据库
        $this->save($tokenData);
    }

    /**
     * 自动登陆方法
     * @return bool 布尔值
     */
    public function autoLogin()
    {
        //获取cookie
        $cookie = cookie('ADMIN_LOGIN_INFO');
        //cookie如果不存在,返回false
        if(!$cookie){
            return false;
        }
        //根据cookie作为查询条件获取符合条件的数据
        $admin = $this->where($cookie)->find();
        //如果没有获取到数据,返回false
        if (!$admin) {
            return false;
        }
        //更新token令牌
        $this->_createToken($admin);
        //重新生成session
        session('ADMIN_INFO',$admin);
        //生成权限session
        $this->_getPermissions();
        //返回执行结果
        return true;
    }

    private function _getPermissions(){
        //获取session
        $adminInfo = session('ADMIN_INFO');

        //根据权限关联表获得当前用户对应的权限路径
        $permission_id_path = M('AdminRole')->alias('ar')
            ->field('p.id,p.path')
            ->join('__ROLE_PERMISSION__ as rp ON ar.role_id = rp.role_id')
            ->join('__PERMISSION__ as p ON rp.permission_id = p.id')
            ->where(array('admin_id' => $adminInfo['id']))
            ->select();

        //遍历查询出来的权限路径和权限id,分别保存到数组中
        $pathes = array();  //权限路径
        $ids = array(); //权限id
        foreach($permission_id_path as $v){
            $pathes[] = $v['path'];
            $ids[] = $v['id'];
        }

        //将查询出来的权限路径和权限id保存到session中
        session('ADMIN_PERSISSION_PATHES',$pathes);
        session('ADMIN_PERSISSION_IDS',$ids);
    }
}