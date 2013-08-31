# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.44)
# Database: blog
# Generation Time: 2013-08-31 16:31:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cabinet
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cabinet`;

CREATE TABLE `cabinet` (
  `cab_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cab_name` varchar(100) NOT NULL DEFAULT '',
  `node_id` int(11) DEFAULT NULL,
  `cab_location` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cab_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `cabinet` WRITE;
/*!40000 ALTER TABLE `cabinet` DISABLE KEYS */;

INSERT INTO `cabinet` (`cab_id`, `cab_name`, `node_id`, `cab_location`)
VALUES
	(1,'测试',16,'四楼机房进门左拐第二排第四个\n                            '),
	(2,'aaaa',17,'四楼机房进门往西\n                            '),
	(3,'再来一个',23,'不知道在哪里                            '),
	(4,'hello',19,'四楼机房进门左拐第二排第四个\n                            '),
	(5,'aaaa的',23,'四楼机房进门左拐第二排第四个\n                            '),
	(6,'地对地导弹',17,'四楼机房进门左拐第二排第四个\n                            ');

/*!40000 ALTER TABLE `cabinet` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cabinet_device
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cabinet_device`;

CREATE TABLE `cabinet_device` (
  `dev_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cab_id` int(11) NOT NULL,
  `dev_list` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`dev_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `cabinet_device` WRITE;
/*!40000 ALTER TABLE `cabinet_device` DISABLE KEYS */;

INSERT INTO `cabinet_device` (`dev_id`, `cab_id`, `dev_list`)
VALUES
	(1,1,'5,6,7,8,9'),
	(2,3,'14');

/*!40000 ALTER TABLE `cabinet_device` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) DEFAULT NULL,
  `group_desc` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;

INSERT INTO `group` (`group_id`, `group_name`, `group_desc`)
VALUES
	(1,'root','超级管理员'),
	(2,'operation','运维组'),
	(3,'standard','标准用户组'),
	(8,'guest','宾客'),
	(50,'test','测试组');

/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table node
# ------------------------------------------------------------

DROP TABLE IF EXISTS `node`;

CREATE TABLE `node` (
  `node_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_parent_id` int(10) unsigned DEFAULT '0',
  `node_name` varchar(100) DEFAULT NULL,
  `node_desc` varchar(200) DEFAULT NULL,
  `node_role` varchar(100) DEFAULT 'CPIS合同节点',
  PRIMARY KEY (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `node` WRITE;
/*!40000 ALTER TABLE `node` DISABLE KEYS */;

INSERT INTO `node` (`node_id`, `node_parent_id`, `node_name`, `node_desc`, `node_role`)
VALUES
	(1,0,'CMN-HF','安徽移动','CPIS合同节点'),
	(17,1,'CMN-HF-2','安徽移动2节点','CPIS服务节点'),
	(20,18,'CMN-NJ-5','江苏移动5节点','CPIS服务节点'),
	(16,1,'CMN-HF-1','安徽移动1节点','CPIS服务节点'),
	(18,0,'CMN-NJ','江苏移动','CPIS服务节点'),
	(19,18,'CMN-NJ-4','江苏移动4节点','CPIS服务节点'),
	(21,18,'CMN-NJ-6','江苏移动6节点','CPIS服务节点'),
	(22,18,'CMN-NJ-K','江苏移动K节点','CPIS服务节点'),
	(23,18,'CMN-NJ-L','江苏移动L节点','CPIS服务节点'),
	(24,18,'CMN-NJ-M','江苏移动M节点','CPIS服务节点'),
	(25,18,'CMN-NJ-S','江苏移动S节点','CPIS服务节点'),
	(26,18,'CMN-NJ-Q','江苏移动Q节点','CPIS服务节点'),
	(27,18,'CMN-NJ-R','江苏移动R节点','CPIS服务节点');

/*!40000 ALTER TABLE `node` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table relationship
# ------------------------------------------------------------

DROP TABLE IF EXISTS `relationship`;

CREATE TABLE `relationship` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned DEFAULT '0',
  `group_name` varchar(100) DEFAULT NULL,
  `group_desc` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `relationship` WRITE;
/*!40000 ALTER TABLE `relationship` DISABLE KEYS */;

INSERT INTO `relationship` (`group_id`, `node_id`, `group_name`, `group_desc`)
VALUES
	(1,1,'CMN-HF-WEB-PBL','web组，出口是PBL'),
	(2,1,'CMN-HF-WEB-TOP','web组，出口是PBL，并且是top20重点保障组'),
	(4,18,'CMN-NJ-WEB-Q','江苏移动Q节点，WEB服务'),
	(5,18,'CMN-NJ-WEB-R','江苏移动R节点，WEB服务');

/*!40000 ALTER TABLE `relationship` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table relationship_real
# ------------------------------------------------------------

DROP TABLE IF EXISTS `relationship_real`;

CREATE TABLE `relationship_real` (
  `real_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `server_ids` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`real_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `relationship_real` WRITE;
/*!40000 ALTER TABLE `relationship_real` DISABLE KEYS */;

INSERT INTO `relationship_real` (`real_id`, `group_id`, `server_ids`)
VALUES
	(1,2,'12,11,10,5,4,3,2,1'),
	(2,1,'10,9,8,7,6,5,4,2');

/*!40000 ALTER TABLE `relationship_real` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table server
# ------------------------------------------------------------

DROP TABLE IF EXISTS `server`;

CREATE TABLE `server` (
  `server_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) NOT NULL,
  `server_name` varchar(40) NOT NULL DEFAULT '',
  `server_ip` varchar(100) DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `is_active` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `server_desc` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `server` WRITE;
