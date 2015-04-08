/*
Navicat MySQL Data Transfer

Source Server         : mydb
Source Server Version : 50614
Source Host           : 127.0.0.1:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2015-04-08 13:03:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `IDUser` int(15) NOT NULL AUTO_INCREMENT,
  `IDRole` int(11) NOT NULL DEFAULT '3',
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_pegawai` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `inst_satkerkd` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `peg_nik` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `tmp_lahir` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `validate` enum('valid','invalid') COLLATE latin1_general_ci NOT NULL DEFAULT 'invalid',
  `status` enum('active','inactive') COLLATE latin1_general_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`IDUser`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'administrator', 'zyEap4WB6tlTqzDyqR8ELgH3HFEAB5s3V84nkMySDsREawAAxVjxpRm/yc3gXj4jLnSv0CqcJGmRe0KGyVlneihig==', 'ano@ano.com', 'Administrator', '00', '1234567', 'homeless', 'none', '1988-12-08', 'valid', 'active');
