# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.44)
# Database: blog
# Generation Time: 2013-11-01 02:25:21 +0000
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
	(7,'xx-1-JJ1',16,'四楼机房进门左拐第二排第四个\n                        '),
	(2,'xx-L-JJ1',23,'四楼机房进门左拐第二排第四个\n                        ');

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
	(3,7,'13,10,11,1,2,3,4,5,6');

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
	(1,0,'xx-xx','XX移动','xx合同节点');

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
	(1,1,'CMN-HF-WEB-PBL','web组，出口是PBL');

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
	(3,1,'qing.chen','8d925a558dbfe96e63faaac3e3fab8af6703abe9',64,'2013-02-28 13:56:40',1)

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
