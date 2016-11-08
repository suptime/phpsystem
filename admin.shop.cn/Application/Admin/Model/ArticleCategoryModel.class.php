<?php
/**
 * Created by PhpStorm.
 * User: Nano
 * Date: 2016/11/6
 * Time: 13:56
 */

namespace Admin\Model;


use Think\Model;

class ArticleCategoryModel extends Model
{

    //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
    protected $_validate = array(
        array('name','require','文章分类标题不能为空'),
        array('sort','number','排序只能是数字')
    );


    /**
     * 获取所有分类信息
     */
    public function getCategorys($data=[],$pid=0,$deep=0){
        //获得所有分类
        $data =  $this->order('sort')->select();
        //定义一个静态变量为空数组来存储数据
        static $arr = array();
        //遍历查询结果数组
        foreach($data as $row){
            //如果父级id与$pid相等,将数据保存到数组中
            if($row['pid']==$pid){
                //得到循环深度
                $row['deep']=$deep;
                $row['nbsp']=str_repeat('&nbsp;',$deep*5);
                $row['fields']=$row['nbsp'].$row['name'];
                $arr[]=$row;
                //递归,将自己的id传进去,查询所有子分类
                $this->getCategorys($data,$row['id'],$deep+1);
            }
        }
        return $arr;
    }



}