/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : shop

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2016-11-14 17:49:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for shop_admin
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin`;
CREATE TABLE `shop_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `salt` char(6) NOT NULL,
  `email` varchar(30) NOT NULL,
  `add_time` int(11) unsigned NOT NULL,
  `last_login_time` int(10) unsigned NOT NULL,
  `last_login_ip` varchar(50) NOT NULL,
  `token` char(32) DEFAULT NULL,
  `token_create_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_admin
-- ----------------------------
INSERT INTO `shop_admin` VALUES ('1', 'admin', 'd925a6a6b5764569926bdc3d672f1b24', '0NLX7R', 'admin@admin.com', '1478879851', '1479115158', '127.0.0.1', 'qfHEheiMDwtJFrCiKmiLElrwWkaMBUFn', '1479115158');
INSERT INTO `shop_admin` VALUES ('2', 'baidu', '4f2d93791887abe9f0a810cb34f33786', 'LBANQU', 'baidu@baidu.com', '1478879889', '1478962794', '127.0.0.1', '506173b0b5e4d5a7d166afc9d9389397', '1478879889');

-- ----------------------------
-- Table structure for shop_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin_role`;
CREATE TABLE `shop_admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL COMMENT '管理员',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色',
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_admin_role
-- ----------------------------

-- ----------------------------
-- Table structure for shop_article
-- ----------------------------
DROP TABLE IF EXISTS `shop_article`;
CREATE TABLE `shop_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '文章标题',
  `article_category_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '文章分类',
  `intro` text COMMENT '简介@textarea',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  `inputtime` int(11) NOT NULL DEFAULT '0' COMMENT '录入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_article
-- ----------------------------
INSERT INTO `shop_article` VALUES ('3', '揭秘“战神轰炸机”轰-6K巡航黄岩岛：腿变长了！2', '6', '据央视新闻客户端11月5日报道，在央视5日播出的《焦点访谈》中，空军航空兵某团参谋长刘锐向记者独家披露了我轰-6K飞机巡航黄岩岛的背后故事。2', '1', '20', '1478438887');
INSERT INTO `shop_article` VALUES ('4', '云南文山代市长就涉苗族同胞言论致歉 称举例不恰当', '2', '2016年10月26日，文山市政府召开会议听取“蒡兜朗苗族文化生态园”项目规划汇报，因我本人的发言引发广大苗族同胞和网友的关注、讨论。昨晚州调查工作组公布的调查核实情况通报是客观实际的，本人就此事给广大苗族同胞造成的情感伤害表示深深的歉意。', '1', '20', '1478438887');
INSERT INTO `shop_article` VALUES ('5', '上海严查购房首付款 严禁前妻前夫参与还贷', '1', '上海楼市调控再度升级！4日，看看新闻Knews记者独家获悉，央行下属上海市市场利率定价自律机制，全面叫停接力贷、合力贷，并严禁前妻、前夫参与还贷。', '1', '20', '1478438887');
INSERT INTO `shop_article` VALUES ('6', '前3季度房贷同比多增1.8万亿元 短期内居民快速加杠杆', '1', '编者按：前3季度，个人住房贷款增加3.63万亿元，同比多增1.8万亿元。住房贷款激增背后的原因是什么？激增的房贷风险是否可控？9月底，北京、苏州、合肥等多个城市出台限购限贷政策后，房贷增速会否踩刹车？对此，本报记者采访了多位银行高管和金融业专家', '1', '20', '1478438887');
INSERT INTO `shop_article` VALUES ('8', '昆明：男子上访无果情绪失控 刀砍3名路人', '1', '云南网讯（记者赵岗摄影赵泽锋廖伟）“各巡逻小组请注意，现有一名身穿蓝色衣服40岁左右男子砍伤群众后，往北京路方向逃窜，请迅速前往处置”', '1', '20', '1478519690');
INSERT INTO `shop_article` VALUES ('9', '铁总原总经理盛光祖任全国人大财经委副主任', '6', '近年来，不仅在北京、上海、西安、山东等地野生动物园，即使在因野生动物而闻名的肯尼亚、南非、津巴布韦等国的国家公园，狮子、大象等猛兽袭击导致伤亡的事故也不胜枚举。其原因大多数是游客误入猛兽区或违反规定自行下车', '1', '20', '1478523426');

-- ----------------------------
-- Table structure for shop_article_category
-- ----------------------------
DROP TABLE IF EXISTS `shop_article_category`;
CREATE TABLE `shop_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `intro` text COMMENT '简介@textarea',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  `is_help` tinyint(4) DEFAULT '1' COMMENT '是否是帮助相关的分类',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级栏目id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_article_category
-- ----------------------------
INSERT INTO `shop_article_category` VALUES ('1', '购物指南', '购物指南购物指南购物指南购物指南', '1', '20', '1', '0');
INSERT INTO `shop_article_category` VALUES ('2', '配送方式', '配送方式配送方式配送方式', '1', '20', '1', '0');
INSERT INTO `shop_article_category` VALUES ('3', '支付方式', '支付方式支付方式', '1', '20', '1', '0');
INSERT INTO `shop_article_category` VALUES ('4', '售后服务', '售后服务售后服务', '1', '20', '1', '0');
INSERT INTO `shop_article_category` VALUES ('5', '特色服务', '特色服务特色服务', '1', '20', '1', '0');
INSERT INTO `shop_article_category` VALUES ('6', '网站快报', '网站快报网站快报', '1', '20', '1', '0');
INSERT INTO `shop_article_category` VALUES ('7', '网站首发', '网站首发网站首发', '1', '20', '1', '0');
INSERT INTO `shop_article_category` VALUES ('8', '电商资讯', '分类资讯分类资讯', '1', '20', '1', '0');

