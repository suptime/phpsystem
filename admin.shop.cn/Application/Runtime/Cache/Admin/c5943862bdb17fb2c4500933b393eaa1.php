<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>">分类列表</a></span>
    <span class="action-span1"><a href="#">管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加分类 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form method="post" action="<?php echo U();?>"enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">分类名称</td>
                <td><input type="hidden" name="id" value="<?php echo ($id); ?>">
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">上级分类:</td>
                <td>
                    <select name="parent_id" id="parent_id">
                        <option value="0">顶级分类</option>
                        <?php if(is_array($rows)): foreach($rows as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">分类描述</td>
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
                    <input type="radio" name="status" class="status" value="0"  /> 否
                </td>
            </tr>
            <tr>
                <td class="label">是否是帮助分类</td>
                <td>
                    <input type="radio" name="is_help" class="is_help" value="1" /> 是
                    <input type="radio" name="is_help" class="is_help" value="0"  /> 否
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
<br />
版权所有 &copy; 2016</div>
<script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="http://admin.shop.cn/Public/plugs/layer/layer.js"></script>
<script type="text/javascript">
    //状态显示
    $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    $('.is_help').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    $('.parent_id').val([<?php echo ((isset($parent_id) && ($parent_id !== ""))?($parent_id):0); ?>]);
</script>
</body>
</html>