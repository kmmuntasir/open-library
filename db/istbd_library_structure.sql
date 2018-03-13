/*
Navicat MySQL Data Transfer

Source Server         : lampp
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : istbd_library

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2016-12-01 01:23:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `author`
-- ----------------------------
DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
`author_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`author_name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
PRIMARY KEY (`author_id`, `author_name`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=2095

;

-- ----------------------------
-- Table structure for `book`
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
`book_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`book_isbn`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '' ,
`book_title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`publication_id`  int(10) UNSIGNED NOT NULL ,
`book_add_date`  datetime NOT NULL ,
`manager_id`  int(10) UNSIGNED NOT NULL ,
`book_edition`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`book_place_of_pub`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`book_year_of_pub`  year NULL DEFAULT NULL ,
`book_pages`  int(11) NULL DEFAULT NULL ,
`book_status`  tinyint(4) NOT NULL ,
`book_remarks`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`book_stock`  int(11) NOT NULL DEFAULT 0 ,
`book_available`  int(11) NOT NULL DEFAULT 0 ,
PRIMARY KEY (`book_id`, `book_isbn`),
FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`) ON DELETE CASCADE ON UPDATE CASCADE,
INDEX `book_id` (`book_id`) USING BTREE ,
INDEX `book_pub_FK_1` (`publication_id`) USING BTREE ,
INDEX `book_manager_FK_2` (`manager_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=56

;

-- ----------------------------
-- Table structure for `book_author`
-- ----------------------------
DROP TABLE IF EXISTS `book_author`;
CREATE TABLE `book_author` (
`book_author_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`book_id`  int(10) UNSIGNED NOT NULL ,
`author_id`  int(10) UNSIGNED NOT NULL ,
PRIMARY KEY (`book_author_id`),
FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
INDEX `book_author_book_FK_1` (`book_id`) USING BTREE ,
INDEX `book_author_author_FK_2` (`author_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=104

;

-- ----------------------------
-- Table structure for `book_category`
-- ----------------------------
DROP TABLE IF EXISTS `book_category`;
CREATE TABLE `book_category` (
`book_category_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`book_id`  int(10) UNSIGNED NOT NULL ,
`category_id`  int(10) UNSIGNED NOT NULL ,
PRIMARY KEY (`book_category_id`),
FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
INDEX `book_category_book_FK_1` (`book_id`) USING BTREE ,
INDEX `book_category_category` (`category_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=293

;

-- ----------------------------
-- Table structure for `book_copy`
-- ----------------------------
DROP TABLE IF EXISTS `book_copy`;
CREATE TABLE `book_copy` (
`book_copy_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`book_id`  int(10) UNSIGNED NOT NULL ,
`book_copy_accession_no`  int(10) UNSIGNED NOT NULL ,
`book_copy_status`  tinyint(1) NOT NULL ,
`book_copy_type`  tinyint(1) NOT NULL ,
`book_copy_date`  date NOT NULL ,
`book_copy_price`  float NULL DEFAULT NULL ,
`book_copy_source`  tinyint(1) NULL DEFAULT NULL ,
`book_copy_remarks`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`book_copy_manager_id`  int(10) UNSIGNED NULL DEFAULT NULL ,
`book_copy_is_deleted`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 ,
PRIMARY KEY (`book_copy_id`, `book_copy_accession_no`),
FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`book_copy_manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE,
INDEX `book_copy_book_FK1` (`book_id`) USING BTREE ,
INDEX `book_copy_manager_FK2` (`book_copy_manager_id`) USING BTREE ,
INDEX `book_copy_id` (`book_copy_id`) USING BTREE ,
INDEX `book_copy_accession_no` (`book_copy_accession_no`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=264

;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
`category_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`category_name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
PRIMARY KEY (`category_id`, `category_name`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=126

;

-- ----------------------------
-- Table structure for `issue`
-- ----------------------------
DROP TABLE IF EXISTS `issue`;
CREATE TABLE `issue` (
`issue_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`issue_datetime`  datetime NOT NULL ,
`issue_return_datetime`  datetime NULL DEFAULT NULL ,
`issue_deadline`  datetime NULL DEFAULT NULL ,
`issue_auto_expire_datetime`  datetime NULL DEFAULT NULL ,
`issue_book_id`  int(10) UNSIGNED NOT NULL ,
`issue_book_copy_accession_no`  int(10) UNSIGNED NULL DEFAULT NULL ,
`user_id`  int(10) UNSIGNED NOT NULL ,
`manager_id`  int(10) UNSIGNED NOT NULL ,
`issue_status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 ,
`issue_lend_user_code`  varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`issue_receive_user_code`  varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`issue_receive_admin_code`  varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`issue_fine_user_code`  varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`issue_fine_admin_code`  varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`issue_renew_user_code`  varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`issue_remarks`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`issue_id`),
FOREIGN KEY (`issue_book_copy_accession_no`) REFERENCES `book_copy` (`book_copy_accession_no`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`issue_book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
INDEX `user_issue_FK_2` (`user_id`) USING BTREE ,
INDEX `manager_issue_FK_3` (`manager_id`) USING BTREE ,
INDEX `book_issue_FK_4` (`issue_book_id`) USING BTREE ,
INDEX `book_copy_issue_FK_1` (`issue_book_copy_accession_no`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=162

;

-- ----------------------------
-- Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
`log_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`log_query`  longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`log_is_synced`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 ,
PRIMARY KEY (`log_id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=280

;

-- ----------------------------
-- Table structure for `manager`
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
`manager_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`manager_user`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`manager_pass`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`manager_name`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`manager_phone`  varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '' ,
`manager_email`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`is_admin`  tinyint(2) NOT NULL ,
PRIMARY KEY (`manager_id`, `manager_user`, `manager_phone`, `manager_email`),
INDEX `manager_id` (`manager_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=4

;

-- ----------------------------
-- Table structure for `publication`
-- ----------------------------
DROP TABLE IF EXISTS `publication`;
CREATE TABLE `publication` (
`publication_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`publication_name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
PRIMARY KEY (`publication_id`, `publication_name`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=68

;

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
`user_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`user_username`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`user_pass`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`user_name`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`user_phone`  varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '' ,
`user_email`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`user_library_code`  varchar(35) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`user_dept`  varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`user_roll`  varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`user_session`  year NOT NULL ,
`is_teacher`  tinyint(1) UNSIGNED NULL DEFAULT 0 ,
PRIMARY KEY (`user_id`, `user_username`, `user_phone`, `user_email`, `user_library_code`),
INDEX `user_id` (`user_id`) USING BTREE ,
INDEX `user_code` (`user_library_code`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=3

;

-- ----------------------------
-- Auto increment value for `author`
-- ----------------------------
ALTER TABLE `author` AUTO_INCREMENT=2095;

-- ----------------------------
-- Auto increment value for `book`
-- ----------------------------
ALTER TABLE `book` AUTO_INCREMENT=56;

-- ----------------------------
-- Auto increment value for `book_author`
-- ----------------------------
ALTER TABLE `book_author` AUTO_INCREMENT=104;

-- ----------------------------
-- Auto increment value for `book_category`
-- ----------------------------
ALTER TABLE `book_category` AUTO_INCREMENT=293;

-- ----------------------------
-- Auto increment value for `book_copy`
-- ----------------------------
ALTER TABLE `book_copy` AUTO_INCREMENT=264;

-- ----------------------------
-- Auto increment value for `category`
-- ----------------------------
ALTER TABLE `category` AUTO_INCREMENT=126;

-- ----------------------------
-- Auto increment value for `issue`
-- ----------------------------
ALTER TABLE `issue` AUTO_INCREMENT=162;

-- ----------------------------
-- Auto increment value for `log`
-- ----------------------------
ALTER TABLE `log` AUTO_INCREMENT=280;

-- ----------------------------
-- Auto increment value for `manager`
-- ----------------------------
ALTER TABLE `manager` AUTO_INCREMENT=4;

-- ----------------------------
-- Auto increment value for `publication`
-- ----------------------------
ALTER TABLE `publication` AUTO_INCREMENT=68;

-- ----------------------------
-- Auto increment value for `user`
-- ----------------------------
ALTER TABLE `user` AUTO_INCREMENT=3;
