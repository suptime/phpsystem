<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 文章列表 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加管理员</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 用户列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="<?php echo U();?>" name="searchForm" id="searchForm">
    <img src="http://admin.shop.cn/Public/images/icon_search.gif" width="26" height="22" border="0" alt="search" />
    <input type="text" name="keyword" value="<?php echo I('get.keyword');?>" size="15" />
    <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>用户编号</th>
                <th>用户名</th>
                <th>注册邮箱</th>
                <th>注册时间</th>
                <th>最后登陆时间</th>
                <th>最后登陆ip</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td class="first-cell"><?php echo ($val["id"]); ?></td>
                <td align="center"><?php echo ($val["username"]); ?></td>
                <td class="first-cell"><?php echo ($val["email"]); ?></td>
                <td align="center"><?php echo (date("Y-m-d h:i:s",$val["add_time"])); ?></td>
                <td align="center"><?php echo (date("Y-m-d h:i:s",$val["last_login_time"])); ?></td>
                <td align="center"><?php echo ($val["last_login_ip"]); ?></td>
                <td align="center">
                <a href="<?php echo U('edit',array('id'=>$val['id']));?>" title="编辑">编辑</a> |
                <a href="<?php echo U('remove',array('id'=>$val['id']));?>" title="编辑">移除</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr>
                <td align="right" nowrap="true" colspan="7">
                    <div class="page">
                        <?php echo ($page); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>

<div id="footer">
共执行 3 个查询，用时 0.021251 秒，Gzip 已禁用，内存占用 2.194 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
<script type="text/javascript">
//    $("#cate option[value='<?php echo I('get.article_category_id');?>']").prop("selected",true);
    function submitForm(){
        document.getElementById("searchForm").submit();//form表单提交
    }
</script>
</body>
</html>