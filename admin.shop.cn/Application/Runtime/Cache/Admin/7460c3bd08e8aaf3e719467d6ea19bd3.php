<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>管理中心 - 商品列表 </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
        <link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="http://admin.shop.cn/Public/css/page.css" />
    </head>
    <body>
        <h1>
            <span class="action-span"><a href="<?php echo U('add');?>">添加新商品</a></span>
            <span class="action-span1"><a href="__GROUP__">管理中心</a></span>
            <span id="search_id" class="action-span1"> - 商品列表 </span>
        </h1>
        <div style="clear:both"></div>
        <div class="form-div">
            <form action="" name="searchForm">
                <img src="http://admin.shop.cn/Public/images/icon_search.gif" width="26" height="22" border="0" alt="search" />
                <!-- 分类 -->
                <?php echo arr2select($goods_categories,'id','name','goods_category_id',I('get.goods_category_id'));?>
                <!-- 品牌 -->
                <?php echo arr2select($brands,'id','name','brand_id',I('get.brand_id'));?>
                <!-- 推荐 -->
                <select name="goods_status" class="goods_status">
                    <option value="">全部</option>
                    <option value="1">精品</option>
                    <option value="2">新品</option>
                    <option value="4">热销</option>
                </select>
                <!-- 上架 -->
                <select name="is_on_sale" class="is_on_sale">
                    <option value=''>全部</option>
                    <option value="1">上架</option>
                    <option value="0">下架</option>
                </select>
                <!-- 关键字 -->
                关键字 <input type="text" name="keyword" size="15" value='<?php echo I("get.keyword");?>'/>
                <input type="submit" value=" 搜索 " class="button" />
            </form>
        </div>

        <!-- 商品列表 -->
        <form method="post" action="" name="listForm" onsubmit="">
            <div class="list-div" id="listDiv">
                <table cellpadding="3" cellspacing="1">
                    <tr>
                        <th>编号</th>
                        <th>商品名称</th>
                        <th>货号</th>
                        <th>价格</th>
                        <th>上架</th>
                        <th>精品</th>
                        <th>新品</th>
                        <th>热销</th>
                        <th>推荐排序</th>
                        <th>库存</th>
                        <th>操作</th>
                    </tr>
                    <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
                            <td align="center"><?php echo ($row["id"]); ?></td>
                            <td align="center"><?php echo ($row["name"]); ?></td>
                            <td align="center"><?php echo ($row["sn"]); ?></td>
                            <td align="center"><?php echo ($row["shop_price"]); ?>/<?php echo ($row["market_price"]); ?></td>
                            <td align="center"><img src="http://admin.shop.cn/Public/images/<?php echo ($row["is_on_sale"]); ?>.gif"/></td>
                            <td align="center"><img src="http://admin.shop.cn/Public/images/<?php echo ($row["is_best"]); ?>.gif"/></td>
                            <td align="center"><img src="http://admin.shop.cn/Public/images/<?php echo ($row["is_new"]); ?>.gif"/></td>
                            <td align="center"><img src="http://admin.shop.cn/Public/images/<?php echo ($row["is_hot"]); ?>.gif"/></td>
                            <td align="center"><?php echo ($row["sort"]); ?></td>
                            <td align="center"><?php echo ($row["stock"]); ?></td>
                            <td align="center">
                                <a href="<?php echo U('edit',['id'=>$row['id']]);?>" title="编辑"><img src="http://admin.shop.cn/Public/images/icon_edit.gif" width="16" height="16" border="0" /></a>
                                <a href="<?php echo U('remove',['id'=>$row['id']]);?>" onclick="" title="回收站"><img src="http://admin.shop.cn/Public/images/icon_trash.gif" width="16" height="16" border="0" /></a></td>
                        </tr><?php endforeach; endif; ?>
                </table>

                <!-- 分页开始 -->
                <table id="page-table" cellspacing="0" class='page'>
                    <tr>
                        <td colspan="2" align="center" nowrap="true">
                            <?php echo ($page_html); ?>
                        </td>
                    </tr>
                </table>
                <!-- 分页结束 -->
            </div>
        </form>

        <div id="footer">
            2016<br />
            版权所有 &copy; 2016
        </div>
        <script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
        <script type="text/javascript">
            $(function(){
                //回显促销状态,是否上架
                <?php if(I('get.goods_status')): ?>$('.goods_status').val([<?php echo I('get.goods_status');?>]);<?php endif; ?>
                <?php if(I('get.is_on_sale') !== ''): ?>$('.is_on_sale').val([<?php echo I('get.is_on_sale');?>]);<?php endif; ?>
            });
        </script>
        
    </body>
</html>