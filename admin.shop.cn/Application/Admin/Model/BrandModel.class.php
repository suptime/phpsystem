<?php

namespace Admin\Model;

use Think\Model;
use Think\Page;

class BrandModel extends Model
{
    //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
    protected $_validate = array(
        array('name','require','品牌名称不能为空'),
    );

    /**
     * 获取包列表数据
     */
    public function getList($keyword){
        //搜索条件
        $condition['name'] = array('like', '%'.$keyword.'%');
        $condition['status'] = array('neq',-1);
        //获取数据总数
        $count = $this->where($condition)->count();
        //查询数据并排序
        $rows = $this->where($condition)->page(I('get.p'),C('PAGES.PAGESIZE'))->order('sort')->select();
        //实例化分页类
        $page = new Page($count,C('PAGES.PAGESIZE'));
        //输出页码
        $data['page'] = $page->show();
        //查询的数据
        $data['rows'] = $rows;
        $data['msg'] = '';
        if(!$rows){
            $data['msg'] = $this->getError();
        }
        //返回数据
        return $data;
    }

    /**
     * 获取所有可用的的品牌.
     * @return array
     */
    public function getAllBrand() {
        return $this->where(['status'=>1])->order('sort')->select();
    }
}