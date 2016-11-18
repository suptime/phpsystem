<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 添加菜单 </title>
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/plugs/ztree/zTreeStyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
<span class="action-span"><a href="<?php echo U('index');?>">菜单列表</a></span>
<span class="action-span1"><a href="__GROUP__"> 管理中心</a></span>
<span id="search_id" class="action-span1"> - 添加菜单 </span>
</h1>
<div style="clear:both"></div>
<div class="main-div">
<form action="<?php echo U();?>" method="post" name="theForm" enctype="multipart/form-data">
    <table width="100%" id="general-table">
        <tr>
            <td class="label">菜单名称:</td>
            <td>
                <input type='text' name='name' value='<?php echo ($row["name"]); ?>' />
            </td>
        </tr>
        <tr>
            <td class="label">菜单路径:</td>
            <td>
                <input type='text' name='path' value='<?php echo ($row["path"]); ?>' />
                ( 格式为: <span style="color: #f00">控制器/方法</span>  如: Menu/index )
            </td>
        </tr>
        <tr>
            <td class="label">上级菜单:</td>
            <td>
                <select name="parent_id" id="parent_id">
                    <?php if(is_array($menus)): foreach($menus as $key=>$menu): ?><option value="<?php echo ($menu["id"]); ?>" <?php if($menu['id'] == $row['parent_id']): ?>selected="selected"<?php endif; ?>><?php echo str_repeat('&nbsp;',$menu['level']*3); echo ($menu["name"]); ?></option><?php endforeach; endif; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="label">关联权限:</td>
            <td>
                <!--权限列表-->
            <?php if(is_array($permissions)): foreach($permissions as $key=>$top): if(($top["parent_id"]) == "0"): ?><div class="item_list">
                        <p><label><input class="top_checkbox" type="checkbox" value="<?php echo ($top["id"]); ?>" name="permission_id[]" <?php if(in_array($top['id'],$power)): ?>checked="checked"<?php endif; ?> /> <b><?php echo ($top["name"]); ?></b> </label></p>
                        <div class="son_permission">
                        <?php if(is_array($permissions)): foreach($permissions as $key=>$son): if(($son["parent_id"]) == $top['id']): ?><label><input class="checkbox" type="checkbox" value="<?php echo ($son["id"]); ?>" name="permission_id[]" <?php if(in_array($son['id'],$power)): ?>checked="checked"<?php endif; ?> /> <?php echo ($son["name"]); ?> </label><?php endif; endforeach; endif; ?>
                        </div>
                    </div><?php endif; endforeach; endif; ?>
            </td>
        </tr>
    </table>
    <div class="button-div">
        <input type="hidden" name="id" value='<?php echo ($row["id"]); ?>'/>
        <input type="submit"  value=" 确定 " />
        <input type="reset" value=" 重置 " />
    </div>
</form>
</div>

<div id="footer">版权所有 &copy; <?php echo date('Y-m-d h:i:s',NOW_TIME);?></div>

<script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    $('.top_checkbox').click(function(){
        $(this).closest('.item_list').find('.checkbox').prop('checked',$(this).prop('checked'));
    })


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