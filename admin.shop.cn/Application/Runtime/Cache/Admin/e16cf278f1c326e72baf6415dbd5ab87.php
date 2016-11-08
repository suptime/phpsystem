<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加文章 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.cn/Public/plugs/uploadify/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>">文章列表</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加文章 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form method="post" action="<?php echo U();?>"enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">文章分类:</td>
                <td><input type="hidden" name="id" value="<?php echo ($article["id"]); ?>">
                    <select name="article_category_id" id="cate">

                        <option value="0">--选择栏目--</option>
                        <?php if(is_array($cates)): foreach($cates as $key=>$val): if($val["id"] == $article['article_category_id']): ?><option value="<?php echo ($val["id"]); ?>" selected="selected"><?php echo ($val["name"]); ?></option>
                                <?php else: ?>
                                <option value="<?php echo ($val["id"]); ?>"><?php echo ($val["name"]); ?></option><?php endif; endforeach; endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">文章标题</td>
                <td>
                    <input type="text" name="title" size="82" value="<?php echo ($article["title"]); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">简介</td>
                <td>
                    <textarea  name="intro" cols="80" rows="4"><?php echo ($article["intro"]); ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">正文内容</td>
                <td>
                    <!--<textarea  name="content" cols="80" rows="20"></textarea>-->
                    <script id="container" name="content" type="text/plain"><?php echo ($article["content"]); ?></script>
                    <script type="text/javascript" src="http://admin.shop.cn/Public/plugs/uediter/ueditor.config.js"></script>
                    <script type="text/javascript" src="http://admin.shop.cn/Public/plugs/uediter/ueditor.all.min.js"></script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('container',{
                            initialFrameWidth : 583,
                            initialFrameHeight: 306,
                            autoFloatEnabled:false,
                            initialStyle:'p{line-height:1.6em; font-size:12px; font-family:courier new}'
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="40" size="15" value="<?php echo ((isset($article["sort"]) && ($article["sort"] !== ""))?($article["sort"]):20); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td>
                    <input type="radio" name="status" class="status" value="1" /> 是
                    <input type="radio" name="status" class="status" value="0"  /> 否(当品牌下还没有商品的时候，首页及分类页的品牌区将不会显示该品牌。)
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="footer">
共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="http://admin.shop.cn/Public/plugs/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="http://admin.shop.cn/Public/plugs/layer/layer.js"></script>
<script type="text/javascript">
    //状态显示
    $('.status').val([<?php echo ((isset($article["status"]) && ($article["status"] !== ""))?($article["status"]):1); ?>]);
    //显示当前栏目
//    $("#cate option[value='<?php echo ((isset($article["article_category_id"]) && ($article["article_category_id"] !== ""))?($article["article_category_id"]):0); ?>']").prop("selected",true);
</script>
</body>
</html>