/*!40000 ALTER TABLE `server` DISABLE KEYS */;

INSERT INTO `server` (`server_id`, `node_id`, `server_name`, `server_ip`, `role_id`, `is_active`, `server_desc`)
VALUES
	(1,16,'CMN-HF-1-3O1','221.130.162.44',5,0,'PBL组FC'),
	(2,16,'CMN-HF-1-3O2','221.130.162.38 ',5,0,'PBL组FC'),
	(3,16,'CMN-HF-1-3O3','221.130.162.39 ',5,0,'PBL组FC'),
	(4,16,'CMN-HF-1-3O4','221.130.162.40',5,1,'PBL组FC'),
	(5,16,'CMN-HF-1-3O5','221.130.162.41',5,1,'PBL组FC'),
	(6,16,'CMN-HF-1-3O6','221.130.162.42',5,1,'PBL组FC'),
	(7,16,'CMN-HF-1-3O7','221.130.162.43',5,1,'PBL组FC'),
	(8,16,'CMN-HF-1-3O8','221.130.162.44',5,1,'PBL组FC'),
	(9,16,'CMN-HF-1-3O9','221.130.162.45',5,1,'PBL组FC'),
	(10,16,'CMN-HF-1-3Z1','221.130.162.34',6,0,'PBL组FSCS'),
	(11,16,'CMN-HF-1-3Z2','221.130.162.35',6,0,'PBL组FSCS'),
	(12,16,'CMN-HF-1-3Z3','221.130.162.35',6,0,'PBL组FSCS'),
	(13,16,'CMN-HF-1-6C1','221.130.162.65',11,0,'PBL组交换机'),
	(14,23,'CMN-NJ-L-3O1','1.1.1.1',5,0,'江苏移动L节点FC');

/*!40000 ALTER TABLE `server` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table server_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `server_role`;

CREATE TABLE `server_role` (
  `role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) DEFAULT NULL,
  `role_desc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `server_role` WRITE;
/*!40000 ALTER TABLE `server_role` DISABLE KEYS */;

INSERT INTO `server_role` (`role_id`, `role_name`, `role_desc`)
VALUES
	(1,'A10','A10硬件负载均衡器'),
	(2,'F5','F5硬件负载均衡器'),
	(3,'LVS','软件负载均衡器'),
	(5,'FC','普通FC'),
	(6,'FSCS','缓存负载均衡设备'),
	(7,'FDNS','智能调度DNS'),
	(8,'Hadoop','日志存储设备'),
	(9,'LDC','日志中转与作图设备'),
	(10,'三层交换机','节点核心设备'),
	(11,'二层交换机','节点接入或者小节点的核心交换机');

/*!40000 ALTER TABLE `server_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_password` char(40) NOT NULL,
  `user_privilege` tinyint(4) NOT NULL DEFAULT '0',
  `last_login` varchar(40) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`user_id`, `group_id`, `user_name`, `user_password`, `user_privilege`, `last_login`, `is_active`)
VALUES
	(3,2,'qing.chen','8d925a558dbfe96e63faaac3e3fab8af6703abe9',40,'2013-02-28 13:56:40',1),
	(25,3,'squid','40bd001563085fc35165329ea1ff5c5ecbdbbeef',62,'2013-07-23  05:50',1),
	(28,1,'yanjun.liu','4b832c546fde5d2a73a16fe4ec7ed09da78cd2b0',124,'2013-07-27  03:23',1),
	(29,1,'cpis','4b832c546fde5d2a73a16fe4ec7ed09da78cd2b0',62,'2013-07-28  11:09',1),
	(30,1,'1','4b832c546fde5d2a73a16fe4ec7ed09da78cd2b0',2,'2013-07-29  08:34',1),
	(31,1,'2','4b832c546fde5d2a73a16fe4ec7ed09da78cd2b0',2,'2013-07-29  08:35',1),
	(32,1,'3','4b832c546fde5d2a73a16fe4ec7ed09da78cd2b0',2,'2013-07-29  08:35',1),
	(33,1,'4','4b832c546fde5d2a73a16fe4ec7ed09da78cd2b0',2,'2013-07-29  08:35',1),
	(34,1,'5','4b832c546fde5d2a73a16fe4ec7ed09da78cd2b0',2,'2013-07-29  08:35',1),
	(35,1,'6','4b832c546fde5d2a73a16fe4ec7ed09da78cd2b0',2,'2013-07-29  08:35',1),
	(36,1,'ff','4b832c546fde5d2a73a16fe4ec7ed09da78cd2b0',2,'2013-07-29  09:15',1),
	(37,1,'gggg','4b832c546fde5d2a73a16fe4ec7ed09da78cd2b0',2,'2013-07-29  09:18',1);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
