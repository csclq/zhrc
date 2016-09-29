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
  KEY `depart` (`depart`),
  CONSTRAINT `nhs_o2o_admin_ibfk_1` FOREIGN KEY (`depart`) REFERENCES `nhs_o2o_depart` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhs_o2o_admin`
--

LOCK TABLES `nhs_o2o_admin` WRITE;
/*!40000 ALTER TABLE `nhs_o2o_admin` DISABLE KEYS */;
INSERT INTO `nhs_o2o_admin` VALUES (3,'admin','e10adc3949ba59abbe56e057f20f883e',1,1,1468783543,1468783543,1468783543,NULL),(6,'lishi','e10adc3949ba59abbe56e057f20f883e',1,1,1468783543,1468783543,1468783543,NULL),(7,'wangwu','e10adc3949ba59abbe56e057f20f883e',1,1,1474277894,1474277894,1474277894,'127.0.0.1'),(8,'zhaoliu','e10adc3949ba59abbe56e057f20f883e',1,1,1474278526,1474278526,1474278526,'127.0.0.1');
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
  `add_time` int(10) unsigned DEFAULT '0',
  `add_ip` char(16) DEFAULT '',
  `update_time` int(10) unsigned DEFAULT '0',
  `update_ip` char(16) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhs_o2o_app`
--

LOCK TABLES `nhs_o2o_app` WRITE;
/*!40000 ALTER TABLE `nhs_o2o_app` DISABLE KEYS */;
INSERT INTO `nhs_o2o_app` VALUES (1,'index','首页',0,1,1,0,'',0,''),(2,'ZhAdgroup','test1',0,1,1,0,'',0,''),(3,'index','shouye1',1,1,1,0,'',0,''),(4,'say','shouye2',1,1,1,0,'',0,''),(5,'test','test2',2,1,1,0,'',0,'');
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
  `permission` varchar(255) DEFAULT '',
  `active` tinyint(4) DEFAULT '1',
  `add_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhs_o2o_depart`
--

LOCK TABLES `nhs_o2o_depart` WRITE;
/*!40000 ALTER TABLE `nhs_o2o_depart` DISABLE KEYS */;
INSERT INTO `nhs_o2o_depart` VALUES (1,'admin','管理员,超级管理员','1,3,4',1,1468783543,1468783543),(2,'kefu','客服','1,2,3,5',1,1468783543,1468783543);
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
  KEY `did` (`did`),
  KEY `aid` (`aid`),
  CONSTRAINT `nhs_o2o_permission_ibfk_1` FOREIGN KEY (`did`) REFERENCES `nhs_o2o_depart` (`id`),
  CONSTRAINT `nhs_o2o_permission_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `nhs_o2o_app` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhs_o2o_permission`
--

LOCK TABLES `nhs_o2o_permission` WRITE;
/*!40000 ALTER TABLE `nhs_o2o_permission` DISABLE KEYS */;
INSERT INTO `nhs_o2o_permission` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,1),(5,2,2),(6,2,3),(7,2,4),(8,2,5),(9,1,5);
/*!40000 ALTER TABLE `nhs_o2o_permission` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-21 17:27:58
