<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="http://www.shop.cn/Public/css/base.css" type="text/css">
    <link rel="stylesheet" href="http://www.shop.cn/Public/css/global.css" type="text/css">
    <link rel="stylesheet" href="http://www.shop.cn/Public/css/header.css" type="text/css">
    <link rel="stylesheet" href="http://www.shop.cn/Public/css/common.css" type="text/css">
    <link rel="stylesheet" href="http://www.shop.cn/Public/css/bottomnav.css" type="text/css">
    <link rel="stylesheet" href="http://www.shop.cn/Public/css/footer.css" type="text/css">
    <script type="text/javascript" src="http://www.shop.cn/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://www.shop.cn/Public/js/header.js"></script>
    
    <link rel="stylesheet" href="http://www.shop.cn/Public/css/home.css" type="text/css">
    <link rel="stylesheet" href="http://www.shop.cn/Public/css/user.css" type="text/css">

</head>
<body>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w1210 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>
                <?php if($member == false): ?><li>您好，欢迎来到京西！[<a href="<?php echo U('Member/login');?>">登录</a>] [<a href="<?php echo U('Member/register');?>">免费注册</a>]</li>
                    <li class="line">|</li>
                    <li><a href="">我的订单</a></li>
                    <li class="line">|</li>
                    <li>客户服务</li>

                    <?php else: ?>

                    <li>欢迎回来！<a href="<?php echo U('Member/index');?>"><?php echo ($member["username"]); ?></a>  </li>
                    <li class="line">|</li>
                    <li><a href="">我的订单</a></li>
                    <li class="line">|</li>
                    <li>客户服务</li><?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 头部 start -->
<div class="header w1210 bc mt15">
    <!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
    <div class="logo w1210">
        <h1 class="fl"><a href="/"><img src="http://www.shop.cn/Public/images/logo.png" alt="京西商城"></a></h1>
        <!-- 头部搜索 start -->
        <div class="search fl">
            <div class="search_form">
                <div class="form_left fl"></div>
                <form action="" name="serarch" method="get" class="fl">
                    <input type="text" class="txt" value="请输入商品关键字"/><input type="submit" class="btn" value="搜索"/>
                </form>
                <div class="form_right fl"></div>
            </div>

            <div style="clear:both;"></div>

            <div class="hot_search">
                <strong>热门搜索:</strong>
                <a href="">D-Link无线路由</a>
                <a href="">休闲男鞋</a>
                <a href="">TCL空调</a>
                <a href="">耐克篮球鞋</a>
            </div>
        </div>
        <!-- 头部搜索 end -->

        <!-- 用户中心 start-->
        <div class="user fl">
            <dl>
                <dt>
                    <em></em>
                    <a href="">用户中心</a>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt">
                        尊敬的用户您好，请 <a href="">登录</a> 后操作
                    </div>
                    <div class="uclist mt10">
                        <ul class="list1 fl">
                            <li><a href="">用户信息</a></li>
                            <li><a href="">我的订单</a></li>
                            <li><a href="">收货地址</a></li>
                            <li><a href="">我的收藏</a></li>
                        </ul>

                        <ul class="fl">
                            <li><a href="">我的留言</a></li>
                            <li><a href="">我的红包</a></li>
                            <li><a href="">我的评论</a></li>
                            <li><a href="">资金管理</a></li>
                        </ul>

                    </div>
                    <div style="clear:both;"></div>
                    <div class="viewlist mt10">
                        <h3>最近浏览的商品：</h3>
                        <ul>
                            <li><a href=""><img src="http://www.shop.cn/Public/images/view_list1.jpg" alt=""/></a></li>
                            <li><a href=""><img src="http://www.shop.cn/Public/images/view_list2.jpg" alt=""/></a></li>
                            <li><a href=""><img src="http://www.shop.cn/Public/images/view_list3.jpg" alt=""/></a></li>
                        </ul>
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 用户中心 end-->

        <!-- 购物车 start -->
        <div class="cart fl">
            <dl>
                <dt>
                    <a href="">去购物车结算</a>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt">
                        购物车中还没有商品，赶紧选购吧！
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 购物车 end -->
    </div>
    <!-- 头部上半部分 end -->

    <div style="clear:both;"></div>

    <!-- 导航条部分 start -->
    <div class="nav w1210 bc mt10">
        <!--  商品分类部分 start-->
        <div class="category fl <?php if(CONTROLLER_NAME.'/'.ACTION_NAME != 'Index/index'): ?>cat1<?php endif; ?>"> <!-- 非首页，需要添加cat1类 -->
        <div class="cat_hd <?php if(CONTROLLER_NAME.'/'.ACTION_NAME != 'Index/index'): ?>off<?php endif; ?>">
        <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
        <h2>全部商品分类</h2>
        <em></em>
    </div>

    <div class="cat_bd <?php if(CONTROLLER_NAME.'/'.ACTION_NAME != 'Index/index'): ?>none<?php endif; ?>">
    <?php if(is_array($cates)): foreach($cates as $key=>$top): if(($top["parent_id"]) == "0"): ?><div class="cat item1">
                <h3><a href="<?php echo U('Goods/category',array('id'=>$top['id']),'',true);?>"><?php echo ($top["name"]); ?></a> <b></b></h3>

                <div class="cat_detail">
                    <?php if(is_array($cates)): foreach($cates as $index=>$sub_cate): if(($sub_cate['parent_id']) == $top['id']): ?><dl>
                                <dt><a href="<?php echo U('Goods/category',array('id'=>$sub_cate['id']),'',true);?>"><?php echo ($sub_cate["name"]); ?></a>
                                </dt>

                                <?php if(is_array($cates)): foreach($cates as $key=>$three): if(($three['parent_id']) == $sub_cate['id']): ?><dd>
                                            <a href="<?php echo U('Goods/category',array('id'=>$three['id']),'',true);?>"><?php echo ($three["name"]); ?></a>
                                        </dd><?php endif; endforeach; endif; ?>

                            </dl><?php endif; endforeach; endif; ?>
                </div>
            </div><?php endif; endforeach; endif; ?>


