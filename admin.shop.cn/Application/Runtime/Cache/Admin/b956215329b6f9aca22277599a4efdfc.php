<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_list.htm 17019 2010-01-29 10:10:34Z liuhui $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title> 管理中心 - 商品菜单 </title>
        <meta name="robots" content="noindex, nofollow"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
        <link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>
            <span class="action-span"><a href="<?php echo U('add');?>">添加菜单</a></span>
            <span class="action-span1"><a href="__GROUP__"> 管理中心</a></span>
            <span id="search_id" class="action-span1"> - 商品菜单 </span>
        </h1>
        <div style="clear:both"></div>
        <form method="post" action="" name="listForm">
            <div class="list-div" id="listDiv">
                <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
                    <tr>
                        <th>菜单ID</th>
                        <th>菜单名称</th>
                        <th>路径</th>
                        <th>操作</th>
                    </tr>
                    <?php if(is_array($menus)): foreach($menus as $key=>$row): ?><tr align="center" class="0">
                            <td><?php echo ($row["id"]); ?></td>
                            <td align="left" class="first-cell" ><?php echo str_repeat('&nbsp;',($row['level']-1)*5); echo ($row["name"]); ?></td>
                            <td width="40%"><?php echo ($row["path"]); ?></td>
                            <td width="30%" align="center">
                                <a href="<?php echo U('edit',['id'=>$row['id']]);?>">编辑</a> |
                                <a href="<?php echo U('remove',['id'=>$row['id']]);?>" title="移除" onclick="">移除</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </table>
            </div>
        </form>
        <div id="footer">
            版权所有 &copy; <?php echo date('Y-m-d h:i:s',NOW_TIME);?>
        </div>
        
    </body>
</html>