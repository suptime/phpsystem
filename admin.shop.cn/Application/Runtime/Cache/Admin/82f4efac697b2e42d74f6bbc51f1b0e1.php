<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加文章 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/plugs/uploadify/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php if($id == 1): ?><h1>
        <span class="action-span"><a href="<?php echo U('index');?>">用户列表</a></span>
        <span class="action-span1"><a href="#">管理中心</a></span>
        <span id="search_id" class="action-span1"> - 添加账号 </span>
        <div style="clear:both"></div>
    </h1><?php endif; ?>
<div class="main-div">
    <form method="post" action="<?php echo U();?>">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">用户名</td>
                <td>
                    <input type="hidden" name="id" value="<?php echo ($id); ?>" />
                    <input type="text" name="username" size="27" value="<?php echo ($username); ?>" <?php if(isset($username)): ?>disabled="disabled"<?php endif; ?>/>
                </td>
            </tr>
            <tr>
                <td class="label">邮箱</td>
                <td>
                    <input type="text" name="email" size="27" value="<?php echo ($email); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">密码</td>
                <td>
                    <input type="password" name="password" size="27" />
                </td>
            </tr>
            <tr>
                <td class="label">重复密码</td>
                <td>
                    <input type="password" name="repassword" size="27" />
                </td>
            </tr>
            <?php if($id == 1): ?><tr>
                    <td class="label">用户角色</td>
                    <td>
                        <?php if(is_array($roles)): foreach($roles as $key=>$val): ?><label><input type="checkbox" name="role_id[]" class="admin_role" value="<?php echo ($val["id"]); ?>" <?php if(in_array($val['id'],$roleCurrent)): ?>checked="checked"<?php endif; ?> /> <?php echo ($val["name"]); ?></label><?php endforeach; endif; ?>
                    </td>
                </tr><?php endif; ?>
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
版权所有 &copy; <?php echo date('Y-m-d h:i:s',NOW_TIME);?></div>
</body>
</html>