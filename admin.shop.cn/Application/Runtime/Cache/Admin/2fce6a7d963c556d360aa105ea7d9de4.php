<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加品牌 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/plugs/uploadify/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>">商品品牌</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加品牌 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form method="post" action="<?php echo U();?>"enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">品牌名称</td>
                <td><input type="hidden" name="id" value="<?php echo ($id); ?>">
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">品牌LOGO</td>
                <td>
                    <input type="input" name="logo" id="logo_url" value="<?php echo ($logo); ?>" size="45" />
                    <input type="button" id="logo" /><br/>
                    <img id="show_img" src="/<?php echo ($logo); ?>" alt="" width="100" height="100" style="margin: 0 0 10px"/>
                    <span class="notice-span" style="display:block"  id="warn_brandlogo">请上传图片，做为品牌的LOGO！</span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌描述</td>
                <td>
                    <textarea  name="intro" cols="60" rows="4"><?php echo ($intro); ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="40" size="15" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td>
                    <input type="radio" name="status" class="status" value="1" /> 是
                    <input type="radio" name="status" class="status" value="0"  /> 否(当品牌下还没有商品的时候，首页及分类页的品牌区将不会显示该品牌。)
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="footer">
共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="http://admin.shop.cn/Public/plugs/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="http://admin.shop.cn/Public/plugs/layer/layer.js"></script>
<script type="text/javascript">
    //状态显示
    $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    //swf上传插件
    $(function() {
        $("#logo").uploadify({
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
                    $('#logo_url').val(data.filePath);
                    $('#show_img').prop({'src':'/'+data.filePath});
                }
            }
        });
    });
</script>
</body>
</html>