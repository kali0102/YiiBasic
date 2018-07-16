/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50721
Source Host           : 127.0.0.1:3306
Source Database       : yii-basic

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-07-16 18:18:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(32) NOT NULL COMMENT '用户名',
  `password` varchar(128) NOT NULL COMMENT '登录密码',
  `email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `phone_number` varchar(32) NOT NULL DEFAULT '' COMMENT '手机号码',
  `realname` varchar(32) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `avatar` varchar(128) NOT NULL DEFAULT '' COMMENT '头像',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别（1：男、2：女、0：保密）',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（0：禁用、1：正常）',
  `logins` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `last_login_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最近登录时间',
  `last_login_ip` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最近登录IP',
  `created_at` int(11) unsigned NOT NULL COMMENT '创建时间',
  `updated_at` int(11) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@qq.com', '', '', '', '1', '0', '0', '0', '0', '1529917517', '1531719987');
INSERT INTO `admin` VALUES ('2', 'test', 'e10adc3949ba59abbe56e057f20f883e', 'test@qq.com', '', '', '', '1', '1', '0', '0', '0', '1531736019', '1531736019');

-- ----------------------------
-- Table structure for crontab
-- ----------------------------
DROP TABLE IF EXISTS `crontab`;
CREATE TABLE `crontab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '定时任务名称',
  `route` varchar(50) NOT NULL COMMENT '任务路由',
  `crontab_str` varchar(50) NOT NULL COMMENT 'crontab格式',
  `switch` tinyint(1) NOT NULL DEFAULT '0' COMMENT '任务开关 0关闭 1开启',
  `status` tinyint(1) DEFAULT '0' COMMENT '任务运行状态 0正常 1任务报错',
  `last_rundate` datetime DEFAULT NULL COMMENT '任务上次运行时间',
  `next_rundate` datetime DEFAULT NULL COMMENT '任务下次运行时间',
  `execmemory` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '任务执行消耗内存(单位/byte)',
  `exectime` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '任务执行消耗时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of crontab
-- ----------------------------
INSERT INTO `crontab` VALUES ('1', '测试每分钟运行一次', 'test/test', '* * * * *', '1', '0', '2018-07-13 14:10:00', '2018-07-13 14:11:00', '0.00', '2.09');
INSERT INTO `crontab` VALUES ('2', '测试每天十一点运行一次', 'test/index', '* 12 * * *', '1', '0', '2018-07-13 13:34:00', '2018-07-14 12:00:00', '0.00', '1.09');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(128) NOT NULL DEFAULT '' COMMENT '登录密码',
  `email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `phone_number` varchar(32) NOT NULL DEFAULT '' COMMENT '手机号码',
  `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(128) NOT NULL DEFAULT '' COMMENT '头像',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别（1：男、2：女、0：保密）',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（0：禁用、1：正常）',
  `logins` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `last_login_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最近登录时间',
  `last_login_ip` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最近登录IP',
  `created_at` int(11) unsigned NOT NULL COMMENT '创建时间',
  `updated_at` int(11) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', 'test', 'e10adc3949ba59abbe56e057f20f883e', 'test@test.com', '', '', '', '0', '1', '0', '0', '0', '1529998101', '1529998101');
