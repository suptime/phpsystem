<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>成功提交订单</title>
	<link rel="stylesheet" href="http://www.shop.cn/Public/css/base.css" type="text/css">
	<link rel="stylesheet" href="http://www.shop.cn/Public/css/global.css" type="text/css">
	<link rel="stylesheet" href="http://www.shop.cn/Public/css/header.css" type="text/css">
	<link rel="stylesheet" href="http://www.shop.cn/Public/css/footer.css" type="text/css">
	<script type="text/javascript" src="http://www.shop.cn/Public/js/jquery.min.js"></script>
	
	<link rel="stylesheet" href="http://www.shop.cn/Public/css/success.css" type="text/css">

</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
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
	
	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="/"><img src="http://www.shop.cn/Public/images/logo.png" alt="京西商城"></a></h2>

			<?php if(ACTION_NAME == 'addToCart'): ?><div class="search fr" style="padding-right: 0">
					<div class="search_form">
						<div class="form_left fl"></div>
						<form action="" name="serarch" method="get" class="fl">
							<input type="text" class="txt" value="请输入商品关键字" style="color: rgb(153, 153, 153);"><input type="submit" class="btn" value="搜索">
						</form>
						<div class="form_right fl"></div>
					</div>

					<div style="clear:both;"></div>
				</div>
				<?php else: ?>
						<?php if(ACTION_NAME == 'cartList'): ?><div class="flow fr">
							<ul>
								<li class="cur">1.我的购物车</li>
								<li>2.填写核对订单信息</li>
								<li>3.成功提交订单</li>
							</ul>
						</div>
						<?php elseif(ACTION_NAME == 'cartOrder'): ?>
						<div class="flow fr flow2">
							<ul>
								<li>1.我的购物车</li>
								<li class="cur">2.填写核对订单信息</li>
								<li>3.成功提交订单</li>
							</ul>
						</div>
						<?php else: ?>
						<div class="flow fr flow3">
							<ul>
								<li>1.我的购物车</li>
								<li>2.填写核对订单信息</li>
								<li class="cur">3.成功提交订单</li>
							</ul>
						</div><?php endif; endif; ?>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	
	<!-- 主体部分 start -->
	<div class="success w990 bc mt15">
		<div class="success_hd" style="background: none">
		</div>
		<div class="success_bd">
			<p><span></span> 商品已成功加入购物车！&nbsp;<a href="<?php echo U('Cart/cartList');?>">去购物车结算</a> </p>
			<p class="message">商品成功添加到购物车后，你可以 &nbsp; <a href="<?php echo U('Goods/show',array('id'=>I('get.goods_id')));?>">查看商品详情</a>&nbsp; &nbsp; &nbsp; &nbsp; <a href="/">继续购物</a></p>
		</div>
	</div>
	<!-- 主体部分 end -->


	<div style="clear:both;"></div>

	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt15">
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
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="http://www.shop.cn/Public/images/xin.png" alt="" /></a>
			<a href=""><img src="http://www.shop.cn/Public/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="http://www.shop.cn/Public/images/police.jpg" alt="" /></a>
			<a href=""><img src="http://www.shop.cn/Public/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->

</body>
</html>