<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>管理中心 - 文章分类 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.cn/Public/css/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加分类</a></span>
    <span class="action-span1"><a href="#">管理中心</a></span>
    <span id="search_id" class="action-span1"> - 文章分类 </span>
    <div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>分类名称</th>
                <th>分类描述</th>
                <th>排序</th>
                <th>是否显示</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                    <td class="first-cell"><?php echo ($val["id"]); ?></td>
                    <td class="first-cell"><a href="<?php echo U('Article/index',array('article_category_id'=>$val['id']));?>"><?php echo ($val["name"]); ?></a></td>
                    <td align="center"><?php echo ($val["intro"]); ?></td>
                    <td align="center"><?php echo ($val["sort"]); ?></td>
                    <td align="center"><img src="http://admin.shop.cn/Public/images/<?php echo ($val["status"]); ?>.gif" /> </td>
                    <td align="center">
                        <a href="<?php echo U('edit',array('id'=>$val['id']));?>" title="编辑">编辑</a> |
                        <a href="<?php echo U('remove',array('id'=>$val['id']));?>" title="编辑">移除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr>
                <td align="right" nowrap="true" colspan="6">
                    <div class="page">
                        <?php echo ($page); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>

<div id="footer">
    <br />
    版权所有 &copy; 2016</div>
</body>
</html>