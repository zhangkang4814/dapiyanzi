/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : project

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-11-02 16:06:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpu` varchar(255) NOT NULL,
  `memory` varchar(255) NOT NULL,
  `disk` varchar(255) NOT NULL COMMENT '硬盘',
  `system` varchar(255) NOT NULL,
  `video_card` varchar(255) NOT NULL COMMENT '图形处理化（显卡）',
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', '8', '20g', '10000', 'w10', 'GTX1080', '1000');
INSERT INTO `config` VALUES ('5', '142', '124', '214', '123', '11', '1000');
INSERT INTO `config` VALUES ('3', '8核', '16g', '1T', 'windows10', 'GTX1080', '1000');
INSERT INTO `config` VALUES ('4', 'Int酷睿I7', '16G', '1024G', 'windows10', 'GTX1080', '1000');
INSERT INTO `config` VALUES ('6', 'I9', '16G', '1T', 'windows10', 'GTX1080', '298');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `user_id` int(11) NOT NULL,
  `cop` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL,
  `custom_name` varchar(255) NOT NULL,
  `post` char(6) NOT NULL,
  `legal_person` varchar(255) NOT NULL,
  `legal_card` char(18) NOT NULL COMMENT '法人身份证卡',
  `business_pic` varchar(255) NOT NULL COMMENT '营业执照图片',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('4', '阿里巴巴', '3', '杭州', '12451451254', '张仁灿', '1221', '曹超东方闪电', '222222225555665', '/upload/d7e7c72af83450e862333bd175fb96b0.png');
INSERT INTO `customer` VALUES ('4', '阿里巴巴', '2', '杭州', '12451451254', '曹超2', '1221', '曹超2', '222222225555665', '/upload/5350d679b502240c60c6386d72321f44.png');
INSERT INTO `customer` VALUES ('7', '阿里巴巴', '7', '杭州', '12451451254', '哈哈', '1222', '哈哈', '222222225555665', '/upload/c431e51c0ce2db941ef9dac53eb300a7.jpg');
INSERT INTO `customer` VALUES ('4', '阿里巴巴', '6', '杭州', '12451451254', '郭洋', '1221', '儿子', '222222225555665', '/upload/1d2371cd07736126a5a6eacf224b0270.png');

-- ----------------------------
-- Table structure for device
-- ----------------------------
DROP TABLE IF EXISTS `device`;
CREATE TABLE `device` (
  `mid` varchar(255) NOT NULL,
  `confid` int(11) NOT NULL COMMENT '配置id',
  `customid` int(11) DEFAULT NULL COMMENT '客户id',
  `manufacturer` varchar(255) NOT NULL COMMENT '生产厂家',
  `batch` int(11) NOT NULL COMMENT '批次',
  `mac` char(17) NOT NULL COMMENT 'mac地址',
  `buytime` int(11) NOT NULL COMMENT '购买时间',
  `op` varchar(255) NOT NULL COMMENT '操作员',
  `state` int(11) NOT NULL COMMENT '0 未分配  1 已分配（試用期15天） 2 已分配（正式使用） 3 已使用',
  `usestate` int(11) DEFAULT NULL COMMENT '使用状态：0未使用 1已使用 2已报修 3已报废',
  `startime` int(11) DEFAULT NULL COMMENT '开始时间',
  `expiretime` int(11) DEFAULT NULL COMMENT '到期时间'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of device
-- ----------------------------
INSERT INTO `device` VALUES ('A2112', '1', '3', '1232', '4441111', '111-aaa-bbb-sda11', '1540951380', '张康', '1', '1', '1541142584', '1547622584');
INSERT INTO `device` VALUES ('A21555', '4', '3', 'aaab', '22', '111-aaa-bbb-sda', '1541120460', '张康', '0', '1', '1541139220', '1545027221');
INSERT INTO `device` VALUES ('A215551', '1', '3', '412', '444', '111-aaa-bbb-sda', '1541037720', '张康', '1', '1', '1541142584', '1547622584');
INSERT INTO `device` VALUES ('B333', '1', '3', '章康', '999', '111-211-aaa-111', '1541037720', '张康', '1', '1', '1541142584', '1547622584');
INSERT INTO `device` VALUES ('B3332', '1', '3', '章康', '999', '111-211-aaa-111', '1541120460', '张康', '0', '1', '1541140612', '1547620612');

-- ----------------------------
-- Table structure for device_fenpei
-- ----------------------------
DROP TABLE IF EXISTS `device_fenpei`;
CREATE TABLE `device_fenpei` (
  `custom_id` int(11) NOT NULL,
  `confid` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `op` varchar(255) NOT NULL,
  `order_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of device_fenpei
