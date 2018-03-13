/*
Navicat MySQL Data Transfer

Source Server         : lampp
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : istbd_library

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-13 18:12:41
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
  PRIMARY KEY (`id`,`author_id`,`author_name`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of author
-- ----------------------------
INSERT INTO `author` VALUES ('4', 'IST_LIBRARY_2', 'W. A. Triebel');
INSERT INTO `author` VALUES ('5', 'IST_LIBRARY_3', 'E. Balagurusamy');
INSERT INTO `author` VALUES ('6', 'IST_LIBRARY_4', 'Seymour Lipschutz');
INSERT INTO `author` VALUES ('50', 'IST_LIBRARY_5', 'Ahmed Shamsul Arefin');
INSERT INTO `author` VALUES ('52', 'L_6', 'মুহম্মদ জাফর ইকবাল');
INSERT INTO `author` VALUES ('53', 'L_7', 'আফসার-উজ-জামান');
INSERT INTO `author` VALUES ('54', 'L_8', 'Avtar Singh');
INSERT INTO `author` VALUES ('55', 'L_9', 'Test Author');
INSERT INTO `author` VALUES ('56', 'L_10', 'Udit Acharya');
INSERT INTO `author` VALUES ('57', 'L_11', 'Abraham Silberschatz');
INSERT INTO `author` VALUES ('58', 'L_12', 'Henry F. Korth');
INSERT INTO `author` VALUES ('59', 'L_13', 'S. Sudarshan');

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
INSERT INTO `book` VALUES ('34', 'IST_LIBRARY_2', '8676543234676', 'Programming in ANSI C', 'IST_LIBRARY_2', '2016-12-21 18:41:30', 'IST_LIBRARY_1', '4th', 'Delhi, India', '2011', '245', '1', '', '11', '9', 'https://books.google.com.bd/books?id=AokcsKn-1iIC&lpg=PP1&pg=PP1&output=embed', '1');
INSERT INTO `book` VALUES ('35', 'IST_3', '12345', 'Art of Programming Contest', 'IST_LIBRARY_4', '2016-12-21 20:11:47', 'IST_LIBRARY_1', '1st', 'Dhaka, Bangladesh', '2009', '195', '1', '', '16', '15', 'https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf', '1');
INSERT INTO `book` VALUES ('36', 'L_4', '2358094', 'টাইট্রন একটি গ্রহের নাম', 'L_5', '2016-12-21 23:48:54', 'IST_LIBRARY_1', '1st', 'Dhaka, Bangladesh', '2001', '68', '1', '', '6', '6', 'http://download848.mediafire.com/mnocrzt5i9zg/bdoj3r01q09db5k/Titron+Ekti+Groher+Naam+%28allbdbooks.com%29.PDF', '1');
INSERT INTO `book` VALUES ('37', 'L_5', 'uiy6756gh', 'উচ্চ মাধ্যমিক জ্যামিতি ও ক্যালকুলাস', 'L_5', '2016-12-21 23:50:17', 'IST_LIBRARY_1', '2nd', 'Dhaka, Bangladesh', '2011', '298', '1', '', '6', '4', null, '1');
INSERT INTO `book` VALUES ('38', 'L_6', 'jkluio789023jod', 'The 8088 and 8086 Microprocessor System', 'IST_LIBRARY_3', '2016-12-21 23:52:48', 'IST_LIBRARY_1', '3rd', 'New Delhi', '2004', '593', '1', '', '10', '9', null, '1');
INSERT INTO `book` VALUES ('39', 'L_7', '39dkdk', 'Bangla Grammar', 'L_6', '2016-12-21 23:54:28', 'IST_LIBRARY_1', '1st', 'Dhaka, Bangladesh', '2000', '198', '1', '', '10', '9', null, '1');
INSERT INTO `book` VALUES ('43', 'L_8', '978-0073523323', 'Database System Concepts', 'L_7', '2017-12-23 13:07:08', 'IST_LIBRARY_1', '6th', 'Yale', '2006', '678', '1', '', '1', '0', null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_author
-- ----------------------------
INSERT INTO `book_author` VALUES ('35', '', 'IST_LIBRARY_2', 'IST_LIBRARY_3');
INSERT INTO `book_author` VALUES ('37', '', 'IST_3', 'IST_LIBRARY_5');
INSERT INTO `book_author` VALUES ('38', '', 'L_4', 'L_6');
INSERT INTO `book_author` VALUES ('39', '', 'L_5', 'L_7');
INSERT INTO `book_author` VALUES ('40', '', 'L_6', 'IST_LIBRARY_2');
INSERT INTO `book_author` VALUES ('41', '', 'L_6', 'L_8');
INSERT INTO `book_author` VALUES ('47', '', 'L_7', 'L_10');
INSERT INTO `book_author` VALUES ('49', '', 'L_8', 'L_11');
INSERT INTO `book_author` VALUES ('50', '', 'L_8', 'L_12');
INSERT INTO `book_author` VALUES ('51', '', 'L_8', 'L_13');

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
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_category
-- ----------------------------
INSERT INTO `book_category` VALUES ('71', '', 'IST_LIBRARY_2', 'IST_LIBRARY_1');
INSERT INTO `book_category` VALUES ('72', '', 'IST_LIBRARY_2', 'IST_LIBRARY_2');
INSERT INTO `book_category` VALUES ('73', '', 'IST_LIBRARY_2', 'IST_LIBRARY_4');
INSERT INTO `book_category` VALUES ('78', '', 'IST_3', 'IST_LIBRARY_1');
INSERT INTO `book_category` VALUES ('79', '', 'IST_3', 'IST_LIBRARY_2');
INSERT INTO `book_category` VALUES ('80', '', 'L_4', 'L_6');
INSERT INTO `book_category` VALUES ('81', '', 'L_4', 'L_7');
INSERT INTO `book_category` VALUES ('82', '', 'L_5', 'L_8');
INSERT INTO `book_category` VALUES ('83', '', 'L_5', 'L_9');
INSERT INTO `book_category` VALUES ('84', '', 'L_6', 'L_10');
INSERT INTO `book_category` VALUES ('85', '', 'L_6', 'IST_LIBRARY_2');
INSERT INTO `book_category` VALUES ('86', '', 'L_6', 'IST_LIBRARY_1');
INSERT INTO `book_category` VALUES ('92', '', 'L_7', 'L_11');
INSERT INTO `book_category` VALUES ('94', '', 'L_8', 'L_12');
INSERT INTO `book_category` VALUES ('95', '', 'L_8', 'IST_LIBRARY_4');
INSERT INTO `book_category` VALUES ('96', '', 'L_8', 'IST_LIBRARY_1');

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
  PRIMARY KEY (`book_copy_id`,`book_copy_accession_no`),
  KEY `FK1_book_copy_book` (`book_id`),
  KEY `FK2_book_copy_manager` (`book_copy_manager_id`),
  KEY `book_copy_accession_no` (`book_copy_accession_no`),
  CONSTRAINT `FK1_book_copy_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_book_copy_manager` FOREIGN KEY (`book_copy_manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book_copy
-- ----------------------------
INSERT INTO `book_copy` VALUES ('5', 'IST_LIBRARY_2', 'IST_c_5', '1', '0', '2016-12-21', '93', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('26', 'IST_LIBRARY_2', 'IST_c_26', '0', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('27', 'IST_LIBRARY_2', 'IST_c_27', '0', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('28', 'IST_LIBRARY_2', 'IST_c_28', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('29', 'IST_LIBRARY_2', 'IST_c_29', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('30', 'IST_LIBRARY_2', 'IST_c_30', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('31', 'IST_LIBRARY_2', 'IST_c_31', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('32', 'IST_LIBRARY_2', 'IST_c_32', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('33', 'IST_LIBRARY_2', 'IST_c_33', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('34', 'IST_LIBRARY_2', 'IST_c_34', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('35', 'IST_LIBRARY_2', 'IST_c_35', '1', '1', '2016-12-21', '75', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('36', 'IST_3', 'IST_c_36', '1', '0', '2016-12-21', '90', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('37', 'IST_3', 'IST_c_37', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('38', 'IST_3', 'IST_c_38', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('39', 'IST_3', 'IST_c_39', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('40', 'IST_3', 'IST_c_40', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('41', 'IST_3', 'IST_c_41', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('42', 'IST_3', 'IST_c_42', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('43', 'IST_3', 'IST_c_43', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('44', 'IST_3', 'IST_c_44', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('45', 'IST_3', 'IST_c_45', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('46', 'IST_3', 'IST_c_46', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('47', 'IST_3', 'IST_c_47', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('48', 'IST_3', 'IST_c_48', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('49', 'IST_3', 'IST_c_49', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('50', 'IST_3', 'IST_c_50', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('51', 'IST_3', 'IST_c_51', '1', '1', '2016-12-21', '72.5', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('52', 'L_4', 'L_c_52', '1', '0', '2016-12-21', '50', '1', '', 'IST_LIBRARY_1', '1');
INSERT INTO `book_copy` VALUES ('53', 'L_4', 'L_c_53', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('54', 'L_4', 'L_c_54', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('55', 'L_4', 'L_c_55', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '1');
INSERT INTO `book_copy` VALUES ('56', 'L_4', 'L_c_56', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('57', 'L_4', 'L_c_57', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('58', 'L_4', 'L_c_58', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('59', 'L_4', 'L_c_59', '1', '1', '2016-12-21', '43', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('60', 'L_5', 'L_c_60', '1', '0', '2016-12-21', '80', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('61', 'L_5', 'L_c_61', '1', '1', '2016-12-21', '72', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('62', 'L_5', 'L_c_62', '1', '1', '2016-12-21', '72', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('63', 'L_5', 'L_c_63', '1', '1', '2016-12-21', '72', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('64', 'L_5', 'L_c_64', '1', '1', '2016-12-21', '72', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('65', 'L_5', 'L_c_65', '1', '1', '2016-12-21', '72', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('66', 'L_6', 'L_c_66', '1', '0', '2016-12-21', '430', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('67', 'L_6', 'L_c_67', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('68', 'L_6', 'L_c_68', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('69', 'L_6', 'L_c_69', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('70', 'L_6', 'L_c_70', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('71', 'L_6', 'L_c_71', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('72', 'L_6', 'L_c_72', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('73', 'L_6', 'L_c_73', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('74', 'L_6', 'L_c_74', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('75', 'L_6', 'L_c_75', '1', '1', '2016-12-21', '450', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('86', 'L_7', 'L_c_86', '1', '0', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('87', 'L_7', 'L_c_87', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('88', 'L_7', 'L_c_88', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('89', 'L_7', 'L_c_89', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('90', 'L_7', 'L_c_90', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('91', 'L_7', 'L_c_91', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('92', 'L_7', 'L_c_92', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('93', 'L_7', 'L_c_93', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('94', 'L_7', 'L_c_94', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('95', 'L_7', 'L_c_95', '1', '1', '2016-12-22', '187', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('116', 'L_8', 'L_c_96', '1', '0', '2017-12-23', '1200', '1', '', 'IST_LIBRARY_1', '0');
INSERT INTO `book_copy` VALUES ('117', 'L_8', 'L_c_97', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1');
INSERT INTO `book_copy` VALUES ('118', 'L_8', 'L_c_98', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1');
INSERT INTO `book_copy` VALUES ('119', 'L_8', 'L_c_99', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1');
INSERT INTO `book_copy` VALUES ('120', 'L_8', 'L_c_100', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1');
INSERT INTO `book_copy` VALUES ('121', 'L_8', 'L_c_101', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1');
INSERT INTO `book_copy` VALUES ('122', 'L_8', 'L_c_102', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1');
INSERT INTO `book_copy` VALUES ('123', 'L_8', 'L_c_103', '1', '1', '2017-12-23', '270', '1', '', 'IST_LIBRARY_1', '1');
INSERT INTO `book_copy` VALUES ('124', 'L_8', 'L_c_104', '1', '1', '2017-12-23', '100', '1', '', 'IST_LIBRARY_1', '1');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`category_id`,`category_name`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'IST_LIBRARY_1', 'Computer');
INSERT INTO `category` VALUES ('2', 'IST_LIBRARY_2', 'Programming');
INSERT INTO `category` VALUES ('4', 'IST_LIBRARY_3', 'Programming Contest');
INSERT INTO `category` VALUES ('5', 'IST_LIBRARY_4', 'CSE Course');
INSERT INTO `category` VALUES ('6', 'IST_LIBRARY_5', 'Bangla Programming');
INSERT INTO `category` VALUES ('8', 'L_6', 'Science Fiction');
INSERT INTO `category` VALUES ('9', 'L_7', 'Novel');
INSERT INTO `category` VALUES ('10', 'L_8', 'Mathematics');
INSERT INTO `category` VALUES ('11', 'L_9', 'H.S.C Books');
INSERT INTO `category` VALUES ('12', 'L_10', 'Microprocessor');
INSERT INTO `category` VALUES ('13', 'L_11', 'Test Category');
INSERT INTO `category` VALUES ('14', 'L_12', 'Database');

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
  `issue_received_fine` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`,`issue_id`),
  KEY `FK1_issue_book` (`issue_book_id`),
  KEY `FK2_issue_book_copy` (`issue_book_copy_accession_no`),
  KEY `FK3_issue_user` (`user_id`),
  KEY `FK4_issue_manager` (`manager_id`),
  CONSTRAINT `FK1_issue_book` FOREIGN KEY (`issue_book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_issue_book_copy` FOREIGN KEY (`issue_book_copy_accession_no`) REFERENCES `book_copy` (`book_copy_accession_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK3_issue_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK4_issue_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of issue
-- ----------------------------
INSERT INTO `issue` VALUES ('1', 'L_1', '2017-12-27 13:16:28', '2017-12-27 13:18:39', '2018-01-11 16:30:00', '2017-12-29 16:30:00', 'IST_LIBRARY_2', 'IST_c_27', 'IST_1', 'IST_LIBRARY_1', '3', '0NHhs#kN', '9%VpX4E%', 'V9LTABDU', 'vF2L6KQ5', 'rl71vVVJ', 'oOe@92#H', '', null);
INSERT INTO `issue` VALUES ('3', 'L_3', '2017-12-27 13:18:39', '2017-12-27 13:19:39', '2018-01-11 16:30:00', null, 'IST_LIBRARY_2', 'IST_c_27', 'IST_1', 'IST_LIBRARY_1', '3', 'MlgSpMbp', 'Q5E2@GQL', 'Qkvs&w4b', '5$mjMIwJ', 'k&xo9$2F', 'UCNZzLZG', '', null);
INSERT INTO `issue` VALUES ('4', 'L_4', '2017-12-27 20:13:14', '2017-12-27 20:14:43', '2018-01-11 16:30:00', '2017-12-29 16:30:00', 'L_4', 'L_c_53', 'IST_1', 'IST_LIBRARY_1', '3', 'nXUBsPTw', 'YyRIQLuj', 'g@hraDuw', 'xXv0Qtt1', 'v277fgT4', 'qZloeQdK', '', null);
INSERT INTO `issue` VALUES ('5', 'L_5', '2017-12-27 20:21:46', '2017-12-27 20:21:55', '2018-01-11 16:30:00', null, 'L_7', 'L_c_89', 'IST_1', 'IST_LIBRARY_1', '3', 'X45v7xhX', 'kCPNB8Z&', '5uQGAJ9V', 'C%yr1Gxv', 'zFfr@a$D', 'bq&IqzfL', '', null);
INSERT INTO `issue` VALUES ('6', 'L_6', '2017-12-01 20:23:16', '2017-12-27 20:24:44', '2017-12-07 16:30:00', null, 'L_4', 'L_c_54', 'IST_1', 'IST_LIBRARY_1', '3', 'EJ1twSs7', 'eI#T@J&b', 'utp5U@oo', 'D81I6pz8', 'jJ@bDRNg', 'agrCNa#W', '', null);
INSERT INTO `issue` VALUES ('7', 'L_7', '2017-12-01 22:32:00', '2017-12-27 22:42:01', '2017-12-10 16:30:00', null, 'L_5', 'L_c_62', 'IST_1', 'IST_LIBRARY_1', '3', '0gY3obrh', 'jM8cx1%U', 'vENvBcPk', '5zOsiAQG', 'FrNKHVCk', 'Q@tgyiOQ', '', null);
INSERT INTO `issue` VALUES ('8', 'L_8', '2017-12-27 22:42:21', '2017-12-27 22:43:16', '2018-01-11 16:30:00', null, 'L_4', 'L_c_54', 'IST_1', 'IST_LIBRARY_1', '3', 'LUizuyKm', '%xZHl5BJ', 'eQiJktXf', '@fS0yFKq', 'ix&e9GAd', 'x2lUDgNz', '', null);
INSERT INTO `issue` VALUES ('9', 'L_9', '2017-12-01 22:44:11', '2018-02-11 01:44:11', '2017-12-14 16:30:00', null, 'L_4', 'L_c_54', 'IST_1', 'IST_LIBRARY_1', '3', '9VQyLW5k', 'pSuruoOy', 'zpXPSqj0', 'QxBOL$z5', 'Gt#mK2SL', 'isNa3IOa', '', null);
INSERT INTO `issue` VALUES ('10', 'L_10', '2017-12-27 22:56:30', null, null, '2018-01-16 16:30:00', 'IST_LIBRARY_2', null, 'IST_1', null, '8', 'J2#7l5c3', 'VFEFkT1r', 'M%JDmnXA', 'pOPScjkG', 'SmtsZCt1', 'UMeQrJXV', '', null);
INSERT INTO `issue` VALUES ('11', 'L_11', '2017-12-27 22:57:02', null, null, '2017-12-29 16:30:00', 'L_5', null, 'IST_1', null, '8', 'gpQtbC%Q', '4dLQXi8L', 'CiLIhLW8', '5$UHiILc', 'E55rHpy9', 'FKqy31DD', '', null);
INSERT INTO `issue` VALUES ('12', 'L_12', '2018-02-11 01:37:29', '2018-02-11 01:44:04', '2018-02-26 16:30:00', '2018-02-13 16:30:00', 'IST_LIBRARY_2', 'L_c_71', 'IST_1', 'IST_LIBRARY_1', '3', 'FDpeo4Gz', 'DASl%jqD', '3AyzBwBl', 'jxcz1l5p', 'np@uDriD', 'nYh7XXf5', '', null);
INSERT INTO `issue` VALUES ('13', 'L_13', '2018-02-11 01:47:05', '2018-02-11 02:04:53', '2018-02-26 16:30:00', '2018-02-13 16:30:00', 'IST_LIBRARY_2', 'IST_c_27', 'IST_1', 'IST_LIBRARY_1', '3', '%Fmk%7Lr', 'jl3jfGTj', 'lRNNbdHK', 'P#RUwxE0', 'PX3&QErH', 'kgh0E@5Y', '', null);
INSERT INTO `issue` VALUES ('14', 'L_14', '2018-02-11 02:04:53', null, '2018-02-26 16:30:00', null, 'IST_LIBRARY_2', 'IST_c_27', 'IST_1', 'IST_LIBRARY_1', '1', 'V%SzfhNU', 'rAKG90Lo', 'sXJB$G&g', 'k8pIWJxV', 'wrZ8Guee', 'zQJe%h7u', '', null);
INSERT INTO `issue` VALUES ('15', 'L_15', '2018-02-11 02:39:56', null, null, '2018-02-13 16:30:00', 'L_5', null, 'IST_1', null, '0', '1F&$l$4T', 'B4CT0Jr#', 'yxZhXyJy', 'zs5JA#Tn', 'MO&87ISF', 'MdTrCZ0j', '', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('1', 'L_1', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_1\', \'2017-12-27 13:12:43\', \'2017-12-29 16:30:00\', \'IST_LIBRARY_2\', \'IST_1\', 9, \'0NHhs#kN\', \'9%VpX4E%\', \'V9LTABDU\', \'vF2L6KQ5\', \'rl71vVVJ\', \'oOe@92#H\', \'\')', '1', '2017-12-27 13:12:43');
INSERT INTO `log` VALUES ('2', 'L_2', 'UPDATE `book` SET `book_id` = \'IST_LIBRARY_2\', `book_available` = 9 WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2017-12-27 13:12:44');
INSERT INTO `log` VALUES ('3', 'L_3', 'UPDATE `issue` SET `issue_id` = \'L_1\', `issue_status` = 0 WHERE `issue_id` = \'L_1\'', '1', '2017-12-27 13:12:44');
INSERT INTO `log` VALUES ('4', 'L_4', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_2\', \'2017-12-27 13:13:42\', \'2017-12-29 16:30:00\', \'L_7\', \'IST_1\', 9, \'wMaO79rn\', \'3wI#P27s\', \'42RsN1aJ\', \'3A@2DEJq\', \'$CZ2jq$x\', \'a&pc46M%\', \'\')', '1', '2017-12-27 13:13:42');
INSERT INTO `log` VALUES ('5', 'L_5', 'UPDATE `book` SET `book_id` = \'L_7\', `book_available` = 8 WHERE `book_id` = \'L_7\'', '1', '2017-12-27 13:13:43');
INSERT INTO `log` VALUES ('6', 'L_6', 'UPDATE `issue` SET `issue_id` = \'L_2\', `issue_status` = 0 WHERE `issue_id` = \'L_2\'', '1', '2017-12-27 13:13:43');
INSERT INTO `log` VALUES ('7', 'L_7', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'IST_c_27\', `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'IST_c_27\'', '1', '2017-12-27 13:16:28');
INSERT INTO `log` VALUES ('8', 'L_8', 'UPDATE `issue` SET `manager_id` = \'IST_LIBRARY_1\', `issue_book_copy_accession_no` = \'IST_c_27\', `issue_status` = 1, `issue_datetime` = \'2017-12-27 13:16:28\', `issue_deadline` = \'2018-01-11 16:30:00\' WHERE `issue_id` = \'L_1\'', '1', '2017-12-27 13:16:28');
INSERT INTO `log` VALUES ('9', 'L_9', 'UPDATE `issue` SET `issue_id` = \'L_1\', `issue_status` = 3, `issue_return_datetime` = \'2017-12-27 13:18:39\' WHERE `issue_id` = \'L_1\'', '1', '2017-12-27 13:18:39');
INSERT INTO `log` VALUES ('10', 'L_10', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_3\', \'2017-12-27 13:18:39\', \'2018-01-11 16:30:00\', \'IST_LIBRARY_2\', \'IST_c_27\', \'IST_1\', \'IST_LIBRARY_1\', 1, \'MlgSpMbp\', \'Q5E2@GQL\', \'Qkvs&w4b\', \'5$mjMIwJ\', \'k&xo9$2F\', \'UCNZzLZG\', \'\')', '1', '2017-12-27 13:18:39');
INSERT INTO `log` VALUES ('11', 'L_11', 'UPDATE `book` SET `book_id` = \'IST_LIBRARY_2\', `book_available` = 10 WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2017-12-27 13:19:39');
INSERT INTO `log` VALUES ('12', 'L_12', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'IST_c_27\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'IST_c_27\'', '1', '2017-12-27 13:19:39');
INSERT INTO `log` VALUES ('13', 'L_13', 'UPDATE `issue` SET `issue_id` = \'L_3\', `issue_status` = 3, `issue_return_datetime` = \'2017-12-27 13:19:39\' WHERE `issue_id` = \'L_3\'', '1', '2017-12-27 13:19:39');
INSERT INTO `log` VALUES ('14', 'L_14', 'UPDATE `book` SET `book_id` = \'L_7\', `book_available` = 9 WHERE `book_id` = \'L_7\'', '1', '2017-12-27 13:31:14');
INSERT INTO `log` VALUES ('15', 'L_15', 'DELETE FROM `issue` WHERE `issue_id` = \'L_2\'', '1', '2017-12-27 13:31:14');
INSERT INTO `log` VALUES ('16', 'L_16', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:51:08');
INSERT INTO `log` VALUES ('17', 'L_17', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:51:08');
INSERT INTO `log` VALUES ('18', 'L_18', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:51:45');
INSERT INTO `log` VALUES ('19', 'L_19', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:51:45');
INSERT INTO `log` VALUES ('20', 'L_20', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:53:37');
INSERT INTO `log` VALUES ('21', 'L_21', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:53:37');
INSERT INTO `log` VALUES ('22', 'L_22', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'150\', `issue_auto_expire_deadline` = \'5\', `issue_fine_per_day` = \'5\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:54:10');
INSERT INTO `log` VALUES ('23', 'L_23', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.html\', `server_access_code` = \'HF1EBAvrgB9\'', '1', '2017-12-27 14:54:10');
INSERT INTO `log` VALUES ('24', 'L_24', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:54:44');
INSERT INTO `log` VALUES ('25', 'L_25', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:54:44');
INSERT INTO `log` VALUES ('26', 'L_26', 'UPDATE `settings` SET `application_role` = \'1\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB9\'', '1', '2017-12-27 14:54:54');
INSERT INTO `log` VALUES ('27', 'L_27', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:54:54');
INSERT INTO `log` VALUES ('28', 'L_28', 'UPDATE `settings` SET `application_role` = \'1\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:55:12');
INSERT INTO `log` VALUES ('29', 'L_29', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:55:12');
INSERT INTO `log` VALUES ('30', 'L_30', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:55:40');
INSERT INTO `log` VALUES ('31', 'L_31', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB9\'', '1', '2017-12-27 14:55:40');
INSERT INTO `log` VALUES ('32', 'L_32', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:56:16');
INSERT INTO `log` VALUES ('33', 'L_33', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:56:16');
INSERT INTO `log` VALUES ('34', 'L_34', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:57:07');
INSERT INTO `log` VALUES ('35', 'L_35', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 14:57:07');
INSERT INTO `log` VALUES ('36', 'L_36', 'UPDATE `settings` SET `institute_name` = \'Your School Name\', `institute_email` = \'admin@yourschool.edu\', `institute_phone` = \'0123456789\', `institute_address` = \'Dhanmondi\'', '1', '2017-12-27 15:00:52');
INSERT INTO `log` VALUES ('37', 'L_37', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\'', '1', '2017-12-27 15:01:48');
INSERT INTO `log` VALUES ('38', 'L_38', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\', `institute_logo` = \'98c4bb013947ac456e058a9c06a53a0b.jpg\'', '1', '2017-12-27 15:39:02');
INSERT INTO `log` VALUES ('39', 'L_39', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\', `institute_logo` = \'334b43d7e8f5e226a4d9f55e17e2bd42.jpg\'', '1', '2017-12-27 15:41:37');
INSERT INTO `log` VALUES ('40', 'L_40', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\', `institute_favicon` = \'5cbfe51ba50710e0edaa4e4565c2a31e.jpg\'', '1', '2017-12-27 15:41:43');
INSERT INTO `log` VALUES ('41', 'L_41', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\', `institute_logo` = \'8ea247a5079486edb5c6897d83eb46cb.jpg\', `institute_favicon` = \'c497a3ddc28a96d19ac979b6b3418039.jpg\'', '1', '2017-12-27 15:45:12');
INSERT INTO `log` VALUES ('42', 'L_42', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\', `institute_favicon` = \'0d26af746c0b59a2c21ce8be2397da33.jpg\'', '1', '2017-12-27 15:48:07');
INSERT INTO `log` VALUES ('43', 'L_43', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\', `institute_favicon` = \'9c4630c4932447ce67cfed64581ca805.jpg\'', '1', '2017-12-27 15:48:22');
INSERT INTO `log` VALUES ('44', 'L_44', 'UPDATE `settings` SET `institute_name` = \'BUET\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\'', '1', '2017-12-27 16:00:10');
INSERT INTO `log` VALUES ('45', 'L_45', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\'', '1', '2017-12-27 16:00:17');
INSERT INTO `log` VALUES ('46', 'L_46', 'UPDATE `user` SET `user_library_code` = \'bBz7L@3WiW\' WHERE `user_id` = \'IST_1\'', '1', '2017-12-27 20:10:03');
INSERT INTO `log` VALUES ('47', 'L_47', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_4\', \'2017-12-27 20:11:31\', \'2017-12-29 16:30:00\', \'L_4\', \'IST_1\', 9, \'nXUBsPTw\', \'YyRIQLuj\', \'g@hraDuw\', \'xXv0Qtt1\', \'v277fgT4\', \'qZloeQdK\', \'\')', '1', '2017-12-27 20:11:31');
INSERT INTO `log` VALUES ('48', 'L_48', 'UPDATE `book` SET `book_id` = \'L_4\', `book_available` = 5 WHERE `book_id` = \'L_4\'', '1', '2017-12-27 20:11:32');
INSERT INTO `log` VALUES ('49', 'L_49', 'UPDATE `issue` SET `issue_id` = \'L_4\', `issue_status` = 0 WHERE `issue_id` = \'L_4\'', '1', '2017-12-27 20:11:32');
INSERT INTO `log` VALUES ('50', 'L_50', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_53\', `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_53\'', '1', '2017-12-27 20:13:14');
INSERT INTO `log` VALUES ('51', 'L_51', 'UPDATE `issue` SET `manager_id` = \'IST_LIBRARY_1\', `issue_book_copy_accession_no` = \'L_c_53\', `issue_status` = 1, `issue_datetime` = \'2017-12-27 20:13:14\', `issue_deadline` = \'2018-01-11 16:30:00\' WHERE `issue_id` = \'L_4\'', '1', '2017-12-27 20:13:14');
INSERT INTO `log` VALUES ('52', 'L_52', 'UPDATE `book` SET `book_id` = \'L_4\', `book_available` = 6 WHERE `book_id` = \'L_4\'', '1', '2017-12-27 20:14:43');
INSERT INTO `log` VALUES ('53', 'L_53', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_53\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_53\'', '1', '2017-12-27 20:14:43');
INSERT INTO `log` VALUES ('54', 'L_54', 'UPDATE `issue` SET `issue_id` = \'L_4\', `issue_status` = 3, `issue_return_datetime` = \'2017-12-27 20:14:43\' WHERE `issue_id` = \'L_4\'', '1', '2017-12-27 20:14:43');
INSERT INTO `log` VALUES ('55', 'L_55', 'UPDATE `book` SET `book_available` = 8 WHERE `book_id` = \'L_7\'', '1', '2017-12-27 20:21:46');
INSERT INTO `log` VALUES ('56', 'L_56', 'UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_89\'', '1', '2017-12-27 20:21:46');
INSERT INTO `log` VALUES ('57', 'L_57', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_5\', \'2017-12-27 20:21:46\', \'2018-01-11 16:30:00\', \'L_7\', \'L_c_89\', \'IST_1\', \'IST_LIBRARY_1\', 1, \'X45v7xhX\', \'kCPNB8Z&\', \'5uQGAJ9V\', \'C%yr1Gxv\', \'zFfr@a$D\', \'bq&IqzfL\', \'\')', '1', '2017-12-27 20:21:46');
INSERT INTO `log` VALUES ('58', 'L_58', 'UPDATE `book` SET `book_id` = \'L_7\', `book_available` = 9 WHERE `book_id` = \'L_7\'', '1', '2017-12-27 20:21:55');
INSERT INTO `log` VALUES ('59', 'L_59', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_89\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_89\'', '1', '2017-12-27 20:21:55');
INSERT INTO `log` VALUES ('60', 'L_60', 'UPDATE `issue` SET `issue_id` = \'L_5\', `issue_status` = 3, `issue_return_datetime` = \'2017-12-27 20:21:55\' WHERE `issue_id` = \'L_5\'', '1', '2017-12-27 20:21:55');
INSERT INTO `log` VALUES ('61', 'L_61', 'UPDATE `book` SET `book_available` = 5 WHERE `book_id` = \'L_4\'', '1', '2017-12-27 20:23:16');
INSERT INTO `log` VALUES ('62', 'L_62', 'UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_54\'', '1', '2017-12-27 20:23:16');
INSERT INTO `log` VALUES ('63', 'L_63', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_6\', \'2017-12-27 20:23:16\', \'2018-01-11 16:30:00\', \'L_4\', \'L_c_54\', \'IST_1\', \'IST_LIBRARY_1\', 1, \'EJ1twSs7\', \'eI#T@J&b\', \'utp5U@oo\', \'D81I6pz8\', \'jJ@bDRNg\', \'agrCNa#W\', \'\')', '1', '2017-12-27 20:23:16');
INSERT INTO `log` VALUES ('64', 'L_64', 'UPDATE `book` SET `book_id` = \'L_4\', `book_available` = 6 WHERE `book_id` = \'L_4\'', '1', '2017-12-27 20:24:44');
INSERT INTO `log` VALUES ('65', 'L_65', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_54\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_54\'', '1', '2017-12-27 20:24:44');
INSERT INTO `log` VALUES ('66', 'L_66', 'UPDATE `issue` SET `issue_id` = \'L_6\', `issue_status` = 2, `issue_return_datetime` = \'2017-12-27 20:24:44\' WHERE `issue_id` = \'L_6\'', '1', '2017-12-27 20:24:44');
INSERT INTO `log` VALUES ('67', 'L_67', 'INSERT INTO `user` (`user_name`, `user_dept`, `user_session`, `user_roll`, `user_phone`, `user_email`, `user_username`, `user_pass`, `user_library_code`, `user_id`) VALUES (\'Aftabul Islam Himel\', \'CSE\', \'2012\', \'1243\', \'01677181006\', \'toaihimel@gmail.com\', \'himel\', \'c4ca4238a0b923820dcc509a6f75849b\', \'Gz18%kDQgy\', \'L_9\')', '1', '2017-12-27 21:24:59');
INSERT INTO `log` VALUES ('68', 'L_68', 'UPDATE `settings` SET `application_role` = \'1\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 21:27:31');
INSERT INTO `log` VALUES ('69', 'L_69', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 21:27:31');
INSERT INTO `log` VALUES ('70', 'L_70', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 21:30:17');
INSERT INTO `log` VALUES ('71', 'L_71', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 21:30:17');
INSERT INTO `log` VALUES ('72', 'L_72', 'UPDATE `book` SET `book_available` = 4 WHERE `book_id` = \'L_5\'', '1', '2017-12-27 22:32:00');
INSERT INTO `log` VALUES ('73', 'L_73', 'UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_62\'', '1', '2017-12-27 22:32:00');
INSERT INTO `log` VALUES ('74', 'L_74', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_7\', \'2017-12-27 22:32:00\', \'1970-01-01 16:30:00\', \'L_5\', \'L_c_62\', \'IST_1\', \'IST_LIBRARY_1\', 1, \'0gY3obrh\', \'jM8cx1%U\', \'vENvBcPk\', \'5zOsiAQG\', \'FrNKHVCk\', \'Q@tgyiOQ\', \'\')', '1', '2017-12-27 22:32:00');
INSERT INTO `log` VALUES ('75', 'L_75', 'UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 5 WHERE `book_id` = \'L_5\'', '1', '2017-12-27 22:42:01');
INSERT INTO `log` VALUES ('76', 'L_76', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_62\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_62\'', '1', '2017-12-27 22:42:01');
INSERT INTO `log` VALUES ('77', 'L_77', 'UPDATE `issue` SET `issue_id` = \'L_7\', `issue_status` = 3, `issue_return_datetime` = \'2017-12-27 22:42:01\' WHERE `issue_id` = \'L_7\'', '1', '2017-12-27 22:42:01');
INSERT INTO `log` VALUES ('78', 'L_78', 'UPDATE `book` SET `book_available` = 5 WHERE `book_id` = \'L_4\'', '1', '2017-12-27 22:42:21');
INSERT INTO `log` VALUES ('79', 'L_79', 'UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_54\'', '1', '2017-12-27 22:42:21');
INSERT INTO `log` VALUES ('80', 'L_80', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_8\', \'2017-12-27 22:42:21\', \'2018-01-11 16:30:00\', \'L_4\', \'L_c_54\', \'IST_1\', \'IST_LIBRARY_1\', 1, \'LUizuyKm\', \'%xZHl5BJ\', \'eQiJktXf\', \'@fS0yFKq\', \'ix&e9GAd\', \'x2lUDgNz\', \'\')', '1', '2017-12-27 22:42:21');
INSERT INTO `log` VALUES ('81', 'L_81', 'UPDATE `book` SET `book_id` = \'L_4\', `book_available` = 6 WHERE `book_id` = \'L_4\'', '1', '2017-12-27 22:43:16');
INSERT INTO `log` VALUES ('82', 'L_82', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_54\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_54\'', '1', '2017-12-27 22:43:16');
INSERT INTO `log` VALUES ('83', 'L_83', 'UPDATE `issue` SET `issue_id` = \'L_8\', `issue_status` = 3, `issue_return_datetime` = \'2017-12-27 22:43:16\' WHERE `issue_id` = \'L_8\'', '1', '2017-12-27 22:43:16');
INSERT INTO `log` VALUES ('84', 'L_84', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'365\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:44:05');
INSERT INTO `log` VALUES ('85', 'L_85', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:44:05');
INSERT INTO `log` VALUES ('86', 'L_86', 'UPDATE `book` SET `book_available` = 5 WHERE `book_id` = \'L_4\'', '1', '2017-12-27 22:44:11');
INSERT INTO `log` VALUES ('87', 'L_87', 'UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_54\'', '1', '2017-12-27 22:44:11');
INSERT INTO `log` VALUES ('88', 'L_88', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_9\', \'2017-12-27 22:44:11\', \'2018-12-27 16:30:00\', \'L_4\', \'L_c_54\', \'IST_1\', \'IST_LIBRARY_1\', 1, \'9VQyLW5k\', \'pSuruoOy\', \'zpXPSqj0\', \'QxBOL$z5\', \'Gt#mK2SL\', \'isNa3IOa\', \'\')', '1', '2017-12-27 22:44:11');
INSERT INTO `log` VALUES ('89', 'L_89', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'365\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'20\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:50:03');
INSERT INTO `log` VALUES ('90', 'L_90', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:50:03');
INSERT INTO `log` VALUES ('91', 'L_91', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'365\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:50:09');
INSERT INTO `log` VALUES ('92', 'L_92', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:50:09');
INSERT INTO `log` VALUES ('93', 'L_93', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'365\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'20\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:56:02');
INSERT INTO `log` VALUES ('94', 'L_94', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:56:02');
INSERT INTO `log` VALUES ('95', 'L_95', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'365\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:56:12');
INSERT INTO `log` VALUES ('96', 'L_96', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:56:12');
INSERT INTO `log` VALUES ('97', 'L_97', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'365\', `issue_auto_expire_deadline` = \'20\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:56:21');
INSERT INTO `log` VALUES ('98', 'L_98', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:56:21');
INSERT INTO `log` VALUES ('99', 'L_99', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_10\', \'2017-12-27 22:56:30\', \'2018-01-16 16:30:00\', \'IST_LIBRARY_2\', \'IST_1\', 9, \'J2#7l5c3\', \'VFEFkT1r\', \'M%JDmnXA\', \'pOPScjkG\', \'SmtsZCt1\', \'UMeQrJXV\', \'\')', '1', '2017-12-27 22:56:30');
INSERT INTO `log` VALUES ('100', 'L_100', 'UPDATE `book` SET `book_id` = \'IST_LIBRARY_2\', `book_available` = 9 WHERE `book_id` = \'IST_LIBRARY_2\'', '1', '2017-12-27 22:56:32');
INSERT INTO `log` VALUES ('101', 'L_101', 'UPDATE `issue` SET `issue_id` = \'L_10\', `issue_status` = 0 WHERE `issue_id` = \'L_10\'', '1', '2017-12-27 22:56:32');
INSERT INTO `log` VALUES ('102', 'L_102', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'365\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:56:51');
INSERT INTO `log` VALUES ('103', 'L_103', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-27 22:56:51');
INSERT INTO `log` VALUES ('104', 'L_104', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_11\', \'2017-12-27 22:57:02\', \'2017-12-29 16:30:00\', \'L_5\', \'IST_1\', 9, \'gpQtbC%Q\', \'4dLQXi8L\', \'CiLIhLW8\', \'5$UHiILc\', \'E55rHpy9\', \'FKqy31DD\', \'\')', '1', '2017-12-27 22:57:02');
INSERT INTO `log` VALUES ('105', 'L_105', 'UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 4 WHERE `book_id` = \'L_5\'', '1', '2017-12-27 22:57:06');
INSERT INTO `log` VALUES ('106', 'L_106', 'UPDATE `issue` SET `issue_id` = \'L_11\', `issue_status` = 0 WHERE `issue_id` = \'L_11\'', '1', '2017-12-27 22:57:06');
INSERT INTO `log` VALUES ('107', 'L_107', 'UPDATE `settings` SET `application_role` = \'0\', `issue_deadline` = \'15\', `issue_auto_expire_deadline` = \'2\', `issue_fine_per_day` = \'2\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-28 01:02:42');
INSERT INTO `log` VALUES ('108', 'L_108', 'UPDATE `server` SET `server_url` = \'http://localhost/library.ist.edu.bd_online/index.php\', `server_access_code` = \'HF1EBAvrgB\'', '1', '2017-12-28 01:02:42');
INSERT INTO `log` VALUES ('109', 'L_109', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\', `institute_logo` = \'1d28218617ea1c0ba6be8b2ed6ca321a.png\', `institute_favicon` = \'69c613ca183277ba6176e7a845f87d05.ico\'', '1', '2017-12-28 13:34:26');
INSERT INTO `log` VALUES ('110', 'L_110', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\', `institute_logo` = \'b16c7dda9f7f8157dc577f35ced00869.jpg\', `institute_favicon` = \'71fbebd3e1fd8c75039794863e81372b.jpg\'', '1', '2017-12-28 13:36:15');
INSERT INTO `log` VALUES ('111', 'L_111', 'UPDATE `settings` SET `institute_name` = \'Institute of Science and Technology\', `institute_email` = \'info@ist.edu.bd\', `institute_phone` = \'01711223344\', `institute_address` = \'House #54, Road #15/A, Dhanmondi, Dhaka-1209\', `institute_logo` = \'d9b968f458576bc4302a76fb7ff68c4c.png\', `institute_favicon` = \'c47e97c062d1c304619ef00a915e11fe.ico\'', '1', '2017-12-28 13:36:34');
INSERT INTO `log` VALUES ('112', 'L_112', 'UPDATE `user` SET `user_pass` = \'202cb962ac59075b964b07152d234b70\' WHERE `user_id` = \'L_9\'', '1', '2017-12-28 13:36:55');
INSERT INTO `log` VALUES ('113', 'L_113', 'UPDATE `user` SET `user_library_code` = \'zzZTjMvKJi\' WHERE `user_id` = \'L_9\'', '1', '2017-12-28 13:37:11');
INSERT INTO `log` VALUES ('114', 'L_114', 'UPDATE `book` SET `book_url` = \'https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf\' WHERE `book_id` = \'IST_3\'', '1', '2017-12-29 00:44:06');
INSERT INTO `log` VALUES ('115', 'L_115', 'UPDATE `book` SET `book_url` = \'https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf\' WHERE `book_id` = \'IST_3\'', '1', '2017-12-29 00:44:25');
INSERT INTO `log` VALUES ('116', 'L_116', 'UPDATE `book` SET `book_url` = \'http://download848.mediafire.com/mnocrzt5i9zg/bdoj3r01q09db5k/Titron+Ekti+Groher+Naam+%28allbdbooks.com%29.PDF\' WHERE `book_id` = \'L_4\'', '1', '2017-12-29 01:16:55');
INSERT INTO `log` VALUES ('117', 'L_117', 'UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 5 WHERE `book_id` = \'L_5\'', '1', '2018-01-07 15:17:08');
INSERT INTO `log` VALUES ('118', 'L_118', 'UPDATE `issue` SET `issue_id` = \'L_11\', `issue_status` = 8 WHERE `issue_id` = \'L_11\'', '1', '2018-01-07 15:17:08');
INSERT INTO `log` VALUES ('119', 'L_119', 'UPDATE `book` SET `book_id` = \'IST_LIBRARY_2\', `book_available` = 10 WHERE `book_id` = \'IST_LIBRARY_2\'', '0', '2018-02-11 00:53:21');
INSERT INTO `log` VALUES ('120', 'L_120', 'UPDATE `issue` SET `issue_id` = \'L_10\', `issue_status` = 8 WHERE `issue_id` = \'L_10\'', '0', '2018-02-11 00:53:21');
INSERT INTO `log` VALUES ('121', 'L_121', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_12\', \'2018-02-11 00:53:22\', \'2018-02-13 16:30:00\', \'IST_LIBRARY_2\', \'IST_1\', 9, \'FDpeo4Gz\', \'DASl%jqD\', \'3AyzBwBl\', \'jxcz1l5p\', \'np@uDriD\', \'nYh7XXf5\', \'\')', '0', '2018-02-11 00:53:22');
INSERT INTO `log` VALUES ('122', 'L_122', 'UPDATE `book` SET `book_id` = \'IST_LIBRARY_2\', `book_available` = 9 WHERE `book_id` = \'IST_LIBRARY_2\'', '0', '2018-02-11 00:53:28');
INSERT INTO `log` VALUES ('123', 'L_123', 'UPDATE `issue` SET `issue_id` = \'L_12\', `issue_status` = 0 WHERE `issue_id` = \'L_12\'', '0', '2018-02-11 00:53:28');
INSERT INTO `log` VALUES ('124', 'L_124', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_71\', `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_71\'', '0', '2018-02-11 01:37:29');
INSERT INTO `log` VALUES ('125', 'L_125', 'UPDATE `issue` SET `manager_id` = \'IST_LIBRARY_1\', `issue_book_copy_accession_no` = \'L_c_71\', `issue_status` = 1, `issue_datetime` = \'2018-02-11 01:37:29\', `issue_deadline` = \'2018-02-26 16:30:00\' WHERE `issue_id` = \'L_12\'', '0', '2018-02-11 01:37:29');
INSERT INTO `log` VALUES ('126', 'L_126', 'UPDATE `book` SET `book_id` = \'IST_LIBRARY_2\', `book_available` = 10 WHERE `book_id` = \'IST_LIBRARY_2\'', '0', '2018-02-11 01:44:04');
INSERT INTO `log` VALUES ('127', 'L_127', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_71\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_71\'', '0', '2018-02-11 01:44:04');
INSERT INTO `log` VALUES ('128', 'L_128', 'UPDATE `issue` SET `issue_id` = \'L_12\', `issue_status` = 3, `issue_return_datetime` = \'2018-02-11 01:44:04\' WHERE `issue_id` = \'L_12\'', '0', '2018-02-11 01:44:04');
INSERT INTO `log` VALUES ('129', 'L_129', 'UPDATE `book` SET `book_id` = \'L_4\', `book_available` = 6 WHERE `book_id` = \'L_4\'', '0', '2018-02-11 01:44:11');
INSERT INTO `log` VALUES ('130', 'L_130', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_54\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_54\'', '0', '2018-02-11 01:44:11');
INSERT INTO `log` VALUES ('131', 'L_131', 'UPDATE `issue` SET `issue_id` = \'L_9\', `issue_status` = 2, `issue_return_datetime` = \'2018-02-11 01:44:11\' WHERE `issue_id` = \'L_9\'', '0', '2018-02-11 01:44:11');
INSERT INTO `log` VALUES ('132', 'L_132', 'UPDATE `issue` SET `issue_id` = \'L_9\', `issue_status` = 3 WHERE `issue_id` = \'L_9\'', '0', '2018-02-11 01:44:38');
INSERT INTO `log` VALUES ('133', 'L_133', 'UPDATE `issue` SET `issue_id` = \'L_6\', `issue_status` = 3 WHERE `issue_id` = \'L_6\'', '0', '2018-02-11 01:44:43');
INSERT INTO `log` VALUES ('134', 'L_134', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_13\', \'2018-02-11 01:45:03\', \'2018-02-13 16:30:00\', \'IST_LIBRARY_2\', \'IST_1\', 9, \'%Fmk%7Lr\', \'jl3jfGTj\', \'lRNNbdHK\', \'P#RUwxE0\', \'PX3&QErH\', \'kgh0E@5Y\', \'\')', '0', '2018-02-11 01:45:03');
INSERT INTO `log` VALUES ('135', 'L_135', 'UPDATE `book` SET `book_id` = \'IST_LIBRARY_2\', `book_available` = 9 WHERE `book_id` = \'IST_LIBRARY_2\'', '0', '2018-02-11 01:45:04');
INSERT INTO `log` VALUES ('136', 'L_136', 'UPDATE `issue` SET `issue_id` = \'L_13\', `issue_status` = 0 WHERE `issue_id` = \'L_13\'', '0', '2018-02-11 01:45:04');
INSERT INTO `log` VALUES ('137', 'L_137', 'UPDATE `book_copy` SET `book_copy_accession_no` = \'IST_c_27\', `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'IST_c_27\'', '0', '2018-02-11 01:47:05');
INSERT INTO `log` VALUES ('138', 'L_138', 'UPDATE `issue` SET `manager_id` = \'IST_LIBRARY_1\', `issue_book_copy_accession_no` = \'IST_c_27\', `issue_status` = 1, `issue_datetime` = \'2018-02-11 01:47:05\', `issue_deadline` = \'2018-02-26 16:30:00\' WHERE `issue_id` = \'L_13\'', '0', '2018-02-11 01:47:05');
INSERT INTO `log` VALUES ('139', 'L_139', 'UPDATE `issue` SET `issue_id` = \'L_13\', `issue_status` = 3, `issue_return_datetime` = \'2018-02-11 02:04:53\' WHERE `issue_id` = \'L_13\'', '0', '2018-02-11 02:04:53');
INSERT INTO `log` VALUES ('140', 'L_140', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_14\', \'2018-02-11 02:04:53\', \'2018-02-26 16:30:00\', \'IST_LIBRARY_2\', \'IST_c_27\', \'IST_1\', \'IST_LIBRARY_1\', 1, \'V%SzfhNU\', \'rAKG90Lo\', \'sXJB$G&g\', \'k8pIWJxV\', \'wrZ8Guee\', \'zQJe%h7u\', \'\')', '0', '2018-02-11 02:04:53');
INSERT INTO `log` VALUES ('141', 'L_141', 'INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_15\', \'2018-02-11 02:39:56\', \'2018-02-13 16:30:00\', \'L_5\', \'IST_1\', 9, \'1F&$l$4T\', \'B4CT0Jr#\', \'yxZhXyJy\', \'zs5JA#Tn\', \'MO&87ISF\', \'MdTrCZ0j\', \'\')', '0', '2018-02-11 02:39:56');
INSERT INTO `log` VALUES ('142', 'L_142', 'UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 4 WHERE `book_id` = \'L_5\'', '0', '2018-02-11 02:40:00');
INSERT INTO `log` VALUES ('143', 'L_143', 'UPDATE `issue` SET `issue_id` = \'L_15\', `issue_status` = 0 WHERE `issue_id` = \'L_15\'', '0', '2018-02-11 02:40:00');

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
  PRIMARY KEY (`id`,`manager_id`,`manager_user`,`manager_phone`,`manager_email`),
  KEY `manager_id` (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('1', 'IST_LIBRARY_1', 'munna_library', '827ccb0eea8a706c4c34a16891f84e7b', 'Muntasir Billah Munna', '01516180603', 'kmmuntasir@gmail.com', '1', '0');
INSERT INTO `manager` VALUES ('3', 'L_2', 'khalil', 'c4ca4238a0b923820dcc509a6f75849b', 'Khalilullah', '234567', 'khalil@mia.com', '0', '0');
INSERT INTO `manager` VALUES ('4', 'L_3', 'salma', '202cb962ac59075b964b07152d234b70', 'Salma', '23455', 'sal@ma.com', '0', '1');

-- ----------------------------
-- Table structure for `publication`
-- ----------------------------
DROP TABLE IF EXISTS `publication`;
CREATE TABLE `publication` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `publication_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publication_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`publication_id`,`publication_name`),
  KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of publication
-- ----------------------------
INSERT INTO `publication` VALUES ('1', 'IST_LIBRARY_1', 'Schaum\'s Outlines');
INSERT INTO `publication` VALUES ('2', 'IST_LIBRARY_2', 'TATA mCGRAW Hills');
INSERT INTO `publication` VALUES ('3', 'IST_LIBRARY_3', 'Prentice-Hall India');
INSERT INTO `publication` VALUES ('35', 'IST_LIBRARY_4', 'শিখা প্রকাশনী');
INSERT INTO `publication` VALUES ('37', 'L_5', 'Gyankosh Prokashoni, Bangladesh');
INSERT INTO `publication` VALUES ('38', 'L_6', 'Test Publisher');
INSERT INTO `publication` VALUES ('39', 'L_7', 'Yale Publishers');

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
INSERT INTO `server` VALUES ('1', 'remote', 'http://localhost/library.ist.edu.bd_online/index.php', '2018-02-11 00:53:14', '1', '0', 'HF1EBAvrgB');

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
INSERT INTO `settings` VALUES ('1', 'HF1EBAvrgB', '15', '2', '2', '0', 'Institute of Science and Technology', 'd9b968f458576bc4302a76fb7ff68c4c.png', 'c47e97c062d1c304619ef00a915e11fe.ico', 'House #54, Road #15/A, Dhanmondi, Dhaka-1209', 'info@ist.edu.bd', '01711223344', '1');

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
  PRIMARY KEY (`id`,`user_id`,`user_username`,`user_phone`,`user_email`,`user_library_code`,`teacher_id`,`user_roll`,`user_password_reset_code`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'IST_1', 'munna', '202cb962ac59075b964b07152d234b70', 'Muntasir Billah', '1234567890', 'mun@na.com', 'bBz7L@3WiW', 'CSE', '1057', '2009', '0', '0', null, '0', '');
INSERT INTO `user` VALUES ('2', 'IST_2', 'rubayet33', '81dc9bdb52d04dc20036dbd8313ed055', 'Rubayet Hossain', '0987654345678', 'rub@ayet.com', '123', 'CSE', '1014', '2009', '0', '0', null, '0', '');
INSERT INTO `user` VALUES ('3', 'IST_3', 'muntasir', '81dc9bdb52d04dc20036dbd8313ed055', 'K. M. Muntasir Billah Munna', '01516180603', 'kmmuntasir@gmail.com', 'HF1EBAvrgB', 'CSE', '', '0000', '1', '21', 'Faculty Member', '0', '');
INSERT INTO `user` VALUES ('6', 'L_5', 'rakib', '202cb962ac59075b964b07152d234b70', 'Md. Rakib Hossain', '12345678904845', 'rakib@gmail.com', 'E2971AAC8809C0E0232FAEC1924D1176', 'ECE', '', '0000', '1', '0', 'Faculty Member', '0', '');
INSERT INTO `user` VALUES ('7', 'L_6', 'taniasultana', '202cb962ac59075b964b07152d234b70', 'Mrs. Tania Sultana', '0984323456787', 'tania@gmail.com', '943BF7D405B44375372A221F669A261A', 'CSE', '', '0000', '1', '0', 'Faculty Member', '0', '');
INSERT INTO `user` VALUES ('8', 'L_7', 'durjoy', 'c4ca4238a0b923820dcc509a6f75849b', 'Md. Moyeenul Hasan Durjoy', '12355677888', 'kmmuntasir@gmail.com', 'yWd0ehWofG', 'CSE', '1036', '2017', '0', '0', null, '0', 'GPKRbsUWVZF8yFGYbOLl');
INSERT INTO `user` VALUES ('9', 'L_8', 'srafique', 'e5a93371cfc7eab4a88221dd1f6c1a3c', 'Prof. Dr. Shahida Rafique', '01819256950', 'srafique@univdhaka.edu', 'wNl5bpp', 'ECE', '', '0000', '1', '0', 'Professor', '0', '');
INSERT INTO `user` VALUES ('10', 'L_9', 'himel', '202cb962ac59075b964b07152d234b70', 'Aftabul Islam Himel', '01677181006', 'toaihimel@gmail.com', 'zzZTjMvKJi', 'CSE', '1243', '2012', '0', '0', null, '0', '');
