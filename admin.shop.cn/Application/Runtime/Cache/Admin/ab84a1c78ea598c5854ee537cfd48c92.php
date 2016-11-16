<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加角色 </title>
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css"/>
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css"/>
<link href="http://admin.shop.cn/Public/plugs/uploadify/common.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<h1>
<span class="action-span"><a href="<?php echo U('index');?>">角色列表</a></span>
<span class="action-span1"><a href="#">管理中心</a></span>
<span id="search_id" class="action-span1"> - 添加角色 </span>
</h1>
<div style="clear:both"></div>
<div class="main-div">
<form method="post" action="<?php echo U();?>">
    <style>td.label{width: 15%;}</style>
    <table cellspacing="1" cellpadding="3" width="100%">
        <tr>
            <td class="label">角色名称</td>
            <td>
                <input type="text" name="name" value="<?php echo ($row["name"]); ?>"/>
            </td>
        </tr>
        <tr>
            <td class="label">描述</td>
            <td>
                <textarea name="intro" style="resize: none" cols="60" rows="3"><?php echo ($row["intro"]); ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="label">权限</td>
            <td class="permission_td">
                <div>
                <?php if(is_array($permissions)): foreach($permissions as $key=>$per): if($per["level"] == 1): ?></div>

                        <label class="top_checkbox" style="display: block; background:#eee; padding: 5px 10px; margin: 5px 0"><?php echo ($per["name"]); ?></label>
                        <div class="permission_item">
                        <?php else: ?>

                        <label><input class="check_box" type="checkbox" value="<?php echo ($per["id"]); ?>" name="permission_id[]" <?php if(in_array($per['id'],$permissionCurrent)): ?>checked="checked"<?php endif; ?> /> <?php echo ($per["name"]); ?></label><?php endif; endforeach; endif; ?>
                            </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><br/>
                <input type="hidden" name="id" value="<?php echo ($row["id"]); ?>"/>
                <input type="submit" class="button" value=" 确定 "/>
                <input type="reset" class="button" value=" 重置 "/>
            </td>
        </tr>
    </table>
</form>
</div>

<div id="footer">
版权所有 &copy; <?php echo date('Y-m-d h:i:s',NOW_TIME);?>
</div>
</body>
</html>