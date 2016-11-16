<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/css/general.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div id="header-div">
    <div id="logo-div" style="bgcolor:#000000;">
        <img src="http://admin.shop.cn/Public/images/ecshop_logo.gif" alt="- power for e-commerce"/>
    </div>
    <div id="submenu-div">
        <ul>
            <li><a href="http://www.shop.cn/" target="_blank">查看网店</a></li>
            <li><a href="#" target="main-frame">个人设置</a></li>
            <li style="border-right:none"><a href="#">刷新</a></li>
        </ul>
        <div id="send_info">
            <a href="#" target="main-frame" class="fix-submenu">清除缓存</a>
            <a href="<?php echo U('Admin/logout');?>" target="_top" class="fix-submenu">退出</a>
        </div>
    </div>
</div>
<div id="menu-div">
    <ul>
        <li class="fix-spacel">&nbsp;</li>
        <li><a href="<?php echo U('Index/main');?>" target="main-frame">后台主页</a></li>
        <li><a href="<?php echo U('Goods/index');?>" target="main-frame">商品列表</a></li>
        <li><a href="<?php echo U('Order/index');?>" target="main-frame">订单列表</a></li>
        <li><a href="<?php echo U('User/index');?>" target="main-frame">用户评论</a></li>
        <li><a href="<?php echo U('Member/index');?>" target="main-frame">会员列表</a></li>
        <li class="fix-spacer">&nbsp;</li>
    </ul>
    <br class="clear"/>
</div>
</body>
</html>