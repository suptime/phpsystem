<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 文章列表 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加文章</a></span>
    <span class="action-span1"><a href="#">管理中心</a></span>
    <span id="search_id" class="action-span1"> - 文章列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="<?php echo U();?>" name="searchForm" id="searchForm">
    <img src="http://admin.shop.cn/Public/images/icon_search.gif" width="26" height="22" border="0" alt="search" />
    <input type="text" name="title" value="<?php echo I('get.title');?>" size="15" />
    <input type="submit" value=" 搜索 " class="button" />

    <select name="article_category_id" id="cate" onchange="submitForm();">
        <option value="0">--选择分类--</option>
        <?php if(is_array($cates)): foreach($cates as $key=>$val): if($val["id"] == I('get.article_category_id')): ?><option value="<?php echo ($val["id"]); ?>" selected="selected"><?php echo ($val["name"]); ?></option>
                <?php else: ?>
                <option value="<?php echo ($val["id"]); ?>"><?php echo ($val["name"]); ?></option><?php endif; endforeach; endif; ?>
    </select>
    </form>
</div>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>文章编号</th>
                <th>文章分类</th>
                <th>文章标题</th>
                <th>排序</th>
                <th>是否显示</th>
                <th>发布时间</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($articles)): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td class="first-cell"><?php echo ($val["id"]); ?></td>
                <td align="center"><?php echo ($val["name"]); ?></td>
                <td class="first-cell"><?php echo ($val["title"]); ?></td>
                <td align="center"><?php echo ($val["sort"]); ?></td>
                <td align="center"><img src="http://admin.shop.cn/Public/images/<?php echo ($val["status"]); ?>.gif" /> </td>
                <td align="center"><?php echo (date("Y-m-d",$val["inputtime"])); ?></td>
                <td align="center">
                <a href="<?php echo U('edit',array('id'=>$val['id']));?>" title="编辑">编辑</a> |
                <a href="<?php echo U('remove',array('id'=>$val['id']));?>" title="编辑">移除</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr>
                <td align="right" nowrap="true" colspan="7">
                    <div class="page">
                        <?php echo ($pages); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>

<div id="footer">
版权所有 &copy; <?php echo date('Y-m-d h:i:s',NOW_TIME);?></div>
<script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
<script type="text/javascript">
//    $("#cate option[value='<?php echo I('get.article_category_id');?>']").prop("selected",true);
    function submitForm(){
        document.getElementById("searchForm").submit();//form表单提交
    }
</script>
</body>
</html>