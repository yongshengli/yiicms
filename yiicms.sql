# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.9-MariaDB)
# Database: yiicms
# Generation Time: 2016-12-27 07:33:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ad
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ad`;

CREATE TABLE `ad` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `create_at` int(11) NOT NULL DEFAULT '0',
  `update_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ad` WRITE;
/*!40000 ALTER TABLE `ad` DISABLE KEYS */;

INSERT INTO `ad` (`id`, `title`, `image`, `link`, `create_at`, `update_at`)
VALUES
	(1,'百度','/uploads/ad-img/img_58500a3e1b241.jpg','http://www.baidu.com',1481640510,1481640673),
	(2,'腾讯','/uploads/ad-img/img_58500a67014d3.jpg','http://www.qq.com',1481640551,1481640751),
	(3,'网易','/uploads/ad-img/img_58500a8b4fb51.png','http://www.163.com',1481640587,1481640587);

/*!40000 ALTER TABLE `ad` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_user`;

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `create_at` int(11) NOT NULL,
  `update_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u-username` (`username`),
  UNIQUE KEY `u-email` (`email`),
  UNIQUE KEY `u-password-reset-token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;

INSERT INTO `admin_user` (`id`, `username`, `auth_key`, `password`, `password_reset_token`, `email`, `status`, `access_token`, `create_at`, `update_at`)
VALUES
	(1,'admin','','21232f297a57a5a743894a0e4a801fc3',NULL,'739800600@qq.com',10,'',0,1481432518),
	(4,'demo','','fe01ce2a7fbac8fafaed7c982a04e229',NULL,'demo@demo.com',10,'',1481431804,1481431804);

/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '分类名',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `type` tinyint(4) NOT NULL COMMENT '1.news 2 products 3 photo',
  `create_at` int(11) NOT NULL,
  `update_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `i-type-pid` (`type`,`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`id`, `name`, `pid`, `type`, `create_at`, `update_at`)
VALUES
	(1,'产品分类一',0,2,1481360463,1481452810),
	(2,'默认分类',0,1,1481367786,1481367944),
	(3,'新闻分类2',2,1,1481372394,1481372772),
	(4,'产品分类二',0,2,1481609361,1481609361),
	(5,'下载文档',0,3,1482155225,1482155225),
	(6,'企业环境',0,4,1482559711,1482559711);

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table config
# ------------------------------------------------------------

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '字段名英文',
  `label` varchar(50) DEFAULT NULL COMMENT '字段标注',
  `value` text NOT NULL COMMENT '字段值',
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i-name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;

INSERT INTO `config` (`id`, `name`, `label`, `value`, `create_at`, `update_at`)
VALUES
	(2,'contact_us','联系我们','<p>公司: 在北京网络科技</p>\r\n<p>联系人: 李</p>\r\n<p>QQ: 739800600</p>\r\n<p>电话: 130435198910262331</p>\r\n<p>E-mail: 739800600@qq.com</p>\r\n<p>地址: 北京市丰台区大红门</p>',1481350005,1481353232),
	(3,'about_us','关于我们','<p>CMS website system is using PHP + MYSQL technology and MVC pattern, structure clear, the code easier to maintain. Support the pseudo static function, can generate Google and baidu map, support custom url, keywords and description, accord with standard of SEO. With corporate websites commonly used modules (description module, news module, product module, download module, image module, online messages, online orders, links, site map, etc.), strong background management functions, flexible marketing for enterprises to create professional and has force standard web site.<br>The website system function is introduced:<br>Modules: </p><p>1. The single page can release enterprises of all kinds of information, such as the description, organization, enterprise honor, contact information, etc., and can freely add or delete.<br>2. News: modules can be issued corporate news and industry news, etc., to support the secondary column, column number is unlimited.<br>3. The product module: product support secondary classification, and can place orders directly to the product inquiry, and support email notification, conforms to the enterprise marketing.<br>4. Image module: in the form of picture album, photo albums and other columns can be successful or company, more intuitive to show the superiority of the enterprise.<br>5. Download module: users can upload document in the background information, convenient website customers to download to use.<br>6. Online message: let the customer advice message timely feedback to the enterprise, and support email notification, make communication more convenient.<br>7. Product search: input a keyword search, the products to the customer to increase the flexibility of the site.<br>8. Product can add the products to replicate, so as to improve the efficiency of the added products.<br>9. Image watermark: can set up the company in the background of the watermark image, in order to prevent the enterprise product pictures stolen.<br>10. Email notification: under customer orders or leave a message at the same time, will send email to the email address you specify, make work more efficiently.<br>11. Search optimization: total support pseudo static, customizable keywords, description, url, generates a sitemap function, add in chain and tags, and other functions.<br></p>',1481355647,1481607089);

/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型1news,2product3photo',
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
  `description` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0不显示1显示',
  `admin_user_id` int(11) NOT NULL DEFAULT '0',
  `create_at` int(11) NOT NULL DEFAULT '0',
  `update_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `i-type-status-title` (`type`,`status`,`title`),
  KEY `i-update` (`update_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;

INSERT INTO `content` (`id`, `title`, `type`, `category_id`, `image`, `description`, `keywords`, `status`, `admin_user_id`, `create_at`, `update_at`)
VALUES
	(1,'测试1',1,0,'','测试测试222','',1,0,0,1481269292),
	(7,'新闻2',1,3,'','吃豆腐的房地产','',0,0,1481264976,1481379895),
	(9,'dfdsfadfdsfdsfds',1,0,'','dfsdds','',0,0,1481265228,1481265228),
	(10,'dfsdfds312321的所得税法',1,0,'','的范德萨发的','',0,1,1481265362,1481265362),
	(11,'测试你好',1,0,'','三大市场','',1,1,1481265454,1481265454),
	(13,'sdfdsvds',1,0,'','dsfadsfdsa adfdasfd','',0,1,1481265650,1481265650),
	(14,'dfsdfds312321的所得税法dsfdsf',1,0,'','fdsdsfsdfds','',0,1,1481268136,1481268136),
	(15,'测试测试测试',1,0,'','测试测试222','',0,1,1481268506,1481268506),
	(16,'电风扇的范德萨',1,0,'','东方闪电','',0,1,1481268645,1481268645),
	(17,'ceshi',1,2,'','测试','',1,1,1481294417,1482486244),
	(18,'测试测试',1,0,'','测试3333333','',1,1,1481294436,1481294436),
	(19,'测试测试测试',1,2,'','测试测试','',1,1,1481294458,1482120320),
	(20,'德国代购2016 Marc Jacobs/马克·雅可布 女士撞色皮质直板钱包',2,1,'','<p>德国代购2016 Marc Jacobs/马克·雅可布 女士撞色皮质直板钱包</p>','',1,1,1481455753,1482071209),
	(21,'测试测试',2,1,'/uploads/products-img/img_584d571075916.jpg','测试','',1,1,1481463544,1481552670),
	(22,'测试测试测试',2,1,'/uploads/products-img/img_584d57438ddb0.jpg','测试测试测试','',1,1,1481463619,1481463619),
	(23,'测试产品22222222222222',2,1,'/uploads/products-img/img_584d5d65a0855.jpg','测试产品','',1,1,1481465189,1481465189),
	(24,'飒飒的范德萨范德萨似懂非懂是',2,1,'/uploads/products-img/img_58575c9b83b7b.png','<p>似懂非懂是付的是</p><p><br></p>','',1,1,1481465708,1482120751),
	(25,'美国代购2016 MOTHER 女士磨边牛仔裤',2,1,'/uploads/products-img/img_584eb27571659.jpg','重度磨损和猫须褶皱为这款褪色 MOTHER 牛仔裤带来做旧效果。5 口袋设计。钮扣和拉链门襟。','',1,1,1481552501,1481552688),
	(26,'关于公司考勤制度',3,5,'','<p>关于公司考勤制度</p>','',1,1,1482155706,1482157422),
	(27,'测试',3,5,'','','',0,1,1482200020,1482202904),
	(28,'继承测试',1,2,'','继承测试','',1,1,1482291369,1482291661),
	(29,'产品继承测试',2,1,'/uploads/products-img/img_5859f8c6724c8.jpg','','',1,1,1482291398,1482325074),
	(30,'办公环境',4,6,'','','',1,1,1482560413,1482560413),
	(31,'测试相册',4,6,'','测试','测试',1,1,1482654720,1482654720);

/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table content_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_detail`;

CREATE TABLE `content_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `params` varchar(1000) NOT NULL DEFAULT '',
  `file_url` varchar(255) NOT NULL DEFAULT '',
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i-content` (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `content_detail` WRITE;
/*!40000 ALTER TABLE `content_detail` DISABLE KEYS */;

INSERT INTO `content_detail` (`id`, `content_id`, `detail`, `params`, `file_url`, `create_at`, `update_at`)
VALUES
	(1,1,'测试detail,123232,45454545','','',1481264096,1481269292),
	(3,7,'测试测试','','',1481264976,1481379895),
	(4,9,'dsfdsfdsfdsfdsdfsdfds','','',1481265228,1481265228),
	(5,10,'打算vdsvdsdsfadf是打发第三方打发第三方','','',1481265362,1481265362),
	(6,11,'是的撒FDSAD','','',1481265454,1481265454),
	(7,13,'dfadsfda','','',1481265650,1481265650),
	(8,14,'dsfdsfdsfdsfds','','',1481268136,1481268136),
	(9,15,'电风扇的范德萨发生的','','',1481268506,1481268506),
	(10,16,'大多数是范德萨','','',1481268645,1481268645),
	(11,17,'<p><img src=\"/uploads/redactor-img/1/892f7f6043-9c1ab2f5-f848-4e09-bb3e-9b10c2938520.png\" alt=\"892f7f6043-9c1ab2f5-f848-4e09-bb3e-9b10c2938520.png\"/>测试测试</p>','','',1481294417,1482486244),
	(12,18,'测试测试测试','','',1481294436,1481294436),
	(13,19,'<p>水电费的所得税法</p><p><img src=\"/uploads/redactor-img/1/892f7f6043-9c1ab2f5-f848-4e09-bb3e-9b10c2938520.png\"></p><p><br></p><p><img></p>','','',1481294458,1482120320),
	(14,20,'<p><img></p><p><img src=\"/uploads/redactor-img/1/3c779817e7-9c1ab2f5-f848-4e09-bb3e-9b10c2938520.png\"></p><p><img></p><p><img></p><p>发货相关问题</p><p>SEND ABOUT</p><p>购买来源：本店所有商品均为海外购，所有海外购商品均从（美国、欧洲、香港）正品专柜、官网、百货公司购买，正品保证，请放心选购。</p><p>邮寄方式：本店商品均为海外直发，欧洲商家一般经由我们香港仓、澳门仓等中转再转发国内快递发往您；美国商家一般采用美国直邮方式到国内自动转为EMS直接发往您。</p><p>物流显示：因淘宝物流显示问题，本店商品到达国内才会转为发货状态并显示国内物流单号。一般商品到货时间为2-4周。因而当您的订单淘宝未显示发货，请不要心急，商品都在正常国际运输中，我们全程为您监控物流进程，如有异常会及时通知您。如有疑问，可以咨询在线客服，请勿催单哦！</p><p>特别提醒：以上发货及运送时间均为理论时效，但偶有意外如恶劣天气、清关延误、节假日等国际物流的不确定因素请理性看待。</p><p>退换货政策详解</p><p>RETURN POLICY</p><p>商品签收： 确认签收前，请务必 本人签收 ，并当场拍照验货。如遇 严重质量问题或商品错发 请保留商品问题照片及物流签收有效凭证联系 在线客服处理。 如签收后发现严重质量问题请在签收时间起 48小时内 联系处理， 过后恕不负责，且需保持商品完好无损 （产品包装、吊牌、配件保持原样情况下）。 本店不接受任何形式的拒收 ，如因拒收产生一切后果由收件人负责。</p><p>退换说明： 本店不支持退换货，除严重商品质量问题和商品错发外。</p><p>码数、型号、颜色、款式、均由顾客自行决定，客服建议只供参考，不对此负责，不作为退换货理由。</p><p>所有主观原因(但不限于)：面料与想象有差距，例如厚薄或透明度、手感软硬等。不适合自己、穿上不好看、没想象中漂亮。个人认为做工不好等。细微瑕疵、线头、不明显或可去除的画粉痕迹、极好处理的小脱线，存在于鞋底的污迹或刮痕，不明显处的走线不直、偶尔有烫钻装饰的脱落、细微的印花脱落开裂、羽毛制品轻量掉毛，因运输造成的不平整或皱折、不同显示器解析度和颜色质量造成的网上图片与实物颜色存在一定色差、主观认为不是正品等，均不属于质量问题，不支持退换货。</p><p>退货地址：由于我公司为海外公司，商品均为海外直发， 退货需退回指定的海外物流仓库，详情请咨询在线客服。若因寄到非指定的退货地址，造成商品退换货失败，客户需自行承担后果。</p><p>差价问题：关于打折商品购买之后再度打折，或原来价格商品购买之后打折的情况，本店不退差价。</p><p>关税问题：  如遇海关查验，按照海关规定，收件人为办理清关和交纳税金的责任人。 税金产生后无法办理退货退款 。 为保证清关的顺利， 请填写收件人姓名的时候务必使用真实姓名 ，如使用假名将无法正常完成清关，导致扣件等情况，一切后果将由收件人承担。</p><p>如协商一致退货，请务必遵守如下规则：</p><p>本店不接受未经沟通自主邮寄包裹的退换货，如自行邮寄一律拒收。</p><p>本店不接受任何到付件，寄送包裹需要亲先行垫付邮费。</p><p>请务必保持退货商品的标签吊牌包装等的商品完整性。</p><p>寄出包裹后，请联系客服告知物流公司和运单号码，方便客服查询。</p>','','',1481455753,1482071209),
	(15,21,'sadsadsadasdas122333333','','',1481463544,1481552670),
	(16,22,'测试测试测试','','',1481463619,1481463619),
	(17,23,'测试测试测试','','',1481465189,1481465189),
	(18,24,'<p>sdsadsadasdsaasdsadcas</p><p><img src=\"/uploads/redactor-img/1/99ebc906c2-a165a89a-83d3-4882-948c-a551be1bb769.jpg\"></p>','','',1481465708,1482120751),
	(19,25,'商品由美国百货公司发货，下单即采购。约1~2周到货。\r\n商品货号：s1569032116\r\n商品说明：\r\n重度磨损和猫须褶皱为这款褪色 MOTHER 牛仔裤带来做旧效果。5 口袋设计。钮扣和拉链门襟。\r\n\r\n面料: 弹性牛仔布。\r\n98% 棉 / 2% 弹性纤维。\r\n冷水洗涤。\r\n美国制造。\r\n进口面料。\r\n\r\n尺寸\r\n裆高: 9.75 英寸 / 25 厘米\r\n裤子内长: 28.75 英寸 / 73 厘米\r\n裤脚口: 11.75 英寸 / 30 厘米\r\n所列尺寸以 27 号为标准 2010 年，受到突破传统牛仔裤的启发，业内专家 Lela Tillem (Citizens of Humanity) 和 Tim Kaeding (7 For All Mankind) 推出了 MOTHER 牛仔服饰：精致裁剪、超软织物的奢华牛仔裤系列。MOTHER 牛仔裤将显长腿部的外型、创新的水洗工艺、完美的修身效果和令人难以置信的舒适感融入到高度演变的奢华牛仔系列中。这款高级牛仔裤适合并修饰各种体型。 查看所有 MOTHER 的评论\r\n售后服务：香港仓库收到日期计起30天可以申请退换货,final sale不退不换,商家运费$35\r\n最后更新：2016-10-27 22:03','','',1481552501,1481552688),
	(20,26,'<p>关于公司考勤制度</p>','','/uploads/downloads/yiicms5857e77c7167d.zip',1482155706,1482157422),
	(21,27,'<p>测试测试<span class=\"redactor-invisible-space\">测试<span class=\"redactor-invisible-space\">测试<span class=\"redactor-invisible-space\">测试<span class=\"redactor-invisible-space\">测试<span class=\"redactor-invisible-space\"></span></span></span></span></span></p>','','/uploads/downloads/yiicms585893d4e19c8.zip',1482200020,1482202904),
	(22,28,'<p>继承测试</p>','','',1482291369,1482291661),
	(23,29,'<p>产品继承</p>','<p>产品继承</p>','',NULL,1482325074),
	(24,30,'','','/uploads/photos/30/img_585e2a68b0fe2.jpg',1482566248,1482566248),
	(25,30,'','','/uploads/photos/30/img_585e2abda64a2.jpg',1482566333,1482566333),
	(26,30,'','','/uploads/photos/30/img_585f60a17b4fa.jpg',1482645665,1482645665),
	(27,30,'','','/uploads/photos/30/img_585f60a888c8a.jpg',1482645672,1482645672),
	(28,30,'','','/uploads/photos/30/img_585f60bbb3340.jpg',1482645691,1482645691),
	(29,30,'','','/uploads/photos/30/img_585f73b9d439b.jpg',1482650553,1482650553),
	(30,30,'','','/uploads/photos/30/img_585f7414e39c8.jpg',1482650644,1482650644),
	(31,30,'','','/uploads/photos/30/img_585f7a31d66e1.jpg',1482652209,1482652209),
	(32,30,'','','/uploads/photos/30/img_585f7a84578d6.jpg',1482652292,1482652292),
	(33,30,'','','/uploads/photos/30/img_585f7afeb8410.jpg',1482652414,1482652414),
	(34,30,'','','/uploads/photos/30/img_585f7c8f432bd.png',1482652815,1482652815),
	(35,30,'','','/uploads/photos/30/img_585f7cabe31fd.jpg',1482652843,1482652843),
	(36,31,'ceshi','','/uploads/photos/31/img_585f8410249c6.jpg',1482654736,1482655672),
	(37,31,'测试2','','/uploads/photos/31/img_585f84183ea3b.jpg',1482654744,1482822674),
	(38,31,'ceshi3','','/uploads/photos/31/img_585f8410249c6.jpg',1482655165,1482822675);

/*!40000 ALTER TABLE `content_detail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table feedback
# ------------------------------------------------------------

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(125) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `body` varchar(255) NOT NULL DEFAULT '',
  `create_at` int(11) NOT NULL DEFAULT '0',
  `update_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;

INSERT INTO `feedback` (`id`, `subject`, `name`, `phone`, `email`, `body`, `create_at`, `update_at`)
VALUES
	(1,'测试测试','李先生','13240702278','739800600@qq.com','你好你好你好',1481433870,1481433870),
	(2,'你好','你好','','739800600@qq.com','你好，你好',1481434463,1481434463);

/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
