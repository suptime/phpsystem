<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>管理中心 - 编辑商品 </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="http://admin.shop.cn/Public/css/general.css" rel="stylesheet" type="text/css" />
        <link href="http://admin.shop.cn/Public/css/main.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="http://admin.shop.cn/Public/plugs/ztree/zTreeStyle.css" />
        <link href="http://admin.shop.cn/Public/plugs/uploadify/common.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">

        </style>
    </head>
    <body>
        <h1>
            <span class="action-span"><a href="<?php echo U('index');?>">商品列表</a>
            </span>
            <span class="action-span1"><a href="__GROUP__">管理中心</a></span>
            <span id="search_id" class="action-span1"> - 编辑商品 </span>
        </h1>
        <div style="clear:both"></div>

        <div class="tab-div">
            <div id="tabbody-div">
                <form enctype="multipart/form-data" action="<?php echo U();?>" method="post">
                    <table width="90%" id="general-table" align="center">
                        <tr>
                            <td class="label">商品名称：</td>
                            <td><input type="text" name="name" value="<?php echo ($row["name"]); ?>" size="30" />
                        </tr>
                        <tr>
                            <td class="label">商品缩略图： </td>
                            <td>
                                <input type="hidden" id="logo-data" name="logo"  value="<?php echo ($row["logo"]); ?>"/>
                                <input type="file" id="logo-upload" size="20"/>
                                <img id="logo-preview" src='<?php if($row['logo'] == true): ?>/<?php endif; echo ($row["logo"]); ?>' style="max-height:100px; padding: 7px 0 0;"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">商品分类：</td>
                            <td>
                                <input type="hidden" name="goods_category_id" id="goods_category_id" value="<?php echo ($row["goods_category_id"]); ?>"/>
                                <input type="text" disabled="disabled" style="padding-left:1em" id="goods_category_name"/>
                                <ul id="treeDemo" class="ztree"></ul>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">商品品牌：</td>
                            <td>
                                <?php echo arr2select($brands,'id','name','brand_id',$row['brand_id']);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">本店售价：</td>
                            <td>
                                <input type="text" name="shop_price" value="<?php echo ($row["shop_price"]); ?>" size="20"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">市场售价：</td>
                            <td>
                                <input type="text" name="market_price" value="<?php echo ($row["market_price"]); ?>" size="20" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label">商品数量：</td>
                            <td>
                                <input type="text" name="stock" size="8" value="<?php echo ((isset($row["stock"]) && ($row["stock"] !== ""))?($row["stock"]):100); ?>"/>
                            </td>
                        </tr>
                        <td class="label">是否上架：</td>
                        <td>
                            <input type="radio" name="is_on_sale" value="1" class='is_on_sale'/> 是
                            <input type="radio" name="is_on_sale" value="0" class='is_on_sale'/> 否
                        </td>
                        </tr>
                        <tr>
                            <td class="label">加入推荐：</td>
                            <td>
                                <input type="checkbox" name="goods_status[]" value="1" class='goods_status' /> 精品 
                                <input type="checkbox" name="goods_status[]" value="2" class='goods_status'/> 新品 
                                <input type="checkbox" name="goods_status[]" value="4" class='goods_status'/> 热销
                            </td>
                        </tr>
                        <tr>
                            <td class="label">推荐排序：</td>
                            <td>
                                <input type="text" name="sort" size="5" value="<?php echo ((isset($row["sort"]) && ($row["sort"] !== ""))?($row["sort"]):20); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">商品详细描述：</td>
                            <td>
                                <script id="container" name="content" type="text/plain"><?php echo ($row["content"]); ?></script>
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
                            <td class="label">商品相册：</td>
                            <td>
                                <div>
                                    <input type="file" id='goods-gallery-upload'/>
                                </div>
                                <div class="upload-img-box">
                                    <?php if(is_array($row["galleries"])): foreach($row["galleries"] as $key=>$gallery): ?><div class="upload-pre-item-gallery">
                                            <img src="/<?php echo ($gallery["path"]); ?>"/>
                                            <a href="javascript:void(0)" title="删除此图片" data='<?php echo ($gallery["id"]); ?>'>×</a>
                                        </div><?php endforeach; endif; ?>

                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="button-div">
                        <input type='hidden' name='id' value='<?php echo ($row["id"]); ?>'/>
                        <input type="submit" value=" 确定 " class="button"/>
                        <input type="reset" value=" 重置 " class="button" />
                    </div>
                </form>
            </div>
        </div>

        <div id="footer">
            2016<br />
            版权所有 &copy; 2016
        </div>
        <script type="text/javascript" src="http://admin.shop.cn/Public/js/jquery.min.js"></script>
        <script type="text/javascript" src="http://admin.shop.cn/Public/plugs/ztree/jquery.ztree.core.min.js"></script>
        <script type="text/javascript" src="http://admin.shop.cn/Public/plugs/uploadify/jquery.uploadify.min.js"></script>
        <script type="text/javascript" src="http://admin.shop.cn/Public/plugs/layer/layer.js"></script>
        <script type="text/javascript">
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: 'parent_id',
                    }
                },
                callback: {
                    onClick: function (event, tree_ele, node) {
                        $('#goods_category_id').val(node.id);
                        $('#goods_category_name').val(node.name);
                    },
                }
            };
            //ztree显示数据
            var zNodes = <?php echo ($goods_categories); ?>;
            $(document).ready(function () {
                var goods_category_ztree = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
                goods_category_ztree.expandAll(true);

                <?php if(isset($row)): ?>//回显分类,并将分类名称放在input框中
                    var goods_category_node = goods_category_ztree.getNodeByParam('id',<?php echo ($row["goods_category_id"]); ?>);
                    //选中
                    goods_category_ztree.selectNode(goods_category_node);
                    //将名字放在input中
                    $('#goods_category_name').val(goods_category_node.name);<?php endif; ?>

                    //回显是否上架
                    $('.is_on_sale').val([<?php echo ((isset($row["is_on_sale"]) && ($row["is_on_sale"] !== ""))?($row["is_on_sale"]):1); ?>]);
                    //3.促销状态的回显
                    $('.goods_status').val(<?php echo ($row["goods_status"]); ?>);
            });

            //相册上传
            $('#goods-gallery-upload').uploadify({
                'height': 20,
                'width': 100,
                'swf': 'http://admin.shop.cn/Public/plugs/uploadify/uploadify.swf',
                uploader:'<?php echo U("Upload/index");?>',
                buttonText:' 选择多张图片上传 ',
                fileObjName:'file_data',
                fileSizeLimit:'2048K',
                fileTypeExts:'*.jpg;*.jpeg;*.png;*.gif',
                onUploadSuccess:function(file_obj,data){
                    data = $.parseJSON(data);
                    if(data.status){ //上传成功
                        //使用layer弹出提示
                        layer.alert(data.msg, {icon: 6});
                        //预览图片
                        var html = '<div class="upload-pre-item-gallery"><img src="/'+data.filePath+'"/><a href="javascript:void(0)" title="删除此图片">×</a><input type="hidden" value="'+data.filePath+'" name="path[]"/></div>';
                            $(html).appendTo($('.upload-img-box'));
                    }else{ //上传失败
                        //提示
                        layer.alert(data.msg, {icon: 5});
                    }
                },
            });

            //logo
            $('#logo-upload').uploadify({
                'height': 20,
                'width': 100,
                'swf': 'http://admin.shop.cn/Public/plugs/uploadify/uploadify.swf',
                uploader:'<?php echo U("Upload/index");?>',
                buttonText:' 选择上传的图片 ',
                fileObjName:'file_data',
                fileSizeLimit:'2048K',
                fileTypeExts:'*.jpg;*.jpeg;*.png;*.gif',
                onUploadSuccess:function(file_obj,data){
                    data = $.parseJSON(data);
                    if(data.status){ //上传成功
                        //1.将图片地址放入到隐藏域中
                        //2.提示
                        $('#logo-data').val(data.filePath);
                        $('#logo-preview').attr('src','/'+data.filePath);
                        layer.alert(data.msg, {icon: 6});
                    }else{ //上传失败
                        layer.alert(data.msg, {icon: 5});
                    }
                },
            });

            //绑定事件,事件委托,因为js添加的节点,不使用委托,无法监听
            $('.upload-img-box').on('click','a',function(){
                var gallery_id = $(this).attr('data');
                var parent_node = $(this).parent();
                var url = '<?php echo U("GoodsGallery/remove");?>';
                //删除数据库已有的
                if(gallery_id){
                    //说明是数据库中已存的,需要ajax删除
                    var data = {
                        id:gallery_id,
                    };
                    $.getJSON(url,data,function(data){
                        if(data.status){
                            layer.alert(data.info, {icon: 6});
                            parent_node.remove();
                        }else{
                            layer.alert(data.info, {icon: 5});
                        }
                    });
                }else{ //删除刚刚上传还没有保存的
                    parent_node.remove();
                    layer.alert('删除成功', {icon: 6});
                }
            });
        </script>
    </body>
</html>