-- MySQL dump 10.13  Distrib 5.7.14, for Win64 (x86_64)
--
-- Host: localhost    Database: o2o
-- ------------------------------------------------------
-- Server version	5.7.14-log

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
-- Table structure for table `nhs_o2o_admin`
--

DROP TABLE IF EXISTS `nhs_o2o_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhs_o2o_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `passwd` char(32) DEFAULT '',
  `active` tinyint(2) DEFAULT '1',
  `depart` int(11) unsigned DEFAULT '0',
  `add_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL,
  `login_ip` char(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE,
  KEY `depart` (`depart`),
  CONSTRAINT `nhs_o2o_admin_ibfk_1` FOREIGN KEY (`depart`) REFERENCES `nhs_o2o_depart` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='管理员';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhs_o2o_admin`
--

LOCK TABLES `nhs_o2o_admin` WRITE;
/*!40000 ALTER TABLE `nhs_o2o_admin` DISABLE KEYS */;
INSERT INTO `nhs_o2o_admin` VALUES (3,'admin','e10adc3949ba59abbe56e057f20f883e',1,1,1468783543,1474962623,1468783543,NULL),(6,'lishi','e10adc3949ba59abbe56e057f20f883e',1,2,1468783543,1468783543,1468783543,NULL),(7,'wangwu','e10adc3949ba59abbe56e057f20f883e',0,1,1474277894,1475136295,1474277894,'127.0.0.1'),(8,'zhaoliu','e10adc3949ba59abbe56e057f20f883e',0,2,1474278526,1475134258,1474278526,'127.0.0.1'),(9,'zhangsan','e10adc3949ba59abbe56e057f20f883e',1,2,1474944950,1474944950,NULL,NULL),(12,'wangchao','96e79218965eb72c92a549dd5a330112',0,1,1474945202,1475134457,NULL,NULL),(14,'mahan','d553d148479a268914cecb77b2b88e6a',1,2,1474958135,1474958135,NULL,NULL),(15,'zhaohu','e10adc3949ba59abbe56e057f20f883e',1,1,1475133577,1475134778,NULL,NULL),(16,'zhanglong','e10adc3949ba59abbe56e057f20f883e',0,1,1475135727,1475135763,NULL,NULL),(17,'root','e10adc3949ba59abbe56e057f20f883e',1,1,1475136150,1475136228,NULL,NULL);
/*!40000 ALTER TABLE `nhs_o2o_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhs_o2o_app`
--

DROP TABLE IF EXISTS `nhs_o2o_app`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhs_o2o_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '' COMMENT '分类名称',
  `remark` varchar(255) DEFAULT '' COMMENT '分类描述',
  `pid` int(11) DEFAULT '0' COMMENT '父级ID',
  `level` tinyint(4) DEFAULT '1' COMMENT '分类级别',
  `active` tinyint(4) DEFAULT '1' COMMENT '是否有效',
  `show` tinyint(2) DEFAULT '1' COMMENT '是否显示',
  `add_time` int(10) unsigned DEFAULT '0',
  `add_ip` char(16) DEFAULT '',
  `update_time` int(10) unsigned DEFAULT '0',
  `update_ip` char(16) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='应用';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhs_o2o_app`
--

LOCK TABLES `nhs_o2o_app` WRITE;
/*!40000 ALTER TABLE `nhs_o2o_app` DISABLE KEYS */;
INSERT INTO `nhs_o2o_app` VALUES (1,'index','首页',0,1,1,1,0,'',0,''),(2,'ZhAdgroup','test1',0,1,1,1,0,'',0,''),(3,'index','欢迎页',1,2,1,1,0,'',0,''),(4,'say','测试',1,2,1,1,0,'',0,''),(5,'test','test2',2,1,1,1,0,'',0,''),(6,'system','系统管理',0,1,1,1,0,'',0,''),(7,'user','用户管理',6,2,1,1,0,'',0,''),(8,'depart','部门管理',6,2,1,1,0,'',0,''),(9,'operlog','操作日志',6,2,1,1,0,'',0,''),(10,'backup','数据备份',6,2,1,1,0,'',0,''),(11,'clearcache','清除缓存',6,2,1,1,0,'',0,''),(12,'test','测试',1,2,1,1,0,'',0,''),(13,'test','测试',6,2,1,1,0,'',0,''),(14,'home','商铺',0,1,1,1,1474970916,'127.0.0.1',0,''),(15,'add','添加商铺',14,2,1,0,1474970955,'127.0.0.1',0,'');
/*!40000 ALTER TABLE `nhs_o2o_app` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhs_o2o_depart`
--

DROP TABLE IF EXISTS `nhs_o2o_depart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhs_o2o_depart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '',
  `remark` varchar(50) DEFAULT '',
  `active` tinyint(4) DEFAULT '1',
  `add_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `remark` (`remark`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='部门';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhs_o2o_depart`
--

LOCK TABLES `nhs_o2o_depart` WRITE;
/*!40000 ALTER TABLE `nhs_o2o_depart` DISABLE KEYS */;
INSERT INTO `nhs_o2o_depart` VALUES (1,'admin','管理员',1,1468783543,1468783543),(2,'kefu','客服',1,1468783543,1468783543);
/*!40000 ALTER TABLE `nhs_o2o_depart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhs_o2o_permission`
--

DROP TABLE IF EXISTS `nhs_o2o_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhs_o2o_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(11) unsigned DEFAULT '0' COMMENT '部门ID',
  `aid` int(11) unsigned DEFAULT '0' COMMENT '应用ID',
  PRIMARY KEY (`id`),
  KEY `nhs_o2o_permission_ibfk_1` (`did`),
  KEY `nhs_o2o_permission_ibfk_2` (`aid`),
  CONSTRAINT `nhs_o2o_permission_ibfk_1` FOREIGN KEY (`did`) REFERENCES `nhs_o2o_depart` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nhs_o2o_permission_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `nhs_o2o_app` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='部门权限';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhs_o2o_permission`
--

LOCK TABLES `nhs_o2o_permission` WRITE;
/*!40000 ALTER TABLE `nhs_o2o_permission` DISABLE KEYS */;
INSERT INTO `nhs_o2o_permission` VALUES (1,1,1),(2,1,2),(3,1,3),(7,1,4),(9,1,5),(10,1,6),(11,1,7),(12,1,8),(13,1,9),(14,1,10),(15,1,11),(16,1,12),(24,2,1),(25,2,3),(26,2,6),(27,2,8);
/*!40000 ALTER TABLE `nhs_o2o_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhs_o2o_syslog`
--

DROP TABLE IF EXISTS `nhs_o2o_syslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhs_o2o_syslog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(200) DEFAULT '',
  `username` varchar(40) DEFAULT '',
  `add_time` int(11) unsigned DEFAULT NULL,
  `add_ip` char(16) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  CONSTRAINT `nhs_o2o_syslog_ibfk_1` FOREIGN KEY (`username`) REFERENCES `nhs_o2o_admin` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='操作日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhs_o2o_syslog`
--

LOCK TABLES `nhs_o2o_syslog` WRITE;
/*!40000 ALTER TABLE `nhs_o2o_syslog` DISABLE KEYS */;
INSERT INTO `nhs_o2o_syslog` VALUES (1,'修改（增加）zhanglong管理员','admin',1475135727,'127.0.0.1'),(2,'修改（增加）zhanglong管理员','admin',1475135763,'127.0.0.1'),(3,'新增root管理员','admin',1475136150,'127.0.0.1'),(4,'修改root管理员','admin',1475136164,'127.0.0.1'),(5,'修改root管理员','admin',1475136228,'127.0.0.1'),(6,'新增(修改)root管理员','admin',1475136228,'127.0.0.1'),(7,'修改wangwu管理员','admin',1475136295,'127.0.0.1');
/*!40000 ALTER TABLE `nhs_o2o_syslog` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-29 16:26:21
