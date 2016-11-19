<?php
return array(
	//'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  3306,        // 端口
    'DB_PREFIX'             =>  'shop_',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8

    'SITE_URL'              => 'http://admin.shop.cn/', //网站根域名
    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_HTML_SUFFIX'       =>  false,

    'COOKIE_PREFIX'         =>  'COOKIE_PREFIX_',   //cookie前缀

    //静态资源默认地址
    'TMPL_PARSE_STRING' => array(
        '__CSS__' => 'http://admin.shop.cn/Public/css',
        '__IMG__' => 'http://admin.shop.cn/Public/images',
        '__JS__' => 'http://admin.shop.cn/Public/js',
        '__UPLOADIFY__' => 'http://admin.shop.cn/Public/plugs/uploadify',
        '__LAYER__' => 'http://admin.shop.cn/Public/plugs/layer',
        '__UEDITOR__' => 'http://admin.shop.cn/Public/plugs/uediter',
        '__ZTREE__' => 'http://admin.shop.cn/Public/plugs/ztree',
    ),

    //分页数据
    'PAGES' => array(
        'PAGESIZE' => 10,
        'THEME'  => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%'
    ),

    //验证码配置
    'CAPTCHA' => array(
        'fontSize'  =>  18,              // 验证码字体大小(px)
        'useCurve'  =>  false,            // 是否画混淆曲线
        'useNoise'  =>  false,            // 是否添加杂点
        'length'    =>  4,               // 验证码位数
        'bg'        =>  array(243, 251, 254),  // 背景颜色
        'reset'     =>  true,           // 验证成功后是否重置
        'fontttf'   =>  '4.ttf',
    ),

    //已登陆的后台用户公共页面白名单
    'LOGIN_BEFORE_ADMIN' => array(
        'Admin/Index/index',
        'Admin/Index/top',
        'Admin/Index/menu',
        'Admin/Index/main',
        'Admin/Admin/logout',
        'Admin/Admin/edit',
        'Admin/Upload/upload',
    ),

    //后台公共可访问页面白名单
    'LOGIN_AFTER_ADMIN' => array(
        'Admin/Admin/login',
        'Admin/Captcha/code',
    ),

);