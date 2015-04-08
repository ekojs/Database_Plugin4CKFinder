/*
Navicat MySQL Data Transfer

Source Server         : mydb
Source Server Version : 50614
Source Host           : 127.0.0.1:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2015-04-08 11:43:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for userfiles
-- ----------------------------
DROP TABLE IF EXISTS `userfiles`;
CREATE TABLE `userfiles` (
  `IDFile` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `url_path` varchar(255) DEFAULT NULL,
  `physical_path` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` varchar(255) NOT NULL,
  PRIMARY KEY (`IDFile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