</div>

</div>
<!--  商品分类部分 end-->

<div class="navitems fl">
    <ul class="fl">
        <li <?php if(CONTROLLER_NAME.'/'.ACTION_NAME == 'Index/index'): ?>class="current"<?php endif; ?>><a href="/">首页</a></li>
        <li><a href="">电脑频道</a></li>
        <li><a href="">家用电器</a></li>
        <li><a href="">品牌大全</a></li>
        <li><a href="">团购</a></li>
        <li><a href="">积分商城</a></li>
        <li><a href="">夺宝奇兵</a></li>
    </ul>
    <div class="right_corner fl"></div>
</div>
</div>
<!-- 导航条部分 end -->
</div>
<!-- 头部 end-->

<div style="clear:both;"></div>



<!-- 页面主体 start -->
<div class="main w1210 bc mt10">
    <div class="crumb w1210">
        <h2><strong>我的XX </strong><span>> 账户信息</span></h2>
    </div>

    <!-- 左侧导航菜单 start -->
    <div class="menu fl">
        <h3>我的XX</h3>

        <div class="menu_wrap">
            <dl>
                <dt>订单中心 <b></b></dt>
                <dd><b>.</b><a href="">我的订单</a></dd>
                <dd><b>.</b><a href="">我的关注</a></dd>
                <dd><b>.</b><a href="">浏览历史</a></dd>
                <dd><b>.</b><a href="">我的团购</a></dd>
            </dl>

            <dl>
                <dt>账户中心 <b></b></dt>
                <dd class="cur"><b>.</b><a href="">账户信息</a></dd>
                <dd><b>.</b><a href="">账户余额</a></dd>
                <dd><b>.</b><a href="">消费记录</a></dd>
                <dd><b>.</b><a href="">我的积分</a></dd>
                <dd><b>.</b><a href="">收货地址</a></dd>
            </dl>

            <dl>
                <dt>订单中心 <b></b></dt>
                <dd><b>.</b><a href="">返修/退换货</a></dd>
                <dd><b>.</b><a href="">取消订单记录</a></dd>
                <dd><b>.</b><a href="">我的投诉</a></dd>
            </dl>
        </div>
    </div>
    <!-- 左侧导航菜单 end -->

    <!-- 右侧内容区域 start -->
    <div class="content fl ml10">
        <div class="user_hd">
            <h3>账户信息</h3>
        </div>

        <div class="user_bd mt10">
            <form action="" method="post">
                <ul>
                    <li>
                        <label for="">用户名：</label>
                        <strong>diamondwang</strong>
                    </li>
                    <li>
                        <label for="">昵称：</label>
                        <input type="text" class="txt" value="diamondwang"/>
                    </li>
                    <li>
                        <label for="">邮箱：</label>
                        <strong>dw@163.com</strong>
                    </li>
                    <li>
                        <label for="">手机号码：</label>
                        <input type="text" class="txt" value="13333333333"/>
                    </li>
                    <li>
                        <label for="">&nbsp;</label>
                        <input type="submit" value="提交" class="sbtn"/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <!-- 右侧内容区域 end -->
</div>
<!-- 页面主体 end-->
    <div style="clear: both"></div>



<!-- 底部导航 start -->
<div class="bottomnav w1210 bc mt10">
    <?php if(is_array($article_cates)): $k = 0; $__LIST__ = array_slice($article_cates,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($k % 2 );++$k;?><div class="bnav<?php echo ($k); ?>">
            <h3><b></b> <em><?php echo ($val["name"]); ?></em></h3>
            <ul>
                <?php if(is_array($articles)): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arc): $mod = ($i % 2 );++$i; if(($arc["article_category_id"]) == $val['id']): ?><li><a href="<?php echo U('Article/show',array('id'=>$arc['id']),'',true);?>"><?php echo ($arc["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<!-- 底部导航 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt10">
    <p class="links">
        <a href="">关于我们</a> |
        <a href="">联系我们</a> |
        <a href="">人才招聘</a> |
        <a href="">商家入驻</a> |
        <a href="">千寻网</a> |
        <a href="">奢侈品网</a> |
        <a href="">广告服务</a> |
        <a href="">移动终端</a> |
        <a href="">友情链接</a> |
        <a href="">销售联盟</a> |
        <a href="">京西论坛</a>
    </p>

    <p class="copyright">
        © 2005-2013 京东网上商城 版权所有，并保留所有权利。 ICP备案证书号:京ICP证070359号
    </p>

    <p class="auth">
        <a href=""><img src="http://www.shop.cn/Public/images/xin.png" alt=""/></a>
        <a href=""><img src="http://www.shop.cn/Public/images/kexin.jpg" alt=""/></a>
        <a href=""><img src="http://www.shop.cn/Public/images/police.jpg" alt=""/></a>
        <a href=""><img src="http://www.shop.cn/Public/images/beian.gif" alt=""/></a>
    </p>
</div>
<!-- 底部版权 end -->

</body>
</html>