/*
MySQL Backup
Source Server Version: 5.5.53
Source Database: yii2advanced
Date: 2017/2/8 18:29:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `yii2_admin`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_admin`;
CREATE TABLE `yii2_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `yii2_auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_auth_assignment`;
CREATE TABLE `yii2_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `yii2_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `yii2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `yii2_auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_auth_item`;
CREATE TABLE `yii2_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `yii2_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `yii2_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `yii2_auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_auth_item_child`;
CREATE TABLE `yii2_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `yii2_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `yii2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `yii2_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `yii2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `yii2_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_auth_rule`;
CREATE TABLE `yii2_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `yii2_menu`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_menu`;
CREATE TABLE `yii2_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `yii2_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `yii2_news_article`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_news_article`;
CREATE TABLE `yii2_news_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `thumb_img` varchar(255) DEFAULT NULL,
  `content` text,
  `hits` int(10) unsigned DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `is_valid` int(10) unsigned DEFAULT NULL,
  `created_at` int(10) unsigned DEFAULT NULL,
  `updated_at` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `yii2_news_article_tag`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_news_article_tag`;
CREATE TABLE `yii2_news_article_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned DEFAULT NULL,
  `tag_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `yii2_news_category`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_news_category`;
CREATE TABLE `yii2_news_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(5) unsigned DEFAULT NULL,
  `status` tinyint(4) unsigned DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `yii2_news_tag`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_news_tag`;
CREATE TABLE `yii2_news_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `article_number` int(10) unsigned DEFAULT NULL,
  `created_at` int(10) unsigned DEFAULT NULL,
  `updated_at` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `yii2_user`
-- ----------------------------
DROP TABLE IF EXISTS `yii2_user`;
CREATE TABLE `yii2_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `yii2_admin` VALUES ('1','wangxin','ZNoEBSCEE_qvCFEPB5NLNaNg13C9pz-m','$2y$13$6lTQHcJEUtT4CwwzFdXs1utBmL6B0Uvb0K0pJHtriyzu4XBfuG1iO',NULL,'986083741@qq.com','10','10','1486544737','1486544737');
INSERT INTO `yii2_auth_assignment` VALUES ('超级管理员','1','1486546199');
INSERT INTO `yii2_auth_item` VALUES ('/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/assignment/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/assignment/assign','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/assignment/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/assignment/revoke','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/assignment/view','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/default/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/default/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/menu/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/menu/create','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/menu/delete','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/menu/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/menu/update','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/menu/view','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/permission/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/permission/assign','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/permission/create','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/permission/delete','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/permission/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/permission/remove','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/permission/update','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/permission/view','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/role/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/role/assign','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/role/create','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/role/delete','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/role/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/role/remove','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/role/update','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/role/view','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/route/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/route/assign','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/route/create','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/route/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/route/refresh','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/route/remove','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/rule/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/rule/create','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/rule/delete','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/rule/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/rule/update','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/rule/view','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/user/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/user/activate','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/user/change-password','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/user/delete','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/user/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/user/request-password-reset','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/user/reset-password','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/user/signup','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/admin/user/view','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/base/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/debug/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/debug/default/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/debug/default/db-explain','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/debug/default/download-mail','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/debug/default/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/debug/default/toolbar','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/debug/default/view','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/gii/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/gii/default/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/gii/default/action','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/gii/default/diff','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/gii/default/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/gii/default/preview','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/gii/default/view','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/index/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/index/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-article/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-article/create','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-article/delete','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-article/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-article/ueditor','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-article/update','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-article/upload','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-article/view','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-category/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-category/create','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-category/delete','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-category/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-category/update','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/news-category/view','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/site/*','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/site/error','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/site/index','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/site/login','2',NULL,NULL,NULL,'1486545551','1486545551'), ('/site/logout','2',NULL,NULL,NULL,'1486545551','1486545551'), ('超级管理员','2',NULL,NULL,NULL,'1486546164','1486546164');
INSERT INTO `yii2_auth_item_child` VALUES ('超级管理员','/*');
INSERT INTO `yii2_menu` VALUES ('1','权限管理',NULL,NULL,'2','{\"icon\":\"fa fa-key\",\"visible\":true}'), ('2','菜单管理','1','/admin/menu/index','2',NULL), ('3','权限列表','1','/admin/permission/index','3',NULL), ('4','路由管理','1','/admin/route/index','1',NULL), ('5','权限分配','1','/admin/assignment/index','4',NULL), ('6','权限规则','1','/admin/rule/index','5',NULL), ('7','系统管理',NULL,NULL,'1','{\"icon\":\"fa fa-cogs\",\"visible\":true}'), ('8','用户管理',NULL,NULL,'3','{\"icon\":\"fa fa-users\",\"visible\":true}'), ('9','后台用户管理','8','/admin/user/index','1',NULL), ('10','新闻管理',NULL,NULL,'4','{\"icon\":\"fa fa-newspaper-o\",\"visible\":true}'), ('11','分类管理','10','/news-category/index','1',NULL), ('12','文章管理','10','/news-article/index','2',NULL), ('13','aa','7','/site/index','0','{\"icon\":\"fa fa-tachometer\",\"visible\":false}'), ('14','仪表盘',NULL,'/site/index','0','{\"icon\":\"fa fa-tachometer\",\"visible\":true}');
INSERT INTO `yii2_news_article` VALUES ('1','PHP 是最好的语言','PHP 是最好的语言PHP 是最好的语言PHP 是最好的语言PHP 是最好的语言PHP 是最好的语言PHP 是最好的语言不服来辩！','2','','<p>PHP 是最好的语言</p><p>PHP 是最好的语言PHP 是最好的语言</p><p>PHP 是最好的语言PHP 是最好的语言PHP 是最好的语言</p><p>不服来辩！</p>','0','1','0','1486548467','1486548467');
INSERT INTO `yii2_news_article_tag` VALUES ('1','1','1');
INSERT INTO `yii2_news_category` VALUES ('1','编程语言','0','',NULL,'1','1486547539','1486547539'), ('2','PHP','1','','1','1','1486547593','1486547593');
INSERT INTO `yii2_news_tag` VALUES ('1','PHP','1','1486548467','1486548467');
INSERT INTO `yii2_user` VALUES ('1','wangxin','ZNoEBSCEE_qvCFEPB5NLNaNg13C9pz-m','$2y$13$6lTQHcJEUtT4CwwzFdXs1utBmL6B0Uvb0K0pJHtriyzu4XBfuG1iO',NULL,'986083741@qq.com','10','10','1486544737','1486544737');
