/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : al_server_ls_updates

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2017-08-24 12:28:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account_data
-- ----------------------------
DROP TABLE IF EXISTS `account_data`;
CREATE TABLE `account_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `password` varchar(65) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `access_level` tinyint(3) NOT NULL DEFAULT '0',
  `membership` tinyint(3) NOT NULL DEFAULT '0',
  `old_membership` tinyint(3) NOT NULL DEFAULT '0',
  `last_server` tinyint(3) NOT NULL DEFAULT '-1',
  `last_ip` varchar(20) DEFAULT NULL,
  `last_mac` varchar(20) NOT NULL DEFAULT 'xx-xx-xx-xx-xx-xx',
  `ip_force` varchar(20) DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `toll` bigint(13) NOT NULL DEFAULT '0',
  `email` varchar(50) DEFAULT NULL,
  `question` varchar(50) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `return_account` tinyint(1) NOT NULL DEFAULT '0',
  `return_end` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `donate_points` float(50,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of account_data
-- ----------------------------

-- ----------------------------
-- Table structure for account_playtime
-- ----------------------------
DROP TABLE IF EXISTS `account_playtime`;
CREATE TABLE `account_playtime` (
  `account_id` int(10) unsigned NOT NULL,
  `accumulated_online` int(10) unsigned NOT NULL DEFAULT '0',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of account_playtime
-- ----------------------------

-- ----------------------------
-- Table structure for account_rewards
-- ----------------------------
DROP TABLE IF EXISTS `account_rewards`;
CREATE TABLE `account_rewards` (
  `uniqId` int(11) NOT NULL AUTO_INCREMENT,
  `accountId` int(11) NOT NULL,
  `added` varchar(70) NOT NULL DEFAULT '',
  `points` decimal(20,0) NOT NULL DEFAULT '0',
  `received` varchar(70) NOT NULL DEFAULT '0',
  `rewarded` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uniqId`),
  KEY `FK_account_rewards` (`accountId`),
  CONSTRAINT `FK_account_rewards` FOREIGN KEY (`accountId`) REFERENCES `account_data` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of account_rewards
-- ----------------------------

