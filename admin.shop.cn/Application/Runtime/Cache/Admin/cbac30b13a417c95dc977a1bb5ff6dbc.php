<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加账号 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/plugs/uploadify/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>">会员列表</a></span>
    <span class="action-span1"><a href="#">管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加账号 </span>
    <div style="clear:both"></div>
</h1>
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
            <tr>
                <td class="label">邮箱</td>
                <td>
                    <input type="text" name="email" size="27" value="<?php echo ($email); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">手机号码</td>
                <td>
                    <input type="text" name="tel" size="27" value="<?php echo ($tel); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">会员状态</td>
                <td>
                    <input type="radio" name="status" class="status" value="-1" /> 封禁
                    <input type="radio" name="status" class="status" value="0"  /> 未激活
                    <input type="radio" name="status" class="status" value="1"  /> 正常
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
版权所有 &copy; <?php echo date('Y-m-d h:i:s',NOW_TIME);?></div>
<script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
<script type="text/javascript">
    //状态显示
    $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
</script>
</body>
</html>