-- ----------------------------
INSERT INTO `device_fenpei` VALUES ('3', '1', '1', '1541140612', '张康', '1');
INSERT INTO `device_fenpei` VALUES ('3', '4', '1', '1541139220', '张康', '1');
INSERT INTO `device_fenpei` VALUES ('3', '1', '3', '1541142584', '张康', '1');

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(255) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of login
-- ----------------------------
INSERT INTO `login` VALUES ('1', 'zk', 'e10adc3949ba59abbe56e057f20f883e', '0', '1');
INSERT INTO `login` VALUES ('2', 'zhangrencan', 'e10adc3949ba59abbe56e057f20f883e', '0', '2');
INSERT INTO `login` VALUES ('3', 'guoyang', 'e10adc3949ba59abbe56e057f20f883e', '1', '4');
INSERT INTO `login` VALUES ('4', 'gouyang', 'e10adc3949ba59abbe56e057f20f883e', '-1', '2');
INSERT INTO `login` VALUES ('5', 'zhangrencan', 'e10adc3949ba59abbe56e057f20f883e', '-1', '3');
INSERT INTO `login` VALUES ('6', 'guoyang', 'e10adc3949ba59abbe56e057f20f883e', '-1', '6');
INSERT INTO `login` VALUES ('7', 'zhangkang', 'e10adc3949ba59abbe56e057f20f883e', '2', '5');
INSERT INTO `login` VALUES ('8', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2', '6');
INSERT INTO `login` VALUES ('9', 'admins', 'e10adc3949ba59abbe56e057f20f883e', '2', '7');
INSERT INTO `login` VALUES ('10', 'adminss', 'e10adc3949ba59abbe56e057f20f883e', '3', '8');
INSERT INTO `login` VALUES ('11', 'admin1', 'e10adc3949ba59abbe56e057f20f883e', '3', '9');
INSERT INTO `login` VALUES ('12', 'admin12', 'e10adc3949ba59abbe56e057f20f883e', '1', '10');
INSERT INTO `login` VALUES ('13', 'hahaa', 'e10adc3949ba59abbe56e057f20f883e', '-1', '7');

-- ----------------------------
-- Table structure for manager
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('1', '张康');
INSERT INTO `manager` VALUES ('2', '张仁灿');

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operator` varchar(255) NOT NULL COMMENT '操作员',
  `sending_time` int(11) NOT NULL COMMENT '发送时间',
  `mid` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES ('30', 'fd', '1540806384', '53', '2', 'gredfgf', '343');
INSERT INTO `notice` VALUES ('31', 'jeff', '1540806484', '32', '3', '432423423', '铂金专区');
INSERT INTO `notice` VALUES ('32', 'gy', '1540806680', '77', '2', 'thfhb', '大保健优惠券nvbn');
INSERT INTO `notice` VALUES ('33', 'y', '1540806701', '5435', '2', 'gncvbcvbc', 'treter');
INSERT INTO `notice` VALUES ('34', 'vv', '1540806823', '5354', '1', '5gd', '点击进入');
INSERT INTO `notice` VALUES ('35', '4242424', '1540870967', '4242', '2', '42424', '4242');
INSERT INTO `notice` VALUES ('36', 'tomg', '1540874208', '2244', '2', '435rttg', '34534');
INSERT INTO `notice` VALUES ('37', 'pl', '1540874341', '99', '2', '9999999999', '王者专区');
INSERT INTO `notice` VALUES ('38', '好', '1540891192', '77', '广告通知', '好', '大保健优惠券');
INSERT INTO `notice` VALUES ('39', '好', '1540891220', '77', '广告通知', '好', '大保健优惠券');
INSERT INTO `notice` VALUES ('40', '22', '1540893383', '1', '优惠通知', '333', '22');
INSERT INTO `notice` VALUES ('41', 'gy', '1540947346', '999', '催费通知', '你的机子没钱了', '续费');
INSERT INTO `notice` VALUES ('42', 'gy', '1540947703', '100', '优惠通知', '全场五折，买一送一', '大保健优惠券');
INSERT INTO `notice` VALUES ('43', 'hhh', '1541064266', '0', '优惠通知', '恢复规划法规和规范化更符合规范化非共和国', '6圼');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sq_time` int(11) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `state` int(11) NOT NULL COMMENT '1.已申请 2.已分配',
  `cust_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('8', '1540087440', '1', '1080', '1', '3');
INSERT INTO `order` VALUES ('9', '1540087440', '1', '1300', '2', '3');
INSERT INTO `order` VALUES ('10', '1540087440', '1', '1980', '1', '3');
INSERT INTO `order` VALUES ('11', '1540087440', '1', '600', '1', '3');

-- ----------------------------
-- Table structure for order_info
-- ----------------------------
DROP TABLE IF EXISTS `order_info`;
CREATE TABLE `order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_info
-- ----------------------------
INSERT INTO `order_info` VALUES ('1', '1', '5', '2', '8');
INSERT INTO `order_info` VALUES ('2', '5', '10', '2', '8');
INSERT INTO `order_info` VALUES ('3', '1', '0', '2', '9');
INSERT INTO `order_info` VALUES ('4', '2', '2', '2', '9');
INSERT INTO `order_info` VALUES ('5', '4', '0', '1', '9');
INSERT INTO `order_info` VALUES ('6', '1', '3', '2', '10');
INSERT INTO `order_info` VALUES ('7', '2', '3', '2', '10');
INSERT INTO `order_info` VALUES ('8', '4', '3', '1', '10');
INSERT INTO `order_info` VALUES ('9', '1', '2', '3', '11');

-- ----------------------------
-- Table structure for pay
-- ----------------------------
DROP TABLE IF EXISTS `pay`;
CREATE TABLE `pay` (
  `user_id` int(11) NOT NULL,
  `confid` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `expiretime` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay
-- ----------------------------
INSERT INTO `pay` VALUES ('9', '4', '100', '1541142584', '1547622584', '1000', '6');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cop` varchar(255) NOT NULL COMMENT '公司名称',
  `id_card` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `qq` varchar(13) DEFAULT NULL,
  `bank_card` varchar(255) NOT NULL,
  `proportions` int(11) NOT NULL,
  `area` varchar(255) NOT NULL,
  `auth` int(11) NOT NULL,
  `father` int(255) NOT NULL DEFAULT '0',
  `find` varchar(255) DEFAULT NULL COMMENT '冗余列 无限分类',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('4', '阿里巴巴', '566516516168572752', '哒哒哒', '12451451254', '杭州', '455223', '45645645645', '35', '杭州', '1', '0', '0,');
INSERT INTO `user` VALUES ('10', '阿里巴巴', '566516516168572752', '张仁灿22', '12451451254', '杭州', '455222', '45645645645', '35', '杭州', '1', '0', '0,');
INSERT INTO `user` VALUES ('5', '阿里巴巴', '566516516168572752', '章康1', '12451451254', '杭州', '455222', '45645645645', '20', '杭州', '2', '4', '0,4,');
INSERT INTO `user` VALUES ('6', '阿里巴巴', '566516516168572752', '张仁灿', '12451451254', '杭州', '455222', '45645645645', '15', '杭州', '2', '4', '0,4,');
INSERT INTO `user` VALUES ('7', '阿里巴巴', '566516516168572752', '张仁', '12451451254', '杭州', '455222', '45645645645', '25', '杭州', '2', '4', '0,4,');
INSERT INTO `user` VALUES ('8', '阿里巴巴', '566516516168572752', '张', '12451451254', '杭州', '455222', '45645645645', '10', '杭州', '3', '6', '0,4,6,');
INSERT INTO `user` VALUES ('9', '阿里巴巴', '566516516168572752', '是是是', '12451451254', '杭州', '455222', '45645645645', '10', '杭州', '3', '6', '0,4,6,');
