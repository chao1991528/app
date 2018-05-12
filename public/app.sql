/*
Navicat MySQL Data Transfer

Source Server         : 本机
Source Server Version : 50717
Source Host           : 127.0.0.1:3306
Source Database       : app

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2018-05-12 08:22:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ent_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `ent_admin_user`;
CREATE TABLE `ent_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) DEFAULT '',
  `last_login_ip` varchar(30) DEFAULT NULL,
  `last_login_time` int(10) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '状态 1启用，0禁用，-1删除',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ent_admin_user
-- ----------------------------
INSERT INTO `ent_admin_user` VALUES ('1', 'aa', '123456', null, null, '2', '1', null, null);
INSERT INTO `ent_admin_user` VALUES ('3', 'aadg', '123456', null, null, '100', '1', '1524316889', '1524316889');
INSERT INTO `ent_admin_user` VALUES ('4', 'aaf', 'cdb03dc15209874f6cebfcb4adad6f6c', null, null, '12', '1', '1524317315', '1524317315');
INSERT INTO `ent_admin_user` VALUES ('6', 'aaf1', 'cdb03dc15209874f6cebfcb4adad6f6c', null, null, '100', '1', '1524317805', '1524317805');
INSERT INTO `ent_admin_user` VALUES ('7', 'admin', '172b57749cb5906e9c5f8d49c2cd9810', '127.0.0.1', '1524488220', '100', '1', '1524318169', '1524488220');

-- ----------------------------
-- Table structure for ent_category
-- ----------------------------
DROP TABLE IF EXISTS `ent_category`;
CREATE TABLE `ent_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ent_category
-- ----------------------------
INSERT INTO `ent_category` VALUES ('1', '网页', null, null);
INSERT INTO `ent_category` VALUES ('2', '原创', null, null);

-- ----------------------------
-- Table structure for ent_comment
-- ----------------------------
DROP TABLE IF EXISTS `ent_comment`;
CREATE TABLE `ent_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ent_comment
-- ----------------------------
INSERT INTO `ent_comment` VALUES ('1', '10', '3', 'nice', '0', null, '1526048722', '1526048722');
INSERT INTO `ent_comment` VALUES ('2', '10', '3', 'nice', '0', null, '1526048752', '1526048752');
INSERT INTO `ent_comment` VALUES ('3', '10', '3', 'nice', '0', '0', '1526048777', '1526048777');

-- ----------------------------
-- Table structure for ent_news
-- ----------------------------
DROP TABLE IF EXISTS `ent_news`;
CREATE TABLE `ent_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `cate_id` int(8) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text COMMENT '简介',
  `description` varchar(200) DEFAULT NULL,
  `is_recommend` tinyint(1) unsigned DEFAULT '0' COMMENT '是否推荐，0不推荐，1推荐',
  `is_home_recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐到首页，0不推荐',
  `is_allow_comment` tinyint(1) DEFAULT '0' COMMENT '是否可以评论',
  `sort` int(8) DEFAULT '0' COMMENT '排序',
  `source_type` tinyint(4) DEFAULT '0' COMMENT '新闻来源',
  `comment_count` int(11) DEFAULT '0' COMMENT '评论数目',
  `agree_count` int(11) DEFAULT '0' COMMENT '点赞数',
  `read_count` int(10) DEFAULT '0' COMMENT '阅读数',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '状态，0禁用，1启用，-1删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ent_news
-- ----------------------------
INSERT INTO `ent_news` VALUES ('1', 'aa1', '1', '20180422\\8b0a47476da280be2c82ed1aad5d7490.jpg', null, null, '0', '0', '0', '100', '1', '0', '0', '0', '1524370187', '1524584215', '1');
INSERT INTO `ent_news` VALUES ('2', 'fdfsf', '1', '20180422\\48fbead838642b621be430a36e05a8e9.jpg', '<p>fdaffds</p>', 'fdsaf', '1', '1', '0', '100', '1', '0', '0', '0', '1524371000', '1524371897', '1');
INSERT INTO `ent_news` VALUES ('3', 'rank1', '1', '20180422\\8b0a47476da280be2c82ed1aad5d7490.jpg', null, null, '0', '0', '0', '100', '0', '0', '0', '5', '1524372000', '1524370187', '1');
INSERT INTO `ent_news` VALUES ('4', 'fdfsf', '2', '20180422\\48fbead838642b621be430a36e05a8e9.jpg', '<p>fdaffds</p>', 'fdsaf', '0', '1', '0', '100', '0', '0', '0', '0', '1524371897', '1524584208', '1');
INSERT INTO `ent_news` VALUES ('5', 'rankff', '1', '20180422\\8b0a47476da280be2c82ed1aad5d7490.jpg', null, null, '0', '0', '0', '100', '0', '0', '0', '7', '1524364000', '1524584081', '1');
INSERT INTO `ent_news` VALUES ('6', 'fdfsf', '2', '20180422\\48fbead838642b621be430a36e05a8e9.jpg', '<p>fdaffds</p>', 'fdsaf', '0', '1', '0', '100', '1', '0', '0', '0', '1524371897', '1524583901', '1');
INSERT INTO `ent_news` VALUES ('7', 'aa', '1', '20180422\\8b0a47476da280be2c82ed1aad5d7490.jpg', null, null, '0', '0', '0', '100', '1', '0', '0', '0', '1514373000', '1524584276', '-1');
INSERT INTO `ent_news` VALUES ('8', 'fdfsf', '2', '20180422\\48fbead838642b621be430a36e05a8e9.jpg', '<p>fdaffds</p>', 'fdsaf', '0', '1', '0', '100', '0', '0', '0', '0', '1524061000', '1524371897', '1');
INSERT INTO `ent_news` VALUES ('9', 'aa', '1', '20180422\\8b0a47476da280be2c82ed1aad5d7490.jpg', null, null, '0', '0', '0', '100', '0', '0', '0', '0', '1514362000', '1524370187', '0');
INSERT INTO `ent_news` VALUES ('10', 'fdfsf', '1', '20180422\\48fbead838642b621be430a36e05a8e9.jpg', '<p>fdaffds</p>', 'fdsaf', '0', '1', '0', '100', '1', '3', '0', '0', '1524263000', '1524371897', '1');

-- ----------------------------
-- Table structure for ent_user
-- ----------------------------
DROP TABLE IF EXISTS `ent_user`;
CREATE TABLE `ent_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT '',
  `password` char(32) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT '',
  `time_out` int(10) unsigned DEFAULT '0' COMMENT 'token过期时间',
  `image` varchar(255) DEFAULT NULL COMMENT '头像',
  `sex` tinyint(1) DEFAULT NULL,
  `signature` varchar(200) DEFAULT '' COMMENT '个性签名',
  `status` tinyint(1) DEFAULT '0' COMMENT '0待审核，1正常，-1删除',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phone_index` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ent_user
-- ----------------------------
INSERT INTO `ent_user` VALUES ('3', '137****2150', null, '13714432150', 'ed535fb3f221357b19769590ade17d84', '1526653223', null, null, '', '1', '1525784643', '1526048423');

-- ----------------------------
-- Table structure for ent_user_news_like
-- ----------------------------
DROP TABLE IF EXISTS `ent_user_news_like`;
CREATE TABLE `ent_user_news_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `news_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ent_user_news_like
-- ----------------------------

-- ----------------------------
-- Table structure for ent_version
-- ----------------------------
DROP TABLE IF EXISTS `ent_version`;
CREATE TABLE `ent_version` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `app_type` varchar(20) DEFAULT NULL COMMENT '客户端类型 ios，andriod',
  `version` int(10) DEFAULT NULL COMMENT '内部版本号',
  `version_code` varchar(20) DEFAULT NULL COMMENT '外部版本号',
  `is_force` tinyint(1) unsigned DEFAULT '0' COMMENT '是否强制更新，0不，1是',
  `apk_url` varchar(255) DEFAULT NULL COMMENT 'apk最新地址',
  `upgrade_point` varchar(255) DEFAULT NULL COMMENT '更新说明',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned DEFAULT NULL,
  `update_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ent_version
-- ----------------------------
INSERT INTO `ent_version` VALUES ('1', 'android', '3', '1.3', '0', 'http://www.baidu.com', '优化了一些数据', '1', '1525271835', '1525271835');
INSERT INTO `ent_version` VALUES ('2', 'android', '4', '1.4', '0', 'http://www.sohu.com', '优化了网络', '1', '1525271700', '1525271700');
