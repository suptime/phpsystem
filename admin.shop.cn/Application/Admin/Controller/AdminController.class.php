<?php

namespace Admin\Controller;


use Think\Controller;

class AdminController extends Controller
{

    public function index($keyword=''){
        $adminModel = D('Admin');
        //判断是否获取数据成功
        if (!($list = $adminModel->getList($keyword))) {
            $this->error($adminModel->$list['msg']);
        }
        $this->assign('list',$list['list']);
        $this->assign('page',$list['pageHtml']);
        $this->display();
    }

    public function add(){
        if (IS_POST) {
            $adminModel = D('Admin');
            //收集数据
            if ($adminModel->create() === false) {
                $this->error($adminModel->getError());
            }
            //插入数据
            if ($adminModel->addAdmin() === false) {
                $this->error('添加失败');
            }
            $this->success('添加管理员成功',U('index'));
        }else{
            $this->display();
        }
    }

    public function edit($id){
        $adminModel = D('Admin');
        if (IS_POST) {
            //收集数据
            if ($adminModel->create() === false) {
                $this->error($adminModel->getError());
            }
            //插入数据
            if ($adminModel->saveAdmin() === false) {
                $this->error('修改失败');
            }
            $this->success('修改管理员成功',U('index'));
        }else{
            $row = $adminModel->find($id);
            $this->assign($row);
            $this->display('add');
        }
    }
}