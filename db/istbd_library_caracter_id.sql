/*
Navicat MySQL Data Transfer

Source Server         : lampp
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : istbd_library

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2016-12-12 19:16:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `author`
-- ----------------------------
DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `author_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`author_id`,`author_name`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of author
-- ----------------------------

-- ----------------------------
-- Table structure for `book`
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `book_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_isbn` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `book_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publication_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_add_date` datetime NOT NULL,
  `manager_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_edition` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `book_place_of_pub` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_year_of_pub` year(4) DEFAULT NULL,
  `book_pages` int(11) DEFAULT NULL,
  `book_status` tinyint(4) NOT NULL,
  `book_remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_stock` int(11) NOT NULL DEFAULT '0',
  `book_available` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`book_id`,`book_isbn`),
  KEY `book_id` (`book_id`),
  KEY `book_pub_FK_1` (`publication_id`),
  KEY `book_manager_FK_2` (`manager_id`),
  CONSTRAINT `FK1_book_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book
-- ----------------------------

-- ----------------------------
-- Table structure for `book_author`
-- ----------------------------
DROP TABLE IF EXISTS `book_author`;
CREATE TABLE `book_author` (
  `book_author_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`book_author_id`),
  KEY `book_author_book_FK_1` (`book_id`),
  KEY `book_author_author_FK_2` (`author_id`),
  CONSTRAINT `FK1_book_author_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_book_author_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_author
-- ----------------------------

-- ----------------------------
-- Table structure for `book_category`
-- ----------------------------
DROP TABLE IF EXISTS `book_category`;
CREATE TABLE `book_category` (
  `book_category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`book_category_id`),
  KEY `book_category_book_FK_1` (`book_id`),
  KEY `book_category_category` (`category_id`),
  CONSTRAINT `FK1_book_category_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_book_category_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_category
-- ----------------------------

-- ----------------------------
-- Table structure for `book_copy`
-- ----------------------------
DROP TABLE IF EXISTS `book_copy`;
CREATE TABLE `book_copy` (
  `book_copy_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_copy_accession_no` int(10) unsigned NOT NULL,
  `book_copy_status` tinyint(1) NOT NULL,
  `book_copy_type` tinyint(1) NOT NULL,
  `book_copy_date` date NOT NULL,
  `book_copy_price` float DEFAULT NULL,
  `book_copy_source` tinyint(1) DEFAULT NULL,
  `book_copy_remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_copy_manager_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_copy_is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`book_copy_id`,`book_copy_accession_no`),
  KEY `book_copy_book_FK1` (`book_id`),
  KEY `book_copy_manager_FK2` (`book_copy_manager_id`),
  KEY `book_copy_id` (`book_copy_id`),
  KEY `book_copy_accession_no` (`book_copy_accession_no`),
  CONSTRAINT `FK1_book_copy_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_book_copy_manager` FOREIGN KEY (`book_copy_manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_copy
-- ----------------------------

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`,`category_name`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------

-- ----------------------------
-- Table structure for `issue`
-- ----------------------------
DROP TABLE IF EXISTS `issue`;
CREATE TABLE `issue` (
  `issue_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `issue_datetime` datetime NOT NULL,
  `issue_return_datetime` datetime DEFAULT NULL,
  `issue_deadline` datetime DEFAULT NULL,
  `issue_auto_expire_datetime` datetime DEFAULT NULL,
  `issue_book_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `issue_book_copy_accession_no` int(10) unsigned DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manager_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issue_lend_user_code` varchar(15) CHARACTER SET latin1 NOT NULL,
  `issue_receive_user_code` varchar(15) CHARACTER SET latin1 NOT NULL,
  `issue_receive_admin_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `issue_fine_user_code` varchar(15) CHARACTER SET latin1 NOT NULL,
  `issue_fine_admin_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `issue_renew_user_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `issue_remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`issue_id`),
  KEY `user_issue_FK_2` (`user_id`),
  KEY `manager_issue_FK_3` (`manager_id`),
  KEY `book_issue_FK_4` (`issue_book_id`),
  KEY `book_copy_issue_FK_1` (`issue_book_copy_accession_no`),
  CONSTRAINT `FK1_user_issue` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_book_issue` FOREIGN KEY (`issue_book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK3_book_copy_issue` FOREIGN KEY (`issue_book_copy_accession_no`) REFERENCES `book_copy` (`book_copy_accession_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK4_manager_issue` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of issue
-- ----------------------------

-- ----------------------------
-- Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_query` longtext COLLATE utf8_unicode_ci NOT NULL,
  `log_is_synced` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `log_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=332 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('308', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_fine_user_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (164, \'2016-12-01 12:52:32\', \'2016-12-03 16:30:00\', \'40\', \'2\', 9, \'D3qfC5uZ\', \'I3V1dWT#\', \'btzjYXZt\', \'VM4Bbbw#\', \'\')', '0', '2016-12-01 12:52:32');
INSERT INTO `log` VALUES ('309', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_fine_user_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (165, \'2016-12-01 12:52:40\', \'2016-12-03 16:30:00\', \'53-Fundamentals of Electric Circuits (5th) - Charles K. Alexander, Matthew N. O. Sadiku\', \'2\', 9, \'2TIatLl$\', \'2&aq8kCV\', \'saKnBs&W\', \'o9F#3hEM\', \'\')', '0', '2016-12-01 12:52:40');
INSERT INTO `log` VALUES ('310', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_fine_user_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (166, \'2016-12-01 13:05:04\', \'2016-12-03 16:30:00\', \'40-Art of Programming Contest (2nd) - Ahmed Shamsul Arefin\', \'2\', 9, \'eSUJ%z6N\', \'Vw6Memgt\', \'Tls@vigr\', \'8VUvBB8@\', \'\')', '0', '2016-12-01 13:05:04');
INSERT INTO `log` VALUES ('311', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_fine_user_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (167, \'2016-12-01 13:07:49\', \'2016-12-03 16:30:00\', \'40\', \'2\', 9, \'sIW9eL7m\', \'rl4bOkOW\', \'ODUk2lbN\', \'Esx#bxTa\', \'\')', '0', '2016-12-01 13:07:49');
INSERT INTO `log` VALUES ('312', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_fine_user_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (167, \'2016-12-01 13:08:12\', \'2016-12-03 16:30:00\', \'40\', \'2\', 9, \'4jfeGJ7L\', \'BpDDzyvN\', \'R46#IN$X\', \'e7Au&De#\', \'\')', '0', '2016-12-01 13:08:12');
INSERT INTO `log` VALUES ('313', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_fine_user_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (167, \'2016-12-01 13:08:32\', \'2016-12-03 16:30:00\', \'40\', \'2\', 9, \'Yh8BDoT8\', \'n#oVTGbd\', \'1vxoDRUZ\', \'VgjFBO1J\', \'\')', '0', '2016-12-01 13:08:32');
INSERT INTO `log` VALUES ('314', 'DELETE FROM `issue` WHERE `issue_id` = \'164\'', '0', '2016-12-01 13:11:12');
INSERT INTO `log` VALUES ('315', 'UPDATE `book` SET `book_id` = \'40\', `book_available` = 3 WHERE `book_id` = \'40\'', '0', '2016-12-01 13:17:01');
INSERT INTO `log` VALUES ('316', 'DELETE FROM `issue` WHERE `issue_id` = \'166\'', '0', '2016-12-01 13:17:01');
INSERT INTO `log` VALUES ('317', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'198\', `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'198\'', '0', '2016-12-01 14:13:59');
INSERT INTO `log` VALUES ('318', 'UPDATE `issue` SET `issue_book_copy_accession_no` = \'198\', `issue_status` = 1, `issue_datetime` = \'2016-12-01 14:13:59\', `issue_deadline` = \'2016-12-16 16:30:00\' WHERE `issue_id` = \'163\'', '0', '2016-12-01 14:13:59');
INSERT INTO `log` VALUES ('319', 'UPDATE `issue` SET `issue_id` = \'163\', `issue_status` = 3, `issue_return_datetime` = \'2016-12-01 18:26:46\' WHERE `issue_id` = \'163\'', '0', '2016-12-01 18:26:46');
INSERT INTO `log` VALUES ('320', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (166, \'2016-12-01 18:26:46\', \'2016-12-16 16:30:00\', \'4\', \'198\', \'2\', \'3\', 1, \'bp#Em&0z\', \'Ay@nXKrH\', \'LBKxTyKC\', \'fjvsutfK\', \'3lb$Hzpu\', \'Ze#59i@5\', \'\')', '0', '2016-12-01 18:26:46');
INSERT INTO `log` VALUES ('321', 'UPDATE `issue` SET `issue_id` = \'163\', `issue_status` = 3, `issue_return_datetime` = \'2016-12-01 18:26:58\' WHERE `issue_id` = \'163\'', '0', '2016-12-01 18:26:59');
INSERT INTO `log` VALUES ('322', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (166, \'2016-12-01 18:26:58\', \'2016-12-16 16:30:00\', \'4\', \'198\', \'2\', \'3\', 1, \'s$Z&#Y8p\', \'YOSgnhnH\', \'X%2EZelN\', \'$UUgE80H\', \'QoTCUH4a\', \'bcAnX8pH\', \'\')', '0', '2016-12-01 18:26:59');
INSERT INTO `log` VALUES ('323', 'UPDATE `issue` SET `issue_id` = \'163\', `issue_status` = 3, `issue_return_datetime` = \'2016-12-01 18:27:17\' WHERE `issue_id` = \'163\'', '0', '2016-12-01 18:27:17');
INSERT INTO `log` VALUES ('324', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (166, \'2016-12-01 18:27:17\', \'2016-12-16 16:30:00\', \'4\', \'198\', \'2\', \'3\', 1, \'6A8dVgPL\', \'dHu@h3Gm\', \'2t6u8lWt\', \'XbY6tPKG\', \'D$Ea3Eio\', \'PU&LxGyP\', \'\')', '0', '2016-12-01 18:27:18');
INSERT INTO `log` VALUES ('325', 'UPDATE `issue` SET `issue_id` = \'160\', `issue_status` = 3, `issue_return_datetime` = \'2016-12-01 18:41:36\' WHERE `issue_id` = \'160\'', '0', '2016-12-01 18:41:36');
INSERT INTO `log` VALUES ('326', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (167, \'2016-12-01 18:41:36\', \'2016-12-16 16:30:00\', \'40\', \'104\', \'1\', \'3\', 1, \'fhv6&$zf\', \'ovTFdrai\', \'J40k0k0U\', \'EgTYSEbC\', \'5Tn6BuQd\', \'MvrpovU%\', \'\')', '0', '2016-12-01 18:41:36');
INSERT INTO `log` VALUES ('327', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_fine_user_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (168, \'2016-12-01 18:53:42\', \'2016-12-03 16:30:00\', \'46\', \'1\', 9, \'Ba6U3pVZ\', \'jDBUmTh%\', \'VO##GnuS\', \'OFSNdmE0\', \'\')', '0', '2016-12-01 18:53:42');
INSERT INTO `log` VALUES ('328', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_fine_user_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (168, \'2016-12-01 18:54:04\', \'2016-12-03 16:30:00\', \'46\', \'1\', 9, \'DzpmWaw8\', \'Lpr&sGjw\', \'VChvOQVf\', \'bk6zFYlR\', \'\')', '0', '2016-12-01 18:54:04');
INSERT INTO `log` VALUES ('329', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_fine_user_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (168, \'2016-12-01 18:55:09\', \'2016-12-03 16:30:00\', \'46\', \'1\', 9, \'m2e27A7v\', \'BCKJuyO4\', \'seegLaZp\', \'wzsx1xxz\', \'\')', '0', '2016-12-01 18:55:09');
INSERT INTO `log` VALUES ('330', 'DELETE FROM `issue` WHERE `issue_id` = \'168\'', '0', '2016-12-01 18:57:01');
INSERT INTO `log` VALUES ('331', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_fine_user_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (168, \'2016-12-01 21:29:45\', \'2016-12-03 16:30:00\', \'47\', \'1\', 9, \'3Me&x#5Q\', \'HSHBFDZ1\', \'b1aWmT#b\', \'&#T29Dz9\', \'\')', '0', '2016-12-01 21:29:45');

-- ----------------------------
-- Table structure for `manager`
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `manager_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manager_user` varchar(255) CHARACTER SET latin1 NOT NULL,
  `manager_pass` varchar(255) CHARACTER SET latin1 NOT NULL,
  `manager_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `manager_phone` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `manager_email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `is_admin` tinyint(2) NOT NULL,
  PRIMARY KEY (`manager_id`,`manager_user`,`manager_phone`,`manager_email`),
  KEY `manager_id` (`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('3', 'munna', '827ccb0eea8a706c4c34a16891f84e7b', 'Mr. Munna', '0987654321', 'asdfasdf@mail.com', '1');

-- ----------------------------
-- Table structure for `publication`
-- ----------------------------
DROP TABLE IF EXISTS `publication`;
CREATE TABLE `publication` (
  `publication_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publication_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`publication_id`,`publication_name`),
  CONSTRAINT `FK1_publication_book` FOREIGN KEY (`publication_id`) REFERENCES `book` (`publication_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of publication
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_pass` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_phone` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `user_email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `user_library_code` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `user_dept` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_roll` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_session` year(4) NOT NULL,
  `is_teacher` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`user_id`,`user_username`,`user_phone`,`user_email`,`user_library_code`),
  KEY `user_id` (`user_id`),
  KEY `user_code` (`user_library_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'rubayet33', '202cb962ac59075b964b07152d234b70', 'Md. Rubayet Hossain', '0987654321', 'rub@ayet.com', '59B11F34CB4F5EF7F6F6BB14E678F08E', 'CSE', '1014', '2009', '0');
INSERT INTO `user` VALUES ('2', 'munna', '827ccb0eea8a706c4c34a16891f84e7b', 'Muntasir Billah', '0987545678', 'mun@na.com', '1234567890', 'CSE', '1057', '2009', '0');
