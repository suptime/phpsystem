<?php
return array(
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

    'SITE_URL'              => 'http://www.shop.cn/', //网站根域名
    'WEB_TITLE'             => ' - 拉邦购物网 - www.labanggou.com',
    'IMG_PATH'              => 'http://admin.shop.cn/', //图片附件远程地址

    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_HTML_SUFFIX'       =>  false,

    'COOKIE_PREFIX'         =>  'COOKIE_PREFIX_',   //cookie前缀



    //静态资源默认地址
    'TMPL_PARSE_STRING' => array(
        '__CSS__' => 'http://www.shop.cn/Public/css',
        '__IMG__' => 'http://www.shop.cn/Public/images',
        '__JS__' => 'http://www.shop.cn/Public/js',
        '__UPLOADIFY__' => 'http://www.shop.cn/Public/plugs/uploadify',
        '__LAYER__' => 'http://www.shop.cn/Public/plugs/layer',
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
        'useNoise'  =>  true,            // 是否添加杂点
        'length'    =>  4,               // 验证码位数
        'bg'        =>  array(243, 251, 254),  // 背景颜色
        'reset'     =>  false,           // 验证成功后是否重置
        'fontttf'   =>  '4.ttf',
    ),

    //短信验证/阿里大于api
    'SMS' => array(
        'appkey' => '23534030',
        'secret' => 'a0b4b5450538583429a9c92621db3f52',
        'autograph' => '网站短信接口测试',
        'webname' => '拉邦购商城',
        'TemplateCode' => 'SMS_26035289',
    ),


    //验证列表
    'MEMBER_URL_LIST' => array(
        'Home/Member/index',
    ),


);