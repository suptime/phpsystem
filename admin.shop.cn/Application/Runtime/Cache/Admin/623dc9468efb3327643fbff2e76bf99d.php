<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo u('index');?>">商品分类</a></span>
    <span class="action-span1"><a href="__GROUP__">管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加分类 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form action="<?php echo u();?>" method="post" name="theForm" enctype="multipart/form-data">
        <table width="100%" id="general-table">
            <tr>
                <td class="label">分类名称:</td>
                <td>
                    <input type='hidden' name='id' value='<?php echo ($row["id"]); ?>' />
                    <input type='text' name='name' maxlength="20" value='<?php echo ($row["name"]); ?>' size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">上级分类:</td>
                <td>
                    <select name="parent_id" id="parent_id">
                        <option value="0">顶级分类</option>
                        <?php if(is_array($cates)): foreach($cates as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"  <?php if($val["id"] == $row['parent_id']): ?>selected="selected"<?php endif; ?>><?php echo str_repeat('&nbsp;',($val['level']-1)*4); echo ($val["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">排序:</td>
                <td>
                    <input type="text" name='sort' value="<?php echo ((isset($row["sort"]) && ($row["sort"] !== ""))?($row["sort"]):20); ?>" size="15" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示:</td>
                <td>
                    <input class="is_show" type="radio" name="is_show" value="1"/> 是
                    <input class="is_show"type="radio" name="is_show" value="0"/> 否
                </td>
            </tr>
            <tr>
                <td class="label">导航显示:</td>
                <td>
                    <input class="is_nav" type="radio" name="is_nav" value="1"/> 是
                    <input class="is_nav" type="radio" name="is_nav" value="0"/> 否
                </td>
            </tr>
            <tr>
                <td class="label">描述:</td>
                <td>
                    <textarea rows="5" name="intro" cols="60"><?php echo ($row["intro"]); ?></textarea>
                </td>
            </tr>
        </table>
        <div class="button-div">
            <input type="submit" value=" 确定 " />
            <input type="reset" value=" 重置 " />
        </div>
    </form>
</div>

<div id="footer">
<br />
版权所有 &copy; 2016</div>
<script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
<script type="text/javascript">
    //状态显示
    $('.is_nav').val([<?php echo ((isset($row["is_nav"]) && ($row["is_nav"] !== ""))?($row["is_nav"]):1); ?>]);
    $('.is_show').val([<?php echo ((isset($row["is_show"]) && ($row["is_show"] !== ""))?($row["is_show"]):1); ?>]);
</script>

</body>
</html>