-- ----------------------------
-- Table structure for shop_article_detail
-- ----------------------------
DROP TABLE IF EXISTS `shop_article_detail`;
CREATE TABLE `shop_article_detail` (
  `article_id` int(11) NOT NULL,
  `content` text COMMENT '文章内容',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_article_detail
-- ----------------------------
INSERT INTO `shop_article_detail` VALUES ('3', '<p>据央视新闻客户端11月5日报道，在央视5日播出的《焦点访谈》中，空军航空兵某团参谋长刘锐向记者独家披露了我轰-6K飞机巡航黄岩岛的背后故事。\r\n轰-6K是我国在老轰-6基础上自行研制的最新型号战略轰炸机，又名“战神轰炸机”，是中国空军进攻作战的核心力量。下图是一张当时极大振奋国人信心的照片：这架涂装中国空军标志的轰-6K飞机正在飞越黄岩岛上空，由中国空军在今年7月公开发布。而这张照片的拍摄者，就是我国第一批驾驶轰-6K战机巡航黄岩岛的飞行员刘锐。2</p>');
INSERT INTO `shop_article_detail` VALUES ('4', '<p style=\"text-indent: 2em; text-align: left;\">2016年10月26日，文山市政府召开会议听取“蒡兜朗苗族文化生态园”项目规划汇报，因我本人的发言引发广大苗族同胞和网友的关注、讨论。昨晚州调查工作组公布的调查核实情况通报是客观实际的，本人就此事给广大苗族同胞造成的情感伤害表示深深的歉意。&nbsp;</p><p style=\"text-indent: 2em; text-align: left;\">这件事情发生后，我就非常想就大家关心的问题及时作出回应，但如果没有组织的调查，仅凭个人的一面之词，大家肯定难以相信。几天来，我积极主动配合调查，反思大家的批评和质疑，多次回忆会上发言，虽然我主观上没有侮辱歧视苗族同胞，但通过深刻反省，自己确实存在语言不得体、举例不恰当、用词不严谨的地方，客观上造成了对苗族同胞情感的伤害。对此，我感到深深的愧疚，再次对苗族同胞表示真诚的道歉，恳请大家给予理解和宽容。</p><p style=\"text-indent: 2em; text-align: left;\">&nbsp;此事给我极其深刻的教育。在今后工作中，我将进一步深化在民族地区抓民族工作重要性的认识，认真学习宣传民族政策，善用民族政策为群众谋利；更加严格要求自己，注意工作方式方法，谨言慎行，全力维护各民族共同团结奋斗、共同繁荣发展的良好局面。\r\n恳请广大苗族同胞及社会各界继续关心、关注文山，继续监督我的工作，对我多提宝贵意见。</p>');
INSERT INTO `shop_article_detail` VALUES ('5', '<p style=\"text-indent: 2em; text-align: left;\">上海楼市调控再度升级！4日，看看新闻Knews记者独家获悉，央行下属上海市市场利率定价自律机制，全面叫停接力贷、合力贷，并严禁前妻、前夫参与还贷。\r\n11月3日，为切实贯彻落实上海市房地产调控要求和人民银行上海总部住房信贷工作会议精神，有效发挥行业自律在房地产金融调控中的重要作用，上海市市场利率定价自律机制发布了《关于切实落实上海市房地产调控精神促进房地产金融市场有序运行的决议》，进一步要求各商业银行严格落实上海市房地产调控政策，维护房地产金融市场秩序。</p><p style=\"text-indent: 2em; text-align: left;\">&nbsp;看看新闻Knews记者获悉，决议不仅要求继续强化对首付资金来源的审查，防止各类消费贷款、个人经营性贷款、信用卡大额透支等被用于支付购房首付，同时要求对房屋抵押贷款加强审核，避免资金被违规用于加杠杆。也就是说，央行再次重申，房屋抵押贷款不能用于买房！！！只能用于消费贷！\r\n上海严查购房首付款 严禁前妻前夫参与还贷\r\n此外，央行还要求加强居民收入证明等真实性的审核，注重把控第一还款来源。严禁通过成年子女、（双方）父母、前夫、前妻或其他第三方参与共同还款并承担还款责任等方式变相规避调控政策和住房信贷管理规定。</p><p style=\"text-indent: 2em; text-align: left;\">也就是说，此前多家商业银行开展的&quot;接力贷&quot;、&quot;合力贷&quot;等业务，被全面叫停；同时禁止前妻、前夫参与还贷，意味着假离婚的夫妻，也无法作为共同贷款人从银行获得贷款。\r\n上海严查购房首付款 严禁前妻前夫参与还贷1\r\n此外，决议还要求各商业银行严审房地产企业自有资金来源，防止信贷等各类资金，尤其是理财资金通过对接信托、资管计划、私募基金等通道违规进入土地市场。\r\n背景：\r\n上海市市场利率定价自律机制成立于上海自贸区改革初期，是人民银行上海总部监督指导下的在沪银行业金融机构自律协调机制，曾为平稳有序实现自贸区小额外币利率市场化发挥了积极作用。</p><p style=\"text-indent: 2em; text-align: left;\">今年以来，根据国家有关政策和人民银行宏观审慎管理要求，上海市市场利率定价自律机制在上海市房地产金融调控中继续发挥重要作用：</p><p style=\"text-indent: 2em; text-align: left;\">一是根据上海市房地产调控要求，在人民银行上海总部指导下，今年3月按照&quot;因城施策&quot;的原则，协商确定了差别化住房信贷政策调整方案，并在全国率先出台了严格的限贷政策。&nbsp;</p><p style=\"text-indent: 2em; text-align: left;\">二是通过&quot;政策宣讲、沟通联动、不断补充实施细则、加强举报和惩戒&quot;等工作机制，在统一差别化住房信贷政策具体执行标准，规范商业银行与房地产中介业务合作，防范&quot;首付贷&quot;等房地产市场场外配资加杠杆行为，维护住房金融市场秩序等方面发挥了关键性作用，有效督促了商业银行全面贯彻落实好上海市房地产金融调控政策。新闻频道</p>');
INSERT INTO `shop_article_detail` VALUES ('6', '<p style=\"text-indent: 2em; text-align: left;\">编者按：前3季度，个人住房贷款增加3.63万亿元，同比多增1.8万亿元。住房贷款激增背后的原因是什么？激增的房贷风险是否可控？9月底，北京、苏州、合肥等多个城市出台限购限贷政策后，房贷增速会否踩刹车？对此，本报记者采访了多位银行高管和金融业专家\r\n前不久，中国人民银行发布的2016年前3季度金融统计数据显示，前3季度人民币贷款增加10.16万亿元，其中，个人住房贷款增加3.63万亿元，同比多增1.8万亿元。</p><p style=\"text-indent: 2em; text-align: left;\">个人住房贷款快速增长的原因是什么？是否存在信用风险？对此，《经济日报》记者采访了多位业内人士和专家。\r\n居民有需求 银行有动力\r\n应该说，此次个人住房贷款的快速增长是供需两端共同发力的结果。\r\n专家表示，从需求方面看，个人住房贷款利率下降以及首付比例的下调，降低了居民购房的成本和门槛，使得个人住房贷款需求快速增长。同时，理财市场收益下行，居民财富配置出现“再房地产化”的势头。\r\n中国民生银行首席研究员温彬说，自2014年以来，央行连续降准降息，个人住房贷款利率下降，加上各商业银行对个人住房贷款利率有不同程度优惠，降低了房贷成本。</p><p style=\"text-indent: 2em; text-align: left;\">同时，2014年9月以后，原来实行限购的大中城市，绝大多数已退出或者变相退出限购，首套房、二套房贷款以及公积金贷款首付比例下调，降低了购房门槛，从而刺激了居民购房需求。\r\n“同时，随着以银行理财为代表的理财市场收益率下行，房地产市场成为资金的‘蓄水池’，居民财富配置呈现出‘再房地产化’的势头。”中国人民大学重阳金融研究院客座研究员董希淼说。&nbsp;</p><p style=\"text-indent: 2em; text-align: left;\">董希淼认为，个人住房贷款增速的大幅提升主要由房价上涨刺激下，居民投资和投机性购房需求上涨所带动。&nbsp;</p><p style=\"text-indent: 2em; text-align: left;\">中金公司分析师易峘则认为，个人住房贷款的快速增长是以真实购房需求上升为支撑，而非单一的杠杆撬动。随着全国房价2013年至2015年的调整以及房贷利率的下降，住房负担能力的改善推动了购房需求出现可持续的复苏。此外，近年来交通效率的大幅提高以及人口向经济效益高的城市自然聚集，都带动了地产购置和置换需求的增长。</p>');
INSERT INTO `shop_article_detail` VALUES ('8', '<p>云南网讯<strong>（记者赵岗摄影赵泽锋廖伟）</strong>“各巡逻小组请注意，现有一名身穿蓝色衣服40岁左右男子砍伤群众后，往北京路方向逃窜，请迅速前往处置”，对讲机里传出赵泽锋队长的紧急命令。11月6日，昆明一男子持刀砍人逃窜，被昆明武警“撂倒”在80米处。</p><p>当天15时05分，昆明火车站铁路防疫站门口，四川籍男子杨某某，持菜刀砍伤三名群众后，慌忙向北京路方向逃窜。武警昆明市支队驻火车站分队担负安检口定点警戒哨兵舒远刚下士及时发现，迅速发出警报信号。各巡逻小组火速展开行动，采取围追堵截的战术手段，将犯罪嫌疑人制伏于安检口前侧80米处。</p><p>随后，将犯罪嫌疑人移交给赶到现场的北京路派出所民警。</p>');
INSERT INTO `shop_article_detail` VALUES ('9', '<p>近年来，不仅在北京、上海、西安、山东等地野生动物园，即使在因野生动物而闻名的肯尼亚、南非、津巴布韦等国的国家公园，狮子、大象等猛兽袭击导致伤亡的事故也不胜枚举。其原因大多数是游客误入猛兽区或违反规定自行下车、开窗等所致。</p><p>今年7月北京八达岭野生动物园发生的东北虎伤人事件还远未告一段落，3个月之后，伤者父亲赵斌表示，就善后工作与园方仍未达成一致，而且“协商通道都被堵死了”。</p><p>双方分歧在事故责任的划分上。</p><p>8月24日，北京延庆区政府官方发布了一份事故调查报告，认定伤者赵某违反园区规定擅自下车，被老虎攻击受伤，随后其母周某违规下车施救，被虎攻击死亡；该事件“不属于生产安全责任事故”。</p><p>据此，八达岭动物园认为己方不应对该事件担责，但从道义出发给予占定损15%的补偿即20万元。对此赵斌并不认同，“园方应该负死者的全部责任和伤者的主要责任”，他表示，将走法律途径解决此事。</p>');

-- ----------------------------
-- Table structure for shop_brand
-- ----------------------------
DROP TABLE IF EXISTS `shop_brand`;
CREATE TABLE `shop_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '品牌名称',
  `intro` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '品牌标识',
  `sort` int(10) unsigned NOT NULL DEFAULT '20' COMMENT '排序，数字越小越靠前',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1正常 0隐藏 -1删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_brand
-- ----------------------------
INSERT INTO `shop_brand` VALUES ('1', '华为啊啊啊', '华为手机', 'Uploads/20161105/581dea3aecbfd.gif', '20', '1');
INSERT INTO `shop_brand` VALUES ('2', '盛大撒2', '华为手机', 'Uploads/20161105/581dea430c581.gif', '20', '1');
INSERT INTO `shop_brand` VALUES ('3', '华为', '华为手机', '', '20', '1');
INSERT INTO `shop_brand` VALUES ('4', '华为', '华为手机', '', '20', '1');
INSERT INTO `shop_brand` VALUES ('5', '华为', '华为手机', '', '20', '1');
INSERT INTO `shop_brand` VALUES ('6', '都是都是', '都是是方式方式都是', '', '20', '1');
INSERT INTO `shop_brand` VALUES ('7', '小米', '小米小米小米小米小米小米', 'Uploads/20161105/581de6ba37a43.gif', '20', '1');
INSERT INTO `shop_brand` VALUES ('8', '的反馈是你发的', '盛大都是都是都是', 'Uploads/20161105/581deba8ede75.jpg', '20', '1');
INSERT INTO `shop_brand` VALUES ('9', 'ECShop', '盛大按时阿萨德萨达撒打算撒', 'Uploads/20161105/581dec50f11e4.gif', '20', '1');

-- ----------------------------
-- Table structure for shop_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods`;
CREATE TABLE `shop_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `sn` char(15) NOT NULL DEFAULT '' COMMENT '货号',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT '商品LOGO',
  `goods_category_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类',
  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '品牌',
  `supplier_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '供货商',
  `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `shop_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '本店价格',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `goods_status` int(11) NOT NULL DEFAULT '0' COMMENT '商品状态',
  `is_on_sale` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否上架',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  `inputtime` int(11) NOT NULL DEFAULT '0' COMMENT '录入时间',
  PRIMARY KEY (`id`),
  KEY `goods_category_id` (`goods_category_id`),
  KEY `brand_id` (`brand_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='商品';

-- ----------------------------
-- Records of shop_goods
-- ----------------------------
INSERT INTO `shop_goods` VALUES ('1', '第三方第三方', 'SN2016111400001', 'Uploads/20161114/5829804d2cc15.gif', '5', '7', '0', '599.00', '299.00', '100', '3', '1', '1', '20', '1479114103');

-- ----------------------------
-- Table structure for shop_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_category`;
CREATE TABLE `shop_goods_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `intro` text,
  `is_show` tinyint(4) NOT NULL DEFAULT '1',
  `is_nav` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL DEFAULT '20',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods_category
-- ----------------------------
INSERT INTO `shop_goods_category` VALUES ('1', '电脑', '0', '1', '6', '1', '都是地方说的', '1', '1', '20');
INSERT INTO `shop_goods_category` VALUES ('2', '手机', '0', '7', '10', '1', '都是地方说的', '1', '1', '20');
INSERT INTO `shop_goods_category` VALUES ('3', '平板电脑', '1', '2', '3', '2', '平板电脑平板电脑平板电脑', '1', '0', '20');
INSERT INTO `shop_goods_category` VALUES ('4', '台式机', '1', '4', '5', '2', '地方萨达撒都是是', '1', '0', '20');
INSERT INTO `shop_goods_category` VALUES ('5', '智能手机', '2', '8', '9', '2', '智能手机智能手机', '1', '0', '20');

-- ----------------------------
-- Table structure for shop_goods_day_count
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_day_count`;
CREATE TABLE `shop_goods_day_count` (
  `day` date NOT NULL COMMENT '日期',
  `count` int(10) unsigned DEFAULT NULL COMMENT '商品数',
  PRIMARY KEY (`day`),
  KEY `day` (`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods_day_count
-- ----------------------------
INSERT INTO `shop_goods_day_count` VALUES ('2016-11-14', '1');

-- ----------------------------
-- Table structure for shop_goods_gallery
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_gallery`;
CREATE TABLE `shop_goods_gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` bigint(20) DEFAULT NULL COMMENT '商品ID',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '商品图片地址',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='商品相册';

-- ----------------------------
-- Records of shop_goods_gallery
-- ----------------------------
INSERT INTO `shop_goods_gallery` VALUES ('7', '1', 'Uploads/20161114/5829807e40115.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('8', '1', 'Uploads/20161114/5829807e9b04e.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('9', '1', 'Uploads/20161114/5829807eb3b00.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('10', '1', 'Uploads/20161114/5829807eca010.jpg');

-- ----------------------------
-- Table structure for shop_goods_intro
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_intro`;
CREATE TABLE `shop_goods_intro` (
  `goods_id` bigint(20) NOT NULL COMMENT '商品ID',
  `content` text COMMENT '商品描述',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品描述';

-- ----------------------------
-- Records of shop_goods_intro
-- ----------------------------
INSERT INTO `shop_goods_intro` VALUES ('1', '<p>地方上能看到分少女峰能看肯定是南方肯定是南方流口水的南方快递费你考虑过你抵抗力感到付款呢肯定是南方克里斯蒂娜分克里斯蒂娜分考了多少你发的顺口溜你老打瞌睡你发的快乐是你分路口的少年款式的你大神快来发</p>');

-- ----------------------------
-- Table structure for shop_permission
-- ----------------------------
DROP TABLE IF EXISTS `shop_permission`;
CREATE TABLE `shop_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '权限名称',
  `path` varchar(50) NOT NULL COMMENT '操作路径：  模块/控制器/操作方法',
  `parent_id` int(10) unsigned NOT NULL COMMENT '父级权限',
  `lft` int(10) unsigned NOT NULL COMMENT '左节点',
  `rght` int(10) unsigned NOT NULL COMMENT '右节点',
  `level` int(10) unsigned NOT NULL COMMENT '层级',
  `intro` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_permission
-- ----------------------------

-- ----------------------------
-- Table structure for shop_role
-- ----------------------------
DROP TABLE IF EXISTS `shop_role`;
CREATE TABLE `shop_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `intro` varchar(255) DEFAULT NULL COMMENT '描述',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序，越小越靠前',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_role
-- ----------------------------

-- ----------------------------
-- Table structure for shop_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `shop_role_permission`;
CREATE TABLE `shop_role_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL COMMENT '角色',
  `permission_id` int(10) unsigned NOT NULL COMMENT '权限',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_role_permission
-- ----------------------------