-- ----------------------------
-- Table structure for account_time
-- ----------------------------
DROP TABLE IF EXISTS `account_time`;
CREATE TABLE `account_time` (
  `account_id` int(11) NOT NULL,
  `last_active` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiration_time` timestamp NULL DEFAULT NULL,
  `session_duration` int(10) DEFAULT '0',
  `accumulated_online` int(10) DEFAULT '0',
  `accumulated_rest` int(10) DEFAULT '0',
  `penalty_end` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`account_id`),
  CONSTRAINT `FK_account_time` FOREIGN KEY (`account_id`) REFERENCES `account_data` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of account_time
-- ----------------------------

-- ----------------------------
-- Table structure for banned_ip
-- ----------------------------
DROP TABLE IF EXISTS `banned_ip`;
CREATE TABLE `banned_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mask` varchar(45) NOT NULL,
  `time_end` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mask` (`mask`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banned_ip
-- ----------------------------

-- ----------------------------
-- Table structure for banned_mac
-- ----------------------------
DROP TABLE IF EXISTS `banned_mac`;
CREATE TABLE `banned_mac` (
  `uniId` int(10) NOT NULL AUTO_INCREMENT,
  `address` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `details` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`uniId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banned_mac
-- ----------------------------

-- ----------------------------
-- Table structure for cms_log_account_update
-- ----------------------------
DROP TABLE IF EXISTS `cms_log_account_update`;
CREATE TABLE `cms_log_account_update` (
  `account_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `email` int(11) DEFAULT NULL,
  `email_previous` int(11) DEFAULT NULL,
  `toll` int(11) DEFAULT NULL,
  `toll_previous` int(11) DEFAULT NULL,
  `donate_points` int(11) DEFAULT NULL,
  `donate_points_previous` int(11) DEFAULT NULL,
  `access_level` int(11) DEFAULT NULL,
  `access_level_previous` int(11) DEFAULT NULL,
  `privilege` int(11) DEFAULT NULL,
  `privilege_previous` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `read` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_log_account_update
-- ----------------------------

-- ----------------------------
-- Table structure for cms_log_donate
-- ----------------------------
DROP TABLE IF EXISTS `cms_log_donate`;
CREATE TABLE `cms_log_donate` (
  `account` int(11) NOT NULL,
  `invoice` int(11) NOT NULL,
  `usd` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `read` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_log_donate
-- ----------------------------
INSERT INTO `cms_log_donate` VALUES ('1', '1', '10', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for cms_log_membership
-- ----------------------------
DROP TABLE IF EXISTS `cms_log_membership`;
CREATE TABLE `cms_log_membership` (
  `account_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `read` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_log_membership
-- ----------------------------

-- ----------------------------
-- Table structure for cms_log_online_count
-- ----------------------------
DROP TABLE IF EXISTS `cms_log_online_count`;
CREATE TABLE `cms_log_online_count` (
  `id` smallint(1) NOT NULL,
  `online_count` int(1) NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_log_online_count
-- ----------------------------
INSERT INTO `cms_log_online_count` VALUES ('1', '33', '2016-08-12');

-- ----------------------------
-- Table structure for cms_log_tools_senditem
-- ----------------------------
DROP TABLE IF EXISTS `cms_log_tools_senditem`;
CREATE TABLE `cms_log_tools_senditem` (
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `enchant` int(11) DEFAULT NULL,
  `temperance` int(11) DEFAULT NULL,
  `sent_at` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `read` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_log_tools_senditem
-- ----------------------------

-- ----------------------------
-- Table structure for cms_log_webshop
-- ----------------------------
DROP TABLE IF EXISTS `cms_log_webshop`;
CREATE TABLE `cms_log_webshop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `read` int(11) DEFAULT NULL,
  `enchant` int(11) DEFAULT NULL,
  `temperance` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5390 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_log_webshop
-- ----------------------------
INSERT INTO `cms_log_webshop` VALUES ('4078', '45', '316303', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4079', '45', '316303', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4080', '45', '316303', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4081', '45', '316303', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4082', '45', '316303', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4083', '45', '316303', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4084', '45', '316303', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4085', '45', '316303', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4086', '45', '316303', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4087', '45', '316303', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4088', '9', '309988', '168000070', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4089', '56', '311066', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4090', '56', '311066', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4091', '56', '311066', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4092', '56', '311066', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4093', '56', '311066', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4094', '56', '311066', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4095', '56', '311066', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4096', '56', '311066', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4097', '56', '311066', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4098', '56', '311066', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4099', '56', '311066', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4100', '56', '311066', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4101', '56', '311066', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4102', '56', '311066', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4103', '66', '317523', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4104', '66', '317523', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4105', '66', '317523', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4106', '66', '317523', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4107', '66', '317523', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4108', '66', '317523', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4109', '66', '317523', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4110', '66', '317523', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4111', '78', '309826', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4112', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4113', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4114', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4115', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4116', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4117', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4118', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4119', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4120', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4121', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4122', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4123', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4124', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4125', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4126', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4127', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4128', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4129', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4130', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4131', '41', '309422', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4132', '45', '327149', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4133', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4134', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4135', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4136', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4137', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4138', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4139', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4140', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4141', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4142', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4143', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4144', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4145', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4146', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4147', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4148', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4149', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4150', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4151', '9', '313943', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4152', '9', '313943', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4153', '9', '313943', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4154', '9', '313943', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4155', '9', '313943', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4156', '9', '313943', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4157', '9', '313943', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4158', '9', '313943', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4159', '9', '313943', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4160', '9', '313943', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4161', '10', '330332', '168000070', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4162', '15', '311119', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4163', '15', '311119', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4164', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4165', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4166', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4167', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4168', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4169', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4170', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4171', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4172', '45', '327149', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4173', '56', '313047', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4174', '64', '334073', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4175', '64', '334073', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4176', '64', '334073', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4177', '64', '334073', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4178', '64', '334073', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4179', '64', '334073', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4180', '90', '330296', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4181', '90', '330296', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4182', '90', '330296', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4183', '90', '330296', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4184', '90', '330296', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4185', '90', '330296', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4186', '90', '330296', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4187', '90', '330296', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4188', '90', '330296', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4189', '90', '330296', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4190', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4191', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4192', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4193', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4194', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4195', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4196', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4197', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4198', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4199', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4200', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4201', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4202', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4203', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4204', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4205', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4206', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4207', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4208', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4209', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4210', '64', '334073', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4211', '28', '308291', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4212', '91', '329852', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4213', '95', '333104', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4214', '95', '333104', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4215', '95', '333104', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4216', '95', '333104', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4217', '95', '333104', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4218', '41', '314588', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4219', '41', '335175', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4220', '41', '314588', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4221', '41', '314588', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4222', '41', '314588', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4223', '41', '314588', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4224', '41', '314588', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4225', '41', '314588', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4226', '41', '314588', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4227', '41', '314588', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4228', '41', '314588', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4229', '41', '314588', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4230', '92', '335221', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4231', '92', '335221', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4232', '103', '346934', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4233', '103', '346934', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4234', '103', '346934', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4235', '103', '346934', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4236', '103', '346934', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4237', '103', '346934', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4238', '103', '346934', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4239', '103', '346934', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4240', '90', '330296', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4241', '90', '330296', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4242', '91', '329852', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4243', '104', '347108', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4244', '94', '331622', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4245', '94', '331622', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4246', '94', '331622', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4247', '90', '349017', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4248', '90', '349017', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4249', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4250', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4251', '88', '329648', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4252', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4253', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4254', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4255', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4256', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4257', '88', '329648', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4258', '88', '329648', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4259', '88', '329648', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4260', '88', '329648', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4261', '88', '329648', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4262', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4263', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4264', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4265', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4266', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4267', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4268', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4269', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4270', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4271', '88', '329648', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4272', '88', '354631', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4273', '88', '354631', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4274', '88', '354631', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4275', '88', '354631', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4276', '88', '354631', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4277', '88', '354631', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4278', '88', '354631', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4279', '45', '353253', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4280', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4281', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4282', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4283', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4284', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4285', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4286', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4287', '98', '337136', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4288', '98', '337136', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4289', '92', '335221', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4290', '92', '335221', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4291', '92', '335221', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4292', '98', '337136', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4293', '98', '337136', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4294', '98', '337136', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4295', '91', '348874', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4296', '91', '348874', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4297', '91', '348874', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4298', '91', '348874', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4299', '91', '329852', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4300', '91', '329852', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4301', '91', '329852', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4302', '91', '329852', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4303', '91', '329852', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4304', '91', '371291', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4305', '91', '371291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4306', '91', '371291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4307', '91', '371291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4308', '91', '371291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4309', '91', '371291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4310', '91', '371291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4311', '91', '371291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4312', '91', '371291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4313', '106', '357623', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4314', '106', '357623', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4315', '106', '357623', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4316', '106', '357623', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4317', '106', '357623', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4318', '106', '357623', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4319', '106', '357623', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4320', '106', '357623', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4321', '106', '357623', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4322', '106', '357623', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4323', '117', '308149', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4324', '37', '312392', '168000073', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4325', '91', '328931', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4326', '114', '317823', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4327', '114', '317823', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4328', '114', '317823', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4329', '114', '317823', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4330', '114', '317823', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4331', '114', '317823', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4332', '114', '317823', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4333', '105', '323909', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4334', '105', '323909', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4335', '105', '323909', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4336', '105', '323909', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4337', '124', '323624', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4338', '124', '323624', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4339', '124', '337384', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4340', '124', '323624', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4341', '124', '337384', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4342', '124', '337384', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4343', '124', '323624', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4344', '105', '323909', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4345', '105', '323909', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4346', '105', '323909', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4347', '28', '308291', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4348', '132', '318350', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4349', '91', '329852', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4350', '21', '312644', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4351', '105', '324997', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4352', '105', '324997', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4353', '105', '324997', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4354', '105', '324997', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4355', '90', '329864', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4356', '90', '329864', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4357', '90', '329864', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4358', '90', '329864', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4359', '90', '329864', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4360', '97', '335230', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4361', '97', '335230', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4362', '97', '335230', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4363', '97', '335230', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4364', '97', '335230', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4365', '97', '335230', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4366', '94', '350920', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4367', '94', '350920', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4368', '94', '350920', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4369', '94', '350920', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4370', '94', '332335', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4371', '94', '332335', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4372', '94', '368697', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4373', '127', '335943', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4374', '127', '335943', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4375', '127', '335943', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4376', '127', '335943', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4377', '127', '335943', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4378', '127', '335943', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4379', '127', '335943', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4380', '97', '335230', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4381', '97', '335230', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4382', '97', '335230', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4383', '97', '335230', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4384', '97', '335230', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4385', '97', '335230', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4386', '91', '328931', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4387', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4388', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4389', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4390', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4391', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4392', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4393', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4394', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4395', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4396', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4397', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4398', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4399', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4400', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4401', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4402', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4403', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4404', '146', '318985', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4405', '134', '324978', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4406', '134', '324978', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4407', '134', '324978', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4408', '134', '324978', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4409', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4410', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4411', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4412', '90', '330296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4413', '55', '335416', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4414', '55', '335416', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4415', '55', '335416', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4416', '55', '335416', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4417', '153', '332402', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4418', '153', '332402', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4419', '153', '332402', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4420', '153', '332402', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4421', '153', '332402', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4422', '153', '332402', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4423', '153', '332402', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4424', '153', '332402', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4425', '127', '320197', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4426', '127', '320197', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4427', '127', '320197', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4428', '127', '320197', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4429', '127', '320197', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4430', '127', '320197', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4431', '127', '320197', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4432', '127', '320197', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4433', '123', '330797', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4434', '123', '330797', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4435', '157', '336138', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4436', '152', '339254', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4437', '152', '339254', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4438', '152', '339254', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4439', '152', '339254', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4440', '157', '336138', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4441', '157', '336138', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4442', '157', '336138', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4443', '137', '318025', '167000518', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4444', '137', '311216', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4445', '137', '311216', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4446', '137', '311216', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4447', '137', '311216', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4448', '149', '335324', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4449', '149', '327821', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4450', '149', '335324', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4451', '132', '316873', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4452', '132', '318350', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4453', '153', '332402', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4454', '153', '332402', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4455', '28', '308291', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4456', '28', '308291', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4457', '28', '308291', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4458', '28', '308291', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4459', '119', '336991', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4460', '119', '336991', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4461', '119', '336991', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4462', '119', '336991', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4463', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4464', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4465', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4466', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4467', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4468', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4469', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4470', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4471', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4472', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4473', '92', '321992', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4474', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4475', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4476', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4477', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4478', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4479', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4480', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4481', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4482', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4483', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4484', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4485', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4486', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4487', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4488', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4489', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4490', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4491', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4492', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4493', '28', '308291', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4494', '39', '312338', '167000754', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4495', '39', '312338', '167000754', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4496', '39', '312338', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4497', '23', '324255', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4498', '114', '322524', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4499', '114', '322524', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4500', '114', '322524', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4501', '114', '322524', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4502', '114', '322524', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4503', '114', '322524', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4504', '114', '322524', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4505', '114', '322524', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4506', '92', '321992', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4507', '92', '321992', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4508', '92', '321992', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4509', '92', '321992', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4510', '92', '321992', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4511', '92', '321992', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4512', '92', '321992', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4513', '92', '321992', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4514', '92', '321992', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4515', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4516', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4517', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4518', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4519', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4520', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4521', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4522', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4523', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4524', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4525', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4526', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4527', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4528', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4529', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4530', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4531', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4532', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4533', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4534', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4535', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4536', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4537', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4538', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4539', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4540', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4541', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4542', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4543', '199', '316796', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4544', '199', '316796', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4545', '199', '316796', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4546', '10', '330332', '101301131', '1', '10000', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4547', '10', '330332', '168000037', '1', '1500', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4548', '134', '366123', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4549', '134', '366123', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4550', '134', '366123', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4551', '134', '366123', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4552', '134', '308348', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4553', '134', '308348', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4554', '64', '367865', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4555', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4556', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4557', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4558', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4559', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4560', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4561', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4562', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4563', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4564', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4565', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4566', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4567', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4568', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4569', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4570', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4571', '64', '367865', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4572', '177', '310239', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4573', '177', '310239', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4574', '177', '310239', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4575', '177', '310239', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4576', '177', '310239', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4577', '177', '310239', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4578', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4579', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4580', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4581', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4582', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4583', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4584', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4585', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4586', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4587', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4588', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4589', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4590', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4591', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4592', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4593', '156', '311417', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4594', '156', '311417', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4595', '156', '311417', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4596', '156', '311417', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4597', '156', '311417', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4598', '23', '324255', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4599', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4600', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4601', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4602', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4603', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4604', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4605', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4606', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4607', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4608', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4609', '85', '324770', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4610', '23', '324255', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4611', '115', '372081', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4612', '115', '372081', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4613', '115', '372081', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4614', '115', '372081', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4615', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4616', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4617', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4618', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4619', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4620', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4621', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4622', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4623', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4624', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4625', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4626', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4627', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4628', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4629', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4630', '177', '318842', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4631', '177', '318842', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4632', '177', '318842', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4633', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4634', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4635', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4636', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4637', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4638', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4639', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4640', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4641', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4642', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4643', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4644', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4645', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4646', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4647', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4648', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4649', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4650', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4651', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4652', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4653', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4654', '102', '345785', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4655', '134', '366123', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4656', '134', '366123', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4657', '209', '348152', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4658', '209', '314743', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4659', '209', '343071', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4660', '209', '348152', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4661', '209', '314743', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4662', '209', '343071', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4663', '28', '369507', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4664', '229', '333158', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4665', '28', '369507', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4666', '28', '369507', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4667', '28', '369507', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4668', '28', '369507', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4669', '28', '369507', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4670', '28', '369507', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4671', '28', '369507', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4672', '28', '369507', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4673', '28', '369507', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4674', '28', '369507', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4675', '28', '369507', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4676', '28', '369507', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4677', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4678', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4679', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4680', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4681', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4682', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4683', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4684', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4685', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4686', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4687', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4688', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4689', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4690', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4691', '249', '328328', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4692', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4693', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4694', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4695', '153', '329462', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4696', '153', '329462', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4697', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4698', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4699', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4700', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4701', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4702', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4703', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4704', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4705', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4706', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4707', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4708', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4709', '153', '329462', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4710', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4711', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4712', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4713', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4714', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4715', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4716', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4717', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4718', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4719', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4720', '39', '312338', '168000038', '1', '1500', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4721', '39', '312338', '168000038', '1', '1500', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4722', '253', '335411', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4723', '253', '335411', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4724', '253', '335411', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4725', '253', '335411', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4726', '253', '335411', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4727', '253', '335411', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4728', '199', '316796', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4729', '199', '316796', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4730', '199', '316796', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4731', '199', '316796', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4732', '199', '316796', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4733', '199', '316796', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4734', '197', '336096', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4735', '197', '336096', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4736', '197', '336096', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4737', '197', '336096', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4738', '197', '336096', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4739', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4740', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4741', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4742', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4743', '182', '330257', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4744', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4745', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4746', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4747', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4748', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4749', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4750', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4751', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4752', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4753', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4754', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4755', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4756', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4757', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4758', '182', '330257', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4759', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4760', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4761', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4762', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4763', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4764', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4765', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4766', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4767', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4768', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4769', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4770', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4771', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4772', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4773', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4774', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4775', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4776', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4777', '182', '372324', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4778', '190', '360714', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4779', '190', '360714', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4780', '190', '360714', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4781', '125', '316311', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4782', '125', '316311', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4783', '125', '316311', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4784', '125', '316311', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4785', '125', '316311', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4786', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4787', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4788', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4789', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4790', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4791', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4792', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4793', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4794', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4795', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4796', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4797', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4798', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4799', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4800', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4801', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4802', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4803', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4804', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4805', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4806', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4807', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4808', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4809', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4810', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4811', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4812', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4813', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4814', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4815', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4816', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4817', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4818', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4819', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4820', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4821', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4822', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4823', '91', '363088', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4824', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4825', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4826', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4827', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4828', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4829', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4830', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4831', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4832', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4833', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4834', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4835', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4836', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4837', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4838', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4839', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4840', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4841', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4842', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4843', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4844', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4845', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4846', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4847', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4848', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4849', '102', '326043', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4850', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4851', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4852', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4853', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4854', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4855', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4856', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4857', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4858', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4859', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4860', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4861', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4862', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4863', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4864', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4865', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4866', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4867', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4868', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4869', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4870', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4871', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4872', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4873', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4874', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4875', '21', '368447', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4876', '21', '368447', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4877', '21', '368447', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4878', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4879', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4880', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4881', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4882', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4883', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4884', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4885', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4886', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4887', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4888', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4889', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4890', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4891', '149', '367296', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4892', '23', '324255', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4893', '23', '324255', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4894', '23', '324255', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4895', '23', '324255', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4896', '23', '324255', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4897', '23', '324255', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4898', '23', '324255', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4899', '23', '324255', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4900', '23', '324255', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4901', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4902', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4903', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4904', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4905', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4906', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4907', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4908', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4909', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4910', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4911', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4912', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4913', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4914', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4915', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4916', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4917', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4918', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4919', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4920', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4921', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4922', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4923', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4924', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4925', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4926', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4927', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4928', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4929', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4930', '23', '324255', '166030005', '1', '400', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4931', '9', '327981', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4932', '9', '327981', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4933', '9', '327981', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4934', '9', '327981', '167010137', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4935', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4936', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4937', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4938', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4939', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4940', '9', '327981', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4941', '199', '316796', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4942', '199', '316796', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4943', '199', '316796', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4944', '199', '316796', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4945', '199', '316796', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4946', '199', '316796', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4947', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4948', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4949', '182', '384909', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4950', '182', '384909', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4951', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4952', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4953', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4954', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4955', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4956', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4957', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4958', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4959', '182', '384909', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4960', '272', '333896', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4961', '272', '333896', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4962', '272', '333896', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4963', '272', '333896', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4964', '272', '333896', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4965', '272', '333896', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4966', '272', '333896', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4967', '272', '333896', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4968', '272', '333896', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4969', '272', '333896', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4970', '272', '333896', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4971', '272', '333896', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4972', '97', '340305', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4973', '97', '340305', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4974', '97', '340305', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4975', '97', '340305', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4976', '97', '340305', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4977', '97', '340305', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4978', '97', '340305', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4979', '123', '330797', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4980', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4981', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4982', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4983', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4984', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4985', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4986', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4987', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4988', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4989', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4990', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4991', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4992', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4993', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4994', '134', '366123', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4995', '197', '336096', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4996', '197', '336096', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4997', '197', '336096', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4998', '197', '336096', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('4999', '74', '325009', '190070010', '1', '1000', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5000', '252', '369990', '167020074', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5001', '252', '369990', '167020074', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5002', '252', '369990', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5003', '252', '369990', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5004', '252', '311328', '167000721', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5005', '252', '311328', '167000721', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5006', '252', '311328', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5007', '252', '311328', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5008', '252', '311328', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5009', '252', '311328', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5010', '252', '311328', '167020074', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5011', '252', '311328', '167020074', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5012', '252', '311328', '168000070', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5013', '252', '311328', '167000721', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5014', '252', '311328', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5015', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5016', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5017', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5018', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5019', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5020', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5021', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5022', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5023', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5024', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5025', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5026', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5027', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5028', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5029', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5030', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5031', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5032', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5033', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5034', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5035', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5036', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5037', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5038', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5039', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5040', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5041', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5042', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5043', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5044', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5045', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5046', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5047', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5048', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5049', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5050', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5051', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5052', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5053', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5054', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5055', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5056', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5057', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5058', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5059', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5060', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5061', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5062', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5063', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5064', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5065', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5066', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5067', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5068', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5069', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5070', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5071', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5072', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5073', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5074', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5075', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5076', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5077', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5078', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5079', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5080', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5081', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5082', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5083', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5084', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5085', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5086', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5087', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5088', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5089', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5090', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5091', '102', '345785', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5092', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5093', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5094', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5095', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5096', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5097', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5098', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5099', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5100', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5101', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5102', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5103', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5104', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5105', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5106', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5107', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5108', '102', '347516', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5109', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5110', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5111', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5112', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5113', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5114', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5115', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5116', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5117', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5118', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5119', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5120', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5121', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5122', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5123', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5124', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5125', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5126', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5127', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5128', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5129', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5130', '134', '347756', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5131', '134', '347756', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5132', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5133', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5134', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5135', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5136', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5137', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5138', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5139', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5140', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5141', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5142', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5143', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5144', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5145', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5146', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5147', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5148', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5149', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5150', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5151', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5152', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5153', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5154', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5155', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5156', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5157', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5158', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5159', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5160', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5161', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5162', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5163', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5164', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5165', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5166', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5167', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5168', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5169', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5170', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5171', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5172', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5173', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5174', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5175', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5176', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5177', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5178', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5179', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5180', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5181', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5182', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5183', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5184', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5185', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5186', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5187', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5188', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5189', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5190', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5191', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5192', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5193', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5194', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5195', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5196', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5197', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5198', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5199', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5200', '137', '338452', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5201', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5202', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5203', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5204', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5205', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5206', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5207', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5208', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5209', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5210', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5211', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5212', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5213', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5214', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5215', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5216', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5217', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5218', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5219', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5220', '92', '323467', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5221', '167', '343013', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5222', '167', '343013', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5223', '167', '343013', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5224', '167', '343013', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5225', '167', '343013', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5226', '167', '343013', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5227', '294', '347392', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5228', '294', '347392', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5229', '294', '347392', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5230', '209', '314743', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5231', '209', '314743', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5232', '209', '314743', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5233', '209', '314743', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5234', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5235', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5236', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5237', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5238', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5239', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5240', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5241', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5242', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5243', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5244', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5245', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5246', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5247', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5248', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5249', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5250', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5251', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5252', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5253', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5254', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5255', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5256', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5257', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5258', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5259', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5260', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5261', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5262', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5263', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5264', '199', '316796', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5265', '199', '340533', '167020074', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5266', '199', '340533', '167000725', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5267', '199', '340533', '167000725', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5268', '199', '340533', '167000725', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5269', '199', '340533', '167000725', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5270', '199', '340533', '167000725', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5271', '288', '348845', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5272', '288', '348845', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5273', '288', '348845', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5274', '156', '311417', '167000721', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5275', '156', '311417', '167000721', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5276', '156', '311417', '167010222', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5277', '156', '311417', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5278', '156', '311417', '167000720', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5279', '23', '324255', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5280', '145', '317453', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5281', '145', '317453', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5282', '145', '317453', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5283', '145', '317453', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5284', '145', '317453', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5285', '145', '317453', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5286', '145', '317453', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5287', '145', '317453', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5288', '145', '317453', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5289', '145', '317453', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5290', '197', '336096', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5291', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5292', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5293', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5294', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5295', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5296', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5297', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5298', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5299', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5300', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5301', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5302', '113', '356892', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5303', '299', '385871', '167000455', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5304', '299', '385871', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5305', '299', '385871', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5306', '299', '385871', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5307', '299', '385871', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5308', '299', '385871', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5309', '55', '335416', '167000735', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5310', '55', '335416', '167000735', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5311', '55', '335416', '167000735', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5312', '55', '335416', '167000735', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5313', '55', '335416', '167000735', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5314', '156', '391792', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5315', '156', '391792', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5316', '156', '391792', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5317', '156', '391792', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5318', '123', '330797', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5319', '123', '330797', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5320', '123', '330797', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5321', '123', '330797', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5322', '123', '330797', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5323', '123', '330797', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5324', '308', '314678', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5325', '308', '314678', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5326', '308', '314678', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5327', '308', '314678', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5328', '308', '314678', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5329', '309', '312928', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5330', '309', '312928', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5331', '309', '312928', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5332', '309', '312928', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5333', '309', '312928', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5334', '309', '312928', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5335', '309', '312928', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5336', '309', '312928', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5337', '309', '312928', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5338', '309', '312928', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5339', '306', '311655', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5340', '306', '311655', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5341', '306', '311655', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5342', '306', '311655', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5343', '306', '311655', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5344', '306', '311655', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5345', '306', '311655', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5346', '306', '311655', '110900136', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5347', '306', '311655', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5348', '306', '311655', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5349', '306', '311655', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5350', '288', '312200', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5351', '288', '312200', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5352', '23', '324255', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5353', '23', '324255', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5354', '315', '335646', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5355', '315', '335646', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5356', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5357', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5358', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5359', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5360', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5361', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5362', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5363', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5364', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5365', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5366', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5367', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5368', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5369', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5370', '315', '335646', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5371', '290', '374179', '110900217', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5372', '290', '374179', '110900218', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5373', '104', '333819', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5374', '104', '333819', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5375', '104', '333819', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5376', '104', '333819', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5377', '104', '333819', '188054204', '100', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5378', '252', '311328', '168000038', '1', '1500', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5379', '252', '361732', '167000743', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5380', '252', '361732', '167000743', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5381', '252', '361732', '167000743', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5382', '252', '361732', '167000743', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5383', '252', '361732', '167000743', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5384', '252', '361732', '167000743', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5385', '252', '361732', '167020072', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5386', '252', '361732', '167020072', '1', '100', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5387', '252', '361732', '167000721', '5', '200', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5388', '297', '378800', '110900191', '1', '0', null, '0', '0', '2016', '2016');
INSERT INTO `cms_log_webshop` VALUES ('5389', '297', '378800', '110900217', '1', '0', null, '0', '0', '2016', '2016');

-- ----------------------------
-- Table structure for cms_membership
-- ----------------------------
DROP TABLE IF EXISTS `cms_membership`;
CREATE TABLE `cms_membership` (
  `title` varchar(11) NOT NULL,
  `type` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `desc` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_membership
-- ----------------------------
INSERT INTO `cms_membership` VALUES ('VIP', '2', '30', '12000', '0', '0', '2', '0', '0', '0');
INSERT INTO `cms_membership` VALUES ('VIP', '2', '15', '7500', '0', '0', '1', '0', '0', '0');
INSERT INTO `cms_membership` VALUES ('Premium', '1', '30', '7500', '0', '0', '4', '0', '0', '0');
INSERT INTO `cms_membership` VALUES ('Premium', '1', '15', '5000', '0', '0', '3', '0', '0', '0');

-- ----------------------------
-- Table structure for cms_membership_type
-- ----------------------------
DROP TABLE IF EXISTS `cms_membership_type`;
CREATE TABLE `cms_membership_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_membership_type
-- ----------------------------
INSERT INTO `cms_membership_type` VALUES ('1', 'VIP', '2', '15', '7500');
INSERT INTO `cms_membership_type` VALUES ('2', 'VIP', '2', '30', '12000');
INSERT INTO `cms_membership_type` VALUES ('3', 'Premium', '1', '15', '5000');
INSERT INTO `cms_membership_type` VALUES ('4', 'Premium', '1', '30', '7500');

-- ----------------------------
-- Table structure for cms_news
-- ----------------------------
DROP TABLE IF EXISTS `cms_news`;
CREATE TABLE `cms_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `content` text,
  `created_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_by` varchar(11) DEFAULT NULL,
  `updated_at` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_news
-- ----------------------------
INSERT INTO `cms_news` VALUES ('4', 'Starter Kit Info', 'starter-kit-info', '<p>Hello, Daevas<br /><br />kami juga memberikan starterpak untuk para player heat aion berupa<br /><br />-Custodian&nbsp;armor set (no divine)<br />-Nac Acc Set<br />-Weapon shedim dan hyperion<br />-Ransum<br />-Wings dengan 2 stat bisa pilih salah 1,<br />-Kinah .givekinah dengan otomatis akan mendapatkan kinah 9999999<br /><br />system yang kami terapkan di heat aion<br /><br />-Instant level 65 (harus jalani quest ascension)<br />-No stigma system/full stigma<br />-instance/dungeon aktif kalian juga bisa medapatkan equip yang tinggi dari pve<br />-pvp map dengan monster yang sengaja di beri drop omega enchant stone<br /><br />dan masih banyak yang lain\"<br /><br /><br />Regard.<br />Heat Aion Team</p>', '2016', null, '1', '2', '201', '2016-11-07 ');
INSERT INTO `cms_news` VALUES ('5', 'Heat  Aion OBT', 'heat-aion-obt', '<p><span style=\"color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\">Hello, Daveas</span></p>\r\n<p>07 November 2016<br style=\"box-sizing: border-box; color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\" /><span style=\"color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\">kami dari team heat aion telah membuka server dengan status&nbsp;OBT</span><br style=\"box-sizing: border-box; color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\" /><span style=\"color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\">dan kami juga mengadakan event\"menarik untuk player yang berpartisipasi</span><br style=\"box-sizing: border-box; color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\" /><br style=\"box-sizing: border-box; color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\" /><br style=\"box-sizing: border-box; color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\" /><span style=\"color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\">Regard.</span><br style=\"box-sizing: border-box; color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\" /><span style=\"color: #6d6d6d; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\">Heat Aion Team</span></p>', '2016', null, '1', '2', '201', '2016-11-07 ');
INSERT INTO `cms_news` VALUES ('6', 'Event Promosi AION', 'event-promosi-aion', '<p><strong>Event Promosi HEAT AION 4.9</strong></p>\r\n<p>&nbsp;</p>\r\n<p>Tag Rising Force Heat​ pada setiap postingan ketika anda promosi</p>\r\n<p>( FB aja / ga wajib )</p>\r\n<p>Promosi di perbolehkan di&nbsp;</p>\r\n<p>Timeline (1x 24jam)</p>\r\n<p>Group AION Share-Share atau Grup AION (1x10 Menit)</p>\r\n<p>Kaskus / IDWS / KotakGame / IDGS dan lain-lain ( Spam di perbolehkan )</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>List reward:</strong>&nbsp;</p>\r\n<p>Juara 1 akan mendapatkan:</p>\r\n<p><strong>Rp 1.500.000</strong></p>\r\n<p>Juara 2 akan mendapatkan:</p>\r\n<p><strong>Rp 1.000.000</strong></p>\r\n<p>Juara 3 akan mendapatkan</p>\r\n<p><strong>Rp 750.000</strong></p>\r\n<p>&nbsp;</p>\r\n<p>Rentang Event <strong>11 November 2016 - 11 Desember 2016</strong></p>\r\n<p>Submit dilakukan tanggal: <strong>10 Desember 2016</strong></p>\r\n<p>&nbsp;</p>\r\n<p>Info Daftar untuk ikut event di&nbsp;</p>\r\n<p><a href=\"https://forum.heat.web.id/showthread.php/3418-Event-Promosi-AION-HEAT\">Forum</a></p>', '2016', null, '1', '201', '201', '2016-11-07 ');

-- ----------------------------
-- Table structure for cms_news_category
-- ----------------------------
DROP TABLE IF EXISTS `cms_news_category`;
CREATE TABLE `cms_news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` varchar(11) NOT NULL,
  `updated_at` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_news_category
-- ----------------------------
INSERT INTO `cms_news_category` VALUES ('1', 'news', '1', 'News', '2016-07-11 ', '2016-07-11 ');
INSERT INTO `cms_news_category` VALUES ('2', 'updates', '1', 'Updates', '2016-07-11 ', '2016-07-11 ');
INSERT INTO `cms_news_category` VALUES ('9', 'maintenance', '1', 'Maintenance', '2016-07-11 ', '2016-07-11 ');

-- ----------------------------
-- Table structure for cms_pages
-- ----------------------------
DROP TABLE IF EXISTS `cms_pages`;
CREATE TABLE `cms_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(11) NOT NULL,
  `slug` varchar(11) NOT NULL,
  `status` int(11) NOT NULL,
  `content` varchar(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `link` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content` (`content`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_pages
-- ----------------------------
INSERT INTO `cms_pages` VALUES ('1', 'Pembayaran', 'pembayaran', '1', '<p>test</p>', '2016', '2016', '');

-- ----------------------------
-- Table structure for cms_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `cms_password_resets`;
CREATE TABLE `cms_password_resets` (
  `name` varchar(50) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `token` varchar(90) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for cms_paymentwall_transactions
-- ----------------------------
DROP TABLE IF EXISTS `cms_paymentwall_transactions`;
CREATE TABLE `cms_paymentwall_transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_paymentwall_transactions
-- ----------------------------
INSERT INTO `cms_paymentwall_transactions` VALUES ('1', '1', '1', '1', '1', '1');
INSERT INTO `cms_paymentwall_transactions` VALUES ('50', '5645', '100000', '2016', '0', '0');
INSERT INTO `cms_paymentwall_transactions` VALUES ('8709812', '5645', '100000', '2016', '0', '0');

-- ----------------------------
-- Table structure for cms_paypal_transactions
-- ----------------------------
DROP TABLE IF EXISTS `cms_paypal_transactions`;
CREATE TABLE `cms_paypal_transactions` (
  `transaction_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` int(11) DEFAULT NULL,
  `ack` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `error_code` int(11) DEFAULT NULL,
  `error_shortmessage` int(11) DEFAULT NULL,
  `error_longmessage` int(11) DEFAULT NULL,
  `error_severitycode` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_paypal_transactions
-- ----------------------------
INSERT INTO `cms_paypal_transactions` VALUES ('1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for cms_routes_access
-- ----------------------------
DROP TABLE IF EXISTS `cms_routes_access`;
CREATE TABLE `cms_routes_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dashboard` int(11) NOT NULL,
  `news` int(11) NOT NULL,
  `news_category` int(11) NOT NULL,
  `accounts` int(11) NOT NULL,
  `webshop_category` int(11) NOT NULL,
  `webshop` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `pages` int(11) NOT NULL,
  `ban` int(11) NOT NULL,
  `tools` int(11) NOT NULL,
  `membership` int(11) NOT NULL,
  `logs` int(11) NOT NULL,
  `settings` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `news` (`news`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_routes_access
-- ----------------------------
INSERT INTO `cms_routes_access` VALUES ('1', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '2016', '48');

-- ----------------------------
-- Table structure for cms_settings_email
-- ----------------------------
DROP TABLE IF EXISTS `cms_settings_email`;
CREATE TABLE `cms_settings_email` (
  `driver` varchar(50) NOT NULL,
  `host` varchar(45) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `encryption` varchar(45) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(65) NOT NULL,
  `from_email` varchar(50) DEFAULT NULL,
  `from_name` varchar(50) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_settings_email
-- ----------------------------
INSERT INTO `cms_settings_email` VALUES ('smtp', 'smtp.gmail.com', '587', 'tls', 'onyen542@gmail.com', '*', 'onyen542@gmail.com', 'AionUnity Team', '60');

-- ----------------------------
-- Table structure for cms_settings_general
-- ----------------------------
DROP TABLE IF EXISTS `cms_settings_general`;
CREATE TABLE `cms_settings_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_name` varchar(30) NOT NULL DEFAULT '',
  `pass_reset_expire` bigint(11) NOT NULL,
  `rates_exp` int(4) NOT NULL,
  `rates_kinah` int(4) NOT NULL,
  `rates_drop` int(4) NOT NULL,
  `rates_quest` int(4) NOT NULL,
  `port_game` int(4) NOT NULL,
  `port_login` int(4) NOT NULL,
  `port_timeout` int(4) NOT NULL,
  `webshop_discount_normal` int(4) NOT NULL,
  `webshop_discount_premium` int(4) NOT NULL,
  `webshop_discount_vip` int(4) NOT NULL,
  `credit_name` varchar(30) NOT NULL,
  `donate_type` int(4) NOT NULL COMMENT '0',
  `vote_type` int(4) NOT NULL COMMENT '0',
  `vote_ip_blocking` int(4) NOT NULL DEFAULT '2',
  `news_count` int(4) NOT NULL,
  `rank_player` int(4) NOT NULL,
  `rank_abyss` int(4) NOT NULL,
  `rank_exp` int(4) NOT NULL,
  `rank_legions` int(4) NOT NULL,
  `rank_gp` int(4) NOT NULL,
  `rank_kinah` int(4) NOT NULL,
  `rank_ap` int(4) NOT NULL,
  `allow_banned_ip` int(4) NOT NULL COMMENT '0',
  `unlock_unstuck` int(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_settings_general
-- ----------------------------
INSERT INTO `cms_settings_general` VALUES ('1', 'Heat-Aion', '1440', '50', '50', '15', '15', '7771', '9999', '60', '0', '0', '0', 'Toll(S)', '1', '1', '0', '5', '10', '10', '10', '10', '10', '10', '10', '1', '60', '2016-11-17 22:13:27');

-- ----------------------------
-- Table structure for cms_settings_payment
-- ----------------------------
DROP TABLE IF EXISTS `cms_settings_payment`;
CREATE TABLE `cms_settings_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paypal_status` int(11) DEFAULT NULL,
  `paypal_test_mode` int(40) DEFAULT NULL,
  `paypal_api_username` varchar(40) DEFAULT NULL,
  `paypal_api_password` varchar(50) DEFAULT NULL,
  `paypal_api_signature` varchar(90) DEFAULT NULL,
  `paypal_donate_points` int(11) DEFAULT NULL,
  `paypal_donate_toll` int(11) DEFAULT NULL,
  `donate_rates` int(11) DEFAULT NULL,
  `paymentwall_status` int(11) DEFAULT NULL,
  `paymentwall_public_key` varchar(90) DEFAULT NULL,
  `paymentwall_private_key` varchar(90) DEFAULT NULL,
  `super_rewards_status` int(11) DEFAULT NULL,
  `super_rewards_public_key` varchar(90) NOT NULL DEFAULT '',
  `super_rewards_private_key` varchar(90) DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`super_rewards_public_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_settings_payment
-- ----------------------------
INSERT INTO `cms_settings_payment` VALUES ('1', '0', '0', 'michelgorter_api1.outlook.com', 'XR5AWMJ4V8QDS73E', 'AwFxsFhRZyS2iiEGAQT4HPmxjYlEARHjXivbfIW-p57gqoMk9t54LM99', '1', '1', '100', '0', '4f17beff5717b3ee3d1d849866c22964', '05a8f39d90d8cb2da196a2d7cfff10ad', '0', 'qiekpzkkmjn.742299193364', '16cdfcab227e89e8cfd3acf97106a9c6', null, null, '2016-07-16 07:24:10');

-- ----------------------------
-- Table structure for cms_super_rewards_transactions
-- ----------------------------
DROP TABLE IF EXISTS `cms_super_rewards_transactions`;
CREATE TABLE `cms_super_rewards_transactions` (
  `tid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL,
  `new` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_super_rewards_transactions
-- ----------------------------

-- ----------------------------
-- Table structure for cms_unstuck_logs
-- ----------------------------
DROP TABLE IF EXISTS `cms_unstuck_logs`;
CREATE TABLE `cms_unstuck_logs` (
  `account_id` int(11) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_unstuck_logs
-- ----------------------------
INSERT INTO `cms_unstuck_logs` VALUES ('61', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('55', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('93', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('81', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('86', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('34', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('9', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('85', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('130', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('28', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('27', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('41', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('111', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('67', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('167', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('176', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('69', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('210', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('82', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('173', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('36', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('2', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('117', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('4', '2016');
INSERT INTO `cms_unstuck_logs` VALUES ('24', '2016');

-- ----------------------------
-- Table structure for cms_vote_logs
-- ----------------------------
DROP TABLE IF EXISTS `cms_vote_logs`;
CREATE TABLE `cms_vote_logs` (
  `site_id` int(11) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `unblock_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_vote_logs
-- ----------------------------

-- ----------------------------
-- Table structure for cms_vote_sites
-- ----------------------------
DROP TABLE IF EXISTS `cms_vote_sites`;
CREATE TABLE `cms_vote_sites` (
  `id` int(11) NOT NULL,
  `name` varchar(140) DEFAULT NULL,
  `address` varchar(140) DEFAULT NULL,
  `points` int(4) DEFAULT NULL,
  `banner_url` varchar(140) DEFAULT NULL,
  `blocking_time` int(4) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cms_vote_sites
-- ----------------------------

-- ----------------------------
-- Table structure for cms_webshop
-- ----------------------------
DROP TABLE IF EXISTS `cms_webshop`;
CREATE TABLE `cms_webshop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `category_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `enchant` int(11) NOT NULL,
  `temperance` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  `image_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_webshop
-- ----------------------------
INSERT INTO `cms_webshop` VALUES ('1', '167000518', '50', 'Manastone: Attack +5', '1', '100', '100', '0', '0', '2016-11-08', '2016-07-20', 'icon_item_magicstone_04', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('2', '167010137', '70', 'Manastone: Attack +5 / Crit Strike +9', '1', '5', '200', '0', '0', '2016-11-02', '2016-07-20', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('3', '167000754', '70', 'Manastone: Attack +5 / Accuracy +14', '1', '5', '200', '0', '0', '2016-07-20', '2016-07-20', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('4', '167000757', '70', 'Manastone: Attack +5 / Block +14', '1', '5', '200', '0', '0', '2016-07-20', '2016-07-20', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('5', '167000755', '70', 'Manastone: Attack +5 / Evasion +14', '1', '5', '200', '0', '0', '2016-07-20', '2016-07-20', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('6', '167000752', '70', 'Manastone: Attack +5 / HP +50', '1', '5', '200', '0', '0', '2016-07-20', '2016-07-20', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('7', '167000717', '70', 'Manastone: Attack +5 / Magical Accuracy +8', '1', '5', '200', '0', '0', '2016-07-20', '2016-07-20', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('8', '167000753', '70', 'Manastone: Attack +5 / MP +52', '1', '5', '200', '0', '0', '2016-07-20', '2016-07-20', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('9', '167000756', '70', 'Manastone: Attack +5 / Parry +14', '1', '5', '200', '0', '0', '2016-07-20', '2016-07-20', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('10', '167000716', '70', 'Manastone: Attack +5 / Resist Magic +8', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('11', '167000720', '70', 'Manastone: Crit Strike +19 / Attack +2', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('12', '167000722', '70', 'Manastone: Crit Strike +19 / Evasion +14', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('13', '167000718', '70', 'Manastone: Crit Strike +19 / HP +50', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('14', '167000726', '70', 'Manastone: Crit Strike +19 / Magical Accuracy +8', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('15', '167000719', '70', 'Manastone: Crit Strike +19 / MP +52', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('16', '167000723', '70', 'Manastone: Crit Strike +19 / Parry +14', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('17', '167000725', '70', 'Manastone: Crit Strike +19 / Resist Magic +8', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('18', '167000729', '70', 'Manastone: Magic Boost +27 / Accuracy +14', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('19', '167000732', '70', 'Manastone: Magic Boost +27 / Block +14', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('20', '167000733', '70', 'Manastone: Magic Boost +27 / Crit Strike +9', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('21', '167010206', '70', 'Manastone: Magic Boost +27 / Crit Strike +9', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('22', '167000730', '70', 'Manastone: Magic Boost +27 / Evasion +14', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('23', '167000727', '70', 'Manastone: Magic Boost +27 / HP +50', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('24', '167000735', '70', 'Manastone: Magic Boost +27 / Magical Accuracy +8', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('25', '167000728', '70', 'Manastone: Magic Boost +27 / MP +52', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('26', '167000734', '70', 'Manastone: Magic Boost +27 / Resist Magic +8', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('27', '167000739', '70', 'Manastone: Magical Accuracy +16 / Accuracy +14', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('28', '167010217', '70', 'Manastone: Magical Accuracy +16 / Attack +3', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('29', '167000742', '70', 'Manastone: Magical Accuracy +16 / Block +14', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('30', '167000743', '70', 'Manastone: Magical Accuracy +16 / Crit Strike +9', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('31', '167000740', '70', 'Manastone: Magical Accuracy +16 / Evasion +14', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('32', '167000738', '70', 'Manastone: Magical Accuracy +16 / Magic Boost +14', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('33', '167000744', '70', 'Manastone: Magical Accuracy +16 / Resist Magic +8', '1', '5', '200', '0', '0', '0000-00-00', '0000-00-00', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('35', '166030005', '70', 'Tempering Solution', '2', '1', '400', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_2stenchant_water_m01', 'enchant');
INSERT INTO `cms_webshop` VALUES ('39', '164002111', '1', 'Greater Running Scroll (1 hour)', '18', '50', '500', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_scroll_speed_run_01', 'ransum');
INSERT INTO `cms_webshop` VALUES ('41', '164002112', '1', 'Greater Courage Scroll (1 hour)', '18', '50', '500', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_scroll_speed_atk_01', 'ransum');
INSERT INTO `cms_webshop` VALUES ('43', '164002113', '1', 'Greater Awakening Scroll (1 hour)', '18', '50', '500', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_scroll_speed_casting_01', 'ransum');
INSERT INTO `cms_webshop` VALUES ('45', '164002115', '1', 'Major Crit Spell Scroll (1 hour)', '18', '50', '500', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_scroll_critical_mag_01', 'ransum');
INSERT INTO `cms_webshop` VALUES ('47', '164002114', '1', 'Major Crit Strike Scroll (1 hour)', '18', '50', '500', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_scroll_critical_phy_01', 'ransum');
INSERT INTO `cms_webshop` VALUES ('51', '162000107', '1', 'Saam King\'s Herbs', '19', '100', '50', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_herb02', 'ransum');
INSERT INTO `cms_webshop` VALUES ('52', '168000070', '1', 'Godstone: Aegir\'s Eye Beam 5%', '4', '1', '100', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_holystone_legend_blind', 'godstone');
INSERT INTO `cms_webshop` VALUES ('53', '168000038', '1', 'Godstone: Bollvig\'s Love 10%', '4', '1', '1500', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_holystone_legend_blind', 'godstone');
INSERT INTO `cms_webshop` VALUES ('54', '168000035', '1', 'Godstone: Vidar\'s Dignity 2% (OutOfStock)', '4', '1', '300', '0', '0', '2016-10-15', '0000-00-00', 'icon_item_holystone_legend_paralyze', 'godstone');
INSERT INTO `cms_webshop` VALUES ('55', '168000037', '1', 'Godstone: Khrudgelmir\'s Silence 10%', '4', '1', '1500', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_holystone_legend_slience', 'godstone');
INSERT INTO `cms_webshop` VALUES ('56', '168000073', '1', 'Godstone: Khrudgelmir\'s Tacitness 5%', '4', '1', '100', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_holystone_legend_slience', 'godstone');
INSERT INTO `cms_webshop` VALUES ('57', '167000455', '1', 'Manastone: Magic Boost +21', '1', '100', '0', '0', '0', '2016-10-09', '0000-00-00', 'icon_item_magicstone_04', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('136', '110900136', '1', 'Foxtail Hot Pants Outfit', '14', '1', '0', '0', '0', '2016-10-09', '2016-10-06', 'icon_cash_item_missa_body_01', 'baju');
INSERT INTO `cms_webshop` VALUES ('137', '110900191', '1', '[Event] Hot Beachwear', '14', '1', '0', '0', '0', '2016-10-09', '2016-10-06', 'icon_cash_item_swimsuit_02', 'baju');
INSERT INTO `cms_webshop` VALUES ('138', '110900217', '1', '\'I-Can-Hear-Only-You\' Matching T-Shirt', '14', '1', '0', '0', '0', '2016-10-09', '2016-10-06', 'icon_cash_item_shirt_body_01', 'baju');
INSERT INTO `cms_webshop` VALUES ('139', '110900218', '1', 'I-Am-Yours\' Matching T-Shirt', '14', '1', '0', '0', '0', '2016-10-09', '2016-10-06', 'icon_cash_item_shirt_body_01', 'baju');
INSERT INTO `cms_webshop` VALUES ('140', '167020072', '70', 'Ancient Manastone: Accuracy +35', '1', '1', '100', '0', '0', '2016-10-09', '2016-10-06', 'icon_item_type_magicstone_02', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('141', '167020079', '70', 'Ancient Manastone: Attack +8', '1', '1', '100', '0', '0', '2016-10-09', '2016-10-06', 'icon_item_type_magicstone_02', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('142', '167020074', '70', 'Ancient Manastone: Crit Strike +24', '1', '1', '100', '0', '0', '2016-10-09', '2016-10-06', 'icon_item_type_magicstone_02', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('143', '167020075', '70', 'Ancient Manastone: Crit Spell +9', '1', '1', '100', '0', '0', '2016-10-09', '2016-10-06', 'icon_item_type_magicstone_02', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('144', '167020073', '70', 'Ancient Manastone: Evasion +24', '1', '1', '100', '0', '0', '2016-10-09', '2016-10-06', 'icon_item_type_magicstone_02', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('145', '167020077', '70', 'Ancient Manastone: Physical Defense +100', '1', '1', '100', '0', '0', '2016-10-09', '2016-10-06', 'icon_item_type_magicstone_02', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('146', '167020078', '70', 'Ancient Manastone: Resist Magic +20', '1', '1', '100', '0', '0', '2016-10-09', '2016-10-06', 'icon_item_type_magicstone_02', 'manastone');
INSERT INTO `cms_webshop` VALUES ('147', '187060174', '10', 'Metaspanner Steampunk Wings', '17', '1', '3500', '0', '0', '2016-10-09', '2016-10-07', 'icon_cash_item_wing_steampunk02', 'wings');
INSERT INTO `cms_webshop` VALUES ('148', '187050031', '10', 'Ornate Butterfly Wing Feather', '17', '1', '3500', '0', '0', '2016-10-09', '2016-10-07', 'icon_cash_item_wing_shine01', 'wings');
INSERT INTO `cms_webshop` VALUES ('149', '187060198', '30', 'Archangel\'s Wings', '17', '1', '3500', '0', '0', '2016-10-09', '2016-10-07', 'icon_cash_item_wing_valkyrie_01', 'wings');
INSERT INTO `cms_webshop` VALUES ('150', '187060195', '30', 'Magma Wings', '17', '1', '3500', '0', '0', '2016-10-09', '2016-10-07', 'icon_cash_item_wing_gfcontest_03', 'wings');
INSERT INTO `cms_webshop` VALUES ('151', '162000023', '30', 'Greater Healing Potion', '19', '100', '10', '0', '0', '2016-10-10', '2016-10-08', 'icon_item_potion_cure01a', 'ransum');
INSERT INTO `cms_webshop` VALUES ('152', '162000137', '60', 'Sublime Life Serum', '19', '100', '100', '0', '0', '2016-10-09', '2016-10-08', 'icon_item_potion_hp04_4', 'ransum');
INSERT INTO `cms_webshop` VALUES ('153', '164000095', '1', 'Seed of Detection', '18', '100', '200', '0', '0', '2016-10-09', '2016-10-08', 'icon_item_seed01', 'ransum');
INSERT INTO `cms_webshop` VALUES ('154', '164000259', '70', 'Premium Anti-Shock Scroll', '18', '100', '50', '0', '0', '2016-10-09', '2016-10-08', 'icon_item_scroll_shield_all_01', 'ransum');
INSERT INTO `cms_webshop` VALUES ('155', '190070010', '1', 'Popstar Summoning Lamp', '20', '1', '1000', '0', '0', '2016-10-09', '2016-10-08', 'icon_cash_item_guardian_angel_01', 'pet');
INSERT INTO `cms_webshop` VALUES ('156', '190100150', '60', 'Shugo Gyrocopter', '21', '1', '5000', '0', '0', '2016-10-09', '2016-10-08', 'icon_cash_shugoplane_01', 'mount');
INSERT INTO `cms_webshop` VALUES ('157', '190100147', '60', 'Immortal Knight\'s War Steed', '21', '1', '5000', '0', '0', '2016-10-09', '2016-10-08', 'icon_cash_midhorse_01', 'mount');
INSERT INTO `cms_webshop` VALUES ('158', '190100139', '60', 'Sleek Hovercycle', '21', '1', '5000', '0', '0', '2016-10-09', '2016-10-08', 'icon_cash_spacehover_01', 'mount');
INSERT INTO `cms_webshop` VALUES ('159', '190100131', '60', 'Lustrous Skymane', '21', '1', '5000', '0', '0', '2016-10-09', '2016-10-08', 'icon_item_tricorider_01', 'mount');
INSERT INTO `cms_webshop` VALUES ('160', '190100053', '60', 'Sharptooth Mauler', '21', '1', '2000', '0', '0', '2016-10-10', '2016-10-08', 'icon_item_bike_003', 'mount');
INSERT INTO `cms_webshop` VALUES ('161', '187060166', '65', 'Trillirunerk\'s Ice Flame Feather', '17', '1', '12000', '0', '0', '2016-10-09', '2016-10-08', 'icon_cash_item_wing_burningchilling_01', 'wings');
INSERT INTO `cms_webshop` VALUES ('162', '187060170', '65', 'Trillirunerk\'s Blue Flame Feather', '17', '1', '12000', '0', '0', '2016-10-09', '2016-10-08', 'icon_cash_item_wing_burningchilling_02', 'wings');
INSERT INTO `cms_webshop` VALUES ('163', '167020092', '70', 'Ancient Manastone: Magical Accuracy +22', '1', '1', '100', '0', '0', '2016-10-09', '2016-10-08', 'icon_item_type_magicstone_02', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('164', '167010219', '70', 'Manastone: HP +95 / Accuracy +16', '1', '5', '200', '0', '0', '2016-10-09', '2016-10-08', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('165', '167010222', '70', 'Manastone: HP +95 / Block +16', '1', '5', '200', '0', '0', '2016-10-09', '2016-10-08', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('166', '167010223', '70', 'Manastone: HP +95 / Crit Strike +10', '1', '5', '200', '0', '0', '2016-10-09', '2016-10-08', 'icon_item_magicstone_03', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('167', '100001544', '65', 'Exalted Noble Katalium Sword', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_sword_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('168', '100101179', '65', 'Exalted Noble Katalium Mace', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_mace_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('169', '115001585', '65', 'Exalted Noble Katalium Shield', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_shield_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('170', '100201349', '65', 'Exalted Noble Katalium Dagger', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_dagger_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('171', '100501183', '65', 'Exalted Noble Katalium Orb', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_orb_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('172', '100601271', '65', 'Exalted Noble Katalium Spellbook', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_book_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('173', '100901198', '65', 'Exalted Noble Katalium Greatsword', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_2hsword_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('174', '101301131', '65', 'Exalted Noble Katalium Polearm', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_polearm_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('175', '101501212', '65', 'Exalted Noble Katalium Staff', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_staff_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('176', '101701230', '65', 'Exalted Noble Katalium Bow', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_bow_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('177', '101801013', '65', 'Exalted Noble Katalium Pistol', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_gun_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('178', '101900977', '65', 'Exalted Noble Katalium Aethercannon', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_cannon_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('179', '102001040', '65', 'Exalted Noble Katalium Harp', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_harp_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('180', '102100816', '65', 'Exalted Noble Katalium Cipher-Blade', '6', '1', '10000', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_keyblade_m01', 'PVE');
INSERT INTO `cms_webshop` VALUES ('181', '169610048', '1', '[Title Card] Indomitable – 7-day pass', '23', '1', '200', '0', '0', '2016-10-10', '2016-10-10', 'icon_cash_item_card_title_01', 'Title');
INSERT INTO `cms_webshop` VALUES ('182', '169610050', '1', '[Title Card] Daevic Defender – 30-day pass', '23', '1', '300', '0', '0', '2016-10-10', '2016-10-10', 'icon_cash_item_card_title_01', 'Title');
INSERT INTO `cms_webshop` VALUES ('183', '169610052', '1', '[Title] Legendary – 30-day pass', '23', '1', '500', '0', '0', '2016-10-10', '2016-10-10', 'icon_cash_item_card_title_01', 'Title');
INSERT INTO `cms_webshop` VALUES ('184', '169610060', '1', '[Title Card] Chaser of Atreia – 30-day pass', '23', '1', '500', '0', '0', '2016-10-10', '2016-10-10', 'icon_cash_item_card_title_01', 'Title');
INSERT INTO `cms_webshop` VALUES ('185', '169610146', '1', '[Title] Glorious Number One (30 days)', '23', '1', '700', '0', '0', '2016-10-10', '2016-10-10', 'icon_cash_item_card_title_01', 'Title');
INSERT INTO `cms_webshop` VALUES ('186', '169670001', '1', '[Event] Name Change Ticket', '23', '1', '2000', '0', '0', '2016-10-10', '2016-10-10', 'icon_cash_change_character_name_01', 'Other');
INSERT INTO `cms_webshop` VALUES ('187', '169680001', '1', '[Event] Legion Name Change Ticket', '23', '1', '1000', '0', '0', '2016-10-10', '2016-10-10', 'icon_cash_change_character_name_01', 'Other');
INSERT INTO `cms_webshop` VALUES ('188', '188500014', '1', '[Motion Card] The Dragon\'s Set', '23', '1', '1000', '0', '0', '2016-10-10', '2016-10-10', 'icon_cash_item_motion_customize_01', 'Other');
INSERT INTO `cms_webshop` VALUES ('189', '169620062', '1', 'AP Boost Charm I - 50%', '23', '1', '500', '0', '0', '2016-10-10', '2016-10-10', 'icon_cash_item_apboost_01', 'Other');
INSERT INTO `cms_webshop` VALUES ('190', '169620067', '1', 'AP Boost Charm II - 50%', '23', '1', '250', '0', '0', '2016-10-10', '2016-10-10', 'icon_cash_item_apboost_01', 'Other');
INSERT INTO `cms_webshop` VALUES ('191', '188054204', '65', 'Fine Manastone Ore', '1', '100', '0', '0', '0', '2016-10-10', '2016-10-10', 'icon_item_type_magicstone_04', 'Manastone');
INSERT INTO `cms_webshop` VALUES ('192', '167020081', '70', 'Ancient Manastone: Magic Boost +35', '1', '1', '100', '0', '0', '2016-10-15', '2016-10-15', 'icon_item_type_magicstone_02', 'manastone');
INSERT INTO `cms_webshop` VALUES ('193', '167000721', '70', 'Manastone: Crit Strike +19 / Accuracy + 14', '1', '5', '200', '0', '0', '2016-11-13', '2016-11-13', 'icon_item_magicstone_03', 'Manastone');

-- ----------------------------
-- Table structure for cms_webshop_category
-- ----------------------------
DROP TABLE IF EXISTS `cms_webshop_category`;
CREATE TABLE `cms_webshop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_webshop_category
-- ----------------------------
INSERT INTO `cms_webshop_category` VALUES ('1', 'Manastone', 'manastone', '1', '2016-07-20', '2016-07-20');
INSERT INTO `cms_webshop_category` VALUES ('2', 'Enchantment', 'enchantment', '1', '2016-07-20', '2016-07-20');
INSERT INTO `cms_webshop_category` VALUES ('3', 'Consumables', 'consumables', '0', '2016-10-08', '2016-07-20');
INSERT INTO `cms_webshop_category` VALUES ('4', 'Godstone', 'godstone', '1', '2016-07-20', '2016-07-20');
INSERT INTO `cms_webshop_category` VALUES ('5', 'Weapon PVP', 'weapon pvp', '0', '2016-10-08', '2016-07-20');
INSERT INTO `cms_webshop_category` VALUES ('6', 'Weapon PVE', 'weapon pve', '1', '2016-10-10', '2016-07-20');
INSERT INTO `cms_webshop_category` VALUES ('7', 'Weapon Extends', 'weapon extendable', '0', '2016-10-08', '2016-07-20');
INSERT INTO `cms_webshop_category` VALUES ('10', 'General', 'general', '1', '2016-10-10', '2016-07-20');
INSERT INTO `cms_webshop_category` VALUES ('11', 'Set Remodel', 'set remodel', '0', '2016-10-08', '2016-07-30');
INSERT INTO `cms_webshop_category` VALUES ('12', 'Head Remodel', 'head remodel', '0', '2016-10-08', '2016-07-30');
INSERT INTO `cms_webshop_category` VALUES ('13', 'Weapon Remodel', 'weapon remodel', '0', '2016-10-08', '0000-00-00');
INSERT INTO `cms_webshop_category` VALUES ('14', 'Costume', 'costume', '1', '2016-07-30', '2016-07-30');
INSERT INTO `cms_webshop_category` VALUES ('17', 'Wings', 'wings', '1', '2016-10-07', '2016-10-07');
INSERT INTO `cms_webshop_category` VALUES ('18', 'Scroll', 'scroll', '0', '2016-10-10', '2016-10-08');
INSERT INTO `cms_webshop_category` VALUES ('19', 'Potion', 'potion', '0', '2016-10-10', '2016-10-08');
INSERT INTO `cms_webshop_category` VALUES ('20', 'Pets', 'pets', '1', '2016-10-10', '2016-10-08');
INSERT INTO `cms_webshop_category` VALUES ('21', 'Mount', 'mount', '1', '2016-10-08', '2016-10-08');
INSERT INTO `cms_webshop_category` VALUES ('23', 'Titles, Tickets, Boosts', 'titles-tickets-boosts', '0', '2016-10-10', '2016-10-10');

-- ----------------------------
-- Table structure for gameservers
-- ----------------------------
DROP TABLE IF EXISTS `gameservers`;
CREATE TABLE `gameservers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mask` varchar(45) NOT NULL,
  `password` varchar(65) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gameservers
-- ----------------------------
INSERT INTO `gameservers` VALUES ('1', '*', 'root');

-- ----------------------------
-- Table structure for player_transfers
-- ----------------------------
DROP TABLE IF EXISTS `player_transfers`;
CREATE TABLE `player_transfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_server` tinyint(3) NOT NULL,
  `target_server` tinyint(3) NOT NULL,
  `source_account_id` int(11) NOT NULL,
  `target_account_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `time_added` varchar(100) DEFAULT NULL,
  `time_performed` varchar(100) DEFAULT NULL,
  `time_done` varchar(100) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of player_transfers
-- ----------------------------

-- ----------------------------
-- Table structure for svstats
-- ----------------------------
DROP TABLE IF EXISTS `svstats`;
CREATE TABLE `svstats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `current` int(11) NOT NULL DEFAULT '0',
  `max` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of svstats
-- ----------------------------

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `task_type` enum('SHUTDOWN','RESTART','CLEAN_ACCOUNTS') NOT NULL,
  `trigger_type` enum('FIXED_IN_TIME','AFTER_RESTART') NOT NULL,
  `exec_param` text,
  `trigger_param` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tasks
-- ----------------------------
