/*
Navicat MySQL Data Transfer

Source Server         : lamp_stack
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : istbd_library

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-03-29 23:22:29
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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of author
-- ----------------------------
INSERT INTO `author` VALUES ('4', 'IST_LIBRARY_2', 'W. A. Triebel', '2018-03-28 19:36:04');
INSERT INTO `author` VALUES ('5', 'IST_LIBRARY_3', 'E. Balagurusamy', '2018-03-28 19:36:04');
INSERT INTO `author` VALUES ('6', 'IST_LIBRARY_4', 'Seymour Lipschutz', '2018-03-28 19:36:04');
INSERT INTO `author` VALUES ('50', 'IST_LIBRARY_5', 'Ahmed Shamsul Arefin', '2018-03-28 19:36:04');
INSERT INTO `author` VALUES ('52', 'L_6', 'মুহম্মদ জাফর ইকবাল', '2018-03-28 19:36:04');
INSERT INTO `author` VALUES ('53', 'L_7', 'আফসার-উজ-জামান', '2018-03-28 19:36:04');
INSERT INTO `author` VALUES ('54', 'L_8', 'Avtar Singh', '2018-03-28 19:36:04');
INSERT INTO `author` VALUES ('56', 'L_10', 'Udit Acharya', '2018-03-28 19:36:04');
INSERT INTO `author` VALUES ('57', 'L_11', 'Abraham Silberschatz', '2018-03-28 19:36:04');
INSERT INTO `author` VALUES ('58', 'L_12', 'Henry F. Korth', '2018-03-28 19:36:04');
INSERT INTO `author` VALUES ('59', 'L_13', 'S. Sudarshan', '2018-03-28 19:36:04');

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
  PRIMARY KEY (`id`,`book_id`,`book_isbn`),
  KEY `book_id` (`book_id`),
  KEY `FK1_book_publication` (`publication_id`),
  KEY `FK2_book_manager` (`manager_id`),
  CONSTRAINT `FK1_book_publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_book_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES ('34', 'IST_LIBRARY_2', '8676543234676', 'Programming in ANSI C', 'IST_LIBRARY_2', '2016-12-21 18:41:30', 'IST_LIBRARY_1', '4th', 'Delhi, India', '2011', '245', '1', '', '11', '10', 'https://books.google.com.bd/books?id=AokcsKn-1iIC&lpg=PP1&pg=PP1&output=embed', '0', '', '2018-03-28 19:42:17');
INSERT INTO `book` VALUES ('35', 'IST_3', '12345', 'Art of Programming Contest', 'IST_LIBRARY_4', '2016-12-21 20:11:47', 'IST_LIBRARY_1', '1st', 'Dhaka, Bangladesh', '2009', '195', '1', '', '16', '15', 'https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf', '0', '', '2018-03-28 19:42:17');
INSERT INTO `book` VALUES ('36', 'L_4', '2358094', 'টাইট্রন একটি গ্রহের নাম', 'L_5', '2016-12-21 23:48:54', 'IST_LIBRARY_1', '1st', 'Dhaka, Bangladesh', '2001', '68', '1', '', '7', '6', 'http://download848.mediafire.com/mnocrzt5i9zg/bdoj3r01q09db5k/Titron+Ekti+Groher+Naam+%28allbdbooks.com%29.PDF', '0', '', '2018-03-28 19:42:17');
INSERT INTO `book` VALUES ('37', 'L_5', 'uiy6756gh', 'উচ্চ মাধ্যমিক জ্যামিতি ও ক্যালকুলাস', 'L_5', '2016-12-21 23:50:17', 'IST_LIBRARY_1', '2nd', 'Dhaka, Bangladesh', '2011', '298', '1', '', '6', '5', null, '1', '', '2018-03-28 19:42:17');
INSERT INTO `book` VALUES ('38', 'L_6', 'jkluio789023jod', 'The 8088 and 8086 Microprocessor System', 'IST_LIBRARY_3', '2016-12-21 23:52:48', 'IST_LIBRARY_1', '3rd', 'New Delhi', '2004', '593', '1', '', '3', '2', null, '1', '', '2018-03-29 23:20:42');
INSERT INTO `book` VALUES ('39', 'L_7', '39dkdk', 'Bangla Grammar', 'L_7', '2016-12-21 23:54:28', 'IST_LIBRARY_1', '1st', 'Dhaka, Bangladesh', '2000', '198', '1', '', '10', '9', null, '1', '', '2018-03-29 02:38:24');
INSERT INTO `book` VALUES ('43', 'L_8', '978-0073523323', 'Database System Concepts', 'L_7', '2017-12-23 13:07:08', 'IST_LIBRARY_1', '6th', 'Yale', '2006', '678', '1', '', '1', '0', '', '1', '', '2018-03-28 23:13:47');

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
  CONSTRAINT `FK1_book_author_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_book_author_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_author
-- ----------------------------
INSERT INTO `book_author` VALUES ('39', '', 'L_5', 'L_7');
INSERT INTO `book_author` VALUES ('40', '', 'L_6', 'IST_LIBRARY_2');
INSERT INTO `book_author` VALUES ('41', '', 'L_6', 'L_8');
INSERT INTO `book_author` VALUES ('47', '', 'L_7', 'L_10');
INSERT INTO `book_author` VALUES ('64', '', 'IST_LIBRARY_2', 'IST_LIBRARY_3');
INSERT INTO `book_author` VALUES ('65', '', 'L_4', 'L_6');
INSERT INTO `book_author` VALUES ('66', '', 'L_8', 'L_11');
INSERT INTO `book_author` VALUES ('67', '', 'L_8', 'L_12');
INSERT INTO `book_author` VALUES ('68', '', 'L_8', 'L_13');
INSERT INTO `book_author` VALUES ('69', '', 'IST_3', 'IST_LIBRARY_5');
INSERT INTO `book_author` VALUES ('70', '', 'IST_3', 'L_10');

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
  CONSTRAINT `FK1_book_category_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_book_category_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_category
-- ----------------------------
INSERT INTO `book_category` VALUES ('82', '', 'L_5', 'L_8');
INSERT INTO `book_category` VALUES ('83', '', 'L_5', 'L_9');
INSERT INTO `book_category` VALUES ('84', '', 'L_6', 'L_10');
INSERT INTO `book_category` VALUES ('85', '', 'L_6', 'IST_LIBRARY_2');
INSERT INTO `book_category` VALUES ('86', '', 'L_6', 'IST_LIBRARY_1');
INSERT INTO `book_category` VALUES ('92', '', 'L_7', 'L_11');
INSERT INTO `book_category` VALUES ('124', '', 'IST_LIBRARY_2', 'IST_LIBRARY_1');
INSERT INTO `book_category` VALUES ('125', '', 'IST_LIBRARY_2', 'IST_LIBRARY_2');
INSERT INTO `book_category` VALUES ('126', '', 'IST_LIBRARY_2', 'IST_LIBRARY_4');
INSERT INTO `book_category` VALUES ('127', '', 'IST_LIBRARY_2', 'L_15');
INSERT INTO `book_category` VALUES ('128', '', 'L_4', 'L_6');
INSERT INTO `book_category` VALUES ('129', '', 'L_4', 'L_7');
INSERT INTO `book_category` VALUES ('130', '', 'L_4', 'L_15');
INSERT INTO `book_category` VALUES ('131', '', 'L_8', 'L_12');
INSERT INTO `book_category` VALUES ('132', '', 'L_8', 'IST_LIBRARY_4');
INSERT INTO `book_category` VALUES ('133', '', 'L_8', 'IST_LIBRARY_1');
INSERT INTO `book_category` VALUES ('134', '', 'L_8', 'L_15');
INSERT INTO `book_category` VALUES ('135', '', 'IST_3', 'IST_LIBRARY_1');
INSERT INTO `book_category` VALUES ('136', '', 'IST_3', 'IST_LIBRARY_2');
INSERT INTO `book_category` VALUES ('137', '', 'IST_3', 'L_15');

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
  CONSTRAINT `FK1_book_copy_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_book_copy_manager` FOREIGN KEY (`book_copy_manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_copy
-- ----------------------------
INSERT INTO `book_copy` VALUES ('5', 'IST_LIBRARY_2', 'IST_c_5', '1', '0', '2016-12-21', '93', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('26', 'IST_LIBRARY_2', 'IST_c_26', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('27', 'IST_LIBRARY_2', 'IST_c_27', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('28', 'IST_LIBRARY_2', 'IST_c_28', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('29', 'IST_LIBRARY_2', 'IST_c_29', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('30', 'IST_LIBRARY_2', 'IST_c_30', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('31', 'IST_LIBRARY_2', 'IST_c_31', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('32', 'IST_LIBRARY_2', 'IST_c_32', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('33', 'IST_LIBRARY_2', 'IST_c_33', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('34', 'IST_LIBRARY_2', 'IST_c_34', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('35', 'IST_LIBRARY_2', 'IST_c_35', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('36', 'IST_3', 'IST_c_36', '1', '0', '2016-12-21', '90', '1', 'Original Copy from the Publisher, Hard Cover Binding', 'IST_LIBRARY_1', '0', '2018-03-28 19:50:47');
INSERT INTO `book_copy` VALUES ('37', 'IST_3', 'IST_c_37', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('38', 'IST_3', 'IST_c_38', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('39', 'IST_3', 'IST_c_39', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('40', 'IST_3', 'IST_c_40', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('41', 'IST_3', 'IST_c_41', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('42', 'IST_3', 'IST_c_42', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('43', 'IST_3', 'IST_c_43', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('44', 'IST_3', 'IST_c_44', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('45', 'IST_3', 'IST_c_45', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('46', 'IST_3', 'IST_c_46', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('47', 'IST_3', 'IST_c_47', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('48', 'IST_3', 'IST_c_48', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('49', 'IST_3', 'IST_c_49', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('50', 'IST_3', 'IST_c_50', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('51', 'IST_3', 'IST_c_51', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('52', 'L_4', 'L_c_52', '1', '0', '2016-12-21', '50', '1', '', 'IST_LIBRARY_1', '1', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('53', 'L_4', 'L_c_53', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('54', 'L_4', 'L_c_54', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('55', 'L_4', 'L_c_55', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '1', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('56', 'L_4', 'L_c_56', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('57', 'L_4', 'L_c_57', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('58', 'L_4', 'L_c_58', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('59', 'L_4', 'L_c_59', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('60', 'L_5', 'L_c_60', '1', '0', '2016-12-21', '80', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('61', 'L_5', 'L_c_61', '1', '1', '2016-12-21', '72', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('62', 'L_5', 'L_c_62', '1', '1', '2016-12-21', '72', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('63', 'L_5', 'L_c_63', '1', '1', '2016-12-21', '72', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('64', 'L_5', 'L_c_64', '1', '1', '2016-12-21', '72', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('65', 'L_5', 'L_c_65', '1', '1', '2016-12-21', '72', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('66', 'L_6', 'L_c_66', '1', '0', '2016-12-21', '430', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('67', 'L_6', 'L_c_67', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('68', 'L_6', 'L_c_68', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('69', 'L_6', 'L_c_69', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '1', '2018-03-29 18:58:36');
INSERT INTO `book_copy` VALUES ('70', 'L_6', 'L_c_70', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '1', '2018-03-29 18:58:36');
INSERT INTO `book_copy` VALUES ('71', 'L_6', 'L_c_71', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '1', '2018-03-29 18:58:36');
INSERT INTO `book_copy` VALUES ('72', 'L_6', 'L_c_72', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '1', '2018-03-29 18:58:36');
INSERT INTO `book_copy` VALUES ('73', 'L_6', 'L_c_73', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '1', '2018-03-29 18:58:36');
INSERT INTO `book_copy` VALUES ('74', 'L_6', 'L_c_74', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '1', '2018-03-29 18:58:36');
INSERT INTO `book_copy` VALUES ('75', 'L_6', 'L_c_75', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '1', '2018-03-29 18:58:36');
INSERT INTO `book_copy` VALUES ('86', 'L_7', 'L_c_86', '1', '0', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('87', 'L_7', 'L_c_87', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('88', 'L_7', 'L_c_88', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('89', 'L_7', 'L_c_89', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('90', 'L_7', 'L_c_90', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('91', 'L_7', 'L_c_91', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('92', 'L_7', 'L_c_92', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('93', 'L_7', 'L_c_93', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('94', 'L_7', 'L_c_94', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('95', 'L_7', 'L_c_95', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('116', 'L_8', 'L_c_96', '1', '0', '2017-12-23', '1200', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('117', 'L_8', 'L_c_97', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('118', 'L_8', 'L_c_98', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('119', 'L_8', 'L_c_99', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('120', 'L_8', 'L_c_100', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('121', 'L_8', 'L_c_101', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('122', 'L_8', 'L_c_102', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('123', 'L_8', 'L_c_103', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('124', 'L_8', 'L_c_104', '1', '1', '2017-12-23', '100', '1', '', 'IST_LIBRARY_1', '1', '2018-03-28 19:35:15');
INSERT INTO `book_copy` VALUES ('125', 'L_4', 'L_c_105', '1', '0', '2018-03-15', '120', '1', '', 'IST_LIBRARY_1', '0', '2018-03-28 19:35:15');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'IST_LIBRARY_1', 'Computer', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('2', 'IST_LIBRARY_2', 'Programming', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('4', 'IST_LIBRARY_3', 'Programming Contest', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('5', 'IST_LIBRARY_4', 'CSE Course', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('6', 'IST_LIBRARY_5', 'Bangla Programming', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('8', 'L_6', 'Science Fiction', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('9', 'L_7', 'Novel', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('10', 'L_8', 'Mathematics', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('11', 'L_9', 'H.S.C Books', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('12', 'L_10', 'Microprocessor', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('13', 'L_11', 'Test Category', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('14', 'L_12', 'Database', '2018-03-28 19:38:16');
INSERT INTO `category` VALUES ('24', 'L_15', 'Merge Category 3', '2018-03-29 01:56:28');

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
  CONSTRAINT `FK1_issue_book` FOREIGN KEY (`issue_book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_issue_book_copy` FOREIGN KEY (`issue_book_copy_accession_no`) REFERENCES `book_copy` (`book_copy_accession_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK3_issue_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK4_issue_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of issue
-- ----------------------------
INSERT INTO `issue` VALUES ('22', 'L_1', '2018-01-01 15:35:04', '2018-03-14 15:36:18', '2018-02-01 16:30:00', null, 'IST_3', 'IST_c_37', 'IST_1', 'IST_LIBRARY_1', '3', '#ZPReea3', 'cCLshL7s', 'mslQDI4W', 'aJMkObY$', 'IT0KX2uZ', 'V@JY9b2L', '', '820', '820');
INSERT INTO `issue` VALUES ('23', 'L_2', '2018-01-01 15:35:04', '2018-03-14 15:36:36', '2018-02-01 16:30:00', null, 'IST_LIBRARY_2', 'IST_c_27', 'IST_1', 'IST_LIBRARY_1', '3', 'f&U#ftZ2', 'DUi8dpVJ', '$JFRZwyI', '0GhMTyuw', 'NICW5&WX', 'y7ts1HoZ', '', '82', '82');
INSERT INTO `issue` VALUES ('24', 'L_3', '2018-03-01 13:03:25', null, null, '2018-03-05 16:30:00', 'IST_3', null, 'IST_1', null, '8', 'ibVRONu#', 'MPEMADPu', '$#BdY0Je', 'nfTEeMnv', 'ZfuEtpfR', 'zvlqnqc0', '', '0', '0');
INSERT INTO `issue` VALUES ('25', 'L_4', '2018-03-15 13:03:36', null, null, '2018-03-17 16:30:00', 'L_5', null, 'IST_1', null, '8', 'UhMhXK@s', 'aUAVUxZj', 'SVdp3$aI', 'QlSNAdWw', 'Fj2rGiRP', '6knQFOul', '', '0', '0');
INSERT INTO `issue` VALUES ('26', 'L_5', '2018-03-15 13:08:03', '2018-03-20 03:33:32', '2018-03-30 16:30:00', null, 'IST_LIBRARY_2', 'IST_c_27', 'IST_1', 'IST_LIBRARY_1', '3', 'M@hoC8NW', 'GBnN274D', 'KauFTsmR', 'KUrRPa59', 'MhZey44&', 'QaqqOw3G', '', '0', '0');
INSERT INTO `issue` VALUES ('27', 'L_6', '2018-01-01 13:08:30', '2018-03-15 13:10:29', '2018-02-01 16:30:00', null, 'L_4', 'L_c_57', 'IST_1', 'IST_LIBRARY_1', '3', 'TvBcwlAY', 'rJIGEhT$', 'w$X3obxR', 'B%Yn95#L', 't$3dK0oi', 'U&YMVlYK', '', '84', '84');
INSERT INTO `issue` VALUES ('28', 'L_7', '2018-01-01 13:08:30', '2018-03-20 03:33:46', '2018-02-01 16:30:00', null, 'L_7', 'L_c_91', 'IST_1', 'IST_LIBRARY_1', '3', '071tC1s#', 'YgwAbYat', 'PPnnKRlV', 'Kvw19jA2', 'LzYuh%L%', 'xu6tQZHx', '', '94', '94');
INSERT INTO `issue` VALUES ('29', 'L_8', '2018-03-15 14:51:28', null, null, '2018-03-17 16:30:00', 'L_6', null, 'IST_1', null, '8', 'MfE$Ga4#', 'eXpPZxnX', 'ICb&hwu9', 'bgiO4EVV', 'L2Czy3Q#', 'ZC0WAeou', '', '0', '0');
INSERT INTO `issue` VALUES ('31', 'L_9', '2018-03-20 03:33:15', '2018-03-20 03:33:27', '2018-04-04 16:30:00', '2018-03-22 16:30:00', 'L_5', 'L_c_61', 'IST_1', 'IST_LIBRARY_1', '3', 'eLHAqFlz', '%k6sv3%&', '79EHielX', 'BfFDzlj9', 'pW6&WKM1', 'oab0NgcS', '', '0', '0');
INSERT INTO `issue` VALUES ('32', 'L_10', '2018-03-20 03:52:24', null, null, '2018-03-22 16:30:00', 'IST_3', null, 'IST_1', null, '8', 'gqga9HPe', 'SZ3aB#b%', 'ndXXk61F', 'A1WHFvi#', 'k3bdjwrr', 'Wz9LkkB9', '', '0', '0');
INSERT INTO `issue` VALUES ('33', 'L_11', '2018-03-20 03:58:09', '2018-03-20 04:02:24', '2018-04-04 16:30:00', null, 'L_5', 'L_c_61', 'IST_1', 'IST_LIBRARY_1', '3', 'lup0tDIT', 'MFw#ghE9', 'bCjMmna&', '%hW#U6s#', 'WRtT1JmV', 'RPqXK@eo', '', '0', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=561 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('277', 'L_1', 'UPDATE `book` SET `book_title` = \'Art of Programming Contestt\', `book_isbn` = \'12345\', `publication_id` = \'IST_LIBRARY_4\', `book_edition` = \'1st\', `book_place_of_pub` = \'Dhaka, Bangladesh\', `book_year_of_pub` = \'2009\', `book_pages` = \'195\', `book_status` = \'1\', `book_url` = \'https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'IST_3\'', '1', '2018-03-20 03:51:37');
INSERT INTO `log` VALUES ('278', 'L_278', 'DELETE FROM `book_author` WHERE `book_id` = \'IST_3\'', '1', '2018-03-20 03:51:37');
INSERT INTO `log` VALUES ('279', 'L_279', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'IST_LIBRARY_5\',\'IST_3\')', '1', '2018-03-20 03:51:37');
INSERT INTO `log` VALUES ('280', 'L_280', 'DELETE FROM `book_category` WHERE `book_id` = \'IST_3\'', '1', '2018-03-20 03:51:37');
INSERT INTO `log` VALUES ('281', 'L_281', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'IST_3\',\'IST_LIBRARY_1\'), (\'IST_3\',\'IST_LIBRARY_2\')', '1', '2018-03-20 03:51:37');
INSERT INTO `log` VALUES ('282', 'L_282', 'UPDATE `book` SET `book_title` = \'Art of Programming Contest\', `book_isbn` = \'12345\', `publication_id` = \'IST_LIBRARY_4\', `book_edition` = \'1st\', `book_place_of_pub` = \'Dhaka, Bangladesh\', `book_year_of_pub` = \'2009\', `book_pages` = \'195\', `book_status` = \'1\', `book_url` = \'https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'IST_3\'', '1', '2018-03-20 03:51:58');
INSERT INTO `log` VALUES ('283', 'L_283', 'DELETE FROM `book_author` WHERE `book_id` = \'IST_3\'', '1', '2018-03-20 03:51:58');
INSERT INTO `log` VALUES ('284', 'L_284', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'IST_LIBRARY_5\',\'IST_3\')', '1', '2018-03-20 03:51:58');
INSERT INTO `log` VALUES ('285', 'L_285', 'DELETE FROM `book_category` WHERE `book_id` = \'IST_3\'', '1', '2018-03-20 03:51:58');
INSERT INTO `log` VALUES ('286', 'L_286', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'IST_3\',\'IST_LIBRARY_1\'), (\'IST_3\',\'IST_LIBRARY_2\')', '1', '2018-03-20 03:51:58');
INSERT INTO `log` VALUES ('287', 'L_287', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_10\', \'2018-03-20 03:52:24\', \'2018-03-22 16:30:00\', \'IST_3\', \'IST_1\', 9, \'gqga9HPe\', \'SZ3aB#b%\', \'ndXXk61F\', \'A1WHFvi#\', \'k3bdjwrr\', \'Wz9LkkB9\', \'\')', '1', '2018-03-20 03:52:24');
INSERT INTO `log` VALUES ('288', 'L_288', 'UPDATE `book` SET `book_id` = \'IST_3\', `book_available` = 14 WHERE `book_id` = \'IST_3\'', '1', '2018-03-20 03:52:26');
INSERT INTO `log` VALUES ('289', 'L_289', 'UPDATE `issue` SET `issue_id` = \'L_10\', `issue_status` = 0 WHERE `issue_id` = \'L_10\'', '1', '2018-03-20 03:52:26');
INSERT INTO `log` VALUES ('290', 'L_290', 'UPDATE `book` SET `book_available` = 4 WHERE `book_id` = \'L_5\'', '1', '2018-03-20 03:58:09');
INSERT INTO `log` VALUES ('291', 'L_291', 'UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_61\'', '1', '2018-03-20 03:58:09');
INSERT INTO `log` VALUES ('292', 'L_292', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_11\', \'2018-03-20 03:58:09\', \'2018-04-04 16:30:00\', \'L_5\', \'L_c_61\', \'IST_1\', \'IST_LIBRARY_1\', 1, \'lup0tDIT\', \'MFw#ghE9\', \'bCjMmna&\', \'%hW#U6s#\', \'WRtT1JmV\', \'RPqXK@eo\', \'\')', '1', '2018-03-20 03:58:10');
INSERT INTO `log` VALUES ('293', 'L_293', 'UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 5 WHERE `book_id` = \'L_5\'', '1', '2018-03-20 04:02:24');
INSERT INTO `log` VALUES ('294', 'L_294', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_61\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_61\'', '1', '2018-03-20 04:02:24');
INSERT INTO `log` VALUES ('295', 'L_295', 'UPDATE `issue` SET `issue_id` = \'L_11\', `issue_status` = 3, `issue_return_datetime` = \'2018-03-20 04:02:24\' WHERE `issue_id` = \'L_11\'', '1', '2018-03-20 04:02:24');
INSERT INTO `log` VALUES ('296', 'L_296', 'UPDATE `book` SET `book_id` = \'IST_3\', `book_available` = 15 WHERE `book_id` = \'IST_3\'', '1', '2018-03-27 21:11:55');
INSERT INTO `log` VALUES ('297', 'L_297', 'UPDATE `issue` SET `issue_id` = \'L_10\', `issue_status` = 8 WHERE `issue_id` = \'L_10\'', '1', '2018-03-27 21:11:55');
INSERT INTO `log` VALUES ('298', 'L_298', 'INSERT INTO `manager` (`manager_name`, `manager_phone`, `manager_email`, `manager_user`, `manager_id`, `manager_pass`) VALUES (\'Farjana Boby\', \'123465789\', \'boby@bob.com\', \'boby\', \'L_5\', \'202cb962ac59075b964b07152d234b70\')', '1', '2018-03-27 22:36:58');
INSERT INTO `log` VALUES ('299', 'L_299', 'UPDATE `manager` SET `is_deleted` = 1, `manager_user` = \'\' WHERE `manager_id` = \'L_5\'', '1', '2018-03-27 22:38:36');
INSERT INTO `log` VALUES ('300', 'L_300', 'UPDATE `manager` SET `is_deleted` = 1 WHERE `manager_id` = \'L_5\'', '1', '2018-03-27 22:42:54');
INSERT INTO `log` VALUES ('301', 'L_301', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Databasee\', \'L_13\')', '1', '2018-03-27 23:16:41');
INSERT INTO `log` VALUES ('302', 'L_302', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-27 23:16:51');
INSERT INTO `log` VALUES ('303', 'L_303', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Databasee\', \'L_13\')', '1', '2018-03-27 23:17:06');
INSERT INTO `log` VALUES ('304', 'L_304', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'\', \'L_14\')', '1', '2018-03-27 23:18:17');
INSERT INTO `log` VALUES ('305', 'L_305', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-27 23:18:22');
INSERT INTO `log` VALUES ('306', 'L_306', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-27 23:19:10');
INSERT INTO `log` VALUES ('307', 'L_307', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'fasdf\', \'L_13\')', '1', '2018-03-27 23:19:14');
INSERT INTO `log` VALUES ('308', 'L_308', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-27 23:19:18');
INSERT INTO `log` VALUES ('309', 'L_309', 'UPDATE `book` SET `book_title` = \'Programming in ANSI C\', `book_isbn` = \'8676543234676\', `publication_id` = \'IST_LIBRARY_2\', `book_edition` = \'4th\', `book_place_of_pub` = \'Delhi, India\', `book_year_of_pub` = \'2011\', `book_pages` = \'245\', `book_status` = \'1\', `book_url` = \'https://books.google.com.bd/books?id=AokcsKn-1iIC&lpg=PP1&pg=PP1&output=embed\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2018-03-27 23:28:14');
INSERT INTO `log` VALUES ('310', 'L_310', 'DELETE FROM `book_author` WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2018-03-27 23:28:14');
INSERT INTO `log` VALUES ('311', 'L_311', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'IST_LIBRARY_3\',\'IST_LIBRARY_2\')', '1', '2018-03-27 23:28:14');
INSERT INTO `log` VALUES ('312', 'L_312', 'DELETE FROM `book_category` WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2018-03-27 23:28:14');
INSERT INTO `log` VALUES ('313', 'L_313', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'IST_LIBRARY_2\',\'IST_LIBRARY_1\'), (\'IST_LIBRARY_2\',\'IST_LIBRARY_2\'), (\'IST_LIBRARY_2\',\'IST_LIBRARY_4\')', '1', '2018-03-27 23:28:14');
INSERT INTO `log` VALUES ('314', 'L_314', 'UPDATE `book` SET `book_title` = \'টাইট্রন একটি গ্রহের নাম\', `book_isbn` = \'2358094\', `publication_id` = \'L_5\', `book_edition` = \'1st\', `book_place_of_pub` = \'Dhaka, Bangladesh\', `book_year_of_pub` = \'2001\', `book_pages` = \'68\', `book_status` = \'1\', `book_url` = \'http://download848.mediafire.com/mnocrzt5i9zg/bdoj3r01q09db5k/Titron+Ekti+Groher+Naam+%28allbdbooks.com%29.PDF\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'L_4\'', '1', '2018-03-27 23:28:23');
INSERT INTO `log` VALUES ('315', 'L_315', 'DELETE FROM `book_author` WHERE `book_id` = \'L_4\'', '1', '2018-03-27 23:28:23');
INSERT INTO `log` VALUES ('316', 'L_316', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_6\',\'L_4\')', '1', '2018-03-27 23:28:23');
INSERT INTO `log` VALUES ('317', 'L_317', 'DELETE FROM `book_category` WHERE `book_id` = \'L_4\'', '1', '2018-03-27 23:28:23');
INSERT INTO `log` VALUES ('318', 'L_318', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_4\',\'L_6\'), (\'L_4\',\'L_7\')', '1', '2018-03-27 23:28:23');
INSERT INTO `log` VALUES ('319', 'L_319', 'UPDATE `book` SET `book_title` = \'টাইট্রন একটি গ্রহের নাম\', `book_isbn` = \'2358094\', `publication_id` = \'L_5\', `book_edition` = \'1st\', `book_place_of_pub` = \'Dhaka, Bangladesh\', `book_year_of_pub` = \'2001\', `book_pages` = \'68\', `book_status` = \'1\', `book_url` = \'http://download848.mediafire.com/mnocrzt5i9zg/bdoj3r01q09db5k/Titron+Ekti+Groher+Naam+%28allbdbooks.com%29.PDF\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'L_4\'', '1', '2018-03-27 23:28:24');
INSERT INTO `log` VALUES ('320', 'L_320', 'DELETE FROM `book_author` WHERE `book_id` = \'L_4\'', '1', '2018-03-27 23:28:24');
INSERT INTO `log` VALUES ('321', 'L_321', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_6\',\'L_4\')', '1', '2018-03-27 23:28:24');
INSERT INTO `log` VALUES ('322', 'L_322', 'DELETE FROM `book_category` WHERE `book_id` = \'L_4\'', '1', '2018-03-27 23:28:24');
INSERT INTO `log` VALUES ('323', 'L_323', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_4\',\'L_6\'), (\'L_4\',\'L_7\')', '1', '2018-03-27 23:28:24');
INSERT INTO `log` VALUES ('324', 'L_324', 'INSERT INTO `publication` (`publication_name`, `publication_id`) VALUES (\'Test Publisherr\', \'L_8\')', '1', '2018-03-27 23:31:20');
INSERT INTO `log` VALUES ('325', 'L_325', 'DELETE FROM `publication` WHERE `publication_id` = \'L_8\'', '1', '2018-03-27 23:31:24');
INSERT INTO `log` VALUES ('326', 'L_326', 'UPDATE `book_copy` SET `book_copy_type` = \'0\', `book_copy_remarks` = \'Original Copy from the Publisher, Hard Cover Binding\' WHERE `book_copy_accession_no` = \'IST_c_36\'', '1', '2018-03-28 19:50:47');
INSERT INTO `log` VALUES ('327', 'L_327', 'UPDATE `book` SET `book_title` = \'Art of Programming Contest\', `book_isbn` = \'12345\', `publication_id` = \'IST_LIBRARY_4\', `book_edition` = \'1st\', `book_place_of_pub` = \'Dhaka, Bangladesh\', `book_year_of_pub` = \'2009\', `book_pages` = \'195\', `book_status` = \'1\', `book_url` = \'https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'IST_3\'', '1', '2018-03-28 23:13:25');
INSERT INTO `log` VALUES ('328', 'L_328', 'DELETE FROM `book_author` WHERE `book_id` = \'IST_3\'', '1', '2018-03-28 23:13:25');
INSERT INTO `log` VALUES ('329', 'L_329', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'IST_LIBRARY_5\',\'IST_3\')', '1', '2018-03-28 23:13:25');
INSERT INTO `log` VALUES ('330', 'L_330', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Merge Category 1\', \'L_13\')', '1', '2018-03-28 23:13:25');
INSERT INTO `log` VALUES ('331', 'L_331', 'DELETE FROM `book_category` WHERE `book_id` = \'IST_3\'', '1', '2018-03-28 23:13:25');
INSERT INTO `log` VALUES ('332', 'L_332', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'IST_3\',\'IST_LIBRARY_1\'), (\'IST_3\',\'IST_LIBRARY_2\'), (\'IST_3\',\'L_13\')', '1', '2018-03-28 23:13:25');
INSERT INTO `log` VALUES ('333', 'L_333', 'UPDATE `book` SET `book_title` = \'Programming in ANSI C\', `book_isbn` = \'8676543234676\', `publication_id` = \'IST_LIBRARY_2\', `book_edition` = \'4th\', `book_place_of_pub` = \'Delhi, India\', `book_year_of_pub` = \'2011\', `book_pages` = \'245\', `book_status` = \'1\', `book_url` = \'https://books.google.com.bd/books?id=AokcsKn-1iIC&lpg=PP1&pg=PP1&output=embed\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2018-03-28 23:13:31');
INSERT INTO `log` VALUES ('334', 'L_334', 'DELETE FROM `book_author` WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2018-03-28 23:13:31');
INSERT INTO `log` VALUES ('335', 'L_335', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'IST_LIBRARY_3\',\'IST_LIBRARY_2\')', '1', '2018-03-28 23:13:32');
INSERT INTO `log` VALUES ('336', 'L_336', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Merge Category 2\', \'L_14\')', '1', '2018-03-28 23:13:32');
INSERT INTO `log` VALUES ('337', 'L_337', 'DELETE FROM `book_category` WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2018-03-28 23:13:32');
INSERT INTO `log` VALUES ('338', 'L_338', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'IST_LIBRARY_2\',\'IST_LIBRARY_1\'), (\'IST_LIBRARY_2\',\'IST_LIBRARY_2\'), (\'IST_LIBRARY_2\',\'IST_LIBRARY_4\'), (\'IST_LIBRARY_2\',\'L_14\')', '1', '2018-03-28 23:13:32');
INSERT INTO `log` VALUES ('339', 'L_339', 'UPDATE `book` SET `book_title` = \'টাইট্রন একটি গ্রহের নাম\', `book_isbn` = \'2358094\', `publication_id` = \'L_5\', `book_edition` = \'1st\', `book_place_of_pub` = \'Dhaka, Bangladesh\', `book_year_of_pub` = \'2001\', `book_pages` = \'68\', `book_status` = \'1\', `book_url` = \'http://download848.mediafire.com/mnocrzt5i9zg/bdoj3r01q09db5k/Titron+Ekti+Groher+Naam+%28allbdbooks.com%29.PDF\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'L_4\'', '1', '2018-03-28 23:13:38');
INSERT INTO `log` VALUES ('340', 'L_340', 'DELETE FROM `book_author` WHERE `book_id` = \'L_4\'', '1', '2018-03-28 23:13:38');
INSERT INTO `log` VALUES ('341', 'L_341', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_6\',\'L_4\')', '1', '2018-03-28 23:13:38');
INSERT INTO `log` VALUES ('342', 'L_342', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Merge Category 3\', \'L_15\')', '1', '2018-03-28 23:13:38');
INSERT INTO `log` VALUES ('343', 'L_343', 'DELETE FROM `book_category` WHERE `book_id` = \'L_4\'', '1', '2018-03-28 23:13:38');
INSERT INTO `log` VALUES ('344', 'L_344', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_4\',\'L_6\'), (\'L_4\',\'L_7\'), (\'L_4\',\'L_15\')', '1', '2018-03-28 23:13:38');
INSERT INTO `log` VALUES ('345', 'L_345', 'UPDATE `book` SET `book_title` = \'Database System Concepts\', `book_isbn` = \'978-0073523323\', `publication_id` = \'L_7\', `book_edition` = \'6th\', `book_place_of_pub` = \'Yale\', `book_year_of_pub` = \'2006\', `book_pages` = \'678\', `book_status` = \'1\', `book_url` = \'\', `book_url_unlocked` = \'1\', `book_remarks` = \'\' WHERE `book_id` = \'L_8\'', '1', '2018-03-28 23:13:47');
INSERT INTO `log` VALUES ('346', 'L_346', 'DELETE FROM `book_author` WHERE `book_id` = \'L_8\'', '1', '2018-03-28 23:13:47');
INSERT INTO `log` VALUES ('347', 'L_347', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_11\',\'L_8\'), (\'L_12\',\'L_8\'), (\'L_13\',\'L_8\')', '1', '2018-03-28 23:13:47');
INSERT INTO `log` VALUES ('348', 'L_348', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Merge Category 4\', \'L_16\')', '1', '2018-03-28 23:13:47');
INSERT INTO `log` VALUES ('349', 'L_349', 'DELETE FROM `book_category` WHERE `book_id` = \'L_8\'', '1', '2018-03-28 23:13:48');
INSERT INTO `log` VALUES ('350', 'L_350', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_8\',\'L_12\'), (\'L_8\',\'IST_LIBRARY_4\'), (\'L_8\',\'IST_LIBRARY_1\'), (\'L_8\',\'L_16\')', '1', '2018-03-28 23:13:48');
INSERT INTO `log` VALUES ('351', 'L_351', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:46:48');
INSERT INTO `log` VALUES ('352', 'L_352', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:46:48');
INSERT INTO `log` VALUES ('353', 'L_353', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:46:48');
INSERT INTO `log` VALUES ('354', 'L_354', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:46:48');
INSERT INTO `log` VALUES ('355', 'L_355', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:46:48');
INSERT INTO `log` VALUES ('356', 'L_356', 'DELETE FROM `category` WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:46:48');
INSERT INTO `log` VALUES ('357', 'L_357', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:47:13');
INSERT INTO `log` VALUES ('358', 'L_358', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:47:13');
INSERT INTO `log` VALUES ('359', 'L_359', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:47:13');
INSERT INTO `log` VALUES ('360', 'L_360', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:47:13');
INSERT INTO `log` VALUES ('361', 'L_361', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:47:13');
INSERT INTO `log` VALUES ('362', 'L_362', 'DELETE FROM `category` WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:47:13');
INSERT INTO `log` VALUES ('363', 'L_363', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('364', 'L_364', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('365', 'L_365', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_4\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('366', 'L_366', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_4\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('367', 'L_367', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('368', 'L_368', 'DELETE FROM `category` WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('369', 'L_369', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('370', 'L_370', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('371', 'L_371', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_4\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('372', 'L_372', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_4\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('373', 'L_373', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('374', 'L_374', 'DELETE FROM `category` WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:48:15');
INSERT INTO `log` VALUES ('375', 'L_375', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:48:39');
INSERT INTO `log` VALUES ('376', 'L_376', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:48:39');
INSERT INTO `log` VALUES ('377', 'L_377', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_4\'', '1', '2018-03-29 01:48:39');
INSERT INTO `log` VALUES ('378', 'L_378', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_4\'', '1', '2018-03-29 01:48:39');
INSERT INTO `log` VALUES ('379', 'L_379', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:48:39');
INSERT INTO `log` VALUES ('380', 'L_380', 'DELETE FROM `category` WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:48:39');
INSERT INTO `log` VALUES ('381', 'L_381', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:49:34');
INSERT INTO `log` VALUES ('382', 'L_382', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:49:34');
INSERT INTO `log` VALUES ('383', 'L_383', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_4\'', '1', '2018-03-29 01:49:34');
INSERT INTO `log` VALUES ('384', 'L_384', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_4\'', '1', '2018-03-29 01:49:34');
INSERT INTO `log` VALUES ('385', 'L_385', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:49:34');
INSERT INTO `log` VALUES ('386', 'L_386', 'DELETE FROM `category` WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:49:34');
INSERT INTO `log` VALUES ('387', 'L_387', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:49:35');
INSERT INTO `log` VALUES ('388', 'L_388', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:49:36');
INSERT INTO `log` VALUES ('389', 'L_389', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'IST_LIBRARY_4\'', '1', '2018-03-29 01:49:36');
INSERT INTO `log` VALUES ('390', 'L_390', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_4\'', '1', '2018-03-29 01:49:36');
INSERT INTO `log` VALUES ('391', 'L_391', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_1\' WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:49:36');
INSERT INTO `log` VALUES ('392', 'L_392', 'DELETE FROM `category` WHERE `category_id` = \'L_12\'', '1', '2018-03-29 01:49:36');
INSERT INTO `log` VALUES ('393', 'L_393', 'UPDATE `book_category` SET `category_id` = \'L_12\' WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:50:51');
INSERT INTO `log` VALUES ('394', 'L_394', 'DELETE FROM `category` WHERE `category_id` = \'IST_LIBRARY_1\'', '1', '2018-03-29 01:50:51');
INSERT INTO `log` VALUES ('395', 'L_395', 'UPDATE `book_category` SET `category_id` = \'L_12\' WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:50:51');
INSERT INTO `log` VALUES ('396', 'L_396', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:50:51');
INSERT INTO `log` VALUES ('397', 'L_397', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:51:28');
INSERT INTO `log` VALUES ('398', 'L_398', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:51:28');
INSERT INTO `log` VALUES ('399', 'L_399', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_15\'', '1', '2018-03-29 01:51:28');
INSERT INTO `log` VALUES ('400', 'L_400', 'DELETE FROM `category` WHERE `category_id` = \'L_15\'', '1', '2018-03-29 01:51:28');
INSERT INTO `log` VALUES ('401', 'L_401', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:51:28');
INSERT INTO `log` VALUES ('402', 'L_402', 'DELETE FROM `category` WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:51:28');
INSERT INTO `log` VALUES ('403', 'L_403', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:52:22');
INSERT INTO `log` VALUES ('404', 'L_404', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:52:22');
INSERT INTO `log` VALUES ('405', 'L_405', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_15\'', '1', '2018-03-29 01:52:22');
INSERT INTO `log` VALUES ('406', 'L_406', 'DELETE FROM `category` WHERE `category_id` = \'L_15\'', '1', '2018-03-29 01:52:22');
INSERT INTO `log` VALUES ('407', 'L_407', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:52:23');
INSERT INTO `log` VALUES ('408', 'L_408', 'DELETE FROM `category` WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:52:23');
INSERT INTO `log` VALUES ('409', 'L_409', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:52:48');
INSERT INTO `log` VALUES ('410', 'L_410', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:52:48');
INSERT INTO `log` VALUES ('411', 'L_411', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_15\'', '1', '2018-03-29 01:52:48');
INSERT INTO `log` VALUES ('412', 'L_412', 'DELETE FROM `category` WHERE `category_id` = \'L_15\'', '1', '2018-03-29 01:52:48');
INSERT INTO `log` VALUES ('413', 'L_413', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:52:48');
INSERT INTO `log` VALUES ('414', 'L_414', 'DELETE FROM `category` WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:52:48');
INSERT INTO `log` VALUES ('415', 'L_415', 'UPDATE `book` SET `book_title` = \'Programming in ANSI C\', `book_isbn` = \'8676543234676\', `publication_id` = \'IST_LIBRARY_2\', `book_edition` = \'4th\', `book_place_of_pub` = \'Delhi, India\', `book_year_of_pub` = \'2011\', `book_pages` = \'245\', `book_status` = \'1\', `book_url` = \'https://books.google.com.bd/books?id=AokcsKn-1iIC&lpg=PP1&pg=PP1&output=embed\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2018-03-29 01:56:23');
INSERT INTO `log` VALUES ('416', 'L_416', 'DELETE FROM `book_author` WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2018-03-29 01:56:23');
INSERT INTO `log` VALUES ('417', 'L_417', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'IST_LIBRARY_3\',\'IST_LIBRARY_2\')', '1', '2018-03-29 01:56:23');
INSERT INTO `log` VALUES ('418', 'L_418', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Merge Category 2\', \'L_14\')', '1', '2018-03-29 01:56:24');
INSERT INTO `log` VALUES ('419', 'L_419', 'DELETE FROM `book_category` WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2018-03-29 01:56:24');
INSERT INTO `log` VALUES ('420', 'L_420', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'IST_LIBRARY_2\',\'IST_LIBRARY_1\'), (\'IST_LIBRARY_2\',\'IST_LIBRARY_2\'), (\'IST_LIBRARY_2\',\'IST_LIBRARY_4\'), (\'IST_LIBRARY_2\',\'L_14\')', '1', '2018-03-29 01:56:24');
INSERT INTO `log` VALUES ('421', 'L_421', 'UPDATE `book` SET `book_title` = \'টাইট্রন একটি গ্রহের নাম\', `book_isbn` = \'2358094\', `publication_id` = \'L_5\', `book_edition` = \'1st\', `book_place_of_pub` = \'Dhaka, Bangladesh\', `book_year_of_pub` = \'2001\', `book_pages` = \'68\', `book_status` = \'1\', `book_url` = \'http://download848.mediafire.com/mnocrzt5i9zg/bdoj3r01q09db5k/Titron+Ekti+Groher+Naam+%28allbdbooks.com%29.PDF\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'L_4\'', '1', '2018-03-29 01:56:28');
INSERT INTO `log` VALUES ('422', 'L_422', 'DELETE FROM `book_author` WHERE `book_id` = \'L_4\'', '1', '2018-03-29 01:56:28');
INSERT INTO `log` VALUES ('423', 'L_423', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_6\',\'L_4\')', '1', '2018-03-29 01:56:28');
INSERT INTO `log` VALUES ('424', 'L_424', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Merge Category 3\', \'L_15\')', '1', '2018-03-29 01:56:28');
INSERT INTO `log` VALUES ('425', 'L_425', 'DELETE FROM `book_category` WHERE `book_id` = \'L_4\'', '1', '2018-03-29 01:56:28');
INSERT INTO `log` VALUES ('426', 'L_426', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_4\',\'L_6\'), (\'L_4\',\'L_7\'), (\'L_4\',\'L_15\')', '1', '2018-03-29 01:56:28');
INSERT INTO `log` VALUES ('427', 'L_427', 'UPDATE `book` SET `book_title` = \'Database System Concepts\', `book_isbn` = \'978-0073523323\', `publication_id` = \'L_7\', `book_edition` = \'6th\', `book_place_of_pub` = \'Yale\', `book_year_of_pub` = \'2006\', `book_pages` = \'678\', `book_status` = \'1\', `book_url` = \'\', `book_url_unlocked` = \'1\', `book_remarks` = \'\' WHERE `book_id` = \'L_8\'', '1', '2018-03-29 01:56:42');
INSERT INTO `log` VALUES ('428', 'L_428', 'DELETE FROM `book_author` WHERE `book_id` = \'L_8\'', '1', '2018-03-29 01:56:42');
INSERT INTO `log` VALUES ('429', 'L_429', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_11\',\'L_8\'), (\'L_12\',\'L_8\'), (\'L_13\',\'L_8\')', '1', '2018-03-29 01:56:42');
INSERT INTO `log` VALUES ('430', 'L_430', 'INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Merge Category 4\', \'L_16\')', '1', '2018-03-29 01:56:42');
INSERT INTO `log` VALUES ('431', 'L_431', 'DELETE FROM `book_category` WHERE `book_id` = \'L_8\'', '1', '2018-03-29 01:56:42');
INSERT INTO `log` VALUES ('432', 'L_432', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_8\',\'L_12\'), (\'L_8\',\'IST_LIBRARY_4\'), (\'L_8\',\'IST_LIBRARY_1\'), (\'L_8\',\'L_16\')', '1', '2018-03-29 01:56:42');
INSERT INTO `log` VALUES ('433', 'L_433', 'UPDATE `book_category` SET `category_id` = \'L_16\' WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:57:34');
INSERT INTO `log` VALUES ('434', 'L_434', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:57:34');
INSERT INTO `log` VALUES ('435', 'L_435', 'UPDATE `book_category` SET `category_id` = \'L_16\' WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:57:34');
INSERT INTO `log` VALUES ('436', 'L_436', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:57:34');
INSERT INTO `log` VALUES ('437', 'L_437', 'UPDATE `book_category` SET `category_id` = \'L_16\' WHERE `category_id` = \'L_15\'', '1', '2018-03-29 01:57:34');
INSERT INTO `log` VALUES ('438', 'L_438', 'DELETE FROM `category` WHERE `category_id` = \'L_15\'', '1', '2018-03-29 01:57:34');
INSERT INTO `log` VALUES ('439', 'L_439', 'UPDATE `book_category` SET `category_id` = \'L_15\' WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:58:10');
INSERT INTO `log` VALUES ('440', 'L_440', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:58:10');
INSERT INTO `log` VALUES ('441', 'L_441', 'UPDATE `book_category` SET `category_id` = \'L_15\' WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:58:10');
INSERT INTO `log` VALUES ('442', 'L_442', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:58:10');
INSERT INTO `log` VALUES ('443', 'L_443', 'UPDATE `book_category` SET `category_id` = \'L_15\' WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:58:10');
INSERT INTO `log` VALUES ('444', 'L_444', 'DELETE FROM `category` WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:58:10');
INSERT INTO `log` VALUES ('445', 'L_445', 'UPDATE `book_category` SET `category_id` = \'L_15\' WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:59:08');
INSERT INTO `log` VALUES ('446', 'L_446', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:59:08');
INSERT INTO `log` VALUES ('447', 'L_447', 'UPDATE `book_category` SET `category_id` = \'L_15\' WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:59:08');
INSERT INTO `log` VALUES ('448', 'L_448', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:59:08');
INSERT INTO `log` VALUES ('449', 'L_449', 'UPDATE `book_category` SET `category_id` = \'L_15\' WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:59:08');
INSERT INTO `log` VALUES ('450', 'L_450', 'DELETE FROM `category` WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:59:08');
INSERT INTO `log` VALUES ('451', 'L_451', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_4\' WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:59:37');
INSERT INTO `log` VALUES ('452', 'L_452', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-29 01:59:37');
INSERT INTO `log` VALUES ('453', 'L_453', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_4\' WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:59:37');
INSERT INTO `log` VALUES ('454', 'L_454', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-29 01:59:37');
INSERT INTO `log` VALUES ('455', 'L_455', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_4\' WHERE `category_id` = \'L_15\'', '1', '2018-03-29 01:59:37');
INSERT INTO `log` VALUES ('456', 'L_456', 'DELETE FROM `category` WHERE `category_id` = \'L_15\'', '1', '2018-03-29 01:59:37');
INSERT INTO `log` VALUES ('457', 'L_457', 'UPDATE `book_category` SET `category_id` = \'IST_LIBRARY_4\' WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:59:37');
INSERT INTO `log` VALUES ('458', 'L_458', 'DELETE FROM `category` WHERE `category_id` = \'L_16\'', '1', '2018-03-29 01:59:37');
INSERT INTO `log` VALUES ('459', 'L_459', 'UPDATE `book_category` SET `category_id` = \'L_9\' WHERE `category_id` = \'L_8\'', '1', '2018-03-29 02:00:09');
INSERT INTO `log` VALUES ('460', 'L_460', 'DELETE FROM `category` WHERE `category_id` = \'L_8\'', '1', '2018-03-29 02:00:09');
INSERT INTO `log` VALUES ('461', 'L_461', 'UPDATE `book_category` SET `category_id` = \'L_9\' WHERE `category_id` = \'L_15\'', '1', '2018-03-29 02:00:09');
INSERT INTO `log` VALUES ('462', 'L_462', 'DELETE FROM `category` WHERE `category_id` = \'L_15\'', '1', '2018-03-29 02:00:09');
INSERT INTO `log` VALUES ('463', 'L_463', 'UPDATE `book_category` SET `category_id` = \'L_8\' WHERE `category_id` = \'L_13\'', '1', '2018-03-29 02:00:46');
INSERT INTO `log` VALUES ('464', 'L_464', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-29 02:00:46');
INSERT INTO `log` VALUES ('465', 'L_465', 'UPDATE `book_category` SET `category_id` = \'L_8\' WHERE `category_id` = \'L_15\'', '1', '2018-03-29 02:00:46');
INSERT INTO `log` VALUES ('466', 'L_466', 'DELETE FROM `category` WHERE `category_id` = \'L_15\'', '1', '2018-03-29 02:00:46');
INSERT INTO `log` VALUES ('467', 'L_467', 'UPDATE `book_category` SET `category_id` = \'L_8\' WHERE `category_id` = \'L_14\'', '1', '2018-03-29 02:01:57');
INSERT INTO `log` VALUES ('468', 'L_468', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-29 02:01:57');
INSERT INTO `log` VALUES ('469', 'L_469', 'UPDATE `book_category` SET `category_id` = \'L_8\' WHERE `category_id` = \'L_16\'', '1', '2018-03-29 02:01:57');
INSERT INTO `log` VALUES ('470', 'L_470', 'DELETE FROM `category` WHERE `category_id` = \'L_16\'', '1', '2018-03-29 02:01:57');
INSERT INTO `log` VALUES ('471', 'L_471', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_15\'', '1', '2018-03-29 02:02:46');
INSERT INTO `log` VALUES ('472', 'L_472', 'DELETE FROM `category` WHERE `category_id` = \'L_15\'', '1', '2018-03-29 02:02:46');
INSERT INTO `log` VALUES ('473', 'L_473', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_14\'', '1', '2018-03-29 02:02:46');
INSERT INTO `log` VALUES ('474', 'L_474', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-29 02:02:46');
INSERT INTO `log` VALUES ('475', 'L_475', 'UPDATE `book_category` SET `category_id` = \'L_13\' WHERE `category_id` = \'L_16\'', '1', '2018-03-29 02:03:03');
INSERT INTO `log` VALUES ('476', 'L_476', 'DELETE FROM `category` WHERE `category_id` = \'L_16\'', '1', '2018-03-29 02:03:03');
INSERT INTO `log` VALUES ('477', 'L_477', 'UPDATE `book_category` SET `category_id` = \'L_15\' WHERE `category_id` = \'L_13\'', '1', '2018-03-29 02:03:32');
INSERT INTO `log` VALUES ('478', 'L_478', 'DELETE FROM `category` WHERE `category_id` = \'L_13\'', '1', '2018-03-29 02:03:32');
INSERT INTO `log` VALUES ('479', 'L_479', 'UPDATE `book_category` SET `category_id` = \'L_15\' WHERE `category_id` = \'L_14\'', '1', '2018-03-29 02:03:32');
INSERT INTO `log` VALUES ('480', 'L_480', 'DELETE FROM `category` WHERE `category_id` = \'L_14\'', '1', '2018-03-29 02:03:32');
INSERT INTO `log` VALUES ('481', 'L_481', 'UPDATE `book_category` SET `category_id` = \'L_15\' WHERE `category_id` = \'L_16\'', '1', '2018-03-29 02:03:32');
INSERT INTO `log` VALUES ('482', 'L_482', 'DELETE FROM `category` WHERE `category_id` = \'L_16\'', '1', '2018-03-29 02:03:32');
INSERT INTO `log` VALUES ('483', 'L_483', 'UPDATE `book_author` SET `author_id` = \'L_12\' WHERE `author_id` = \'L_8\'', '1', '2018-03-29 02:10:14');
INSERT INTO `log` VALUES ('484', 'L_484', 'DELETE FROM `author` WHERE `author_id` = \'L_8\'', '1', '2018-03-29 02:10:14');
INSERT INTO `log` VALUES ('485', 'L_485', 'UPDATE `book_author` SET `author_id` = \'L_12\' WHERE `author_id` = \'L_10\'', '1', '2018-03-29 02:10:14');
INSERT INTO `log` VALUES ('486', 'L_486', 'DELETE FROM `author` WHERE `author_id` = \'L_10\'', '1', '2018-03-29 02:10:14');
INSERT INTO `log` VALUES ('487', 'L_487', 'UPDATE `book_author` SET `author_id` = \'L_12\' WHERE `author_id` = \'L_8\'', '1', '2018-03-29 02:10:17');
INSERT INTO `log` VALUES ('488', 'L_488', 'DELETE FROM `author` WHERE `author_id` = \'L_8\'', '1', '2018-03-29 02:10:17');
INSERT INTO `log` VALUES ('489', 'L_489', 'UPDATE `book_author` SET `author_id` = \'L_12\' WHERE `author_id` = \'L_10\'', '1', '2018-03-29 02:10:17');
INSERT INTO `log` VALUES ('490', 'L_490', 'DELETE FROM `author` WHERE `author_id` = \'L_10\'', '1', '2018-03-29 02:10:17');
INSERT INTO `log` VALUES ('491', 'L_491', 'UPDATE `book_author` SET `author_id` = \'L_13\' WHERE `author_id` = \'L_8\'', '1', '2018-03-29 02:10:42');
INSERT INTO `log` VALUES ('492', 'L_492', 'DELETE FROM `author` WHERE `author_id` = \'L_8\'', '1', '2018-03-29 02:10:42');
INSERT INTO `log` VALUES ('493', 'L_493', 'UPDATE `book_author` SET `author_id` = \'L_13\' WHERE `author_id` = \'L_7\'', '1', '2018-03-29 02:10:42');
INSERT INTO `log` VALUES ('494', 'L_494', 'DELETE FROM `author` WHERE `author_id` = \'L_7\'', '1', '2018-03-29 02:10:42');
INSERT INTO `log` VALUES ('495', 'L_495', 'UPDATE `book` SET `book_title` = \'Art of Programming Contest\', `book_isbn` = \'12345\', `publication_id` = \'IST_LIBRARY_4\', `book_edition` = \'1st\', `book_place_of_pub` = \'Dhaka, Bangladesh\', `book_year_of_pub` = \'2009\', `book_pages` = \'195\', `book_status` = \'1\', `book_url` = \'https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf\', `book_url_unlocked` = \'0\', `book_remarks` = \'\' WHERE `book_id` = \'IST_3\'', '1', '2018-03-29 02:11:55');
INSERT INTO `log` VALUES ('496', 'L_496', 'INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'U. Acharya\', \'L_14\')', '1', '2018-03-29 02:11:55');
INSERT INTO `log` VALUES ('497', 'L_497', 'DELETE FROM `book_author` WHERE `book_id` = \'IST_3\'', '1', '2018-03-29 02:11:56');
INSERT INTO `log` VALUES ('498', 'L_498', 'INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'IST_LIBRARY_5\',\'IST_3\'), (\'L_14\',\'IST_3\')', '1', '2018-03-29 02:11:56');
INSERT INTO `log` VALUES ('499', 'L_499', 'DELETE FROM `book_category` WHERE `book_id` = \'IST_3\'', '1', '2018-03-29 02:11:56');
INSERT INTO `log` VALUES ('500', 'L_500', 'INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'IST_3\',\'IST_LIBRARY_1\'), (\'IST_3\',\'IST_LIBRARY_2\'), (\'IST_3\',\'L_15\')', '1', '2018-03-29 02:11:56');
INSERT INTO `log` VALUES ('501', 'L_501', 'UPDATE `book_author` SET `author_id` = \'L_10\' WHERE `author_id` = \'L_14\'', '1', '2018-03-29 02:12:23');
INSERT INTO `log` VALUES ('502', 'L_502', 'DELETE FROM `author` WHERE `author_id` = \'L_14\'', '1', '2018-03-29 02:12:23');
INSERT INTO `log` VALUES ('503', 'L_503', 'UPDATE `book` SET `publication_id` = \'IST_LIBRARY_1\' WHERE `publication_id` = \'L_7\'', '1', '2018-03-29 02:37:04');
INSERT INTO `log` VALUES ('504', 'L_504', 'DELETE FROM `publication` WHERE `publication_id` = \'L_7\'', '1', '2018-03-29 02:37:04');
INSERT INTO `log` VALUES ('505', 'L_505', 'UPDATE `book` SET `publication_id` = \'IST_LIBRARY_2\' WHERE `publication_id` = \'IST_LIBRARY_3\'', '1', '2018-03-29 02:37:25');
INSERT INTO `log` VALUES ('506', 'L_506', 'DELETE FROM `publication` WHERE `publication_id` = \'IST_LIBRARY_3\'', '1', '2018-03-29 02:37:25');
INSERT INTO `log` VALUES ('507', 'L_507', 'UPDATE `book` SET `publication_id` = \'IST_LIBRARY_2\' WHERE `publication_id` = \'L_7\'', '1', '2018-03-29 02:37:25');
INSERT INTO `log` VALUES ('508', 'L_508', 'DELETE FROM `publication` WHERE `publication_id` = \'L_7\'', '1', '2018-03-29 02:37:25');
INSERT INTO `log` VALUES ('509', 'L_509', 'UPDATE `book` SET `publication_id` = \'IST_LIBRARY_1\' WHERE `publication_id` = \'L_7\'', '1', '2018-03-29 02:37:42');
INSERT INTO `log` VALUES ('510', 'L_510', 'DELETE FROM `publication` WHERE `publication_id` = \'L_7\'', '1', '2018-03-29 02:37:42');
INSERT INTO `log` VALUES ('511', 'L_511', 'UPDATE `book` SET `publication_id` = \'IST_LIBRARY_1\' WHERE `publication_id` = \'IST_LIBRARY_3\'', '1', '2018-03-29 02:37:42');
INSERT INTO `log` VALUES ('512', 'L_512', 'DELETE FROM `publication` WHERE `publication_id` = \'IST_LIBRARY_3\'', '1', '2018-03-29 02:37:42');
INSERT INTO `log` VALUES ('513', 'L_513', 'UPDATE `book` SET `publication_id` = \'L_7\' WHERE `publication_id` = \'L_6\'', '1', '2018-03-29 02:38:24');
INSERT INTO `log` VALUES ('514', 'L_514', 'DELETE FROM `publication` WHERE `publication_id` = \'L_6\'', '1', '2018-03-29 02:38:24');
INSERT INTO `log` VALUES ('515', 'L_515', 'UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'IST_2\'', '1', '2018-03-29 18:41:36');
INSERT INTO `log` VALUES ('516', 'L_516', 'UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'IST_1\'', '1', '2018-03-29 18:44:31');
INSERT INTO `log` VALUES ('517', 'L_517', 'UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'IST_2\'', '1', '2018-03-29 18:44:46');
INSERT INTO `log` VALUES ('518', 'L_518', 'UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'IST_1\'', '1', '2018-03-29 18:44:51');
INSERT INTO `log` VALUES ('519', 'L_519', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_12\', \'2018-03-29 18:46:14\', \'2018-03-31 16:30:00\', \'IST_3\', \'IST_1\', 9, \'dya1gkQq\', \'xSoeGq#A\', \'Tg6Ud0LK\', \'H1nCExFG\', \'TwsOadzb\', \'jiFVNlJT\', \'\')', '1', '2018-03-29 18:46:14');
INSERT INTO `log` VALUES ('520', 'L_520', 'UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'IST_1\'', '1', '2018-03-29 18:46:28');
INSERT INTO `log` VALUES ('521', 'L_521', 'UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'IST_1\'', '1', '2018-03-29 18:50:46');
INSERT INTO `log` VALUES ('522', 'L_522', 'DELETE FROM `issue` WHERE `issue_id` = \'L_12\'', '1', '2018-03-29 18:51:57');
INSERT INTO `log` VALUES ('523', 'L_523', 'UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'IST_1\'', '1', '2018-03-29 18:52:07');
INSERT INTO `log` VALUES ('524', 'L_524', 'UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'IST_1\'', '1', '2018-03-29 18:52:12');
INSERT INTO `log` VALUES ('525', 'L_525', 'UPDATE `user` SET `user_name` = \'Md. Moyeenul Hasan Durjoy\', `user_dept` = \'CSE\', `user_session` = \'2017\', `user_roll` = \'1036\', `user_phone` = \'12355677888\', `user_email` = \'durjoy@mail.com\', `user_username` = \'durjoy\', `user_pass` = \'202cb962ac59075b964b07152d234b70\' WHERE `user_id` = \'L_7\'', '1', '2018-03-29 18:57:20');
INSERT INTO `log` VALUES ('526', 'L_526', 'UPDATE `book_copy` SET `book_copy_is_deleted` = 1 WHERE `book_id` = \'L_6\' AND `book_copy_id` >= \'69\' AND `book_copy_id` <= \'75\' AND `book_copy_type` = 1 AND `book_copy_is_deleted` =0', '1', '2018-03-29 18:58:36');
INSERT INTO `log` VALUES ('527', 'L_527', 'UPDATE `book` SET `book_stock` = 3, `book_available` = 2 WHERE `book_id` = \'L_6\'', '1', '2018-03-29 18:58:36');
INSERT INTO `log` VALUES ('528', 'L_528', 'UPDATE `book_copy` SET `book_copy_is_deleted` = 1 WHERE `book_id` = \'L_6\' AND `book_copy_id` >= \'69\' AND `book_copy_id` <= \'75\' AND `book_copy_is_deleted` =0', '1', '2018-03-29 18:58:36');
INSERT INTO `log` VALUES ('529', 'L_529', 'UPDATE `user` SET `user_name` = \'Aftabul Islam Himel\', `user_dept` = \'CSE\', `user_session` = \'2012\', `user_roll` = \'1243\', `user_phone` = \'01677181006\', `user_email` = \'toaihimel@gmail.com\', `user_username` = \'himel\', `user_pass` = \'202cb962ac59075b964b07152d234b70\' WHERE `user_id` = \'L_9\'', '1', '2018-03-29 18:59:24');
INSERT INTO `log` VALUES ('530', 'L_530', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_12\', \'2018-03-29 18:59:32\', \'2018-03-31 16:30:00\', \'L_6\', \'L_7\', 9, \'k%efwcHr\', \'6Lx101oc\', \'fAh5AIcX\', \'&v3y%$dm\', \'qhRgg&9i\', \'Q7K#Bo5r\', \'\')', '1', '2018-03-29 18:59:32');
INSERT INTO `log` VALUES ('531', 'L_531', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_13\', \'2018-03-29 19:00:19\', \'2018-03-31 16:30:00\', \'L_6\', \'L_9\', 9, \'9BK&Uoau\', \'BbrddaV5\', \'CDVBmyhm\', \'&3pzIdej\', \'uc3HgKkU\', \'S5dO1wwO\', \'\')', '1', '2018-03-29 19:00:19');
INSERT INTO `log` VALUES ('532', 'L_532', 'UPDATE `book` SET `book_id` = \'L_6\', `book_available` = 1 WHERE `book_id` = \'L_6\'', '1', '2018-03-29 19:00:29');
INSERT INTO `log` VALUES ('533', 'L_533', 'UPDATE `issue` SET `issue_id` = \'L_13\', `issue_status` = 0 WHERE `issue_id` = \'L_13\'', '1', '2018-03-29 19:00:29');
INSERT INTO `log` VALUES ('534', 'L_534', 'UPDATE `book` SET `book_id` = \'L_6\', `book_available` = 0 WHERE `book_id` = \'L_6\'', '1', '2018-03-29 19:01:03');
INSERT INTO `log` VALUES ('535', 'L_535', 'UPDATE `issue` SET `issue_id` = \'L_12\', `issue_status` = 0 WHERE `issue_id` = \'L_12\'', '1', '2018-03-29 19:01:03');
INSERT INTO `log` VALUES ('536', 'L_536', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_14\', \'2018-03-29 19:07:38\', \'L_6\', \'IST_1\', 6, \'FStQbl0v\', \'EfODvsuL\', \'emHu0rO0\', \'hnP1FLwE\', \'niRTVrod\', \'cNnOqsbr\', \'\')', '1', '2018-03-29 19:07:38');
INSERT INTO `log` VALUES ('537', 'L_537', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_14\', \'2018-03-29 19:08:06\', \'L_6\', \'IST_1\', 6, \'O3NXdjta\', \'PjBYFOCT\', \'XsZd&SXc\', \'eeZP13%G\', \'PL3kXH4B\', \'4VTIdFQw\', \'\')', '1', '2018-03-29 19:08:06');
INSERT INTO `log` VALUES ('538', 'L_538', 'DELETE FROM `issue` WHERE `issue_id` = \'L_14\'', '1', '2018-03-29 19:56:33');
INSERT INTO `log` VALUES ('539', 'L_539', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_14\', \'2018-03-29 19:56:44\', \'L_6\', \'IST_1\', 6, \'@nbGfRK4\', \'RSX9iKw9\', \'G7FLOUAu\', \'Wg7AR%WZ\', \'cVC85Lkj\', \'6x5vr@dN\', \'\')', '1', '2018-03-29 19:56:44');
INSERT INTO `log` VALUES ('540', 'L_540', 'DELETE FROM `issue` WHERE `issue_id` = \'L_14\'', '1', '2018-03-29 20:01:49');
INSERT INTO `log` VALUES ('541', 'L_541', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_14\', \'2018-03-29 20:02:46\', \'L_6\', \'IST_1\', 6, \'LFYn#rN#\', \'ne2@mHpm\', \'fo#IDeNL\', \'svwNLnmA\', \'mqDKt%s@\', \'HDi4FJTC\', \'\')', '1', '2018-03-29 20:02:47');
INSERT INTO `log` VALUES ('542', 'L_542', 'UPDATE `book` SET `book_id` = \'L_6\', `book_available` = 1 WHERE `book_id` = \'L_6\'', '1', '2018-03-29 20:06:50');
INSERT INTO `log` VALUES ('543', 'L_543', 'DELETE FROM `issue` WHERE `issue_id` = \'L_13\'', '1', '2018-03-29 20:06:50');
INSERT INTO `log` VALUES ('544', 'L_544', 'UPDATE `book` SET `book_id` = \'L_6\', `book_available` = 2 WHERE `book_id` = \'L_6\'', '1', '2018-03-29 20:07:02');
INSERT INTO `log` VALUES ('545', 'L_545', 'DELETE FROM `issue` WHERE `issue_id` = \'L_12\'', '1', '2018-03-29 20:07:02');
INSERT INTO `log` VALUES ('546', 'L_546', 'DELETE FROM `issue` WHERE `issue_id` = \'L_14\'', '1', '2018-03-29 20:07:27');
INSERT INTO `log` VALUES ('547', 'L_547', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_12\', \'2018-03-29 23:01:51\', \'2018-03-31 16:30:00\', \'L_6\', \'IST_1\', 9, \'&1tL%zq$\', \'x#9YyKp3\', \'j3#SAAQe\', \'nPUSd@D2\', \'e@D6932b\', \'Y7MB#58h\', \'\')', '1', '2018-03-29 23:01:52');
INSERT INTO `log` VALUES ('548', 'L_548', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_13\', \'2018-03-29 23:02:00\', \'2018-03-31 16:30:00\', \'L_6\', \'L_7\', 9, \'sYyydBrK\', \'Epe@7ZGT\', \'6j@evEH9\', \'aCfWAQ5D\', \'zbUr#gRx\', \'5D9464x5\', \'\')', '1', '2018-03-29 23:02:00');
INSERT INTO `log` VALUES ('549', 'L_549', 'UPDATE `book` SET `book_id` = \'L_6\', `book_available` = 1 WHERE `book_id` = \'L_6\'', '1', '2018-03-29 23:02:11');
INSERT INTO `log` VALUES ('550', 'L_550', 'UPDATE `issue` SET `issue_id` = \'L_12\', `issue_status` = 0 WHERE `issue_id` = \'L_12\'', '1', '2018-03-29 23:02:11');
INSERT INTO `log` VALUES ('551', 'L_551', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_14\', \'2018-03-29 23:02:54\', \'2018-03-31 16:30:00\', \'L_6\', \'L_9\', 9, \'I8BJM7JC\', \'xeQthcSE\', \'LJgfCDWj\', \'3&PL%L4W\', \'9dOZYpcT\', \'VQvA2se%\', \'\')', '1', '2018-03-29 23:02:54');
INSERT INTO `log` VALUES ('552', 'L_552', 'DELETE FROM `issue` WHERE `issue_id` = \'L_14\'', '1', '2018-03-29 23:03:14');
INSERT INTO `log` VALUES ('553', 'L_553', 'UPDATE `book` SET `book_id` = \'L_6\', `book_available` = 0 WHERE `book_id` = \'L_6\'', '1', '2018-03-29 23:19:50');
INSERT INTO `log` VALUES ('554', 'L_554', 'UPDATE `issue` SET `issue_id` = \'L_13\', `issue_status` = 0 WHERE `issue_id` = \'L_13\'', '1', '2018-03-29 23:19:50');
INSERT INTO `log` VALUES ('555', 'L_555', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_14\', \'2018-03-29 23:20:17\', \'L_6\', \'L_9\', 6, \'0UfgIWQg\', \'Va6rM@eC\', \'aZ#j$UfG\', \'IfghaWH5\', \'$EPUKYxE\', \'AljKLMZX\', \'\')', '1', '2018-03-29 23:20:17');
INSERT INTO `log` VALUES ('556', 'L_556', 'UPDATE `book` SET `book_id` = \'L_6\', `book_available` = 1 WHERE `book_id` = \'L_6\'', '1', '2018-03-29 23:20:36');
INSERT INTO `log` VALUES ('557', 'L_557', 'DELETE FROM `issue` WHERE `issue_id` = \'L_12\'', '1', '2018-03-29 23:20:36');
INSERT INTO `log` VALUES ('558', 'L_558', 'UPDATE `book` SET `book_id` = \'L_6\', `book_available` = 2 WHERE `book_id` = \'L_6\'', '1', '2018-03-29 23:20:43');
INSERT INTO `log` VALUES ('559', 'L_559', 'DELETE FROM `issue` WHERE `issue_id` = \'L_13\'', '1', '2018-03-29 23:20:43');
INSERT INTO `log` VALUES ('560', 'L_560', 'DELETE FROM `issue` WHERE `issue_id` = \'L_14\'', '1', '2018-03-29 23:20:49');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('1', 'IST_LIBRARY_1', 'munna_library', '827ccb0eea8a706c4c34a16891f84e7b', 'Muntasir Billah Munna', '01516180603', 'kmmuntasir@gmail.com', '1', '0', '2018-03-28 19:35:38');
INSERT INTO `manager` VALUES ('3', 'L_2', 'khalil', '827ccb0eea8a706c4c34a16891f84e7b', 'Khalilullah', '234567', 'khalil@mia.com', '0', '0', '2018-03-28 19:35:38');
INSERT INTO `manager` VALUES ('4', 'L_3', 'salma', '827ccb0eea8a706c4c34a16891f84e7b', 'Salma', '23455', 'sal@ma.com', '0', '0', '2018-03-28 19:35:38');
INSERT INTO `manager` VALUES ('6', 'L_5', 'boby', '827ccb0eea8a706c4c34a16891f84e7b', 'Farjana Boby', '123465789', 'boby@bob.com', '0', '1', '2018-03-28 19:35:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of publication
-- ----------------------------
INSERT INTO `publication` VALUES ('1', 'IST_LIBRARY_1', 'Schaum\'s Outlines', '2018-03-28 19:37:55');
INSERT INTO `publication` VALUES ('2', 'IST_LIBRARY_2', 'TATA mCGRAW Hills', '2018-03-28 19:37:55');
INSERT INTO `publication` VALUES ('3', 'IST_LIBRARY_3', 'Prentice-Hall India', '2018-03-28 19:37:55');
INSERT INTO `publication` VALUES ('35', 'IST_LIBRARY_4', 'শিখা প্রকাশনী', '2018-03-28 19:37:55');
INSERT INTO `publication` VALUES ('37', 'L_5', 'Gyankosh Prokashoni, Bangladesh', '2018-03-28 19:37:55');
INSERT INTO `publication` VALUES ('39', 'L_7', 'Yale Publishers', '2018-03-28 19:37:55');

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
INSERT INTO `server` VALUES ('1', 'remote', 'http://library.ist.edu.bd/index.php', '2018-03-29 23:22:01', '1', '0', 'HF1EBAvrgB');

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
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'IST_1', 'munna', '202cb962ac59075b964b07152d234b70', 'Muntasir Billah', '1234567890', 'mun@na.com', 'bBz7L@3WiW', 'CSE', '1057', '2009', '0', '0', null, '0', '', '2018-03-29 18:52:12');
INSERT INTO `user` VALUES ('2', 'IST_2', 'rubayet33', '81dc9bdb52d04dc20036dbd8313ed055', 'Rubayet Hossain', '0987654345678', 'rub@ayet.com', '123', 'CSE', '1014', '2009', '0', '0', null, '0', '', '2018-03-29 18:44:46');
INSERT INTO `user` VALUES ('3', 'IST_3', 'muntasir', '81dc9bdb52d04dc20036dbd8313ed055', 'K. M. Muntasir Billah Munna', '01516180603', 'kmmuntasir@gmail.com', 'HF1EBAvrgB', 'CSE', '', '0000', '1', '21', 'Faculty Member', '0', '', '2018-03-28 19:34:31');
INSERT INTO `user` VALUES ('6', 'L_5', 'rakib', '202cb962ac59075b964b07152d234b70', 'Md. Rakib Hossain', '12345678904845', 'rakib@gmail.com', 'E2971AAC8809C0E0232FAEC1924D1176', 'ECE', '', '0000', '1', '0', 'Faculty Member', '0', '', '2018-03-28 19:34:31');
INSERT INTO `user` VALUES ('7', 'L_6', 'taniasultana', '202cb962ac59075b964b07152d234b70', 'Mrs. Tania Sultana', '0984323456787', 'tania@gmail.com', '943BF7D405B44375372A221F669A261A', 'CSE', '', '0000', '1', '0', 'Faculty Member', '0', '', '2018-03-28 19:34:31');
INSERT INTO `user` VALUES ('8', 'L_7', 'durjoy', '202cb962ac59075b964b07152d234b70', 'Md. Moyeenul Hasan Durjoy', '12355677888', 'durjoy@mail.com', 'yWd0ehWofG', 'CSE', '1036', '2017', '0', '0', null, '0', 'GPKRbsUWVZF8yFGYbOLl', '2018-03-29 18:57:20');
INSERT INTO `user` VALUES ('9', 'L_8', 'srafique', 'e5a93371cfc7eab4a88221dd1f6c1a3c', 'Prof. Dr. Shahida Rafique', '01819256950', 'srafique@univdhaka.edu', 'wNl5bpp', 'ECE', '', '0000', '1', '0', 'Professor', '0', '', '2018-03-28 19:34:31');
INSERT INTO `user` VALUES ('10', 'L_9', 'himel', '202cb962ac59075b964b07152d234b70', 'Aftabul Islam Himel', '01677181006', 'toaihimel@gmail.com', 'zzZTjMvKJi', 'CSE', '1243', '2012', '0', '0', null, '0', '', '2018-03-28 19:34:31');
