<?php

namespace Home\Model;


use Think\Model;

class GoodsCategoryModel extends Model
{

    /**
     * @return mixed null/false/array  不为空返回一个二维关联数组, 为空返回null, 失败返回false
     */
    public function getGoodsCategory(){
        return $this->where('is_show = 1')->order('sort')->select();
    }


    /**
     * 根据主键获取一条数据
     * @param $id   栏目id
     * @return mixed  成功返回数组,失败返回false,为空返回null
     */
    public function getCurrentCateInfo($id){
        return $this->field('id,name,parent_id,level')->find($id);
    }


    /**
     * 根据id获得其所有子孙栏目
     * @param $id
     * @return mixed    查询为空返回null,查询不为空返回一个一维索引数组
     */
    public function getChildCates($id){
        //获取栏目id是1的左右节点
        $node = $this->field('id,name,parent_id,lft,rght,level')->find($id);

        //查询出符合条件的子栏目id
        $cond = array(
            'lft' => array('gt',$node['lft']),
            'rght' => array('lt',$node['rght']),
        );
        //执行查询
        return $this->where($cond)->getField('id',true);
    }
}