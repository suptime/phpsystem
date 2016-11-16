<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>管理中心 - 权限 </title>
        <meta name="robots" content="noindex, nofollow"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
        <link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>
            <span class="action-span"><a href="<?php echo U('add');?>">添加权限</a></span>
            <span class="action-span1"><a href="__GROUP__">管理中心</a></span>
            <span id="search_id" class="action-span1"> - 权限 </span>
        </h1>
        <div style="clear:both"></div>
        <form method="post" action="" name="listForm">
            <div class="list-div" id="listDiv">
                <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
                    <tr>
                        <th>权限名称</th>
                        <th>操作路径</th>
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                    <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr align="center" class="0">
                            <td align="left" class="first-cell" ><?php echo str_repeat('&nbsp;',($row['level']-1)*5); echo ($row["name"]); ?></td>
                            <td width="25%"><?php if($row['path'] == '' ): ?>无<?php else: echo ($row["path"]); endif; ?></td>
                            <td width="35%"><?php echo ($row["intro"]); ?></td>
                            <td width="15%" align="center">
                                <a href="<?php echo U('edit',['id'=>$row['id']]);?>">编辑</a> |
                                <a href="<?php echo U('remove',['id'=>$row['id']]);?>" title="删除" onclick="">删除</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </table>
            </div>
        </form>
        <div id="footer">
            <br />
            版权所有 &copy; 2016
        </div>
    </body>
</html>