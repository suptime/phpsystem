<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加广告 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/plugs/uploadify/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>">广告列表</a></span>
    <span class="action-span1"><a href="#">管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加广告 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form method="post" action="<?php echo U();?>" enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">广告名称</td>
                <td>
                    <input type="text" name="title" size="35" value="<?php echo ($banner["title"]); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">图片地址</td>
                <td>
                    <input type="text" name="picture" id="picturePath" value="<?php echo ($banner["picture"]); ?>" size="35" />
                    <input type="button" id="upload_button" /><br/>
                    <img id="show_img" src="<?php if(empty($banner["picture"])): ?>http://admin.shop.cn/Public/images/nopic.jpg<?php else: ?>/<?php echo ($banner["picture"]); endif; ?>" height="100" style="margin: 0 0 10px"/>
                    <span class="notice-span" style="display:block"  id="warn_brandlogo">请上传图片，做为品牌的LOGO！</span>
                </td>
            </tr>
            <tr>
                <td class="label">跳转地址</td>
                <td>
                    <input type="text" name="url" size="35" value="<?php echo ((isset($banner["url"]) && ($banner["url"] !== ""))?($banner["url"]):'http://'); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">开始时间</td>
                <td>
                    <input type="date" name="start_time" size="20" value="<?php echo (date('Y-m-d',$banner["start_time"])); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">结束时间</td>
                <td>
                    <input type="date" name="end_time" size="20" value="<?php echo (date('Y-m-d',$banner["end_time"])); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="40" size="15" value="<?php echo ((isset($banner["sort"]) && ($banner["sort"] !== ""))?($banner["sort"]):10); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td>
                    <input type="radio" name="is_show" class="is_show" value="1" /> 是
                    <input type="radio" name="is_show" class="is_show" value="0"  /> 否
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="hidden" name="id" value="<?php echo ($banner["id"]); ?>">
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="footer">
版权所有 &copy; <?php echo date('Y-m-d h:i:s',NOW_TIME);?></div>
<script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="http://admin.shop.cn/Public/plugs/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="http://admin.shop.cn/Public/plugs/layer/layer.js"></script>
<script type="text/javascript">
    //状态显示
    $('.is_show').val([<?php echo ((isset($banner["is_show"]) && ($banner["is_show"] !== ""))?($banner["is_show"]):1); ?>]);

    //swf上传插件
    $(function() {
        $("#upload_button").uploadify({
            'height': 20,
            'width': 100,
            'buttonText':'选择上传的图片',
            'swf': 'http://admin.shop.cn/Public/plugs/uploadify/uploadify.swf',
            'uploader': "<?php echo U('Upload/index');?>",

            //上传到服务器，服务器返回相应信息到data里
            'onUploadSuccess':function(file, data){
                data = $.parseJSON(data);
                if(data.status === false){
                    layer.msg(data.msg,{icon: 5});
                }else{
                    layer.msg(data.msg,{icon: 1});
                    $('#picturePath').val(data.filePath);
                    $('#show_img').prop({'src':'/'+data.filePath});
                }
            }
        });
    });
</script>
</body>
</html>