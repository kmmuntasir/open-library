/*

Date: 2018-08-20 21:55:36

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
-- Records of `author`
-- ----------------------------
INSERT INTO `author` VALUES ("4", "IST_LIBRARY_2", "W. A. Triebel", "2018-03-28 19:36:04");
INSERT INTO `author` VALUES ("5", "IST_LIBRARY_3", "E. Balagurusamy", "2018-03-28 19:36:04");
INSERT INTO `author` VALUES ("6", "IST_LIBRARY_4", "Seymour Lipschutz", "2018-03-28 19:36:04");
INSERT INTO `author` VALUES ("50", "IST_LIBRARY_5", "Ahmed Shamsul Arefin", "2018-03-28 19:36:04");
INSERT INTO `author` VALUES ("52", "L_6", "মুহম্মদ জাফর ইকবাল", "2018-03-28 19:36:04");
INSERT INTO `author` VALUES ("53", "L_7", "আফসার-উজ-জামান", "2018-03-28 19:36:04");
INSERT INTO `author` VALUES ("54", "L_8", "Avtar Singh", "2018-03-28 19:36:04");
INSERT INTO `author` VALUES ("56", "L_10", "Udit Acharya", "2018-03-28 19:36:04");
INSERT INTO `author` VALUES ("57", "L_11", "Abraham Silberschatz", "2018-03-28 19:36:04");
INSERT INTO `author` VALUES ("58", "L_12", "Henry F. Korth", "2018-03-28 19:36:04");
INSERT INTO `author` VALUES ("59", "L_13", "S. Sudarshan", "2018-03-28 19:36:04");

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
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `book_ibfk_2` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `book`
-- ----------------------------
INSERT INTO `book` VALUES ("34", "IST_LIBRARY_2", "8676543234676", "Programming in ANSI C", "IST_LIBRARY_2", "2016-12-21 18:41:30", "IST_LIBRARY_1", "4th", "Delhi, India", "2011", "245", "1", "", "11", "10", "https://books.google.com.bd/books?id=AokcsKn-1iIC&lpg=PP1&pg=PP1&output=embed", "0", 0, "2018-03-28 19:42:17");
INSERT INTO `book` VALUES ("35", "IST_3", "12345", "Art of Programming Contest", "IST_LIBRARY_4", "2016-12-21 20:11:47", "IST_LIBRARY_1", "1st", "Dhaka, Bangladesh", "2009", "195", "1", "", "16", "15", "https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf", "0", 0, "2018-03-28 19:42:17");
INSERT INTO `book` VALUES ("36", "L_4", "2358094", "টাইট্রন একটি গ্রহের নাম", "L_5", "2016-12-21 23:48:54", "IST_LIBRARY_1", "1st", "Dhaka, Bangladesh", "2001", "68", "1", "", "7", "6", "http://download848.mediafire.com/mnocrzt5i9zg/bdoj3r01q09db5k/Titron+Ekti+Groher+Naam+%28allbdbooks.com%29.PDF", "0", 0, "2018-03-28 19:42:17");
INSERT INTO `book` VALUES ("37", "L_5", "uiy6756gh", "উচ্চ মাধ্যমিক জ্যামিতি ও ক্যালকুলাস", "L_5", "2016-12-21 23:50:17", "IST_LIBRARY_1", "2nd", "Dhaka, Bangladesh", "2011", "298", "1", "", "6", "5", null, "1", 0, "2018-03-28 19:42:17");
INSERT INTO `book` VALUES ("38", "L_6", "jkluio789023jod", "The 8088 and 8086 Microprocessor System", "IST_LIBRARY_3", "2016-12-21 23:52:48", "IST_LIBRARY_1", "3rd", "New Delhi", "2004", "593", "1", "", "3", "0", null, "1", 0, "2018-03-31 01:06:47");
INSERT INTO `book` VALUES ("39", "L_7", "39dkdk", "Bangla Grammar", "L_7", "2016-12-21 23:54:28", "IST_LIBRARY_1", "1st", "Dhaka, Bangladesh", "2000", "198", "1", "", "10", "8", null, "1", 0, "2018-03-31 01:05:06");
INSERT INTO `book` VALUES ("43", "L_8", "978-0073523323", "Database System Concepts", "L_7", "2017-12-23 13:07:08", "IST_LIBRARY_1", "6th", "Yale", "2006", "678", "1", "", "1", "0", "", "1", 0, "2018-03-28 23:13:47");

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `book_author`
-- ----------------------------
INSERT INTO `book_author` VALUES ("39", "", "L_5", "L_7");
INSERT INTO `book_author` VALUES ("40", "", "L_6", "IST_LIBRARY_2");
INSERT INTO `book_author` VALUES ("41", "", "L_6", "L_8");
INSERT INTO `book_author` VALUES ("47", "", "L_7", "L_10");
INSERT INTO `book_author` VALUES ("64", "", "IST_LIBRARY_2", "IST_LIBRARY_3");
INSERT INTO `book_author` VALUES ("65", "", "L_4", "L_6");
INSERT INTO `book_author` VALUES ("66", "", "L_8", "L_11");
INSERT INTO `book_author` VALUES ("67", "", "L_8", "L_12");
INSERT INTO `book_author` VALUES ("68", "", "L_8", "L_13");
INSERT INTO `book_author` VALUES ("69", "", "IST_3", "IST_LIBRARY_5");
INSERT INTO `book_author` VALUES ("70", "", "IST_3", "L_10");

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
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `book_category`
-- ----------------------------
INSERT INTO `book_category` VALUES ("82", "", "L_5", "L_8");
INSERT INTO `book_category` VALUES ("83", "", "L_5", "L_9");
INSERT INTO `book_category` VALUES ("84", "", "L_6", "L_10");
INSERT INTO `book_category` VALUES ("85", "", "L_6", "IST_LIBRARY_2");
INSERT INTO `book_category` VALUES ("86", "", "L_6", "IST_LIBRARY_1");
INSERT INTO `book_category` VALUES ("92", "", "L_7", "L_11");
INSERT INTO `book_category` VALUES ("124", "", "IST_LIBRARY_2", "IST_LIBRARY_1");
INSERT INTO `book_category` VALUES ("125", "", "IST_LIBRARY_2", "IST_LIBRARY_2");
INSERT INTO `book_category` VALUES ("126", "", "IST_LIBRARY_2", "IST_LIBRARY_4");
INSERT INTO `book_category` VALUES ("127", "", "IST_LIBRARY_2", "L_15");
INSERT INTO `book_category` VALUES ("128", "", "L_4", "L_6");
INSERT INTO `book_category` VALUES ("129", "", "L_4", "L_7");
INSERT INTO `book_category` VALUES ("130", "", "L_4", "L_15");
INSERT INTO `book_category` VALUES ("131", "", "L_8", "L_12");
INSERT INTO `book_category` VALUES ("132", "", "L_8", "IST_LIBRARY_4");
INSERT INTO `book_category` VALUES ("133", "", "L_8", "IST_LIBRARY_1");
INSERT INTO `book_category` VALUES ("134", "", "L_8", "L_15");
INSERT INTO `book_category` VALUES ("135", "", "IST_3", "IST_LIBRARY_1");
INSERT INTO `book_category` VALUES ("136", "", "IST_3", "IST_LIBRARY_2");
INSERT INTO `book_category` VALUES ("137", "", "IST_3", "L_15");

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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `book_copy`
-- ----------------------------
INSERT INTO `book_copy` VALUES ("5", "IST_LIBRARY_2", "IST_c_5", "1", "0", "2016-12-21", "93", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("26", "IST_LIBRARY_2", "IST_c_26", "1", "1", "2016-12-21", "75", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("27", "IST_LIBRARY_2", "IST_c_27", "1", "1", "2016-12-21", "75", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("28", "IST_LIBRARY_2", "IST_c_28", "1", "1", "2016-12-21", "75", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("29", "IST_LIBRARY_2", "IST_c_29", "1", "1", "2016-12-21", "75", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("30", "IST_LIBRARY_2", "IST_c_30", "1", "1", "2016-12-21", "75", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("31", "IST_LIBRARY_2", "IST_c_31", "1", "1", "2016-12-21", "75", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("32", "IST_LIBRARY_2", "IST_c_32", "1", "1", "2016-12-21", "75", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("33", "IST_LIBRARY_2", "IST_c_33", "1", "1", "2016-12-21", "75", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("34", "IST_LIBRARY_2", "IST_c_34", "1", "1", "2016-12-21", "75", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("35", "IST_LIBRARY_2", "IST_c_35", "1", "1", "2016-12-21", "75", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("36", "IST_3", "IST_c_36", "1", "0", "2016-12-21", "90", "1", "Original Copy from the Publisher, Hard Cover Binding", "IST_LIBRARY_1", "0", "2018-03-28 19:50:47");
INSERT INTO `book_copy` VALUES ("37", "IST_3", "IST_c_37", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("38", "IST_3", "IST_c_38", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("39", "IST_3", "IST_c_39", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("40", "IST_3", "IST_c_40", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("41", "IST_3", "IST_c_41", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("42", "IST_3", "IST_c_42", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("43", "IST_3", "IST_c_43", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("44", "IST_3", "IST_c_44", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("45", "IST_3", "IST_c_45", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("46", "IST_3", "IST_c_46", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("47", "IST_3", "IST_c_47", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("48", "IST_3", "IST_c_48", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("49", "IST_3", "IST_c_49", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("50", "IST_3", "IST_c_50", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("51", "IST_3", "IST_c_51", "1", "1", "2016-12-21", "72.5", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("52", "L_4", "L_c_52", "1", "0", "2016-12-21", "50", "1", "", "IST_LIBRARY_1", "1", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("53", "L_4", "L_c_53", "1", "1", "2016-12-21", "43", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("54", "L_4", "L_c_54", "1", "1", "2016-12-21", "43", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("55", "L_4", "L_c_55", "1", "1", "2016-12-21", "43", "1", "", "IST_LIBRARY_1", "1", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("56", "L_4", "L_c_56", "1", "1", "2016-12-21", "43", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("57", "L_4", "L_c_57", "1", "1", "2016-12-21", "43", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("58", "L_4", "L_c_58", "1", "1", "2016-12-21", "43", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("59", "L_4", "L_c_59", "1", "1", "2016-12-21", "43", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("60", "L_5", "L_c_60", "1", "0", "2016-12-21", "80", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("61", "L_5", "L_c_61", "1", "1", "2016-12-21", "72", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("62", "L_5", "L_c_62", "1", "1", "2016-12-21", "72", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("63", "L_5", "L_c_63", "1", "1", "2016-12-21", "72", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("64", "L_5", "L_c_64", "1", "1", "2016-12-21", "72", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("65", "L_5", "L_c_65", "1", "1", "2016-12-21", "72", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("66", "L_6", "L_c_66", "1", "0", "2016-12-21", "430", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("67", "L_6", "L_c_67", "0", "1", "2016-12-21", "450", "1", "", "IST_LIBRARY_1", "0", "2018-03-30 21:43:14");
INSERT INTO `book_copy` VALUES ("68", "L_6", "L_c_68", "1", "1", "2016-12-21", "450", "1", "", "IST_LIBRARY_1", "0", "2018-03-31 01:06:41");
INSERT INTO `book_copy` VALUES ("69", "L_6", "L_c_69", "1", "1", "2016-12-21", "450", "1", "", "IST_LIBRARY_1", "1", "2018-03-29 18:58:36");
INSERT INTO `book_copy` VALUES ("70", "L_6", "L_c_70", "1", "1", "2016-12-21", "450", "1", "", "IST_LIBRARY_1", "1", "2018-03-29 18:58:36");
INSERT INTO `book_copy` VALUES ("71", "L_6", "L_c_71", "1", "1", "2016-12-21", "450", "1", "", "IST_LIBRARY_1", "1", "2018-03-29 18:58:36");
INSERT INTO `book_copy` VALUES ("72", "L_6", "L_c_72", "1", "1", "2016-12-21", "450", "1", "", "IST_LIBRARY_1", "1", "2018-03-29 18:58:36");
INSERT INTO `book_copy` VALUES ("73", "L_6", "L_c_73", "1", "1", "2016-12-21", "450", "1", "", "IST_LIBRARY_1", "1", "2018-03-29 18:58:36");
INSERT INTO `book_copy` VALUES ("74", "L_6", "L_c_74", "1", "1", "2016-12-21", "450", "1", "", "IST_LIBRARY_1", "1", "2018-03-29 18:58:36");
INSERT INTO `book_copy` VALUES ("75", "L_6", "L_c_75", "1", "1", "2016-12-21", "450", "1", "", "IST_LIBRARY_1", "1", "2018-03-29 18:58:36");
INSERT INTO `book_copy` VALUES ("86", "L_7", "L_c_86", "1", "0", "2016-12-22", "187", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("87", "L_7", "L_c_87", "1", "1", "2016-12-22", "187", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("88", "L_7", "L_c_88", "1", "1", "2016-12-22", "187", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("89", "L_7", "L_c_89", "1", "1", "2016-12-22", "187", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("90", "L_7", "L_c_90", "1", "1", "2016-12-22", "187", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("91", "L_7", "L_c_91", "1", "1", "2016-12-22", "187", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("92", "L_7", "L_c_92", "1", "1", "2016-12-22", "187", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("93", "L_7", "L_c_93", "1", "1", "2016-12-22", "187", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("94", "L_7", "L_c_94", "1", "1", "2016-12-22", "187", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("95", "L_7", "L_c_95", "1", "1", "2016-12-22", "187", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("116", "L_8", "L_c_96", "1", "0", "2017-12-23", "1200", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("117", "L_8", "L_c_97", "1", "1", "2017-12-23", "270", "1", "", "IST_LIBRARY_1", "1", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("118", "L_8", "L_c_98", "1", "1", "2017-12-23", "270", "1", "", "IST_LIBRARY_1", "1", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("119", "L_8", "L_c_99", "1", "1", "2017-12-23", "270", "1", "", "IST_LIBRARY_1", "1", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("120", "L_8", "L_c_100", "1", "1", "2017-12-23", "270", "1", "", "IST_LIBRARY_1", "1", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("121", "L_8", "L_c_101", "1", "1", "2017-12-23", "270", "1", "", "IST_LIBRARY_1", "1", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("122", "L_8", "L_c_102", "1", "1", "2017-12-23", "270", "1", "", "IST_LIBRARY_1", "1", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("123", "L_8", "L_c_103", "1", "1", "2017-12-23", "270", "1", "", "IST_LIBRARY_1", "1", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("124", "L_8", "L_c_104", "1", "1", "2017-12-23", "100", "1", "", "IST_LIBRARY_1", "1", "2018-03-28 19:35:15");
INSERT INTO `book_copy` VALUES ("125", "L_4", "L_c_105", "1", "0", "2018-03-15", "120", "1", "", "IST_LIBRARY_1", "0", "2018-03-28 19:35:15");

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
-- Records of `category`
-- ----------------------------
INSERT INTO `category` VALUES ("1", "IST_LIBRARY_1", "Computer", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("2", "IST_LIBRARY_2", "Programming", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("4", "IST_LIBRARY_3", "Programming Contest", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("5", "IST_LIBRARY_4", "CSE Course", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("6", "IST_LIBRARY_5", "Bangla Programming", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("8", "L_6", "Science Fiction", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("9", "L_7", "Novel", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("10", "L_8", "Mathematics", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("11", "L_9", "H.S.C Books", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("12", "L_10", "Microprocessor", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("13", "L_11", "Test Category", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("14", "L_12", "Database", "2018-03-28 19:38:16");
INSERT INTO `category` VALUES ("24", "L_15", "Merge Category 3", "2018-03-29 01:56:28");

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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `issue`
-- ----------------------------
INSERT INTO `issue` VALUES ("52", "L_1", "2018-03-30 21:43:14", null, "2018-04-14 16:30:00", null, "L_6", "L_c_67", "L_7", "IST_LIBRARY_1", "1", "oCPJW7V&", "I3e63uVr", "%z2wuOwV", "TwzDY9ZQ", "UmMsXTmg", "#@NVR7jh", "", "0", "0");
INSERT INTO `issue` VALUES ("53", "L_2", "2018-03-30 21:43:28", "2018-03-31 01:06:41", "2018-04-14 16:30:00", null, "L_6", "L_c_68", "L_9", "IST_LIBRARY_1", "3", "I3#H5&ic", "0QwEH43Y", "T6wqaH&R", "Tk31QQO2", "gjJulfeI", "UmEmZgif", "", "0", "0");
INSERT INTO `issue` VALUES ("54", "R_1", "2018-03-31 00:55:27", null, null, "2018-04-02 16:30:00", "L_6", null, "IST_1", null, "0", "0Di&aUxA", "w&nIc6Lq", "n%4u4AV&", "0nBFXTHl", "30q6Cb6#", "l%ISf#1p", "", "0", "0");
INSERT INTO `issue` VALUES ("55", "R_2", "2018-03-31 01:04:17", null, null, "2018-04-02 16:30:00", "L_7", null, "IST_1", null, "0", "IJU2d11L", "KeYb3ZyD", "KmxsS4zJ", "7JcgD#F&", "KGcJXExh", "Mx9a@m%N", "", "0", "0");
INSERT INTO `issue` VALUES ("56", "R_3", "2018-03-31 01:04:37", null, null, "2018-04-02 16:30:00", "L_6", null, "IST_2", null, "6", "ZId2AgIy", "7t#xs6Ay", "jxgssD5G", "&4iX%Ymz", "boPx1@H1", "YERf24Be", "", "0", "0");

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
) ENGINE=InnoDB AUTO_INCREMENT=658 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `log`
-- ----------------------------
INSERT INTO `log` VALUES ("599", "L_1", "UPDATE `book` SET `book_available` = 1 WHERE `book_id` = \'L_6\'", "1", "2018-03-30 21:43:14");
INSERT INTO `log` VALUES ("600", "L_600", "UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_67\'", "1", "2018-03-30 21:43:15");
INSERT INTO `log` VALUES ("601", "L_601", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_1\', \'2018-03-30 21:43:14\', \'2018-04-14 16:30:00\', \'L_6\', \'L_c_67\', \'L_7\', \'IST_LIBRARY_1\', 1, \'oCPJW7V&\', \'I3e63uVr\', \'%z2wuOwV\', \'TwzDY9ZQ\', \'UmMsXTmg\', \'#@NVR7jh\', \'\')", "1", "2018-03-30 21:43:15");
INSERT INTO `log` VALUES ("602", "L_602", "UPDATE `book` SET `book_available` = 0 WHERE `book_id` = \'L_6\'", "1", "2018-03-30 21:43:28");
INSERT INTO `log` VALUES ("603", "L_603", "UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_68\'", "1", "2018-03-30 21:43:28");
INSERT INTO `log` VALUES ("604", "L_604", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_2\', \'2018-03-30 21:43:28\', \'2018-04-14 16:30:00\', \'L_6\', \'L_c_68\', \'L_9\', \'IST_LIBRARY_1\', 1, \'I3#H5&ic\', \'0QwEH43Y\', \'T6wqaH&R\', \'Tk31QQO2\', \'gjJulfeI\', \'UmEmZgif\', \'\')", "1", "2018-03-30 21:43:28");
INSERT INTO `log` VALUES ("605", "R_1", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'R_1\', \'2018-03-31 00:55:27\', \'2018-04-02 16:30:00\', \'L_6\', \'IST_1\', 9, \'0Di&aUxA\', \'w&nIc6Lq\', \'n%4u4AV&\', \'0nBFXTHl\', \'30q6Cb6#\', \'l%ISf#1p\', \'\')", "1", "2018-03-31 00:55:27");
INSERT INTO `log` VALUES ("606", "R_600", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'R_2\', \'2018-03-31 01:04:17\', \'2018-04-02 16:30:00\', \'L_7\', \'IST_1\', 9, \'IJU2d11L\', \'KeYb3ZyD\', \'KmxsS4zJ\', \'7JcgD#F&\', \'KGcJXExh\', \'Mx9a@m%N\', \'\')", "1", "2018-03-31 01:04:17");
INSERT INTO `log` VALUES ("607", "R_601", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'R_3\', \'2018-03-31 01:04:37\', \'2018-04-02 16:30:00\', \'L_6\', \'IST_2\', 9, \'ZId2AgIy\', \'7t#xs6Ay\', \'jxgssD5G\', \'&4iX%Ymz\', \'boPx1@H1\', \'YERf24Be\', \'\')", "1", "2018-03-31 01:04:37");
INSERT INTO `log` VALUES ("608", "L_608", "UPDATE `book` SET `book_id` = \'L_6\' WHERE `book_id` = \'L_6\'", "1", "2018-03-31 01:05:06");
INSERT INTO `log` VALUES ("609", "L_609", "UPDATE `issue` SET `issue_id` = \'R_1\', `issue_status` = 6 WHERE `issue_id` = \'R_1\'", "1", "2018-03-31 01:05:06");
INSERT INTO `log` VALUES ("610", "L_610", "UPDATE `book` SET `book_id` = \'L_7\', `book_available` = 8 WHERE `book_id` = \'L_7\'", "1", "2018-03-31 01:05:06");
INSERT INTO `log` VALUES ("611", "L_611", "UPDATE `issue` SET `issue_id` = \'R_2\', `issue_status` = 0 WHERE `issue_id` = \'R_2\'", "1", "2018-03-31 01:05:06");
INSERT INTO `log` VALUES ("612", "L_612", "UPDATE `book` SET `book_id` = \'L_6\' WHERE `book_id` = \'L_6\'", "1", "2018-03-31 01:05:06");
INSERT INTO `log` VALUES ("613", "L_613", "UPDATE `issue` SET `issue_id` = \'R_3\', `issue_status` = 6 WHERE `issue_id` = \'R_3\'", "1", "2018-03-31 01:05:06");
INSERT INTO `log` VALUES ("614", "L_614", "UPDATE `book` SET `book_id` = \'L_6\', `book_available` = 1 WHERE `book_id` = \'L_6\'", "1", "2018-03-31 01:06:41");
INSERT INTO `log` VALUES ("615", "L_615", "UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_68\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_68\'", "1", "2018-03-31 01:06:41");
INSERT INTO `log` VALUES ("616", "L_616", "UPDATE `issue` SET `issue_id` = \'L_2\', `issue_status` = 3, `issue_return_datetime` = \'2018-03-31 01:06:41\' WHERE `issue_id` = \'L_2\'", "1", "2018-03-31 01:06:41");
INSERT INTO `log` VALUES ("617", "L_617", "UPDATE `book` SET `book_id` = \'L_6\', `book_available` = 0 WHERE `book_id` = \'L_6\'", "1", "2018-03-31 01:06:47");
INSERT INTO `log` VALUES ("618", "L_618", "UPDATE `issue` SET `issue_id` = \'R_1\', `issue_status` = 0 WHERE `issue_id` = \'R_1\'", "1", "2018-03-31 01:06:48");
INSERT INTO `log` VALUES ("619", "L_619", "INSERT INTO `manager` (`manager_name`, `manager_phone`, `manager_email`, `manager_user`, `is_admin`, `manager_id`, `manager_pass`) VALUES (\'Hello\', \'1239550\', \'ljasdf@lkj.com\', \'hello\', \'1\', \'L_7\', \'202cb962ac59075b964b07152d234b70\')", "0", "2018-08-20 18:05:26");
INSERT INTO `log` VALUES ("620", "L_620", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'1\' WHERE `manager_id` = \'L_7\'", "0", "2018-08-20 18:16:12");
INSERT INTO `log` VALUES ("621", "L_621", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'0\' WHERE `manager_id` = \'L_7\'", "0", "2018-08-20 18:16:16");
INSERT INTO `log` VALUES ("622", "L_622", "UPDATE `manager` SET `manager_name` = \'Muntasir Billah Munna\', `manager_phone` = \'01516180603\', `manager_email` = \'kmmuntasir@gmail.com\', `manager_user` = \'munna_library\', `is_admin` = \'0\' WHERE `manager_id` = \'IST_LIBRARY_1\'", "0", "2018-08-20 19:46:21");
INSERT INTO `log` VALUES ("623", "L_623", "UPDATE `manager` SET `manager_name` = \'Muntasir Billah Munna\', `manager_phone` = \'01516180603\', `manager_email` = \'kmmuntasir@gmail.com\', `manager_user` = \'munna_library\' WHERE `manager_id` = \'IST_LIBRARY_1\'", "0", "2018-08-20 19:47:03");
INSERT INTO `log` VALUES ("624", "L_624", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'0\' WHERE `manager_id` = \'L_7\'", "0", "2018-08-20 19:49:13");
INSERT INTO `log` VALUES ("625", "L_625", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'1\' WHERE `manager_id` = \'L_7\'", "0", "2018-08-20 19:49:16");
INSERT INTO `log` VALUES ("626", "L_626", "UPDATE `manager` SET `manager_name` = \'Salma\', `manager_phone` = \'23455\', `manager_email` = \'sal@ma.com\', `manager_user` = \'salma\', `is_admin` = \'1\' WHERE `manager_id` = \'L_3\'", "0", "2018-08-20 20:01:29");
INSERT INTO `log` VALUES ("627", "L_627", "UPDATE `manager` SET `manager_name` = \'Salma\', `manager_phone` = \'23455\', `manager_email` = \'sal@ma.com\', `manager_user` = \'salma\', `is_admin` = \'1\', `manager_pass` = \'202cb962ac59075b964b07152d234b70\' WHERE `manager_id` = \'L_3\'", "0", "2018-08-20 20:02:55");
INSERT INTO `log` VALUES ("628", "L_628", "UPDATE `manager` SET `manager_name` = \'Khalilullah\', `manager_phone` = \'234567\', `manager_email` = \'khalil@mia.com\', `manager_user` = \'khalil\', `is_admin` = \'0\', `manager_pass` = \'202cb962ac59075b964b07152d234b70\' WHERE `manager_id` = \'L_2\'", "0", "2018-08-20 20:03:36");
INSERT INTO `log` VALUES ("629", "L_629", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'0\' WHERE `manager_id` = \'L_7\'", "0", "2018-08-20 20:05:04");
INSERT INTO `log` VALUES ("630", "L_630", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'1\' WHERE `manager_id` = \'L_7\'", "0", "2018-08-20 20:05:13");
INSERT INTO `log` VALUES ("631", "L_631", "UPDATE `user` SET `user_name` = \'Md. Moyeenul Hasan Durjoy\', `user_dept` = \'BBA\', `user_session` = \'2017\', `user_roll` = \'1036\', `user_phone` = \'12355677888\', `user_email` = \'durjoy@mail.com\', `user_username` = \'durjoy\' WHERE `user_id` = \'L_7\'", "0", "2018-08-20 20:08:43");
INSERT INTO `log` VALUES ("632", "L_632", "UPDATE `user` SET `user_name` = \'Aftabul Islam Himel\', `user_dept` = \'CSE\', `user_session` = \'2012\', `user_roll` = \'1057\', `user_phone` = \'01677181006\', `user_email` = \'toaihimel@gmail.com\', `user_username` = \'himel\' WHERE `user_id` = \'L_9\'", "0", "2018-08-20 20:09:37");
INSERT INTO `log` VALUES ("633", "L_633", "UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'L_9\'", "0", "2018-08-20 20:10:54");
INSERT INTO `log` VALUES ("634", "L_634", "UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'L_9\'", "0", "2018-08-20 20:11:09");
INSERT INTO `log` VALUES ("635", "L_635", "UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'L_8\'", "0", "2018-08-20 20:11:15");
INSERT INTO `log` VALUES ("636", "L_636", "UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'L_8\'", "0", "2018-08-20 20:11:26");
INSERT INTO `log` VALUES ("637", "L_637", "UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'L_8\'", "0", "2018-08-20 20:15:12");
INSERT INTO `log` VALUES ("638", "L_638", "UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'L_8\'", "0", "2018-08-20 20:15:22");
INSERT INTO `log` VALUES ("639", "L_639", "UPDATE `user` SET `user_name` = \'K. M. Muntasir Billah Munna\', `user_dept` = \'CSE\', `teacher_designation` = \'Faculty Member\', `user_phone` = \'015161806030\', `user_email` = \'kmmuntasir@gmail.com\', `user_username` = \'muntasir\' WHERE `user_id` = \'IST_3\'", "0", "2018-08-20 20:16:39");
INSERT INTO `log` VALUES ("640", "L_640", "UPDATE `user` SET `user_name` = \'K. M. Muntasir Billah Munna\', `user_dept` = \'CSE\', `teacher_designation` = \'Faculty Member\', `user_phone` = \'015161806030\', `user_email` = \'kmmuntasir@gmail.com\', `user_username` = \'muntasir\' WHERE `user_id` = \'IST_3\'", "0", "2018-08-20 20:18:38");
INSERT INTO `log` VALUES ("641", "L_641", "UPDATE `user` SET `user_name` = \'K. M. Muntasir Billah Munna\', `user_dept` = \'CSE\', `teacher_designation` = \'Faculty Member\', `user_phone` = \'01516180603\', `user_email` = \'kmmuntasir@gmail.com\', `user_username` = \'muntasir\' WHERE `user_id` = \'IST_3\'", "0", "2018-08-20 20:18:45");
INSERT INTO `log` VALUES ("642", "L_642", "UPDATE `user` SET `user_name` = \'K. M. Muntasir Billah Munna\', `user_dept` = \'CSE\', `teacher_designation` = \'Faculty Member\', `user_phone` = \'01516180603\', `user_email` = \'kmmuntasir@gmail.com\', `user_username` = \'muntasir\' WHERE `user_id` = \'IST_3\'", "0", "2018-08-20 20:19:08");
INSERT INTO `log` VALUES ("643", "L_643", "UPDATE `user` SET `user_name` = \'Muntasir Billah\', `user_dept` = \'CSE\', `user_session` = \'2009\', `user_roll` = \'1057\', `user_phone` = \'01516180603\', `user_email` = \'mun@na.com\', `user_username` = \'munna\' WHERE `user_id` = \'IST_1\'", "0", "2018-08-20 20:19:30");
INSERT INTO `log` VALUES ("644", "L_644", "UPDATE `user` SET `user_name` = \'Muntasir Billah\', `user_dept` = \'CSE\', `user_session` = \'2009\', `user_roll` = \'1057\', `user_phone` = \'015161806030\', `user_email` = \'mun@na.com\', `user_username` = \'munna\' WHERE `user_id` = \'IST_1\'", "0", "2018-08-20 20:19:35");
INSERT INTO `log` VALUES ("645", "L_645", "UPDATE `user` SET `user_name` = \'Muntasir Billah\', `user_dept` = \'CSE\', `user_session` = \'2009\', `user_roll` = \'1057\', `user_phone` = \'01516180603\', `user_email` = \'mun@na.com\', `user_username` = \'munna\' WHERE `user_id` = \'IST_1\'", "0", "2018-08-20 20:19:38");
INSERT INTO `log` VALUES ("646", "L_646", "UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'L_9\'", "0", "2018-08-20 20:19:41");
INSERT INTO `log` VALUES ("647", "L_647", "UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'L_9\'", "0", "2018-08-20 20:19:46");
INSERT INTO `log` VALUES ("648", "L_648", "UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'L_8\'", "0", "2018-08-20 20:19:54");
INSERT INTO `log` VALUES ("649", "L_649", "UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'L_8\'", "0", "2018-08-20 20:19:59");
INSERT INTO `log` VALUES ("650", "L_650", "UPDATE `book_copy` SET `book_copy_is_deleted` = 1 WHERE `book_id` = \'IST_3\' AND `book_copy_id` > `IS` `NULL` AND `book_copy_id` <= \'46\' AND `book_copy_type` = 1 AND `book_copy_status` = 1 AND `book_copy_is_deleted` =0", "0", "2018-08-20 21:44:57");
INSERT INTO `log` VALUES ("651", "L_651", "UPDATE `book` SET `book_stock` = 17, `book_available` = 16 WHERE `book_id` = \'IST_3\'", "0", "2018-08-20 21:44:57");
INSERT INTO `log` VALUES ("652", "L_652", "UPDATE `book_copy` SET `book_copy_is_deleted` = 1 WHERE `book_id` = \'IST_3\' AND `book_copy_id` > `IS` `NULL` AND `book_copy_id` <= \'46\' AND `book_copy_type` =0 AND `book_copy_status` = 1 AND `book_copy_is_deleted` =0", "0", "2018-08-20 21:44:57");
INSERT INTO `log` VALUES ("653", "L_653", "UPDATE `book` SET `book_stock` = 18 WHERE `book_id` = \'IST_3\'", "0", "2018-08-20 21:44:57");
INSERT INTO `log` VALUES ("654", "L_654", "UPDATE `book_copy` SET `book_copy_is_deleted` = 1 WHERE `book_id` = \'IST_3\' AND `book_copy_id` > `IS` `NULL` AND `book_copy_id` < `IS` `NULL` AND `book_copy_type` = 1 AND `book_copy_status` = 1 AND `book_copy_is_deleted` =0", "0", "2018-08-20 21:45:26");
INSERT INTO `log` VALUES ("655", "L_655", "UPDATE `book` SET `book_stock` = 17, `book_available` = 16 WHERE `book_id` = \'IST_3\'", "0", "2018-08-20 21:45:26");
INSERT INTO `log` VALUES ("656", "L_656", "UPDATE `book_copy` SET `book_copy_is_deleted` = 1 WHERE `book_id` = \'IST_3\' AND `book_copy_id` > `IS` `NULL` AND `book_copy_id` < `IS` `NULL` AND `book_copy_type` =0 AND `book_copy_status` = 1 AND `book_copy_is_deleted` =0", "0", "2018-08-20 21:45:26");
INSERT INTO `log` VALUES ("657", "L_657", "UPDATE `book` SET `book_stock` = 18 WHERE `book_id` = \'IST_3\'", "0", "2018-08-20 21:45:26");

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
-- Records of `manager`
-- ----------------------------
INSERT INTO `manager` VALUES ("1", "IST_LIBRARY_1", "munna_library", "827ccb0eea8a706c4c34a16891f84e7b", "Muntasir Billah Munna", "01516180603", "kmmuntasir@gmail.com", "2", "0", "2018-08-20 19:46:38");
INSERT INTO `manager` VALUES ("3", "L_2", "khalil", "202cb962ac59075b964b07152d234b70", "Khalilullah", "234567", "khalil@mia.com", "0", "0", "2018-08-20 20:03:36");
INSERT INTO `manager` VALUES ("4", "L_3", "salma", "202cb962ac59075b964b07152d234b70", "Salma", "23455", "sal@ma.com", "1", "0", "2018-08-20 20:02:55");
INSERT INTO `manager` VALUES ("6", "L_5", "boby", "827ccb0eea8a706c4c34a16891f84e7b", "Farjana Boby", "123465789", "boby@bob.com", "0", "1", "2018-03-28 19:35:38");
INSERT INTO `manager` VALUES ("7", "L_7", "hello", "202cb962ac59075b964b07152d234b70", "Hello", "1239550", "ljasdf@lkj.com", "1", "0", "2018-08-20 20:05:13");

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
-- Records of `publication`
-- ----------------------------
INSERT INTO `publication` VALUES ("1", "IST_LIBRARY_1", "Schaum\'s Outlines", "2018-03-28 19:37:55");
INSERT INTO `publication` VALUES ("2", "IST_LIBRARY_2", "TATA mCGRAW Hills", "2018-03-28 19:37:55");
INSERT INTO `publication` VALUES ("3", "IST_LIBRARY_3", "Prentice-Hall India", "2018-03-28 19:37:55");
INSERT INTO `publication` VALUES ("35", "IST_LIBRARY_4", "শিখা প্রকাশনী", "2018-03-28 19:37:55");
INSERT INTO `publication` VALUES ("37", "L_5", "Gyankosh Prokashoni, Bangladesh", "2018-03-28 19:37:55");
INSERT INTO `publication` VALUES ("39", "L_7", "Yale Publishers", "2018-03-28 19:37:55");

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
-- Records of `server`
-- ----------------------------
INSERT INTO `server` VALUES ("1", "remote", "http://library.ist.edu.bd/index.php", "2018-03-31 01:06:52", "1", "0", "HF1EBAvrgB");

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
-- Records of `settings`
-- ----------------------------
INSERT INTO `settings` VALUES ("1", "HF1EBAvrgB", "15", "2", "2", "BDT ", "/=", "0", "Institute of Science and Technology", "d9b968f458576bc4302a76fb7ff68c4c.png", "c47e97c062d1c304619ef00a915e11fe.ico", "House #54, Road #15/A, Dhanmondi, Dhaka-1209", "info@ist.edu.bd", "01711223344", "1");

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `user`
-- ----------------------------
INSERT INTO `user` VALUES ("1", "IST_1", "munna", "202cb962ac59075b964b07152d234b70", "Muntasir Billah", "01516180603", "mun@na.com", "bBz7L@3WiW", "CSE", "1057", "2009", "0", "0", null, "0", "", "2018-08-20 20:19:38");
INSERT INTO `user` VALUES ("2", "IST_2", "rubayet33", "81dc9bdb52d04dc20036dbd8313ed055", "Rubayet Hossain", "0987654345678", "rub@ayet.com", "123", "CSE", "1014", "2009", "0", "0", null, "0", "", "2018-03-29 18:44:46");
INSERT INTO `user` VALUES ("3", "IST_3", "muntasir", "81dc9bdb52d04dc20036dbd8313ed055", "K. M. Muntasir Billah Munna", "01516180603", "kmmuntasir@gmail.com", "HF1EBAvrgB", "CSE", "", "0000", "1", "21", "Faculty Member", "0", "", "2018-08-20 20:18:45");
INSERT INTO `user` VALUES ("6", "L_5", "rakib", "202cb962ac59075b964b07152d234b70", "Md. Rakib Hossain", "12345678904845", "rakib@gmail.com", "E2971AAC8809C0E0232FAEC1924D1176", "ECE", "", "0000", "1", "0", "Faculty Member", "0", "", "2018-03-28 19:34:31");
INSERT INTO `user` VALUES ("7", "L_6", "taniasultana", "202cb962ac59075b964b07152d234b70", "Mrs. Tania Sultana", "0984323456787", "tania@gmail.com", "943BF7D405B44375372A221F669A261A", "CSE", "", "0000", "1", "0", "Faculty Member", "0", "", "2018-03-28 19:34:31");
INSERT INTO `user` VALUES ("8", "L_7", "durjoy", "202cb962ac59075b964b07152d234b70", "Md. Moyeenul Hasan Durjoy", "12355677888", "durjoy@mail.com", "yWd0ehWofG", "BBA", "1036", "2017", "0", "0", null, "0", "GPKRbsUWVZF8yFGYbOLl", "2018-08-20 20:08:43");
INSERT INTO `user` VALUES ("9", "L_8", "srafique", "e5a93371cfc7eab4a88221dd1f6c1a3c", "Prof. Dr. Shahida Rafique", "01819256950", "srafique@univdhaka.edu", "wNl5bpp", "ECE", "", "0000", "1", "0", "Professor", "0", "", "2018-08-20 20:19:59");
INSERT INTO `user` VALUES ("10", "L_9", "himel", "202cb962ac59075b964b07152d234b70", "Aftabul Islam Himel", "01677181006", "toaihimel@gmail.com", "zzZTjMvKJi", "CSE", "1057", "2012", "0", "0", null, "0", "", "2018-08-20 20:19:46");

