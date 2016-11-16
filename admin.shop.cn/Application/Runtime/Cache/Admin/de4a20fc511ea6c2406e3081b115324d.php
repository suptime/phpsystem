<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加权限 </title>
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/plugs/ztree/zTreeStyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
<span class="action-span"><a href="<?php echo U('index');?>">权限列表</a></span>
<span class="action-span1"><a href="__GROUP__">管理中心</a></span>
<span id="search_id" class="action-span1"> - 添加权限 </span>
</h1>
<div style="clear:both"></div>
<div class="main-div">
<form action="<?php echo U();?>" method="post" name="theForm" enctype="multipart/form-data">
    <table width="100%" id="general-table">
        <tr>
            <td class="label">权限名称:</td>
            <td>
                <input type='text' name='name' value='<?php echo ($row["name"]); ?>' size='27' />
            </td>
        </tr>
        <tr>
            <td class="label">操作路径:</td>
            <td>
                <input type='text' name='path' value='<?php echo ($row["path"]); ?>' size='27' />
            </td>
        </tr>
        <tr>
            <td class="label">上级权限:</td>
            <td>
                <select name="parent_id" id="parent_id">
                    <?php if(is_array($permissions)): foreach($permissions as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v["id"] == $row['parent_id']): ?>selected="selected" class="curr"<?php endif; ?>><?php echo str_repeat('&nbsp;',$v['level']*2); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="label">描述:</td>
            <td>
                <textarea name="intro" style='resize: none;' cols="50" rows="5"><?php echo ($row["intro"]); ?></textarea>
            </td>
        </tr>
    </table>
    <div class="button-div">
        <input type="hidden" name="id" value='<?php echo ($row["id"]); ?>'/>
        <input type="submit" value=" 确定 " />
        <input type="reset" value=" 重置 " />
    </div>
</form>
</div>

<div id="footer">
版权所有 &copy; <?php echo date('Y-m-d h:i:s',NOW_TIME);?>
</div>

<script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        changeInput();
        $('#parent_id').change(function(){ changeInput() });

        //input状态设置
        function changeInput(){
            var pid = $('#parent_id').find('option:selected').val();
            if(pid == 0){
                $("input[name='path']").prop('disabled',true);
            }else{
                $("input[name='path']").prop('disabled',false);
            }
        }
    });
</script>
</body>
</html>