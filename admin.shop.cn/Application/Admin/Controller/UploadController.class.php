<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Upload;

class UploadController extends Controller
{

    //上传文件方法
    public function index(){
        //设置上传文件配置
        $config = array(
            'mimes'         =>  array('image/jpeg','image/png','image/gif'), //允许上传的文件MiMe类型
            'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('jpg','jpeg','gif','png'), //允许上传的文件后缀
            'autoSub'       =>  true, //自动子目录保存文件
            'subName'       =>  array('date', 'Ymd'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'      =>  './', //保存根路径
            'savePath'      =>  'Uploads/', //保存路径
            'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
            'replace'       =>  true, //存在同名是否覆盖
            'hash'          =>  false, //是否生成hash编码
            'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
            'driver'        =>  '', // 文件上传驱动 Qiniu
            'driverConfig'  =>  array(
                /*'secretKey'      => '_L8Qck10vH3a7v4d_wwFpfbGM8JFv1GUs3Ak5tBX', //七牛服务器
                'accessKey'      => 'wQmieQd8U27_CsNQAS3eH_ROt1Dis3Td4DziT2PN', //七牛用户
                'domain'         => 'og79dmb2i.bkt.clouddn.com', //七牛密码
                'bucket'         => 'subjectone', //空间名称
                'timeout'        => 300, //超时时间*/
            ), // 上传驱动配置
        );
        //实例化上传类
        $uploads = new Upload($config);
        //开始上传文件
        $fileInfos = $uploads->upload();
        //获得一维数组
//        $fileInfos = $fileInfos['Filedata'];
        //弹出上传后的一组数据
        $fileInfos = array_pop($fileInfos);
        //上传数据
        if (!$fileInfos) {
            $status = false;
            $msg = $uploads->getError();
            $filePath = '';
        }else{
            $status = true;
            $msg = '上传图片成功';
            $filePath = $fileInfos['savepath'].$fileInfos['savename'];
            //如果是骑牛上传,直接返回url,不需要组装url
            /*if($uploads->driver == 'Qiniu'){
                $filePath = $fileInfos['url'];
                //获取本地文件,并删除
                $rmurl = '/'.$fileInfos['savepath'].$fileInfos['savename'];
                //删除本地文件
                unlink($rmurl);
            }else{
                $filePath = $fileInfos['savepath'].$fileInfos['savename'];
            }*/
        }

        //json信息组合
        $data = array(
            'status' => $status,
            'msg' => $msg,
            'filePath' => $filePath,
        );
        //返回json字符串
        $this->ajaxReturn($data);
    }
}