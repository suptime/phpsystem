<?php
/**
 * Created by PhpStorm.
 * User: Nano
 * Date: 2016/11/23
 * Time: 11:11
 */

namespace Admin\Controller;


use Think\Controller;

class BannerController extends Controller
{

    private $_model;

    //初始化
    protected function _initialize(){
        $this->_model = D('Banner');
    }

    /**
     * 添加banner
     */
    public function add(){
        if (IS_POST) {
            //收集数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            //添加banner
            if ($this->_model->addBanner() === false) {
                $this->error(get_error($this->_model));
            }
            $this->success('添加广告成功',U('index'));
        }else{
            $this->display();
        }
    }


    public function index(){
        $keyword = I('get.keyword');
        $cond = array();
        if($keyword){
            //查询条件
            $cond['title']  = array('like','%'.$keyword.'%');
        }
        //获取列表
        $banners = $this->_model->getBannerList($cond);
        $this->assign('banners',$banners['list']);
        $this->assign('pageHtml',$banners['pageHtml']);
        $this->display();
    }


    public function edit($id){
        if (IS_POST) {
            //收集数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            //保存数据
            if ($this->_model->saveBanner($id) === false) {
                $this->error(get_error($this->_model));
            }
            //成功跳转
            $this->success('修改广告成功',U('index'));
        }else{
            $row = $this->_model->find($id);
            $this->assign('banner',$row);
            $this->display('add');
        }
    }

}