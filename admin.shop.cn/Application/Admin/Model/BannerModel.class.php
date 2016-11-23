<?php
/**
 * Created by PhpStorm.
 * User: Nano
 * Date: 2016/11/23
 * Time: 11:12
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BannerModel extends Model
{
    //开启批量验证
    protected $patchValidate =true;

    //自动验证规则
    protected $_validate = array(
        array('picture','require','图片地址不能为空'),
        array('start_time','require','开始时间不能为空'),
    );


    /**
     * 添加banner数据
     * @return bool
     */
    public function addBanner(){

        //格式化时间
        $times = $this->changeTime($this->data['start_time'],$this->data['end_time']);
        $this->data['start_time'] = $times['start_time'];
        $this->data['end_time'] = $times['end_time'];

        //添加广告数据到数据库
        if ($this->add() === false) {
            $this->error = '添加广告失败';
            return false;
        }

        return true;
    }

    /**
     * 获取banner列表
     * @param $cond 搜索条件
     * @return array    返回的数据
     */
    public function getBannerList($cond){
        //返回一个数组
        $total = $this->where($cond)->count();
        $page = new Page($total,C('PAGES.PAGESIZE'));
        $pageHtml = $page->show();

        //获取数据
        $list = $this->where($cond)->page(I('get.p'),C('PAGES.PAGESIZE'))->order('sort')->select();

        //返回数据
        return array(
            'list' => $list,
            'pageHtml' => $pageHtml,
        );

    }

    /**
     * 获取转换后的开始和结束时间
     * @param $start_time   开始时间
     * @param int $end_time     结束时间
     * @return array|bool   成功返回数组,失败返回false
     */
    private function changeTime($start_time,$end_time){
        //将start_time转换成时间戳
        $start_time = string_to_time($start_time);

        //得到结束时间
        if (!$end_time) {
            //如果未填写结束时间,结束时间默认为开始时间
            $end_time = $start_time;
        }else{
            //将结束时间格式化
            $end_time = string_to_time($end_time);
        }

        //判断结束时间是否小于开始时间
        $time = $end_time - $start_time;
        if($time < 0){
            $this->error = '结束时间不能小于开始时间';
            return false;
        }

        //返回数据
        return array(
            'start_time' => $start_time,
            'end_time' => $end_time,
        );
    }

    public function saveBanner($id){

        //格式化时间
        $times = $this->changeTime($this->data['start_time'],$this->data['end_time']);
        $this->data['start_time'] = $times['start_time'];
        $this->data['end_time'] = $times['end_time'];

        //修改当前广告数据
        if ($this->save() === false) {
            $this->error = '修改广告失败';
            return false;
        }

        return true;
    }

}

















