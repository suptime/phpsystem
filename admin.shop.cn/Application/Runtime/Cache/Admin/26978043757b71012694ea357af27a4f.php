<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo u('add');?>">添加分类</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品分类 </span>
    <div style="clear:both"></div>
</h1>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>分类名称</th>
                <th>父级分类</th>
                <th>分类描述</th>
                <th>是否导航栏</th>
                <th>是否显示</th>
                <th>排序</th>
                <th>操作</th>
            </tr>

            <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr align="center" class="0">
                    <td align="left" width=20%"><?php echo str_repeat('&nbsp;',($row['level']-1)*5);?><img src="http://admin.shop.cn/Public/images/menu_arrow.gif" width="9" height="9" border="0" style="margin-left:0em" />  <a href="<?php echo U('Goods/index',array('goods_category_id'=>$row['id']));?>"><?php echo ($row["name"]); ?></a> </td>
                    <td width="10%"><?php if($row["parent_id"] == 0): ?>无<?php else: echo ($row["parent_id"]); endif; ?></td>
                    <td width="15%"><?php echo ($row["intro"]); ?></td>
                    <td width="10%"><img src="http://admin.shop.cn/Public/images/<?php echo ($row["is_nav"]); ?>.gif" /> </td>
                    <td width="10%"><img src="http://admin.shop.cn/Public/images/<?php echo ($row["is_show"]); ?>.gif" /> </td>
                    <td width="15%"><?php echo ($row["sort"]); ?></td>
                    <td width="30%" align="center">
                        <a href="<?php echo U('edit',['id'=>$row['id']]);?>">编辑</a> |
                        <a href="<?php echo U('remove',['id'=>$row['id']]);?>" title="移除" onclick="">移除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
        </table>
    </div>
</form>
<div id="footer">
共执行 1 个查询，用时 0.055904 秒，Gzip 已禁用，内存占用 2.202 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>