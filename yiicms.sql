-- MySQL dump 10.13  Distrib 5.7.17, for osx10.12 (x86_64)
--
-- Host: localhost    Database: yiicms
-- ------------------------------------------------------
-- Server version	5.7.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ad`
--

DROP TABLE IF EXISTS `ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `type` tinyint(4) DEFAULT '101' COMMENT '101 轮播图 102 友情链接',
  `category_id` int(11) DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `i-type-category` (`type`,`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad`
--

LOCK TABLES `ad` WRITE;
/*!40000 ALTER TABLE `ad` DISABLE KEYS */;
INSERT INTO `ad` VALUES (1,'百度',101,0,'/uploads/ad-img/img_58500a3e1b241.jpg','http://www.baidu.com',1481640510,1481640673),(2,'腾讯',101,0,'/uploads/ad-img/img_58500a67014d3.jpg','http://www.qq.com',1481640551,1481640751),(3,'网易',101,0,'/uploads/ad-img/img_58500a8b4fb51.png','http://www.163.com',1481640587,1481640587),(4,'去哪网',102,0,'','http://www.quna.com',0,0),(5,'携程',102,0,'','',0,0),(6,'马蜂窝',102,0,'','',0,0),(7,'面包旅行',102,0,'','',0,0);
/*!40000 ALTER TABLE `ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_menu`
--

DROP TABLE IF EXISTS `admin_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `admin_menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `admin_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,'产品管理',NULL,'/backend/products/index',0,'{\"icon\" :\"fa fa-th\"}'),(2,'产品分类',1,'/backend/category/index?type=2',1,NULL),(3,'产品列表',1,'/backend/products/index',0,NULL),(4,'新闻管理',NULL,'/backend/news/index',1,'{\"icon\":\"fa fa-newspaper-o\"}'),(5,'新闻列表',4,'/backend/news/index',0,NULL),(6,'新闻分类',4,'/backend/category/index?type=1',1,NULL),(7,'下载管理',NULL,'/backend/downloads/index',2,'{\"icon\":\"fa fa-download\"}'),(8,'下载列表',7,'/backend/downloads/index',0,NULL),(9,'下载分类',7,'/backend/category/index?type=3',1,NULL),(10,'照片管理',NULL,'/backend/photos/index',4,'{\"icon\":\"fa fa-picture-o\"}'),(11,'相册列表',10,'/backend/photos/index',0,NULL),(12,'相册分类',10,'/backend/category/index?type=4',1,NULL),(13,'用户反馈',NULL,'/backend/feedback/index',5,'{\"icon\":\"fa fa-commenting\"}'),(14,'网站配置',NULL,'/backend/config/index',6,'{\"icon\":\"fa fa-cog\"}'),(15,'基础配置',14,'/backend/config/base-config',1,NULL),(16,'其他配置',14,'/backend/config/index',2,NULL),(17,'轮播图片',14,'/backend/ad/index',3,NULL),(18,'后台配置',NULL,'/backend/rbac/route/index',7,'{\"icon\":\"fa fa-bars\"}'),(19,'管理员列表',18,'/backend/admin-user/index',1,NULL),(20,'权限配置',18,'/backend/rbac/assignment/index',2,NULL),(21,'角色列表',18,'/backend/rbac/role/index',3,NULL),(22,'权限列表',18,'/backend/rbac/permission/index',4,NULL),(23,'规则列表',18,'/backend/rbac/rule/index',5,NULL),(24,'路由列表',18,'/backend/rbac/route/index',5,NULL),(25,'后台菜单',18,'/backend/rbac/menu/index',7,NULL),(26,'开发工具',NULL,'/gii/default/index',8,'{\"icon\":\"fa fa-share\"}'),(27,'gii',26,'/gii/default/index',2,NULL),(28,'debug',26,'/debug/default/index',1,NULL),(29,'模板主题配置',14,'/backend/config/view-config',2,NULL),(30,'页面管理',14,'/backend/page/index',7,NULL),(31,'友情链接',14,'/backend/blogroll/index',8,NULL);
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u-username` (`username`),
  UNIQUE KEY `u-email` (`email`),
  UNIQUE KEY `u-password-reset-token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user`
--

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` VALUES (1,'admin','','21232f297a57a5a743894a0e4a801fc3',NULL,'739800600@qq.com',10,'',0,1482893156),(4,'demo','','fe01ce2a7fbac8fafaed7c982a04e229',NULL,'demo@demo.com',10,'',1481431804,1481431804);
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('Administrator','1',1482897657),('AdministratorAccess','1',1482897661),('Visitor','4',1482897661),('VisitorAccess','4',1482897661);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('/backend/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/ad/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/ad/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/ad/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/ad/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/ad/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/ad/upload',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/ad/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/admin-user/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/admin-user/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/admin-user/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/admin-user/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/admin-user/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/admin-user/upload',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/admin-user/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/blogroll/*',2,NULL,NULL,NULL,1490367199,1490367199),('/backend/blogroll/create',2,NULL,NULL,NULL,1490367193,1490367193),('/backend/blogroll/delete',2,NULL,NULL,NULL,1490367197,1490367197),('/backend/blogroll/index',2,NULL,NULL,NULL,1490367188,1490367188),('/backend/blogroll/update',2,NULL,NULL,NULL,1490367195,1490367195),('/backend/blogroll/view',2,NULL,NULL,NULL,1490367191,1490367191),('/backend/category/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/category/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/category/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/category/index',2,NULL,NULL,NULL,1482977677,1482977677),('/backend/category/index?type=1',2,NULL,NULL,NULL,1482977712,1482977712),('/backend/category/index?type=2',2,NULL,NULL,NULL,1482977717,1482977717),('/backend/category/index?type=3',2,NULL,NULL,NULL,1482977721,1482977721),('/backend/category/index?type=4',2,NULL,NULL,NULL,1482977728,1482977728),('/backend/category/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/category/upload',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/category/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/config/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/config/base-config',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/config/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/config/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/config/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/config/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/config/upload',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/config/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/config/view-config',2,NULL,NULL,NULL,1483066838,1483066838),('/backend/default/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/default/clear-cache',2,NULL,NULL,NULL,1490367249,1490367249),('/backend/default/edit-password',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/default/error',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/default/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/default/login',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/default/logout',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/default/ueditor',2,NULL,NULL,NULL,1490367249,1490367249),('/backend/downloads/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/downloads/check',2,NULL,NULL,NULL,1490367249,1490367249),('/backend/downloads/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/downloads/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/downloads/delete-all',2,NULL,NULL,NULL,1490367249,1490367249),('/backend/downloads/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/downloads/un-check',2,NULL,NULL,NULL,1490367249,1490367249),('/backend/downloads/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/downloads/upload',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/downloads/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/feedback/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/feedback/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/feedback/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/feedback/upload',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/feedback/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/news/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/news/check',2,NULL,NULL,NULL,1490367231,1490367231),('/backend/news/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/news/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/news/delete-all',2,NULL,NULL,NULL,1490367236,1490367236),('/backend/news/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/news/un-check',2,NULL,NULL,NULL,1490367233,1490367233),('/backend/news/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/news/upload',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/news/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/page/*',2,NULL,NULL,NULL,1483164471,1483164471),('/backend/page/create',2,NULL,NULL,NULL,1483164471,1483164471),('/backend/page/delete',2,NULL,NULL,NULL,1483164471,1483164471),('/backend/page/index',2,NULL,NULL,NULL,1483164471,1483164471),('/backend/page/update',2,NULL,NULL,NULL,1483164471,1483164471),('/backend/page/upload',2,NULL,NULL,NULL,1483164471,1483164471),('/backend/page/view',2,NULL,NULL,NULL,1483164471,1483164471),('/backend/photos/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/photos/check',2,NULL,NULL,NULL,1490367238,1490367238),('/backend/photos/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/photos/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/photos/delete-all',2,NULL,NULL,NULL,1490367242,1490367242),('/backend/photos/delete-detail',2,NULL,NULL,NULL,1490367249,1490367249),('/backend/photos/edit-detail',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/photos/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/photos/set-cover',2,NULL,NULL,NULL,1490367249,1490367249),('/backend/photos/un-check',2,NULL,NULL,NULL,1490367240,1490367240),('/backend/photos/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/photos/upload',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/photos/upload-photo',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/photos/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/products/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/products/check',2,NULL,NULL,NULL,1490367249,1490367249),('/backend/products/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/products/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/products/delete-all',2,NULL,NULL,NULL,1490367249,1490367249),('/backend/products/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/products/un-check',2,NULL,NULL,NULL,1490367249,1490367249),('/backend/products/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/products/upload',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/products/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/assignment/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/assignment/assign',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/assignment/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/assignment/revoke',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/assignment/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/default/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/default/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/menu/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/menu/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/menu/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/menu/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/menu/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/menu/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/permission/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/permission/assign',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/permission/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/permission/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/permission/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/permission/remove',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/permission/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/permission/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/role/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/role/assign',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/role/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/role/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/role/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/role/remove',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/role/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/role/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/route/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/route/assign',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/route/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/route/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/route/refresh',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/route/remove',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/rule/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/rule/create',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/rule/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/rule/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/rule/update',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/rule/view',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/*',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/activate',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/change-password',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/delete',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/index',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/login',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/logout',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/request-password-reset',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/reset-password',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/signup',2,NULL,NULL,NULL,1482896720,1482896720),('/backend/rbac/user/view',2,NULL,NULL,NULL,1482896720,1482896720),('/debug/*',2,NULL,NULL,NULL,1482977163,1482977163),('/debug/default/*',2,NULL,NULL,NULL,1482977163,1482977163),('/debug/default/db-explain',2,NULL,NULL,NULL,1482977163,1482977163),('/debug/default/download-mail',2,NULL,NULL,NULL,1482977163,1482977163),('/debug/default/index',2,NULL,NULL,NULL,1482977163,1482977163),('/debug/default/toolbar',2,NULL,NULL,NULL,1482977163,1482977163),('/debug/default/view',2,NULL,NULL,NULL,1482977163,1482977163),('/gii/*',2,NULL,NULL,NULL,1482896720,1482896720),('/gii/default/*',2,NULL,NULL,NULL,1482896720,1482896720),('/gii/default/action',2,NULL,NULL,NULL,1482896720,1482896720),('/gii/default/diff',2,NULL,NULL,NULL,1482896720,1482896720),('/gii/default/index',2,NULL,NULL,NULL,1482896720,1482896720),('/gii/default/preview',2,NULL,NULL,NULL,1482896720,1482896720),('/gii/default/view',2,NULL,NULL,NULL,1482896720,1482896720),('Administrator',1,'超级管理员',NULL,NULL,1482896582,1482898405),('AdministratorAccess',2,'超级管理员权限',NULL,NULL,1482897169,1482898428),('Visitor',1,'后台参观者','VisitorRule',NULL,1482897794,1482899002),('VisitorAccess',2,'浏览者权限，只读权限','VisitorRule',NULL,1482897866,1482898974);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('AdministratorAccess','/backend/*'),('VisitorAccess','/backend/*'),('AdministratorAccess','/backend/ad/*'),('VisitorAccess','/backend/ad/*'),('AdministratorAccess','/backend/ad/create'),('VisitorAccess','/backend/ad/create'),('AdministratorAccess','/backend/ad/delete'),('VisitorAccess','/backend/ad/delete'),('AdministratorAccess','/backend/ad/index'),('VisitorAccess','/backend/ad/index'),('AdministratorAccess','/backend/ad/update'),('VisitorAccess','/backend/ad/update'),('AdministratorAccess','/backend/ad/upload'),('VisitorAccess','/backend/ad/upload'),('AdministratorAccess','/backend/ad/view'),('VisitorAccess','/backend/ad/view'),('AdministratorAccess','/backend/admin-user/*'),('VisitorAccess','/backend/admin-user/*'),('AdministratorAccess','/backend/admin-user/create'),('VisitorAccess','/backend/admin-user/create'),('AdministratorAccess','/backend/admin-user/delete'),('VisitorAccess','/backend/admin-user/delete'),('AdministratorAccess','/backend/admin-user/index'),('VisitorAccess','/backend/admin-user/index'),('AdministratorAccess','/backend/admin-user/update'),('VisitorAccess','/backend/admin-user/update'),('AdministratorAccess','/backend/admin-user/upload'),('VisitorAccess','/backend/admin-user/upload'),('AdministratorAccess','/backend/admin-user/view'),('VisitorAccess','/backend/admin-user/view'),('AdministratorAccess','/backend/category/*'),('VisitorAccess','/backend/category/*'),('AdministratorAccess','/backend/category/create'),('VisitorAccess','/backend/category/create'),('AdministratorAccess','/backend/category/delete'),('VisitorAccess','/backend/category/delete'),('AdministratorAccess','/backend/category/update'),('VisitorAccess','/backend/category/update'),('AdministratorAccess','/backend/category/upload'),('VisitorAccess','/backend/category/upload'),('AdministratorAccess','/backend/category/view'),('VisitorAccess','/backend/category/view'),('AdministratorAccess','/backend/config/*'),('VisitorAccess','/backend/config/*'),('AdministratorAccess','/backend/config/base-config'),('VisitorAccess','/backend/config/base-config'),('AdministratorAccess','/backend/config/create'),('VisitorAccess','/backend/config/create'),('AdministratorAccess','/backend/config/delete'),('VisitorAccess','/backend/config/delete'),('AdministratorAccess','/backend/config/index'),('VisitorAccess','/backend/config/index'),('AdministratorAccess','/backend/config/update'),('VisitorAccess','/backend/config/update'),('AdministratorAccess','/backend/config/upload'),('VisitorAccess','/backend/config/upload'),('AdministratorAccess','/backend/config/view'),('VisitorAccess','/backend/config/view'),('AdministratorAccess','/backend/config/view-config'),('AdministratorAccess','/backend/default/*'),('VisitorAccess','/backend/default/*'),('AdministratorAccess','/backend/default/edit-password'),('VisitorAccess','/backend/default/edit-password'),('AdministratorAccess','/backend/default/error'),('VisitorAccess','/backend/default/error'),('AdministratorAccess','/backend/default/index'),('VisitorAccess','/backend/default/index'),('AdministratorAccess','/backend/default/login'),('VisitorAccess','/backend/default/login'),('AdministratorAccess','/backend/default/logout'),('VisitorAccess','/backend/default/logout'),('AdministratorAccess','/backend/downloads/*'),('VisitorAccess','/backend/downloads/*'),('AdministratorAccess','/backend/downloads/create'),('VisitorAccess','/backend/downloads/create'),('AdministratorAccess','/backend/downloads/delete'),('VisitorAccess','/backend/downloads/delete'),('AdministratorAccess','/backend/downloads/index'),('VisitorAccess','/backend/downloads/index'),('AdministratorAccess','/backend/downloads/update'),('VisitorAccess','/backend/downloads/update'),('AdministratorAccess','/backend/downloads/upload'),('VisitorAccess','/backend/downloads/upload'),('AdministratorAccess','/backend/downloads/view'),('VisitorAccess','/backend/downloads/view'),('AdministratorAccess','/backend/feedback/*'),('VisitorAccess','/backend/feedback/*'),('AdministratorAccess','/backend/feedback/delete'),('VisitorAccess','/backend/feedback/delete'),('AdministratorAccess','/backend/feedback/index'),('VisitorAccess','/backend/feedback/index'),('AdministratorAccess','/backend/feedback/upload'),('VisitorAccess','/backend/feedback/upload'),('AdministratorAccess','/backend/feedback/view'),('VisitorAccess','/backend/feedback/view'),('AdministratorAccess','/backend/news/*'),('VisitorAccess','/backend/news/*'),('AdministratorAccess','/backend/news/create'),('VisitorAccess','/backend/news/create'),('AdministratorAccess','/backend/news/delete'),('VisitorAccess','/backend/news/delete'),('AdministratorAccess','/backend/news/index'),('VisitorAccess','/backend/news/index'),('AdministratorAccess','/backend/news/update'),('VisitorAccess','/backend/news/update'),('AdministratorAccess','/backend/news/upload'),('VisitorAccess','/backend/news/upload'),('AdministratorAccess','/backend/news/view'),('VisitorAccess','/backend/news/view'),('AdministratorAccess','/backend/photos/*'),('VisitorAccess','/backend/photos/*'),('AdministratorAccess','/backend/photos/create'),('VisitorAccess','/backend/photos/create'),('AdministratorAccess','/backend/photos/delete'),('VisitorAccess','/backend/photos/delete'),('AdministratorAccess','/backend/photos/edit-detail'),('VisitorAccess','/backend/photos/edit-detail'),('AdministratorAccess','/backend/photos/index'),('VisitorAccess','/backend/photos/index'),('AdministratorAccess','/backend/photos/update'),('VisitorAccess','/backend/photos/update'),('AdministratorAccess','/backend/photos/upload'),('VisitorAccess','/backend/photos/upload'),('AdministratorAccess','/backend/photos/upload-photo'),('VisitorAccess','/backend/photos/upload-photo'),('AdministratorAccess','/backend/photos/view'),('VisitorAccess','/backend/photos/view'),('AdministratorAccess','/backend/products/*'),('VisitorAccess','/backend/products/*'),('AdministratorAccess','/backend/products/create'),('VisitorAccess','/backend/products/create'),('AdministratorAccess','/backend/products/delete'),('VisitorAccess','/backend/products/delete'),('AdministratorAccess','/backend/products/index'),('VisitorAccess','/backend/products/index'),('AdministratorAccess','/backend/products/update'),('VisitorAccess','/backend/products/update'),('AdministratorAccess','/backend/products/upload'),('VisitorAccess','/backend/products/upload'),('AdministratorAccess','/backend/products/view'),('VisitorAccess','/backend/products/view'),('AdministratorAccess','/backend/rbac/*'),('VisitorAccess','/backend/rbac/*'),('AdministratorAccess','/backend/rbac/assignment/*'),('VisitorAccess','/backend/rbac/assignment/*'),('AdministratorAccess','/backend/rbac/assignment/assign'),('VisitorAccess','/backend/rbac/assignment/assign'),('AdministratorAccess','/backend/rbac/assignment/index'),('VisitorAccess','/backend/rbac/assignment/index'),('AdministratorAccess','/backend/rbac/assignment/revoke'),('VisitorAccess','/backend/rbac/assignment/revoke'),('AdministratorAccess','/backend/rbac/assignment/view'),('VisitorAccess','/backend/rbac/assignment/view'),('AdministratorAccess','/backend/rbac/default/*'),('VisitorAccess','/backend/rbac/default/*'),('AdministratorAccess','/backend/rbac/default/index'),('VisitorAccess','/backend/rbac/default/index'),('AdministratorAccess','/backend/rbac/menu/*'),('VisitorAccess','/backend/rbac/menu/*'),('AdministratorAccess','/backend/rbac/menu/create'),('VisitorAccess','/backend/rbac/menu/create'),('AdministratorAccess','/backend/rbac/menu/delete'),('VisitorAccess','/backend/rbac/menu/delete'),('AdministratorAccess','/backend/rbac/menu/index'),('VisitorAccess','/backend/rbac/menu/index'),('AdministratorAccess','/backend/rbac/menu/update'),('VisitorAccess','/backend/rbac/menu/update'),('AdministratorAccess','/backend/rbac/menu/view'),('VisitorAccess','/backend/rbac/menu/view'),('AdministratorAccess','/backend/rbac/permission/*'),('VisitorAccess','/backend/rbac/permission/*'),('AdministratorAccess','/backend/rbac/permission/assign'),('VisitorAccess','/backend/rbac/permission/assign'),('AdministratorAccess','/backend/rbac/permission/create'),('VisitorAccess','/backend/rbac/permission/create'),('AdministratorAccess','/backend/rbac/permission/delete'),('VisitorAccess','/backend/rbac/permission/delete'),('AdministratorAccess','/backend/rbac/permission/index'),('VisitorAccess','/backend/rbac/permission/index'),('AdministratorAccess','/backend/rbac/permission/remove'),('VisitorAccess','/backend/rbac/permission/remove'),('AdministratorAccess','/backend/rbac/permission/update'),('VisitorAccess','/backend/rbac/permission/update'),('AdministratorAccess','/backend/rbac/permission/view'),('VisitorAccess','/backend/rbac/permission/view'),('AdministratorAccess','/backend/rbac/role/*'),('VisitorAccess','/backend/rbac/role/*'),('AdministratorAccess','/backend/rbac/role/assign'),('VisitorAccess','/backend/rbac/role/assign'),('AdministratorAccess','/backend/rbac/role/create'),('VisitorAccess','/backend/rbac/role/create'),('AdministratorAccess','/backend/rbac/role/delete'),('VisitorAccess','/backend/rbac/role/delete'),('AdministratorAccess','/backend/rbac/role/index'),('VisitorAccess','/backend/rbac/role/index'),('AdministratorAccess','/backend/rbac/role/remove'),('VisitorAccess','/backend/rbac/role/remove'),('AdministratorAccess','/backend/rbac/role/update'),('VisitorAccess','/backend/rbac/role/update'),('AdministratorAccess','/backend/rbac/role/view'),('VisitorAccess','/backend/rbac/role/view'),('AdministratorAccess','/backend/rbac/route/*'),('VisitorAccess','/backend/rbac/route/*'),('AdministratorAccess','/backend/rbac/route/assign'),('VisitorAccess','/backend/rbac/route/assign'),('AdministratorAccess','/backend/rbac/route/create'),('VisitorAccess','/backend/rbac/route/create'),('AdministratorAccess','/backend/rbac/route/index'),('VisitorAccess','/backend/rbac/route/index'),('AdministratorAccess','/backend/rbac/route/refresh'),('VisitorAccess','/backend/rbac/route/refresh'),('AdministratorAccess','/backend/rbac/route/remove'),('VisitorAccess','/backend/rbac/route/remove'),('AdministratorAccess','/backend/rbac/rule/*'),('VisitorAccess','/backend/rbac/rule/*'),('AdministratorAccess','/backend/rbac/rule/create'),('VisitorAccess','/backend/rbac/rule/create'),('AdministratorAccess','/backend/rbac/rule/delete'),('VisitorAccess','/backend/rbac/rule/delete'),('AdministratorAccess','/backend/rbac/rule/index'),('VisitorAccess','/backend/rbac/rule/index'),('AdministratorAccess','/backend/rbac/rule/update'),('VisitorAccess','/backend/rbac/rule/update'),('AdministratorAccess','/backend/rbac/rule/view'),('VisitorAccess','/backend/rbac/rule/view'),('AdministratorAccess','/backend/rbac/user/*'),('VisitorAccess','/backend/rbac/user/*'),('AdministratorAccess','/backend/rbac/user/activate'),('VisitorAccess','/backend/rbac/user/activate'),('AdministratorAccess','/backend/rbac/user/change-password'),('VisitorAccess','/backend/rbac/user/change-password'),('AdministratorAccess','/backend/rbac/user/delete'),('VisitorAccess','/backend/rbac/user/delete'),('AdministratorAccess','/backend/rbac/user/index'),('VisitorAccess','/backend/rbac/user/index'),('AdministratorAccess','/backend/rbac/user/login'),('VisitorAccess','/backend/rbac/user/login'),('AdministratorAccess','/backend/rbac/user/logout'),('VisitorAccess','/backend/rbac/user/logout'),('AdministratorAccess','/backend/rbac/user/request-password-reset'),('VisitorAccess','/backend/rbac/user/request-password-reset'),('AdministratorAccess','/backend/rbac/user/reset-password'),('VisitorAccess','/backend/rbac/user/reset-password'),('AdministratorAccess','/backend/rbac/user/signup'),('VisitorAccess','/backend/rbac/user/signup'),('AdministratorAccess','/backend/rbac/user/view'),('VisitorAccess','/backend/rbac/user/view'),('AdministratorAccess','/debug/*'),('AdministratorAccess','/debug/default/*'),('AdministratorAccess','/debug/default/db-explain'),('AdministratorAccess','/debug/default/download-mail'),('AdministratorAccess','/debug/default/index'),('AdministratorAccess','/debug/default/toolbar'),('AdministratorAccess','/debug/default/view'),('AdministratorAccess','/gii/*'),('AdministratorAccess','/gii/default/*'),('AdministratorAccess','/gii/default/action'),('AdministratorAccess','/gii/default/diff'),('AdministratorAccess','/gii/default/index'),('AdministratorAccess','/gii/default/preview'),('AdministratorAccess','/gii/default/view');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
INSERT INTO `auth_rule` VALUES ('VisitorRule','O:36:\"app\\modules\\backend\\rbac\\VisitorRule\":3:{s:4:\"name\";s:11:\"VisitorRule\";s:9:\"createdAt\";i:1482898941;s:9:\"updatedAt\";i:1482898941;}',1482898941,1482898941);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '分类名',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `path` varchar(50) NOT NULL DEFAULT '0' COMMENT '完整的父id 用/分开',
  `type` tinyint(4) NOT NULL COMMENT '1.news 2 products 3 download 4 photo',
  `image` varchar(255) DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `i-type-pid` (`type`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'游学研学',0,'',2,'','','',1481360463,1490457550),(2,'默认分类',0,'',1,'/uploads/products-img/img_58f32726aa3df.png','测试','测试，测试测试',1481367786,1492330278),(3,'新闻分类2',2,'2',1,'','','',1481372394,1499598678),(4,'旅行度假',0,'',2,'','','',1481609361,1490457573),(5,'下载文档',0,'',3,'','','',1482155225,1482155225),(6,'企业环境',0,'',4,'','','',1482559711,1482559711),(7,'商务考察',0,'',2,'','','',1490457590,1490457590),(8,'测试修改path',0,'',1,'','','',1498831600,1498833499),(9,'测试修改path2',3,'',1,'','','',1498832464,1499598673),(10,'修改path3',9,'9',1,'','','',1498832583,1499598673);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '字段名英文',
  `label` varchar(50) DEFAULT NULL COMMENT '字段标注',
  `value` varchar(3000) NOT NULL DEFAULT '' COMMENT '字段值',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iu-name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (2,'contact_us','联系我们','<p>公司: 在北京网络科技</p><p>联系人: 李sss</p><p>QQ: 739800600</p><p>电话: 1304351</p><p>E-mail: 739800600@qq.com</p><p>地址: 北京市丰台区大红门</p>',1481350005,1482902162),(3,'contact_us_page_id','联系我们','1',1481355647,1483169811),(4,'jianjie','企业简介','北京雄鹰国际旅行社是新时代投资管理集团旗下的专业旅游平台,依托集团广泛而强大的资源和团队，雄鹰国旅专注于游学交流，商务考察，专项旅行，帆船体验，机票代理等，致力于通过旅行提高青少年的品格与素养，为旅行者提供专业化，个性化的优质服务testtesttest',1490458199,1490458199),(5,'gongyi','公益广告','<script type=\"text/javascript\"> var yibo_id =40276;</script><script src=\"http://yibo.iyiyun.com/yibo.js?random=309727\" type=\"text/javascript\"></script>',1494309812,1494309845),(6,'top_right_data','头部右侧数据','电话:13240702278,17346512591',1507598988,1507598988);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '浏览数点击数',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `i-type-status-title` (`type`,`status`,`title`),
  KEY `i-update` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'测试1',1,0,'','测试测试222','',1,0,0,0,1481269292),(7,'新闻2',1,3,'','吃豆腐的房地产','',0,0,0,1481264976,1481379895),(9,'dfdsfadfdsfdsfds',1,0,'','dfsdds','',0,0,0,1481265228,1481265228),(10,'dfsdfds312321的所得税法',1,0,'','的范德萨发的','',0,1,0,1481265362,1481265362),(11,'测试你好',1,0,'','三大市场','',1,1,0,1481265454,1481265454),(13,'sdfdsvds',1,0,'','dsfadsfdsa adfdasfd','',0,1,0,1481265650,1481265650),(14,'dfsdfds312321的所得税法dsfdsf',1,0,'','fdsdsfsdfds','',0,1,0,1481268136,1481268136),(15,'测试测试测试',1,0,'','测试测试222','',0,1,0,1481268506,1481268506),(16,'电风扇的范德萨',1,0,'','东方闪电','',0,1,0,1481268645,1481268645),(17,'ceshi',1,2,'','测试','',1,1,0,1481294417,1482486244),(18,'测试测试',1,0,'','测试3333333','',1,1,1,1481294436,1481294436),(19,'测试测试测试',1,2,'','测试测试','',1,1,14,1481294458,1482120320),(20,'德国代购2016 Marc Jacobs/马克·雅可布 女士撞色皮质直板钱包',2,1,'','<p>德国代购2016 Marc Jacobs/马克·雅可布 女士撞色皮质直板钱包</p>','',1,1,0,1481455753,1482071209),(21,'测试测试',2,1,'/uploads/products-img/img_584d571075916.jpg','测试','',1,1,0,1481463544,1481552670),(22,'测试测试测试',2,1,'/uploads/products-img/img_584d57438ddb0.jpg','测试测试测试','',1,1,0,1481463619,1481463619),(23,'测试产品22222222222222',2,1,'/uploads/products-img/img_584d5d65a0855.jpg','测试产品','',1,1,0,1481465189,1481465189),(24,'飒飒的范德萨范德萨似懂非懂是',2,1,'/uploads/products-img/img_58575c9b83b7b.png','<p>似懂非懂是付的是</p><p><br></p>','',1,1,1,1481465708,1482120751),(25,'美国代购2016 MOTHER 女士磨边牛仔裤',2,1,'/uploads/products-img/img_584eb27571659.jpg','重度磨损和猫须褶皱为这款褪色 MOTHER 牛仔裤带来做旧效果。5 口袋设计。钮扣和拉链门襟。','',1,1,5,1481552501,1481552688),(26,'关于公司考勤制度',3,5,'','<p>关于公司考勤制度</p>','',1,1,0,1482155706,1482157422),(27,'测试',3,5,'','','',0,1,0,1482200020,1482202904),(28,'继承测试',1,2,'','继承测试','gggg',1,1,10,1482291369,1510469205),(29,'产品继承测试',2,1,'/uploads/products-img/img_5859f8c6724c8.jpg','','',1,1,23,1482291398,1482325074),(30,'办公环境',4,6,'','','',1,1,8,1482560413,1482560413),(31,'测试相册',4,6,'','测试','测试',1,1,0,1482654720,1482654720),(32,'cccc',3,5,'','','ssss',0,1,0,1489731591,1494326191),(33,'测试测试',2,1,'/uploads/products-img/img_59119bdcd73a2.jpg','ddddd','fffff',0,1,0,1494325122,1510469150);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_detail`
--

DROP TABLE IF EXISTS `content_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `params` varchar(1000) NOT NULL DEFAULT '',
  `file_url` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i-content` (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_detail`
--

LOCK TABLES `content_detail` WRITE;
/*!40000 ALTER TABLE `content_detail` DISABLE KEYS */;
INSERT INTO `content_detail` VALUES (1,1,'测试detail,123232,45454545','','',1481264096,1481269292),(3,7,'测试测试','','',1481264976,1481379895),(4,9,'dsfdsfdsfdsfdsdfsdfds','','',1481265228,1481265228),(5,10,'打算vdsvdsdsfadf是打发第三方打发第三方','','',1481265362,1481265362),(6,11,'是的撒FDSAD','','',1481265454,1481265454),(7,13,'dfadsfda','','',1481265650,1481265650),(8,14,'dsfdsfdsfdsfds','','',1481268136,1481268136),(9,15,'电风扇的范德萨发生的','','',1481268506,1481268506),(10,16,'大多数是范德萨','','',1481268645,1481268645),(11,17,'<p><img src=\"/uploads/redactor-img/1/892f7f6043-9c1ab2f5-f848-4e09-bb3e-9b10c2938520.png\" alt=\"892f7f6043-9c1ab2f5-f848-4e09-bb3e-9b10c2938520.png\"/>测试测试</p>','','',1481294417,1482486244),(12,18,'测试测试测试','','',1481294436,1481294436),(13,19,'<p>水电费的所得税法</p><p><img src=\"/uploads/redactor-img/1/892f7f6043-9c1ab2f5-f848-4e09-bb3e-9b10c2938520.png\"></p><p><br></p><p><img></p>','','',1481294458,1482120320),(14,20,'<p><img></p><p><img src=\"/uploads/redactor-img/1/3c779817e7-9c1ab2f5-f848-4e09-bb3e-9b10c2938520.png\"></p><p><img></p><p><img></p><p>发货相关问题</p><p>SEND ABOUT</p><p>购买来源：本店所有商品均为海外购，所有海外购商品均从（美国、欧洲、香港）正品专柜、官网、百货公司购买，正品保证，请放心选购。</p><p>邮寄方式：本店商品均为海外直发，欧洲商家一般经由我们香港仓、澳门仓等中转再转发国内快递发往您；美国商家一般采用美国直邮方式到国内自动转为EMS直接发往您。</p><p>物流显示：因淘宝物流显示问题，本店商品到达国内才会转为发货状态并显示国内物流单号。一般商品到货时间为2-4周。因而当您的订单淘宝未显示发货，请不要心急，商品都在正常国际运输中，我们全程为您监控物流进程，如有异常会及时通知您。如有疑问，可以咨询在线客服，请勿催单哦！</p><p>特别提醒：以上发货及运送时间均为理论时效，但偶有意外如恶劣天气、清关延误、节假日等国际物流的不确定因素请理性看待。</p><p>退换货政策详解</p><p>RETURN POLICY</p><p>商品签收： 确认签收前，请务必 本人签收 ，并当场拍照验货。如遇 严重质量问题或商品错发 请保留商品问题照片及物流签收有效凭证联系 在线客服处理。 如签收后发现严重质量问题请在签收时间起 48小时内 联系处理， 过后恕不负责，且需保持商品完好无损 （产品包装、吊牌、配件保持原样情况下）。 本店不接受任何形式的拒收 ，如因拒收产生一切后果由收件人负责。</p><p>退换说明： 本店不支持退换货，除严重商品质量问题和商品错发外。</p><p>码数、型号、颜色、款式、均由顾客自行决定，客服建议只供参考，不对此负责，不作为退换货理由。</p><p>所有主观原因(但不限于)：面料与想象有差距，例如厚薄或透明度、手感软硬等。不适合自己、穿上不好看、没想象中漂亮。个人认为做工不好等。细微瑕疵、线头、不明显或可去除的画粉痕迹、极好处理的小脱线，存在于鞋底的污迹或刮痕，不明显处的走线不直、偶尔有烫钻装饰的脱落、细微的印花脱落开裂、羽毛制品轻量掉毛，因运输造成的不平整或皱折、不同显示器解析度和颜色质量造成的网上图片与实物颜色存在一定色差、主观认为不是正品等，均不属于质量问题，不支持退换货。</p><p>退货地址：由于我公司为海外公司，商品均为海外直发， 退货需退回指定的海外物流仓库，详情请咨询在线客服。若因寄到非指定的退货地址，造成商品退换货失败，客户需自行承担后果。</p><p>差价问题：关于打折商品购买之后再度打折，或原来价格商品购买之后打折的情况，本店不退差价。</p><p>关税问题：  如遇海关查验，按照海关规定，收件人为办理清关和交纳税金的责任人。 税金产生后无法办理退货退款 。 为保证清关的顺利， 请填写收件人姓名的时候务必使用真实姓名 ，如使用假名将无法正常完成清关，导致扣件等情况，一切后果将由收件人承担。</p><p>如协商一致退货，请务必遵守如下规则：</p><p>本店不接受未经沟通自主邮寄包裹的退换货，如自行邮寄一律拒收。</p><p>本店不接受任何到付件，寄送包裹需要亲先行垫付邮费。</p><p>请务必保持退货商品的标签吊牌包装等的商品完整性。</p><p>寄出包裹后，请联系客服告知物流公司和运单号码，方便客服查询。</p>','','',1481455753,1482071209),(15,21,'sadsadsadasdas122333333','','',1481463544,1481552670),(16,22,'测试测试测试','','',1481463619,1481463619),(17,23,'测试测试测试','','',1481465189,1481465189),(18,24,'<p>sdsadsadasdsaasdsadcas</p><p><img src=\"/uploads/redactor-img/1/99ebc906c2-a165a89a-83d3-4882-948c-a551be1bb769.jpg\"></p>','','',1481465708,1482120751),(19,25,'商品由美国百货公司发货，下单即采购。约1~2周到货。\r\n商品货号：s1569032116\r\n商品说明：\r\n重度磨损和猫须褶皱为这款褪色 MOTHER 牛仔裤带来做旧效果。5 口袋设计。钮扣和拉链门襟。\r\n\r\n面料: 弹性牛仔布。\r\n98% 棉 / 2% 弹性纤维。\r\n冷水洗涤。\r\n美国制造。\r\n进口面料。\r\n\r\n尺寸\r\n裆高: 9.75 英寸 / 25 厘米\r\n裤子内长: 28.75 英寸 / 73 厘米\r\n裤脚口: 11.75 英寸 / 30 厘米\r\n所列尺寸以 27 号为标准 2010 年，受到突破传统牛仔裤的启发，业内专家 Lela Tillem (Citizens of Humanity) 和 Tim Kaeding (7 For All Mankind) 推出了 MOTHER 牛仔服饰：精致裁剪、超软织物的奢华牛仔裤系列。MOTHER 牛仔裤将显长腿部的外型、创新的水洗工艺、完美的修身效果和令人难以置信的舒适感融入到高度演变的奢华牛仔系列中。这款高级牛仔裤适合并修饰各种体型。 查看所有 MOTHER 的评论\r\n售后服务：香港仓库收到日期计起30天可以申请退换货,final sale不退不换,商家运费$35\r\n最后更新：2016-10-27 22:03','','',1481552501,1481552688),(20,26,'<p>关于公司考勤制度</p>','','/uploads/downloads/yiicms5857e77c7167d.zip',1482155706,1482157422),(21,27,'<p>测试测试<span class=\"redactor-invisible-space\">测试<span class=\"redactor-invisible-space\">测试<span class=\"redactor-invisible-space\">测试<span class=\"redactor-invisible-space\">测试<span class=\"redactor-invisible-space\"></span></span></span></span></span></p>','','/uploads/downloads/yiicms585893d4e19c8.zip',1482200020,1482202904),(22,28,'<p>继承测试</p>','','',1482291369,1482291661),(23,29,'<p>产品继承</p>','<p>产品继承</p>','',NULL,1482325074),(24,30,'','','/uploads/photos/30/img_585e2a68b0fe2.jpg',1482566248,1482566248),(25,30,'','','/uploads/photos/30/img_585e2abda64a2.jpg',1482566333,1482566333),(26,30,'','','/uploads/photos/30/img_585f60a17b4fa.jpg',1482645665,1482645665),(27,30,'','','/uploads/photos/30/img_585f60a888c8a.jpg',1482645672,1482645672),(28,30,'','','/uploads/photos/30/img_585f60bbb3340.jpg',1482645691,1482645691),(29,30,'','','/uploads/photos/30/img_585f73b9d439b.jpg',1482650553,1482650553),(30,30,'','','/uploads/photos/30/img_585f7414e39c8.jpg',1482650644,1482650644),(31,30,'','','/uploads/photos/30/img_585f7a31d66e1.jpg',1482652209,1482652209),(32,30,'','','/uploads/photos/30/img_585f7a84578d6.jpg',1482652292,1482652292),(33,30,'','','/uploads/photos/30/img_585f7afeb8410.jpg',1482652414,1482652414),(34,30,'','','/uploads/photos/30/img_585f7c8f432bd.png',1482652815,1482652815),(35,30,'','','/uploads/photos/30/img_585f7cabe31fd.jpg',1482652843,1482652843),(36,31,'ceshi','','/uploads/photos/31/img_585f8410249c6.jpg',1482654736,1482913682),(37,31,'测试2','','/uploads/photos/31/img_585f84183ea3b.jpg',1482654744,1482822674),(38,31,'ceshi34','','/uploads/photos/31/img_585f8410249c6.jpg',1482655165,1482913687),(39,32,'<p>ssss</p>','','/uploads/downloads/yiicms58cb8007d61e7.rar',1489731591,1489731591),(40,33,'<p>是打发第三方</p>','<p>胜多负少订单上</p>','',1494325122,1494325122);
/*!40000 ALTER TABLE `content_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(125) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `body` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,'测试测试','李先生','13240702278','739800600@qq.com','你好你好你好',1481433870,1481433870),(2,'你好','你好','','739800600@qq.com','你好，你好',1481434463,1481434463),(3,'sddfsfsfds','dsfsdfsdds','','739800600@qq.com','sdfdsfds',1501242456,1501242456),(4,'ddddddd','ddddd','','739800600@qq.com','dsfsdfds',1501242645,1501242645),(5,'dsfsdfdsfsd','dddd','','739800600@qq.com','dsfsdfdsfds',1501397774,1501397774);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m140209_132017_init',1494032883),('m140403_174025_create_account_table',1494032883),('m140504_113157_update_tables',1494032884),('m140504_130429_create_token_table',1494032884),('m140506_102106_rbac_init',1482895903),('m140830_171933_fix_ip_field',1494032884),('m140830_172703_change_account_table_name',1494032884),('m141222_110026_update_ip_field',1494032884),('m141222_135246_alter_username_length',1494032884),('m150614_103145_update_social_account_table',1494032884),('m150623_212711_fix_username_notnull',1494032884),('m151218_234654_add_timezone_to_profile',1494032884),('m160929_103127_add_last_login_at_to_user_table',1494032884);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `keyword` varchar(100) NOT NULL DEFAULT '',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '模板路径',
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,'关于我们','','关于我们','关于我们','page','<p><iframe class=\"ueditor_baidumap\" src=\"http://dev.qy.com/assets/7a0b751e/dialogs/map/show.html#center=116.404,39.915&zoom=10&width=530&height=340&markers=116.404,39.915&markerStyles=l,A\" frameborder=\"0\" width=\"534\" height=\"344\"></iframe></p>',1483165325,1483170261);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-02 15:35:35
