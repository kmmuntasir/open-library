/*
Navicat MySQL Data Transfer

Source Server         : lampp
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : istedubd_library

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-08-26 19:47:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `author`
-- ----------------------------
DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`author_id`,`author_name`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of author
-- ----------------------------
INSERT INTO `author` VALUES ('1', 'm1', 'Nicholas Sparks', '2018-08-26 19:42:29');

-- ----------------------------
-- Table structure for `book`
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `book_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_url_unlocked` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_deleted` bit(1) NOT NULL DEFAULT b'0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`book_id`),
  KEY `book_id` (`book_id`),
  KEY `FK1_book_publication` (`publication_id`),
  KEY `FK2_book_manager` (`manager_id`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `book_ibfk_2` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES ('1', 'm1', '1234985983', 'A Walk to Remember', 'm1', '2018-08-26 19:42:29', 'IST_LIBRARY_1', '1st', 'New York', '1999', '201', '1', '', '11', '10', '', '1', '', '2018-08-26 19:43:16');

-- ----------------------------
-- Table structure for `book_author`
-- ----------------------------
DROP TABLE IF EXISTS `book_author`;
CREATE TABLE `book_author` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_author_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`book_author_id`),
  KEY `FK1_book_author_author` (`author_id`),
  KEY `FK2_book_author_book` (`book_id`),
  CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `book_author_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_author
-- ----------------------------
INSERT INTO `book_author` VALUES ('2', 'm1', 'm1', 'm1');

-- ----------------------------
-- Table structure for `book_category`
-- ----------------------------
DROP TABLE IF EXISTS `book_category`;
CREATE TABLE `book_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`book_category_id`),
  KEY `FK1_book_category_category` (`category_id`),
  KEY `FK2_book_category_book` (`book_id`),
  CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `book_category_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_category
-- ----------------------------
INSERT INTO `book_category` VALUES ('2', 'm1', 'm1', 'm1');

-- ----------------------------
-- Table structure for `book_copy`
-- ----------------------------
DROP TABLE IF EXISTS `book_copy`;
CREATE TABLE `book_copy` (
  `book_copy_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_copy_accession_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_copy_status` tinyint(1) NOT NULL,
  `book_copy_type` tinyint(1) NOT NULL,
  `book_copy_date` date NOT NULL,
  `book_copy_price` float DEFAULT NULL,
  `book_copy_source` tinyint(1) DEFAULT NULL,
  `book_copy_remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_copy_manager_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_copy_is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_copy_id`,`book_copy_accession_no`),
  KEY `FK1_book_copy_book` (`book_id`),
  KEY `FK2_book_copy_manager` (`book_copy_manager_id`),
  KEY `book_copy_accession_no` (`book_copy_accession_no`),
  CONSTRAINT `book_copy_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `book_copy_ibfk_2` FOREIGN KEY (`book_copy_manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_copy
-- ----------------------------
INSERT INTO `book_copy` VALUES ('1', 'm1', 'm1', '1', '0', '2018-08-26', '1200', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:42:51');
INSERT INTO `book_copy` VALUES ('2', 'm1', 'm1', '1', '1', '2018-08-26', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:43:16');
INSERT INTO `book_copy` VALUES ('3', 'm1', 'm2', '1', '1', '2018-08-26', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:43:16');
INSERT INTO `book_copy` VALUES ('4', 'm1', 'm3', '1', '1', '2018-08-26', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:43:16');
INSERT INTO `book_copy` VALUES ('5', 'm1', 'm4', '1', '1', '2018-08-26', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:43:16');
INSERT INTO `book_copy` VALUES ('6', 'm1', 'm5', '1', '1', '2018-08-26', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:43:16');
INSERT INTO `book_copy` VALUES ('7', 'm1', 'm6', '1', '1', '2018-08-26', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:43:16');
INSERT INTO `book_copy` VALUES ('8', 'm1', 'm7', '1', '1', '2018-08-26', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:43:16');
INSERT INTO `book_copy` VALUES ('9', 'm1', 'm8', '1', '1', '2018-08-26', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:43:16');
INSERT INTO `book_copy` VALUES ('10', 'm1', 'm9', '1', '1', '2018-08-26', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:43:16');
INSERT INTO `book_copy` VALUES ('11', 'm1', 'm10', '1', '1', '2018-08-26', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-08-26 19:43:16');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`category_id`,`category_name`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'm1', 'Novel', '2018-08-26 19:42:29');

-- ----------------------------
-- Table structure for `issue`
-- ----------------------------
DROP TABLE IF EXISTS `issue`;
CREATE TABLE `issue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `issue_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `issue_datetime` datetime NOT NULL,
  `issue_return_datetime` datetime DEFAULT NULL,
  `issue_deadline` datetime DEFAULT NULL,
  `issue_auto_expire_datetime` datetime DEFAULT NULL,
  `issue_book_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `issue_book_copy_accession_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `issue_total_fine` int(11) DEFAULT '0',
  `issue_received_fine` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`,`issue_id`),
  KEY `FK1_issue_book` (`issue_book_id`),
  KEY `FK2_issue_book_copy` (`issue_book_copy_accession_no`),
  KEY `FK3_issue_user` (`user_id`),
  KEY `FK4_issue_manager` (`manager_id`),
  CONSTRAINT `issue_ibfk_1` FOREIGN KEY (`issue_book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `issue_ibfk_2` FOREIGN KEY (`issue_book_copy_accession_no`) REFERENCES `book_copy` (`book_copy_accession_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `issue_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `issue_ibfk_4` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
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
  `log_entry_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `log_query` longtext COLLATE utf8_unicode_ci NOT NULL,
  `log_is_synced` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `log_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`,`log_entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('1', 'm1', 'INSERT INTO `publication` (`publication_name`, `publication_id`) VALUES (\'Sparks Publication\', \'m1\')', '0', '2018-08-26 19:42:29');
INSERT INTO `log` VALUES ('2', 'm2', 'INSERT INTO `book` (`book_title`, `book_isbn`, `publication_id`, `book_edition`, `book_place_of_pub`, `book_year_of_pub`, `book_pages`, `book_status`, `book_url`, `book_url_unlocked`, `book_remarks`, `book_id`, `manager_id`, `book_add_date`) VALUES (\'A walk to remember\', \'\', \'m1\', \'1st\', \'New York\', \'1999\', \'201\', \'1\', \'\', \'1\', \'\', \'m1\', \'IST_LIBRARY_1\', \'2018-08-26 19:42:29\')', '0', '2018-08-26 19:42:29');
INSERT INTO `log` VALUES ('3', 'm3', 'INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'Nicholas Sparks\', \'m1\')', '0', '2018-08-26 19:42:29');
INSERT INTO `log` VALUES ('4', 'm4', 'INSERT INTO `book_author` (`book_author_id`, `book_id`, `author_id`) VALUES (\'m1\', \'m1\', \'m1\')', '0', '2018-08-26 19:42:29');
INSERT INTO `log` VALUES ('5', 'm5', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Novel\', \'m1\')', '0', '2018-08-26 19:42:29');
INSERT INTO `log` VALUES ('6', 'm6', 'INSERT INTO `book_category` (`book_category_id`, `book_id`, `category_id`) VALUES (\'m1\', \'m1\', \'m1\')', '0', '2018-08-26 19:42:29');
INSERT INTO `log` VALUES ('7', 'm7', 'UPDATE `book` SET `book_title` = \'A Walk to Remember\', `book_isbn` = \'1234985983\', `publication_id` = \'m1\', `book_edition` = \'1st\', `book_place_of_pub` = \'New York\', `book_year_of_pub` = \'1999\', `book_pages` = \'201\', `book_status` = \'1\', `book_url` = \'\', `book_url_unlocked` = \'1\', `book_remarks` = \'\' WHERE `book_id` = \'m1\'', '0', '2018-08-26 19:42:45');
INSERT INTO `log` VALUES ('8', 'm8', 'DELETE FROM `book_author` WHERE `book_id` = \'m1\'', '0', '2018-08-26 19:42:45');
INSERT INTO `log` VALUES ('9', 'm9', 'INSERT INTO `book_author` (`book_author_id`, `book_id`, `author_id`) VALUES (\'m1\', \'m1\', \'m1\')', '0', '2018-08-26 19:42:45');
INSERT INTO `log` VALUES ('10', 'm10', 'DELETE FROM `book_category` WHERE `book_id` = \'m1\'', '0', '2018-08-26 19:42:45');
INSERT INTO `log` VALUES ('11', 'm11', 'INSERT INTO `book_category` (`book_category_id`, `book_id`, `category_id`) VALUES (\'m1\', \'m1\', \'m1\')', '0', '2018-08-26 19:42:45');
INSERT INTO `log` VALUES ('12', 'm12', 'INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'m1\',\'2018-08-26\',\'IST_LIBRARY_1\',\'1200\',\'\',\'1\',1,\'0\',\'m1\')', '0', '2018-08-26 19:42:51');
INSERT INTO `log` VALUES ('13', 'm13', 'UPDATE `book` SET `book_stock` = 1 WHERE `book_id` = \'m1\'', '0', '2018-08-26 19:42:51');
INSERT INTO `log` VALUES ('14', 'm14', 'INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'m1\',\'2018-08-26\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'m1\'), (\'m2\',\'2018-08-26\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'m1\'), (\'m3\',\'2018-08-26\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'m1\'), (\'m4\',\'2018-08-26\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'m1\'), (\'m5\',\'2018-08-26\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'m1\'), (\'m6\',\'2018-08-26\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'m1\'), (\'m7\',\'2018-08-26\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'m1\'), (\'m8\',\'2018-08-26\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'m1\'), (\'m9\',\'2018-08-26\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'m1\'), (\'m10\',\'2018-08-26\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'m1\')', '0', '2018-08-26 19:43:16');
INSERT INTO `log` VALUES ('15', 'm15', 'UPDATE `book` SET `book_stock` = 11, `book_available` = 10 WHERE `book_id` = \'m1\'', '0', '2018-08-26 19:43:16');

-- ----------------------------
-- Table structure for `manager`
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manager_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manager_user` varchar(255) CHARACTER SET latin1 NOT NULL,
  `manager_pass` varchar(255) CHARACTER SET latin1 NOT NULL,
  `manager_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `manager_phone` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `manager_email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `is_admin` tinyint(2) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `timestamps` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`manager_id`,`manager_user`,`manager_phone`,`manager_email`),
  KEY `manager_id` (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('1', 'IST_LIBRARY_1', 'admin', '202cb962ac59075b964b07152d234b70', 'Muntasir Billah Munna', '01516180603', 'kmmuntasir@gmail.com', '2', '0', '2018-08-24 02:40:35');
INSERT INTO `manager` VALUES ('3', 'L_2', 'khalil', '202cb962ac59075b964b07152d234b70', 'Khalilullah', '234567', 'khalil@mia.com', '0', '0', '2018-08-20 20:03:36');
INSERT INTO `manager` VALUES ('4', 'L_3', 'salma', '202cb962ac59075b964b07152d234b70', 'Salma', '23455', 'sal@ma.com', '1', '0', '2018-08-20 20:02:55');

-- ----------------------------
-- Table structure for `publication`
-- ----------------------------
DROP TABLE IF EXISTS `publication`;
CREATE TABLE `publication` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `publication_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publication_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`publication_id`,`publication_name`),
  KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of publication
-- ----------------------------
INSERT INTO `publication` VALUES ('1', 'm1', 'Sparks Publication', '2018-08-26 19:42:29');

-- ----------------------------
-- Table structure for `server`
-- ----------------------------
DROP TABLE IF EXISTS `server`;
CREATE TABLE `server` (
  `server_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `server_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `server_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `server_last_connection` datetime NOT NULL,
  `server_status` tinyint(1) NOT NULL,
  `server_sync_status` tinyint(1) NOT NULL,
  `server_access_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of server
-- ----------------------------
INSERT INTO `server` VALUES ('1', 'remote', 'http://localhost/library.ist.edu.bd_online/index.php', '2018-03-31 01:06:52', '1', '1', 'HF1EBAvrgB');

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `server_access_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `issue_deadline` smallint(6) unsigned NOT NULL,
  `issue_auto_expire_deadline` smallint(5) unsigned NOT NULL,
  `issue_fine_per_day` smallint(5) unsigned NOT NULL,
  `currency_before` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_after` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `application_role` tinyint(1) NOT NULL DEFAULT '0',
  `institute_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Your School Name',
  `institute_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `institute_favicon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `institute_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Your School Address',
  `institute_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'admin@yourschool.edu',
  `institute_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Your School Phone',
  `app_installed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'HF1EBAvrgB', '15', '2', '2', 'BDT ', '/=', '0', 'Institute of Science and Technology', 'd9b968f458576bc4302a76fb7ff68c4c.png', 'c47e97c062d1c304619ef00a915e11fe.ico', 'House #54, Road #15/A, Dhanmondi, Dhaka-1209', 'info@ist.edu.bd', '01711223344', '1');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_pass` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_phone` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `user_email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `user_library_code` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `user_dept` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_roll` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_session` year(4) NOT NULL,
  `is_teacher` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `teacher_id` int(11) unsigned NOT NULL DEFAULT '0',
  `teacher_designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_password_reset_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`user_id`,`user_username`,`user_phone`,`user_email`,`user_library_code`,`teacher_id`,`user_roll`,`user_password_reset_code`),
  UNIQUE KEY `user_id` (`user_id`) USING BTREE,
  UNIQUE KEY `user_username` (`user_username`) USING BTREE,
  UNIQUE KEY `user_library_code` (`user_library_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
