<?php
/**
 * Created by PhpStorm.
 * User: Nano
 * Date: 2016/11/23
 * Time: 14:11
 */

namespace Admin\Controller;


use Think\Controller;

class MemberController extends Controller
{
    private $_model;

    //初始化
    protected function _initialize(){
        $this->_model = D('Member');
    }

    /**
     * 会员管理列表页
     */
    public function index(){
        //获取搜索关键词,判断是否存在关键词
        $cond =array();
        if ($keyword = I('get.keyword')) {
            $cond = array(
                'email' => array('like','%'.$keyword.'%'),
                'tel' => array('like','%'.$keyword.'%'),
                'username' => array('like','%'.$keyword.'%'),
                '_logic' => 'OR',
            );
        }

        //获取member列表
        $members = $this->_model->getMemberList($cond);

        //分配数据给视图
        $this->assign('members',$members['members']);
        $this->assign('pageHtml',$members['pageHtml']);
        $this->display();
    }


    /**
     * 添加新会员
     */
    public function add(){
        if (IS_POST) {
            //收集数据
            if ($this->_model->create('','reg') === false) {
                $this->error(get_error($this->_model));
            }
            //添加banner
            if ($this->_model->addMember() === false) {
                $this->error(get_error($this->_model));
            }
            $this->success('添加会员成功',U('index'));
        }else{
            $this->display();
        }
    }


    public function edit($id){
        if (IS_POST) {
            //收集数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            //添加banner
            if ($this->_model->saveMember($id) === false) {
                $this->error(get_error($this->_model));
            }
            $this->success('修改成功',U('index'));
        }else{
            $row = $this->_model->find($id);
            $this->assign($row);
            $this->display('add');
        }
    }
}