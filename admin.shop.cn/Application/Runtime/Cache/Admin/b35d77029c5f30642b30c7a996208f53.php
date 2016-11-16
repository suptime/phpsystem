<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 角色 </title>
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
<span class="action-span"><a href="<?php echo U('add');?>">添加角色</a></span>
<span class="action-span1"><a href="#">管理中心</a></span>
<span id="search_id" class="action-span1"> - 角色列表 </span>
</h1>
<div style="clear:both"></div>
<div class="form-div">
<form action="<?php echo U();?>" name="searchForm" method="get">
    <img src="http://admin.shop.cn/Public/images/icon_search.gif" width="26" height="22" border="0" alt="search" />
    <input type="text" name="keyword" size="15" value="<?php echo I('get.keyword');?>"/>
    <input type="submit" value=" 搜索 " class="button" />
</form>
</div>
<form method="post" action="" name="listForm">
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th>角色名称</th>
            <th>描述</th>
            <th>排序</th>
            <th>操作</th>
        </tr>

        <?php if(is_array($rows)): foreach($rows as $key=>$v): ?><tr>
                <td class="first-cell"><?php echo ($v["name"]); ?></td>
                <td align="center"><?php echo ($v["intro"]); ?></td>
                <td align="center"><?php echo ($v["sort"]); ?></td>
                <td align="center">
                    <a href="<?php echo U('edit',['id'=>$v['id']]);?>" title="编辑">编辑</a> |
                    <a href="<?php echo U('remove',['id'=>$v['id']]);?>" title="移除">移除</a>
                </td>
            </tr><?php endforeach; endif; ?>

        <tr>
            <td align="right" nowrap="true" colspan="6">
                <div id="turn-page" class="page">
                    <?php echo ($pageHtml); ?>
                </div>
            </td>
        </tr>
    </table>
</div>
</form>

<div id="footer">
版权所有 &copy; <?php echo date('Y-m-d h:i:s',NOW_TIME);?></div>
</body>
</html>