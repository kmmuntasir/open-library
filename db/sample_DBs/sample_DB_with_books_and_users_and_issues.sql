/*

Date: 2018-08-26 00:40:46

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `author`
-- ----------------------------
INSERT INTO `author` VALUES ("1", "L_1", "Ahmed Shamsul Arefin", "2018-08-23 21:16:31");
INSERT INTO `author` VALUES ("2", "L_2", "E. Balagurusamy", "2018-08-23 21:17:41");
INSERT INTO `author` VALUES ("3", "L_3", "মুহম্মদ জাফর ইকবাল", "2018-08-23 21:19:14");
INSERT INTO `author` VALUES ("4", "L_4", "আফসার-উজ-জামান", "2018-08-23 21:19:50");
INSERT INTO `author` VALUES ("5", "L_5", "W. A. Triebel", "2018-08-23 21:20:39");
INSERT INTO `author` VALUES ("6", "L_6", "Avtar Singh", "2018-08-23 21:20:39");
INSERT INTO `author` VALUES ("7", "L_7", "Udit Acharya", "2018-08-23 21:21:12");
INSERT INTO `author` VALUES ("8", "L_8", "Abraham Silberschatz", "2018-08-23 21:21:49");
INSERT INTO `author` VALUES ("9", "L_9", "Henry F. Korth", "2018-08-23 21:21:49");
INSERT INTO `author` VALUES ("10", "L_10", "S. Sudarshan", "2018-08-23 21:21:49");
INSERT INTO `author` VALUES ("11", "L_11", "Seymour Lipschutz", "2018-08-23 21:22:27");

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `book`
-- ----------------------------
INSERT INTO `book` VALUES ("1", "L_1", "784-51467896", "Art of Programming Contest", "L_1", "2018-08-23 21:16:31", "IST_LIBRARY_1", "1st", "Dhaka", "2009", "195", "1", "", "16", "14", "https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf", "1", 0, "2018-08-23 22:29:25");
INSERT INTO `book` VALUES ("2", "L_2", "867-65432346", "Programming in ANSI C", "L_2", "2018-08-23 21:17:41", "IST_LIBRARY_1", "4th", "Delhi", "2011", "245", "1", "", "11", "9", "https://books.google.com.bd/books?id=AokcsKn-1iIC&lpg=PP1&pg=PP1&output=embed", "1", 0, "2018-08-23 22:38:16");
INSERT INTO `book` VALUES ("3", "L_3", "235-80948439", "টাইট্রন একটি গ্রহের নাম", "L_1", "2018-08-23 21:19:14", "IST_LIBRARY_1", "1st", "Dhaka", "1988", "68", "1", "", "7", "6", "http://download848.mediafire.com/mnocrzt5i9zg/bdoj3r01q09db5k/Titron+Ekti+Groher+Naam+%28allbdbooks.com%29.PDF", "1", 0, "2018-08-23 21:41:21");
INSERT INTO `book` VALUES ("4", "L_4", "812-76381358", "উচ্চ মাধ্যমিক জ্যামিতি ও ক্যালকুলাস", "L_3", "2018-08-23 21:19:50", "IST_LIBRARY_1", "2nd", "Dhaka", "2011", "298", "1", "", "6", "4", "", "1", 0, "2018-08-23 22:29:25");
INSERT INTO `book` VALUES ("5", "L_5", "248-76854123", "The 8088 and 8086 Microprocessor System", "L_4", "2018-08-23 21:20:39", "IST_LIBRARY_1", "3rd", "New Delhi", "2004", "583", "1", "", "3", "0", "", "1", 0, "2018-08-23 23:00:12");
INSERT INTO `book` VALUES ("6", "L_6", "249-72486345", "বাংলা ব্যাকরণ ও প্রমিত রচনাবলী", "L_5", "2018-08-23 21:21:12", "IST_LIBRARY_1", "1st", "Dhaka", "2000", "198", "1", "", "10", "9", "", "1", 0, "2018-08-23 21:42:54");
INSERT INTO `book` VALUES ("7", "L_7", "978-00735233", "Database System Concepts", "L_6", "2018-08-23 21:21:49", "IST_LIBRARY_1", "6th", "Yale", "2006", "678", "1", "", "1", "0", "", "1", 0, "2018-08-23 21:43:05");
INSERT INTO `book` VALUES ("8", "L_8", "978-12590299", "Data Structures", "L_7", "2018-08-23 21:22:27", "IST_LIBRARY_1", "1st", "New York", "2002", "286", "1", "", "0", "0", "", "1", 0, "2018-08-23 22:59:28");

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `book_author`
-- ----------------------------
INSERT INTO `book_author` VALUES ("1", "", "L_1", "L_1");
INSERT INTO `book_author` VALUES ("2", "", "L_2", "L_2");
INSERT INTO `book_author` VALUES ("3", "", "L_3", "L_3");
INSERT INTO `book_author` VALUES ("4", "", "L_4", "L_4");
INSERT INTO `book_author` VALUES ("5", "", "L_5", "L_5");
INSERT INTO `book_author` VALUES ("6", "", "L_5", "L_6");
INSERT INTO `book_author` VALUES ("7", "", "L_6", "L_7");
INSERT INTO `book_author` VALUES ("8", "", "L_7", "L_8");
INSERT INTO `book_author` VALUES ("9", "", "L_7", "L_9");
INSERT INTO `book_author` VALUES ("10", "", "L_7", "L_10");
INSERT INTO `book_author` VALUES ("12", "", "L_8", "L_11");

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `book_category`
-- ----------------------------
INSERT INTO `book_category` VALUES ("1", "", "L_1", "L_1");
INSERT INTO `book_category` VALUES ("2", "", "L_1", "L_2");
INSERT INTO `book_category` VALUES ("3", "", "L_1", "L_3");
INSERT INTO `book_category` VALUES ("4", "", "L_1", "L_4");
INSERT INTO `book_category` VALUES ("5", "", "L_2", "L_1");
INSERT INTO `book_category` VALUES ("6", "", "L_2", "L_2");
INSERT INTO `book_category` VALUES ("7", "", "L_2", "L_5");
INSERT INTO `book_category` VALUES ("8", "", "L_3", "L_6");
INSERT INTO `book_category` VALUES ("9", "", "L_3", "L_7");
INSERT INTO `book_category` VALUES ("10", "", "L_4", "L_8");
INSERT INTO `book_category` VALUES ("11", "", "L_4", "L_9");
INSERT INTO `book_category` VALUES ("12", "", "L_5", "L_10");
INSERT INTO `book_category` VALUES ("13", "", "L_5", "L_2");
INSERT INTO `book_category` VALUES ("14", "", "L_5", "L_1");
INSERT INTO `book_category` VALUES ("15", "", "L_6", "L_11");
INSERT INTO `book_category` VALUES ("16", "", "L_6", "L_12");
INSERT INTO `book_category` VALUES ("17", "", "L_7", "L_13");
INSERT INTO `book_category` VALUES ("18", "", "L_7", "L_1");
INSERT INTO `book_category` VALUES ("19", "", "L_7", "L_5");
INSERT INTO `book_category` VALUES ("23", "", "L_8", "L_1");
INSERT INTO `book_category` VALUES ("24", "", "L_8", "L_2");
INSERT INTO `book_category` VALUES ("25", "", "L_8", "L_5");

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `book_copy`
-- ----------------------------
INSERT INTO `book_copy` VALUES ("1", "L_1", "L_c_1", "1", "0", "2018-08-23", "120", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:35:48");
INSERT INTO `book_copy` VALUES ("2", "L_1", "L_c_2", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("3", "L_1", "L_c_3", "0", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 22:29:25");
INSERT INTO `book_copy` VALUES ("4", "L_1", "L_c_4", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("5", "L_1", "L_c_5", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("6", "L_1", "L_c_6", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("7", "L_1", "L_c_7", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("8", "L_1", "L_c_8", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("9", "L_1", "L_c_9", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("10", "L_1", "L_c_10", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("11", "L_1", "L_c_11", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("12", "L_1", "L_c_12", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("13", "L_1", "L_c_13", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("14", "L_1", "L_c_14", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("15", "L_1", "L_c_15", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("16", "L_1", "L_c_16", "1", "1", "2018-08-23", "75", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:36:22");
INSERT INTO `book_copy` VALUES ("17", "L_2", "L_c_17", "1", "0", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:40:30");
INSERT INTO `book_copy` VALUES ("18", "L_2", "L_c_18", "1", "1", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:40:36");
INSERT INTO `book_copy` VALUES ("19", "L_2", "L_c_19", "0", "1", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 22:39:20");
INSERT INTO `book_copy` VALUES ("20", "L_2", "L_c_20", "1", "1", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:40:36");
INSERT INTO `book_copy` VALUES ("21", "L_2", "L_c_21", "1", "1", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:40:36");
INSERT INTO `book_copy` VALUES ("22", "L_2", "L_c_22", "1", "1", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:40:36");
INSERT INTO `book_copy` VALUES ("23", "L_2", "L_c_23", "1", "1", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:40:36");
INSERT INTO `book_copy` VALUES ("24", "L_2", "L_c_24", "1", "1", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:40:36");
INSERT INTO `book_copy` VALUES ("25", "L_2", "L_c_25", "1", "1", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:40:36");
INSERT INTO `book_copy` VALUES ("26", "L_2", "L_c_26", "1", "1", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:40:36");
INSERT INTO `book_copy` VALUES ("27", "L_2", "L_c_27", "1", "1", "2018-08-23", "70", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:40:36");
INSERT INTO `book_copy` VALUES ("28", "L_3", "L_c_28", "1", "0", "2018-08-23", "55", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:41:08");
INSERT INTO `book_copy` VALUES ("29", "L_3", "L_c_29", "1", "1", "2018-08-23", "50", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:41:21");
INSERT INTO `book_copy` VALUES ("30", "L_3", "L_c_30", "1", "1", "2018-08-23", "50", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:41:21");
INSERT INTO `book_copy` VALUES ("31", "L_3", "L_c_31", "1", "1", "2018-08-23", "50", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:41:21");
INSERT INTO `book_copy` VALUES ("32", "L_3", "L_c_32", "1", "1", "2018-08-23", "50", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:41:21");
INSERT INTO `book_copy` VALUES ("33", "L_3", "L_c_33", "1", "1", "2018-08-23", "50", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:41:21");
INSERT INTO `book_copy` VALUES ("34", "L_3", "L_c_34", "1", "1", "2018-08-23", "50", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:41:21");
INSERT INTO `book_copy` VALUES ("35", "L_4", "L_c_35", "1", "0", "2018-08-23", "108", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:41:33");
INSERT INTO `book_copy` VALUES ("36", "L_4", "L_c_36", "1", "1", "2018-08-23", "108", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:09");
INSERT INTO `book_copy` VALUES ("37", "L_4", "L_c_37", "1", "1", "2018-08-23", "108", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:09");
INSERT INTO `book_copy` VALUES ("38", "L_4", "L_c_38", "0", "1", "2018-08-23", "108", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 22:29:25");
INSERT INTO `book_copy` VALUES ("39", "L_4", "L_c_39", "1", "1", "2018-08-23", "108", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:09");
INSERT INTO `book_copy` VALUES ("40", "L_4", "L_c_40", "1", "1", "2018-08-23", "108", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:09");
INSERT INTO `book_copy` VALUES ("41", "L_5", "L_c_41", "1", "0", "2018-08-23", "550", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:24");
INSERT INTO `book_copy` VALUES ("42", "L_5", "L_c_42", "0", "1", "2018-08-23", "240", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 22:57:17");
INSERT INTO `book_copy` VALUES ("43", "L_5", "L_c_43", "0", "1", "2018-08-23", "240", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 23:00:53");
INSERT INTO `book_copy` VALUES ("44", "L_6", "L_c_44", "1", "0", "2018-08-23", "80", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:41");
INSERT INTO `book_copy` VALUES ("45", "L_6", "L_c_45", "1", "1", "2018-08-23", "65", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:54");
INSERT INTO `book_copy` VALUES ("46", "L_6", "L_c_46", "1", "1", "2018-08-23", "65", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:54");
INSERT INTO `book_copy` VALUES ("47", "L_6", "L_c_47", "1", "1", "2018-08-23", "65", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:54");
INSERT INTO `book_copy` VALUES ("48", "L_6", "L_c_48", "1", "1", "2018-08-23", "65", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:54");
INSERT INTO `book_copy` VALUES ("49", "L_6", "L_c_49", "1", "1", "2018-08-23", "65", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:54");
INSERT INTO `book_copy` VALUES ("50", "L_6", "L_c_50", "1", "1", "2018-08-23", "65", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:54");
INSERT INTO `book_copy` VALUES ("51", "L_6", "L_c_51", "1", "1", "2018-08-23", "65", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:54");
INSERT INTO `book_copy` VALUES ("52", "L_6", "L_c_52", "1", "1", "2018-08-23", "65", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:54");
INSERT INTO `book_copy` VALUES ("53", "L_6", "L_c_53", "1", "1", "2018-08-23", "65", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:42:54");
INSERT INTO `book_copy` VALUES ("54", "L_7", "L_c_54", "1", "0", "2018-08-23", "860", "1", "", "IST_LIBRARY_1", "0", "2018-08-23 21:43:05");

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `category`
-- ----------------------------
INSERT INTO `category` VALUES ("1", "L_1", "Computer", "2018-08-23 21:16:31");
INSERT INTO `category` VALUES ("2", "L_2", "Programming", "2018-08-23 21:16:31");
INSERT INTO `category` VALUES ("3", "L_3", "Bangla Programming", "2018-08-23 21:16:31");
INSERT INTO `category` VALUES ("4", "L_4", "Programming Contest", "2018-08-23 21:16:31");
INSERT INTO `category` VALUES ("5", "L_5", "CSE Course", "2018-08-23 21:17:41");
INSERT INTO `category` VALUES ("6", "L_6", "Science Fiction", "2018-08-23 21:19:14");
INSERT INTO `category` VALUES ("7", "L_7", "Novel", "2018-08-23 21:19:14");
INSERT INTO `category` VALUES ("8", "L_8", "Mathematics", "2018-08-23 21:19:50");
INSERT INTO `category` VALUES ("9", "L_9", "H.S.C Books", "2018-08-23 21:19:50");
INSERT INTO `category` VALUES ("10", "L_10", "Microprocessor", "2018-08-23 21:20:39");
INSERT INTO `category` VALUES ("11", "L_11", "Bangla", "2018-08-23 21:21:12");
INSERT INTO `category` VALUES ("12", "L_12", "Grammar", "2018-08-23 21:21:12");
INSERT INTO `category` VALUES ("13", "L_13", "Database", "2018-08-23 21:21:49");

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `issue`
-- ----------------------------
INSERT INTO `issue` VALUES ("1", "L_1", "2018-08-23 22:29:25", null, "2018-09-07 16:30:00", null, "L_1", "L_c_3", "L_2", "IST_LIBRARY_1", "1", "IY&krQux", "zPEVMWUR", "E8Ek3Fco", "&PJEtoyE", "UBltlz%v", "cjYf7Nzw", "", "0", "0");
INSERT INTO `issue` VALUES ("2", "L_2", "2018-08-23 22:29:25", null, "2018-09-07 16:30:00", null, "L_4", "L_c_38", "L_2", "IST_LIBRARY_1", "1", "6M8tN@Cv", "%Vw&eTK3", "$bL7&eQl", "qg2bM9rv", "dXZxS4UU", "NQu5oB#T", "", "0", "0");
INSERT INTO `issue` VALUES ("3", "L_3", "2018-08-23 22:39:20", null, "2018-09-07 16:30:00", "2018-08-25 16:30:00", "L_2", "L_c_19", "L_2", "IST_LIBRARY_1", "1", "lBefye4b", "yFxw3%ZF", "r&3XF&Ru", "B@Kqzxgz", "R6Pizcv4", "ARr4JXQm", "", "0", "0");
INSERT INTO `issue` VALUES ("4", "L_4", "2018-08-23 22:40:47", "2018-08-23 22:45:40", "2018-09-07 16:30:00", null, "L_5", "L_c_42", "L_3", "IST_LIBRARY_1", "3", "6EKef65W", "0Qti8TVQ", "AovC$upZ", "yy&JQMHk", "lv3XNLlZ", "4Mw3xQ5@", "", "0", "0");
INSERT INTO `issue` VALUES ("5", "L_5", "2018-08-23 22:41:05", "2018-08-23 22:42:38", "2018-09-07 16:30:00", null, "L_5", "L_c_43", "L_4", "IST_LIBRARY_1", "3", "sEq1aGtR", "Zzw4Y&2h", "&O9KtdKx", "r#@TBRPj", "QGwDrCbf", "MlzmomOm", "", "0", "0");
INSERT INTO `issue` VALUES ("6", "L_6", "2018-08-23 22:45:54", "2018-08-23 22:47:13", "2018-09-07 16:30:00", "2018-08-25 16:30:00", "L_5", "L_c_43", "L_2", "IST_LIBRARY_1", "3", "E3wTZbC8", "#f3kt2kK", "ExTNwj#w", "Jhw0mFrG", "J88Q8WAM", "e6IrUjyN", "", "0", "0");
INSERT INTO `issue` VALUES ("7", "L_7", "2018-08-23 22:47:39", "2018-08-23 22:49:24", "2018-09-07 16:30:00", null, "L_5", "L_c_42", "L_3", "IST_LIBRARY_1", "3", "vbFLXyck", "wUQcyC2n", "#1EO7IMV", "uh5e1vQO", "mlqRNC7d", "SsyQon#n", "", "0", "0");
INSERT INTO `issue` VALUES ("8", "L_8", "2018-08-23 22:47:53", "2018-08-23 23:00:01", "2018-09-07 16:30:00", null, "L_5", "L_c_43", "L_4", "IST_LIBRARY_1", "3", "LrbeIUtJ", "SDdY2&U@", "ejumQvk$", "6FxyqRYJ", "waStMijz", "F4I7mnoD", "", "0", "0");
INSERT INTO `issue` VALUES ("9", "L_9", "2018-08-23 22:57:17", null, "2018-09-07 16:30:00", "2018-08-25 16:30:00", "L_5", "L_c_42", "L_2", "IST_LIBRARY_1", "1", "jO4iyWqd", "8MfxHK50", "on%twrng", "xjGkpq%e", "v%gLhQx$", "f0RlclXw", "", "0", "0");
INSERT INTO `issue` VALUES ("10", "L_10", "2018-08-23 23:00:53", null, "2018-09-07 16:30:00", "2018-08-25 16:30:00", "L_5", "L_c_43", "L_3", "IST_LIBRARY_1", "1", "Rr01dBb$", "kYJTFU%f", "awJ5dLdE", "3qx1Hkqe", "Zu1t1o0D", "sA9myn7a", "", "0", "0");

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
) ENGINE=InnoDB AUTO_INCREMENT=306 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `log`
-- ----------------------------
INSERT INTO `log` VALUES ("1", "L_1", "INSERT INTO `publication` (`publication_name`, `publication_id`) VALUES (\'শিখা প্রকাশনী\', \'L_1\')", "1", "2018-08-23 21:16:31");
INSERT INTO `log` VALUES ("2", "L_2", "INSERT INTO `book` (`book_title`, `book_isbn`, `publication_id`, `book_edition`, `book_place_of_pub`, `book_year_of_pub`, `book_pages`, `book_status`, `book_url`, `book_url_unlocked`, `book_remarks`, `book_id`, `manager_id`, `book_add_date`) VALUES (\'Art of Programming Contest\', \'784-51467896\', \'L_1\', \'1st\', \'Dhaka\', \'2009\', \'195\', \'1\', \'https://www.comp.nus.edu.sg/~stevenha/database/Art_of_Programming_Contest_SE_for_uva.pdf\', \'1\', \'\', \'L_1\', \'IST_LIBRARY_1\', \'2018-08-23 21:16:31\')", "1", "2018-08-23 21:16:31");
INSERT INTO `log` VALUES ("3", "L_3", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'Ahmed Shamsul Arefin\', \'L_1\')", "1", "2018-08-23 21:16:31");
INSERT INTO `log` VALUES ("4", "L_4", "INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_1\',\'L_1\')", "1", "2018-08-23 21:16:31");
INSERT INTO `log` VALUES ("5", "L_5", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Computer\', \'L_1\')", "1", "2018-08-23 21:16:31");
INSERT INTO `log` VALUES ("6", "L_6", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Programming\', \'L_2\')", "1", "2018-08-23 21:16:31");
INSERT INTO `log` VALUES ("7", "L_7", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Bangla Programming\', \'L_3\')", "1", "2018-08-23 21:16:31");
INSERT INTO `log` VALUES ("8", "L_8", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Programming Contest\', \'L_4\')", "1", "2018-08-23 21:16:31");
INSERT INTO `log` VALUES ("9", "L_9", "INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_1\',\'L_1\'), (\'L_1\',\'L_2\'), (\'L_1\',\'L_3\'), (\'L_1\',\'L_4\')", "1", "2018-08-23 21:16:31");
INSERT INTO `log` VALUES ("10", "L_10", "INSERT INTO `publication` (`publication_name`, `publication_id`) VALUES (\'TATA mCGRAW Hills\', \'L_2\')", "1", "2018-08-23 21:17:41");
INSERT INTO `log` VALUES ("11", "L_11", "INSERT INTO `book` (`book_title`, `book_isbn`, `publication_id`, `book_edition`, `book_place_of_pub`, `book_year_of_pub`, `book_pages`, `book_status`, `book_url`, `book_url_unlocked`, `book_remarks`, `book_id`, `manager_id`, `book_add_date`) VALUES (\'Programming in ANSI C\', \'867-65432346\', \'L_2\', \'4th\', \'Delhi\', \'2011\', \'245\', \'1\', \'https://books.google.com.bd/books?id=AokcsKn-1iIC&lpg=PP1&pg=PP1&output=embed\', \'1\', \'\', \'L_2\', \'IST_LIBRARY_1\', \'2018-08-23 21:17:41\')", "1", "2018-08-23 21:17:41");
INSERT INTO `log` VALUES ("12", "L_12", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'E. Balagurusamy\', \'L_2\')", "1", "2018-08-23 21:17:41");
INSERT INTO `log` VALUES ("13", "L_13", "INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_2\',\'L_2\')", "1", "2018-08-23 21:17:41");
INSERT INTO `log` VALUES ("14", "L_14", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'CSE Course\', \'L_5\')", "1", "2018-08-23 21:17:41");
INSERT INTO `log` VALUES ("15", "L_15", "INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_2\',\'L_1\'), (\'L_2\',\'L_2\'), (\'L_2\',\'L_5\')", "1", "2018-08-23 21:17:41");
INSERT INTO `log` VALUES ("16", "L_16", "INSERT INTO `book` (`book_title`, `book_isbn`, `publication_id`, `book_edition`, `book_place_of_pub`, `book_year_of_pub`, `book_pages`, `book_status`, `book_url`, `book_url_unlocked`, `book_remarks`, `book_id`, `manager_id`, `book_add_date`) VALUES (\'টাইট্রন একটি গ্রহের নাম\', \'235-80948439\', \'L_1\', \'1st\', \'Dhaka\', \'1988\', \'68\', \'1\', \'http://download848.mediafire.com/mnocrzt5i9zg/bdoj3r01q09db5k/Titron+Ekti+Groher+Naam+%28allbdbooks.com%29.PDF\', \'1\', \'\', \'L_3\', \'IST_LIBRARY_1\', \'2018-08-23 21:19:14\')", "1", "2018-08-23 21:19:14");
INSERT INTO `log` VALUES ("17", "L_17", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'মুহম্মদ জাফর ইকবাল\', \'L_3\')", "1", "2018-08-23 21:19:14");
INSERT INTO `log` VALUES ("18", "L_18", "INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_3\',\'L_3\')", "1", "2018-08-23 21:19:14");
INSERT INTO `log` VALUES ("19", "L_19", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Science Fiction\', \'L_6\')", "1", "2018-08-23 21:19:14");
INSERT INTO `log` VALUES ("20", "L_20", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Novel\', \'L_7\')", "1", "2018-08-23 21:19:14");
INSERT INTO `log` VALUES ("21", "L_21", "INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_3\',\'L_6\'), (\'L_3\',\'L_7\')", "1", "2018-08-23 21:19:14");
INSERT INTO `log` VALUES ("22", "L_22", "INSERT INTO `publication` (`publication_name`, `publication_id`) VALUES (\'Gyankosh Prokashoni, Bangladesh\', \'L_3\')", "1", "2018-08-23 21:19:50");
INSERT INTO `log` VALUES ("23", "L_23", "INSERT INTO `book` (`book_title`, `book_isbn`, `publication_id`, `book_edition`, `book_place_of_pub`, `book_year_of_pub`, `book_pages`, `book_status`, `book_url`, `book_url_unlocked`, `book_remarks`, `book_id`, `manager_id`, `book_add_date`) VALUES (\'উচ্চ মাধ্যমিক জ্যামিতি ও ক্যালকুলাস\', \'812-76381358\', \'L_3\', \'2nd\', \'Dhaka\', \'2011\', \'298\', \'1\', \'\', \'1\', \'\', \'L_4\', \'IST_LIBRARY_1\', \'2018-08-23 21:19:50\')", "1", "2018-08-23 21:19:50");
INSERT INTO `log` VALUES ("24", "L_24", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'আফসার-উজ-জামান\', \'L_4\')", "1", "2018-08-23 21:19:50");
INSERT INTO `log` VALUES ("25", "L_25", "INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_4\',\'L_4\')", "1", "2018-08-23 21:19:50");
INSERT INTO `log` VALUES ("26", "L_26", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Mathematics\', \'L_8\')", "1", "2018-08-23 21:19:50");
INSERT INTO `log` VALUES ("27", "L_27", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'H.S.C Books\', \'L_9\')", "1", "2018-08-23 21:19:50");
INSERT INTO `log` VALUES ("28", "L_28", "INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_4\',\'L_8\'), (\'L_4\',\'L_9\')", "1", "2018-08-23 21:19:50");
INSERT INTO `log` VALUES ("29", "L_29", "INSERT INTO `publication` (`publication_name`, `publication_id`) VALUES (\'Prentice-Hall India\', \'L_4\')", "1", "2018-08-23 21:20:39");
INSERT INTO `log` VALUES ("30", "L_30", "INSERT INTO `book` (`book_title`, `book_isbn`, `publication_id`, `book_edition`, `book_place_of_pub`, `book_year_of_pub`, `book_pages`, `book_status`, `book_url`, `book_url_unlocked`, `book_remarks`, `book_id`, `manager_id`, `book_add_date`) VALUES (\'The 8088 and 8086 Microprocessor System\', \'248-76854123\', \'L_4\', \'3rd\', \'New Delhi\', \'2004\', \'583\', \'1\', \'\', \'1\', \'\', \'L_5\', \'IST_LIBRARY_1\', \'2018-08-23 21:20:39\')", "1", "2018-08-23 21:20:39");
INSERT INTO `log` VALUES ("31", "L_31", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'W. A. Triebel\', \'L_5\')", "0", "2018-08-23 21:20:39");
INSERT INTO `log` VALUES ("32", "L_32", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'Avtar Singh\', \'L_6\')", "0", "2018-08-23 21:20:39");
INSERT INTO `log` VALUES ("33", "L_33", "INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_5\',\'L_5\'), (\'L_6\',\'L_5\')", "0", "2018-08-23 21:20:39");
INSERT INTO `log` VALUES ("34", "L_34", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Microprocessor\', \'L_10\')", "0", "2018-08-23 21:20:39");
INSERT INTO `log` VALUES ("35", "L_35", "INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_5\',\'L_10\'), (\'L_5\',\'L_2\'), (\'L_5\',\'L_1\')", "0", "2018-08-23 21:20:39");
INSERT INTO `log` VALUES ("36", "L_36", "INSERT INTO `publication` (`publication_name`, `publication_id`) VALUES (\'আশা প্রকাশনী\', \'L_5\')", "0", "2018-08-23 21:21:12");
INSERT INTO `log` VALUES ("37", "L_37", "INSERT INTO `book` (`book_title`, `book_isbn`, `publication_id`, `book_edition`, `book_place_of_pub`, `book_year_of_pub`, `book_pages`, `book_status`, `book_url`, `book_url_unlocked`, `book_remarks`, `book_id`, `manager_id`, `book_add_date`) VALUES (\'বাংলা ব্যাকরণ ও প্রমিত রচনাবলী\', \'249-72486345\', \'L_5\', \'1st\', \'Dhaka\', \'2000\', \'198\', \'1\', \'\', \'1\', \'\', \'L_6\', \'IST_LIBRARY_1\', \'2018-08-23 21:21:12\')", "0", "2018-08-23 21:21:12");
INSERT INTO `log` VALUES ("38", "L_38", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'Udit Acharya\', \'L_7\')", "0", "2018-08-23 21:21:12");
INSERT INTO `log` VALUES ("39", "L_39", "INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_7\',\'L_6\')", "0", "2018-08-23 21:21:12");
INSERT INTO `log` VALUES ("40", "L_40", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Bangla\', \'L_11\')", "0", "2018-08-23 21:21:12");
INSERT INTO `log` VALUES ("41", "L_41", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Grammar\', \'L_12\')", "0", "2018-08-23 21:21:12");
INSERT INTO `log` VALUES ("42", "L_42", "INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_6\',\'L_11\'), (\'L_6\',\'L_12\')", "0", "2018-08-23 21:21:12");
INSERT INTO `log` VALUES ("43", "L_43", "INSERT INTO `publication` (`publication_name`, `publication_id`) VALUES (\'Yale Publishers\', \'L_6\')", "0", "2018-08-23 21:21:49");
INSERT INTO `log` VALUES ("44", "L_44", "INSERT INTO `book` (`book_title`, `book_isbn`, `publication_id`, `book_edition`, `book_place_of_pub`, `book_year_of_pub`, `book_pages`, `book_status`, `book_url`, `book_url_unlocked`, `book_remarks`, `book_id`, `manager_id`, `book_add_date`) VALUES (\'Database System Concepts\', \'978-00735233\', \'L_6\', \'6th\', \'Yale\', \'2006\', \'678\', \'1\', \'\', \'1\', \'\', \'L_7\', \'IST_LIBRARY_1\', \'2018-08-23 21:21:49\')", "0", "2018-08-23 21:21:49");
INSERT INTO `log` VALUES ("45", "L_45", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'Abraham Silberschatz\', \'L_8\')", "0", "2018-08-23 21:21:49");
INSERT INTO `log` VALUES ("46", "L_46", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'Henry F. Korth\', \'L_9\')", "0", "2018-08-23 21:21:49");
INSERT INTO `log` VALUES ("47", "L_47", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'S. Sudarshan\', \'L_10\')", "0", "2018-08-23 21:21:49");
INSERT INTO `log` VALUES ("48", "L_48", "INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_8\',\'L_7\'), (\'L_9\',\'L_7\'), (\'L_10\',\'L_7\')", "0", "2018-08-23 21:21:49");
INSERT INTO `log` VALUES ("49", "L_49", "INSERT INTO `category` (`category_name`, `category_id`) VALUES (\'Database\', \'L_13\')", "0", "2018-08-23 21:21:49");
INSERT INTO `log` VALUES ("50", "L_50", "INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_7\',\'L_13\'), (\'L_7\',\'L_1\'), (\'L_7\',\'L_5\')", "0", "2018-08-23 21:21:49");
INSERT INTO `log` VALUES ("51", "L_51", "INSERT INTO `publication` (`publication_name`, `publication_id`) VALUES (\'Schaum\\\'s Outlines\', \'L_7\')", "0", "2018-08-23 21:22:27");
INSERT INTO `log` VALUES ("52", "L_52", "INSERT INTO `book` (`book_title`, `book_isbn`, `publication_id`, `book_edition`, `book_place_of_pub`, `book_year_of_pub`, `book_pages`, `book_status`, `book_url`, `book_url_unlocked`, `book_remarks`, `book_id`, `manager_id`, `book_add_date`) VALUES (\'Data Structures\', \'978-12590299\', \'L_7\', \'1st\', \'New York\', \'2002\', \'286\', \'1\', \'http://www.portcity.edu.bd/ELibrary/CSE/DatastructurewithC.pdf\', \'1\', \'\', \'L_8\', \'IST_LIBRARY_1\', \'2018-08-23 21:22:27\')", "0", "2018-08-23 21:22:27");
INSERT INTO `log` VALUES ("53", "L_53", "INSERT INTO `author` (`author_name`, `author_id`) VALUES (\'Seymour Lipschutz\', \'L_11\')", "0", "2018-08-23 21:22:27");
INSERT INTO `log` VALUES ("54", "L_54", "INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_11\',\'L_8\')", "0", "2018-08-23 21:22:27");
INSERT INTO `log` VALUES ("55", "L_55", "INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_8\',\'L_1\'), (\'L_8\',\'L_2\'), (\'L_8\',\'L_5\')", "0", "2018-08-23 21:22:27");
INSERT INTO `log` VALUES ("56", "L_56", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_1\',\'2018-08-23\',\'IST_LIBRARY_1\',\'120\',\'\',\'1\',1,\'0\',\'L_1\')", "0", "2018-08-23 21:35:48");
INSERT INTO `log` VALUES ("57", "L_57", "UPDATE `book` SET `book_stock` = 1 WHERE `book_id` = \'L_1\'", "0", "2018-08-23 21:35:48");
INSERT INTO `log` VALUES ("58", "L_58", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_2\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_3\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_4\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_5\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_6\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_7\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_8\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_9\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_10\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_11\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_12\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_13\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_14\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_15\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\'), (\'L_c_16\',\'2018-08-23\',\'IST_LIBRARY_1\',\'75\',\'\',\'1\',1,\'1\',\'L_1\')", "0", "2018-08-23 21:36:22");
INSERT INTO `log` VALUES ("59", "L_59", "UPDATE `book` SET `book_stock` = 16, `book_available` = 15 WHERE `book_id` = \'L_1\'", "0", "2018-08-23 21:36:22");
INSERT INTO `log` VALUES ("60", "L_60", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_17\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'0\',\'L_2\')", "0", "2018-08-23 21:40:30");
INSERT INTO `log` VALUES ("61", "L_61", "UPDATE `book` SET `book_stock` = 1 WHERE `book_id` = \'L_2\'", "0", "2018-08-23 21:40:30");
INSERT INTO `log` VALUES ("62", "L_62", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_18\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'1\',\'L_2\'), (\'L_c_19\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'1\',\'L_2\'), (\'L_c_20\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'1\',\'L_2\'), (\'L_c_21\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'1\',\'L_2\'), (\'L_c_22\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'1\',\'L_2\'), (\'L_c_23\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'1\',\'L_2\'), (\'L_c_24\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'1\',\'L_2\'), (\'L_c_25\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'1\',\'L_2\'), (\'L_c_26\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'1\',\'L_2\'), (\'L_c_27\',\'2018-08-23\',\'IST_LIBRARY_1\',\'70\',\'\',\'1\',1,\'1\',\'L_2\')", "0", "2018-08-23 21:40:36");
INSERT INTO `log` VALUES ("63", "L_63", "UPDATE `book` SET `book_stock` = 11, `book_available` = 10 WHERE `book_id` = \'L_2\'", "0", "2018-08-23 21:40:36");
INSERT INTO `log` VALUES ("64", "L_64", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_28\',\'2018-08-23\',\'IST_LIBRARY_1\',\'55\',\'\',\'1\',1,\'0\',\'L_3\')", "0", "2018-08-23 21:41:08");
INSERT INTO `log` VALUES ("65", "L_65", "UPDATE `book` SET `book_stock` = 1 WHERE `book_id` = \'L_3\'", "0", "2018-08-23 21:41:08");
INSERT INTO `log` VALUES ("66", "L_66", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_29\',\'2018-08-23\',\'IST_LIBRARY_1\',\'50\',\'\',\'1\',1,\'1\',\'L_3\'), (\'L_c_30\',\'2018-08-23\',\'IST_LIBRARY_1\',\'50\',\'\',\'1\',1,\'1\',\'L_3\'), (\'L_c_31\',\'2018-08-23\',\'IST_LIBRARY_1\',\'50\',\'\',\'1\',1,\'1\',\'L_3\'), (\'L_c_32\',\'2018-08-23\',\'IST_LIBRARY_1\',\'50\',\'\',\'1\',1,\'1\',\'L_3\'), (\'L_c_33\',\'2018-08-23\',\'IST_LIBRARY_1\',\'50\',\'\',\'1\',1,\'1\',\'L_3\'), (\'L_c_34\',\'2018-08-23\',\'IST_LIBRARY_1\',\'50\',\'\',\'1\',1,\'1\',\'L_3\')", "0", "2018-08-23 21:41:21");
INSERT INTO `log` VALUES ("67", "L_67", "UPDATE `book` SET `book_stock` = 7, `book_available` = 6 WHERE `book_id` = \'L_3\'", "0", "2018-08-23 21:41:21");
INSERT INTO `log` VALUES ("68", "L_68", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_35\',\'2018-08-23\',\'IST_LIBRARY_1\',\'108\',\'\',\'1\',1,\'0\',\'L_4\')", "0", "2018-08-23 21:41:33");
INSERT INTO `log` VALUES ("69", "L_69", "UPDATE `book` SET `book_stock` = 1 WHERE `book_id` = \'L_4\'", "0", "2018-08-23 21:41:33");
INSERT INTO `log` VALUES ("70", "L_70", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_36\',\'2018-08-23\',\'IST_LIBRARY_1\',\'108\',\'\',\'1\',1,\'1\',\'L_4\'), (\'L_c_37\',\'2018-08-23\',\'IST_LIBRARY_1\',\'108\',\'\',\'1\',1,\'1\',\'L_4\'), (\'L_c_38\',\'2018-08-23\',\'IST_LIBRARY_1\',\'108\',\'\',\'1\',1,\'1\',\'L_4\'), (\'L_c_39\',\'2018-08-23\',\'IST_LIBRARY_1\',\'108\',\'\',\'1\',1,\'1\',\'L_4\'), (\'L_c_40\',\'2018-08-23\',\'IST_LIBRARY_1\',\'108\',\'\',\'1\',1,\'1\',\'L_4\')", "0", "2018-08-23 21:42:09");
INSERT INTO `log` VALUES ("71", "L_71", "UPDATE `book` SET `book_stock` = 6, `book_available` = 5 WHERE `book_id` = \'L_4\'", "0", "2018-08-23 21:42:09");
INSERT INTO `log` VALUES ("72", "L_72", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_41\',\'2018-08-23\',\'IST_LIBRARY_1\',\'550\',\'\',\'1\',1,\'0\',\'L_5\')", "0", "2018-08-23 21:42:24");
INSERT INTO `log` VALUES ("73", "L_73", "UPDATE `book` SET `book_stock` = 1 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 21:42:24");
INSERT INTO `log` VALUES ("74", "L_74", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_42\',\'2018-08-23\',\'IST_LIBRARY_1\',\'240\',\'\',\'1\',1,\'1\',\'L_5\'), (\'L_c_43\',\'2018-08-23\',\'IST_LIBRARY_1\',\'240\',\'\',\'1\',1,\'1\',\'L_5\')", "0", "2018-08-23 21:42:33");
INSERT INTO `log` VALUES ("75", "L_75", "UPDATE `book` SET `book_stock` = 3, `book_available` = 2 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 21:42:33");
INSERT INTO `log` VALUES ("76", "L_76", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_44\',\'2018-08-23\',\'IST_LIBRARY_1\',\'80\',\'\',\'1\',1,\'0\',\'L_6\')", "0", "2018-08-23 21:42:41");
INSERT INTO `log` VALUES ("77", "L_77", "UPDATE `book` SET `book_stock` = 1 WHERE `book_id` = \'L_6\'", "0", "2018-08-23 21:42:41");
INSERT INTO `log` VALUES ("78", "L_78", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_45\',\'2018-08-23\',\'IST_LIBRARY_1\',\'65\',\'\',\'1\',1,\'1\',\'L_6\'), (\'L_c_46\',\'2018-08-23\',\'IST_LIBRARY_1\',\'65\',\'\',\'1\',1,\'1\',\'L_6\'), (\'L_c_47\',\'2018-08-23\',\'IST_LIBRARY_1\',\'65\',\'\',\'1\',1,\'1\',\'L_6\'), (\'L_c_48\',\'2018-08-23\',\'IST_LIBRARY_1\',\'65\',\'\',\'1\',1,\'1\',\'L_6\'), (\'L_c_49\',\'2018-08-23\',\'IST_LIBRARY_1\',\'65\',\'\',\'1\',1,\'1\',\'L_6\'), (\'L_c_50\',\'2018-08-23\',\'IST_LIBRARY_1\',\'65\',\'\',\'1\',1,\'1\',\'L_6\'), (\'L_c_51\',\'2018-08-23\',\'IST_LIBRARY_1\',\'65\',\'\',\'1\',1,\'1\',\'L_6\'), (\'L_c_52\',\'2018-08-23\',\'IST_LIBRARY_1\',\'65\',\'\',\'1\',1,\'1\',\'L_6\'), (\'L_c_53\',\'2018-08-23\',\'IST_LIBRARY_1\',\'65\',\'\',\'1\',1,\'1\',\'L_6\')", "0", "2018-08-23 21:42:54");
INSERT INTO `log` VALUES ("79", "L_79", "UPDATE `book` SET `book_stock` = 10, `book_available` = 9 WHERE `book_id` = \'L_6\'", "0", "2018-08-23 21:42:54");
INSERT INTO `log` VALUES ("80", "L_80", "INSERT INTO `book_copy` (`book_copy_accession_no`, `book_copy_date`, `book_copy_manager_id`, `book_copy_price`, `book_copy_remarks`, `book_copy_source`, `book_copy_status`, `book_copy_type`, `book_id`) VALUES (\'L_c_54\',\'2018-08-23\',\'IST_LIBRARY_1\',\'860\',\'\',\'1\',1,\'0\',\'L_7\')", "0", "2018-08-23 21:43:05");
INSERT INTO `log` VALUES ("81", "L_81", "UPDATE `book` SET `book_stock` = 1 WHERE `book_id` = \'L_7\'", "0", "2018-08-23 21:43:05");
INSERT INTO `log` VALUES ("82", "L_82", "INSERT INTO `user` (`user_name`, `user_dept`, `user_session`, `user_roll`, `user_phone`, `user_email`, `user_username`, `user_pass`, `user_library_code`, `user_id`) VALUES (\'Md. Rubayet Hossain\', \'CSE\', \'2010\', \'1014\', \'01671900427\', \'rubu@gmail.com\', \'rubayet\', \'202cb962ac59075b964b07152d234b70\', \'ljnKrJ1cJ%\', \'L_1\')", "0", "2018-08-23 21:44:31");
INSERT INTO `log` VALUES ("83", "L_83", "INSERT INTO `user` (`is_teacher`, `user_name`, `user_phone`, `user_email`, `user_dept`, `user_roll`, `user_session`, `user_pass`, `user_id`, `user_username`, `user_library_code`) VALUES (\'0\', \'Md. Rashid Hossain\', \'8801587960318\', \'rashid@gmail.com\', \'CSE\', \'1057\', 2009, \'UwUh@h9&\', \'L_2\', \'CSE1057_L_2\', \'0559a84df364be5a\')", "0", "2018-08-23 21:46:46");
INSERT INTO `log` VALUES ("84", "L_84", "INSERT INTO `user` (`is_teacher`, `user_name`, `user_phone`, `user_email`, `user_dept`, `user_roll`, `user_session`, `user_pass`, `user_id`, `user_username`, `user_library_code`) VALUES (\'0\', \'Md. Nahid Hasan\', \'8801798462574\', \'nahid@gmail.com\', \'ECE\', \'1572\', 2014, \'MG4ihweD\', \'L_3\', \'ECE1572_L_3\', \'c7371d9a561cf1a7\')", "0", "2018-08-23 21:46:46");
INSERT INTO `log` VALUES ("85", "L_85", "INSERT INTO `user` (`is_teacher`, `user_name`, `user_phone`, `user_email`, `user_dept`, `user_roll`, `user_session`, `user_pass`, `user_id`, `user_username`, `user_library_code`) VALUES (\'0\', \'Mst. Shahana Begum\', \'8801978453251\', \'shahana@gmail.com\', \'BBA\', \'1670\', 2015, \'8MNe%dEI\', \'L_4\', \'BBA1670_L_4\', \'9bb4799221b1bd96\')", "0", "2018-08-23 21:46:46");
INSERT INTO `log` VALUES ("86", "L_86", "UPDATE `user` SET `user_name` = \'Md. Rashid Hossain\', `user_dept` = \'CSE\', `user_session` = \'2009\', `user_roll` = \'1057\', `user_phone` = \'01587960318\', `user_email` = \'rashid@gmail.com\', `user_username` = \'CSE1057_L_2\' WHERE `user_id` = \'L_2\'", "0", "2018-08-23 21:46:54");
INSERT INTO `log` VALUES ("87", "L_87", "UPDATE `user` SET `user_name` = \'Md. Nahid Hasan\', `user_dept` = \'ECE\', `user_session` = \'2014\', `user_roll` = \'1572\', `user_phone` = \'01798462574\', `user_email` = \'nahid@gmail.com\', `user_username` = \'ECE1572_L_3\' WHERE `user_id` = \'L_3\'", "0", "2018-08-23 21:46:57");
INSERT INTO `log` VALUES ("88", "L_88", "UPDATE `user` SET `user_name` = \'Mst. Shahana Begum\', `user_dept` = \'BBA\', `user_session` = \'2015\', `user_roll` = \'1670\', `user_phone` = \'01978453251\', `user_email` = \'shahana@gmail.com\', `user_username` = \'BBA1670_L_4\' WHERE `user_id` = \'L_4\'", "0", "2018-08-23 21:47:00");
INSERT INTO `log` VALUES ("89", "L_89", "INSERT INTO `user` (`is_teacher`, `user_name`, `user_phone`, `user_email`, `user_dept`, `teacher_id`, `teacher_designation`, `user_pass`, `user_id`, `user_username`, `user_library_code`) VALUES (\'1\', \'Md. Azad Chowdhury\', \'8801798765432\', \'azad@gmail.com\', \'CSE\', \'1\', \'Professor\\n\', \'31VvnfA5\', \'L_5\', \'CSE1_L_5\', \'d499ac4cf956f42f\')", "0", "2018-08-23 21:50:05");
INSERT INTO `log` VALUES ("90", "L_90", "INSERT INTO `user` (`is_teacher`, `user_name`, `user_phone`, `user_email`, `user_dept`, `teacher_id`, `teacher_designation`, `user_pass`, `user_id`, `user_username`, `user_library_code`) VALUES (\'1\', \'Md. Johirul Islam\', \'8801998765432\', \'johir@gmail.com\', \'ECE\', \'2\', \'Asst. Professor\\n\', \'GUMv3GTl\', \'L_6\', \'ECE2_L_6\', \'9322f3949493b0e3\')", "0", "2018-08-23 21:50:05");
INSERT INTO `log` VALUES ("91", "L_91", "INSERT INTO `user` (`is_teacher`, `user_name`, `user_phone`, `user_email`, `user_dept`, `teacher_id`, `teacher_designation`, `user_pass`, `user_id`, `user_username`, `user_library_code`) VALUES (\'1\', \'Mrs. Tamanna Akter\', \'8801598765432\', \'tamanna@gmail.com\', \'BBA\', \'3\', \'Lecturer\\n\', \'eFib9Oy&\', \'L_7\', \'BBA3_L_7\', \'c1f85b931a3a2b6d\')", "0", "2018-08-23 21:50:05");
INSERT INTO `log` VALUES ("92", "L_92", "UPDATE `user` SET `user_name` = \'Md. Rashid Hossain\', `user_dept` = \'CSE\', `user_session` = \'2009\', `user_roll` = \'1057\', `user_phone` = \'01587960318\', `user_email` = \'rashid@gmail.com\', `user_username` = \'rashid\' WHERE `user_id` = \'L_2\'", "0", "2018-08-23 21:50:25");
INSERT INTO `log` VALUES ("93", "L_93", "UPDATE `user` SET `user_name` = \'Md. Nahid Hasan\', `user_dept` = \'ECE\', `user_session` = \'2014\', `user_roll` = \'1572\', `user_phone` = \'01798462574\', `user_email` = \'nahid@gmail.com\', `user_username` = \'nahid\' WHERE `user_id` = \'L_3\'", "0", "2018-08-23 21:50:31");
INSERT INTO `log` VALUES ("94", "L_94", "UPDATE `user` SET `user_name` = \'Mst. Shahana Begum\', `user_dept` = \'BBA\', `user_session` = \'2015\', `user_roll` = \'1670\', `user_phone` = \'01978453251\', `user_email` = \'shahana@gmail.com\', `user_username` = \'shahana\' WHERE `user_id` = \'L_4\'", "0", "2018-08-23 21:50:37");
INSERT INTO `log` VALUES ("95", "L_95", "UPDATE `user` SET `user_name` = \'Md. Azad Chowdhury\', `user_dept` = \'CSE\', `teacher_designation` = \'Professor\', `user_phone` = \'8801798765432\', `user_email` = \'azad@gmail.com\', `user_username` = \'azad\' WHERE `user_id` = \'L_5\'", "0", "2018-08-23 21:50:45");
INSERT INTO `log` VALUES ("96", "L_96", "UPDATE `user` SET `user_name` = \'Md. Johirul Islam\', `user_dept` = \'ECE\', `teacher_designation` = \'Asst. Professor\', `user_phone` = \'8801998765432\', `user_email` = \'johir@gmail.com\', `user_username` = \'johir\' WHERE `user_id` = \'L_6\'", "0", "2018-08-23 21:50:51");
INSERT INTO `log` VALUES ("97", "L_97", "UPDATE `user` SET `user_name` = \'Mst. Shahana Begum\', `user_dept` = \'BBA\', `user_session` = \'2015\', `user_roll` = \'1670\', `user_phone` = \'01978453251\', `user_email` = \'shahana@gmail.com\', `user_username` = \'tamanna\' WHERE `user_id` = \'L_4\'", "0", "2018-08-23 21:51:02");
INSERT INTO `log` VALUES ("98", "L_98", "UPDATE `manager` SET `manager_name` = \'Muntasir Billah Munna\', `manager_phone` = \'01516180603\', `manager_email` = \'kmmuntasir@gmail.com\', `manager_user` = \'admin\', `manager_pass` = \'202cb962ac59075b964b07152d234b70\' WHERE `manager_id` = \'IST_LIBRARY_1\'", "0", "2018-08-23 22:23:34");
INSERT INTO `log` VALUES ("99", "L_99", "UPDATE `user` SET `user_name` = \'Md. Rashid Hossain\', `user_dept` = \'CSE\', `user_session` = \'2009\', `user_roll` = \'1057\', `user_phone` = \'01587960318\', `user_email` = \'rashid@gmail.com\', `user_username` = \'rashid\', `user_pass` = \'202cb962ac59075b964b07152d234b70\' WHERE `user_id` = \'L_2\'", "0", "2018-08-23 22:24:46");
INSERT INTO `log` VALUES ("100", "L_100", "UPDATE `user` SET `user_name` = \'Mst. Shahana Begum\', `user_dept` = \'BBA\', `user_session` = \'2015\', `user_roll` = \'1670\', `user_phone` = \'01978453251\', `user_email` = \'shahana@gmail.com\', `user_username` = \'shahana\' WHERE `user_id` = \'L_4\'", "0", "2018-08-23 22:27:20");
INSERT INTO `log` VALUES ("101", "L_101", "UPDATE `user` SET `user_name` = \'Mrs. Tamanna Akter\', `user_dept` = \'BBA\', `teacher_designation` = \'Lecturer\', `user_phone` = \'8801598765432\', `user_email` = \'tamanna@gmail.com\', `user_username` = \'tamanna\' WHERE `user_id` = \'L_7\'", "0", "2018-08-23 22:27:27");
INSERT INTO `log` VALUES ("102", "L_102", "UPDATE `book` SET `book_available` = 14 WHERE `book_id` = \'L_1\'", "0", "2018-08-23 22:29:25");
INSERT INTO `log` VALUES ("103", "L_103", "UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_3\'", "0", "2018-08-23 22:29:25");
INSERT INTO `log` VALUES ("104", "L_104", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_1\', \'2018-08-23 22:29:25\', \'2018-09-07 16:30:00\', \'L_1\', \'L_c_3\', \'L_2\', \'IST_LIBRARY_1\', 1, \'IY&krQux\', \'zPEVMWUR\', \'E8Ek3Fco\', \'&PJEtoyE\', \'UBltlz%v\', \'cjYf7Nzw\', \'\')", "0", "2018-08-23 22:29:25");
INSERT INTO `log` VALUES ("105", "L_105", "UPDATE `book` SET `book_available` = 4 WHERE `book_id` = \'L_4\'", "0", "2018-08-23 22:29:25");
INSERT INTO `log` VALUES ("106", "L_106", "UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_38\'", "0", "2018-08-23 22:29:25");
INSERT INTO `log` VALUES ("107", "L_107", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_2\', \'2018-08-23 22:29:25\', \'2018-09-07 16:30:00\', \'L_4\', \'L_c_38\', \'L_2\', \'IST_LIBRARY_1\', 1, \'6M8tN@Cv\', \'%Vw&eTK3\', \'$bL7&eQl\', \'qg2bM9rv\', \'dXZxS4UU\', \'NQu5oB#T\', \'\')", "0", "2018-08-23 22:29:25");
INSERT INTO `log` VALUES ("108", "L_619", "INSERT INTO `manager` (`manager_name`, `manager_phone`, `manager_email`, `manager_user`, `is_admin`, `manager_id`, `manager_pass`) VALUES (\'Hello\', \'1239550\', \'ljasdf@lkj.com\', \'hello\', \'1\', \'L_7\', \'202cb962ac59075b964b07152d234b70\')", "1", "2018-08-20 18:05:26");
INSERT INTO `log` VALUES ("109", "L_620", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'1\' WHERE `manager_id` = \'L_7\'", "1", "2018-08-20 18:16:12");
INSERT INTO `log` VALUES ("110", "L_621", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'0\' WHERE `manager_id` = \'L_7\'", "1", "2018-08-20 18:16:16");
INSERT INTO `log` VALUES ("111", "L_622", "UPDATE `manager` SET `manager_name` = \'Muntasir Billah Munna\', `manager_phone` = \'01516180603\', `manager_email` = \'kmmuntasir@gmail.com\', `manager_user` = \'munna_library\', `is_admin` = \'0\' WHERE `manager_id` = \'IST_LIBRARY_1\'", "1", "2018-08-20 19:46:21");
INSERT INTO `log` VALUES ("112", "L_623", "UPDATE `manager` SET `manager_name` = \'Muntasir Billah Munna\', `manager_phone` = \'01516180603\', `manager_email` = \'kmmuntasir@gmail.com\', `manager_user` = \'munna_library\' WHERE `manager_id` = \'IST_LIBRARY_1\'", "1", "2018-08-20 19:47:03");
INSERT INTO `log` VALUES ("113", "L_624", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'0\' WHERE `manager_id` = \'L_7\'", "1", "2018-08-20 19:49:13");
INSERT INTO `log` VALUES ("114", "L_625", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'1\' WHERE `manager_id` = \'L_7\'", "1", "2018-08-20 19:49:16");
INSERT INTO `log` VALUES ("115", "L_626", "UPDATE `manager` SET `manager_name` = \'Salma\', `manager_phone` = \'23455\', `manager_email` = \'sal@ma.com\', `manager_user` = \'salma\', `is_admin` = \'1\' WHERE `manager_id` = \'L_3\'", "1", "2018-08-20 20:01:29");
INSERT INTO `log` VALUES ("116", "L_627", "UPDATE `manager` SET `manager_name` = \'Salma\', `manager_phone` = \'23455\', `manager_email` = \'sal@ma.com\', `manager_user` = \'salma\', `is_admin` = \'1\', `manager_pass` = \'202cb962ac59075b964b07152d234b70\' WHERE `manager_id` = \'L_3\'", "1", "2018-08-20 20:02:55");
INSERT INTO `log` VALUES ("117", "L_628", "UPDATE `manager` SET `manager_name` = \'Khalilullah\', `manager_phone` = \'234567\', `manager_email` = \'khalil@mia.com\', `manager_user` = \'khalil\', `is_admin` = \'0\', `manager_pass` = \'202cb962ac59075b964b07152d234b70\' WHERE `manager_id` = \'L_2\'", "1", "2018-08-20 20:03:36");
INSERT INTO `log` VALUES ("118", "L_629", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'0\' WHERE `manager_id` = \'L_7\'", "1", "2018-08-20 20:05:04");
INSERT INTO `log` VALUES ("119", "L_630", "UPDATE `manager` SET `manager_name` = \'Hello\', `manager_phone` = \'1239550\', `manager_email` = \'ljasdf@lkj.com\', `manager_user` = \'hello\', `is_admin` = \'1\' WHERE `manager_id` = \'L_7\'", "1", "2018-08-20 20:05:13");
INSERT INTO `log` VALUES ("120", "L_631", "UPDATE `user` SET `user_name` = \'Md. Moyeenul Hasan Durjoy\', `user_dept` = \'BBA\', `user_session` = \'2017\', `user_roll` = \'1036\', `user_phone` = \'12355677888\', `user_email` = \'durjoy@mail.com\', `user_username` = \'durjoy\' WHERE `user_id` = \'L_7\'", "1", "2018-08-20 20:08:43");
INSERT INTO `log` VALUES ("121", "L_632", "UPDATE `user` SET `user_name` = \'Aftabul Islam Himel\', `user_dept` = \'CSE\', `user_session` = \'2012\', `user_roll` = \'1057\', `user_phone` = \'01677181006\', `user_email` = \'toaihimel@gmail.com\', `user_username` = \'himel\' WHERE `user_id` = \'L_9\'", "1", "2018-08-20 20:09:37");
INSERT INTO `log` VALUES ("122", "L_633", "UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'L_9\'", "1", "2018-08-20 20:10:54");
INSERT INTO `log` VALUES ("123", "L_634", "UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'L_9\'", "1", "2018-08-20 20:11:09");
INSERT INTO `log` VALUES ("124", "L_635", "UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'L_8\'", "1", "2018-08-20 20:11:15");
INSERT INTO `log` VALUES ("125", "L_636", "UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'L_8\'", "1", "2018-08-20 20:11:26");
INSERT INTO `log` VALUES ("126", "L_637", "UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'L_8\'", "1", "2018-08-20 20:15:12");
INSERT INTO `log` VALUES ("127", "L_638", "UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'L_8\'", "1", "2018-08-20 20:15:22");
INSERT INTO `log` VALUES ("128", "L_639", "UPDATE `user` SET `user_name` = \'K. M. Muntasir Billah Munna\', `user_dept` = \'CSE\', `teacher_designation` = \'Faculty Member\', `user_phone` = \'015161806030\', `user_email` = \'kmmuntasir@gmail.com\', `user_username` = \'muntasir\' WHERE `user_id` = \'IST_3\'", "1", "2018-08-20 20:16:39");
INSERT INTO `log` VALUES ("129", "L_640", "UPDATE `user` SET `user_name` = \'K. M. Muntasir Billah Munna\', `user_dept` = \'CSE\', `teacher_designation` = \'Faculty Member\', `user_phone` = \'015161806030\', `user_email` = \'kmmuntasir@gmail.com\', `user_username` = \'muntasir\' WHERE `user_id` = \'IST_3\'", "1", "2018-08-20 20:18:38");
INSERT INTO `log` VALUES ("130", "L_641", "UPDATE `user` SET `user_name` = \'K. M. Muntasir Billah Munna\', `user_dept` = \'CSE\', `teacher_designation` = \'Faculty Member\', `user_phone` = \'01516180603\', `user_email` = \'kmmuntasir@gmail.com\', `user_username` = \'muntasir\' WHERE `user_id` = \'IST_3\'", "1", "2018-08-20 20:18:45");
INSERT INTO `log` VALUES ("131", "L_642", "UPDATE `user` SET `user_name` = \'K. M. Muntasir Billah Munna\', `user_dept` = \'CSE\', `teacher_designation` = \'Faculty Member\', `user_phone` = \'01516180603\', `user_email` = \'kmmuntasir@gmail.com\', `user_username` = \'muntasir\' WHERE `user_id` = \'IST_3\'", "1", "2018-08-20 20:19:08");
INSERT INTO `log` VALUES ("132", "L_643", "UPDATE `user` SET `user_name` = \'Muntasir Billah\', `user_dept` = \'CSE\', `user_session` = \'2009\', `user_roll` = \'1057\', `user_phone` = \'01516180603\', `user_email` = \'mun@na.com\', `user_username` = \'munna\' WHERE `user_id` = \'IST_1\'", "1", "2018-08-20 20:19:30");
INSERT INTO `log` VALUES ("133", "L_644", "UPDATE `user` SET `user_name` = \'Muntasir Billah\', `user_dept` = \'CSE\', `user_session` = \'2009\', `user_roll` = \'1057\', `user_phone` = \'015161806030\', `user_email` = \'mun@na.com\', `user_username` = \'munna\' WHERE `user_id` = \'IST_1\'", "1", "2018-08-20 20:19:35");
INSERT INTO `log` VALUES ("134", "L_645", "UPDATE `user` SET `user_name` = \'Muntasir Billah\', `user_dept` = \'CSE\', `user_session` = \'2009\', `user_roll` = \'1057\', `user_phone` = \'01516180603\', `user_email` = \'mun@na.com\', `user_username` = \'munna\' WHERE `user_id` = \'IST_1\'", "1", "2018-08-20 20:19:38");
INSERT INTO `log` VALUES ("135", "L_646", "UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'L_9\'", "1", "2018-08-20 20:19:41");
INSERT INTO `log` VALUES ("136", "L_647", "UPDATE `user` SET `is_deleted` = 0 WHERE `user_id` = \'L_9\'", "1", "2018-08-20 20:19:46");
INSERT INTO `log` VALUES ("137", "L_648", "UPDATE `user` SET `is_deleted` = 1 WHERE `user_id` = \'L_8\'", "1", "2018-08-20 20:19:54");
INSERT INTO `log` VALUES ("138", "L_138", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_3\', \'2018-08-23 22:38:00\', \'2018-08-25 16:30:00\', \'L_2\', \'L_2\', 9, \'lBefye4b\', \'yFxw3%ZF\', \'r&3XF&Ru\', \'B@Kqzxgz\', \'R6Pizcv4\', \'ARr4JXQm\', \'\')", "0", "2018-08-23 22:38:00");
INSERT INTO `log` VALUES ("148", "L_139", "UPDATE `book` SET `book_id` = \'L_2\', `book_available` = 9 WHERE `book_id` = \'L_2\'", "0", "2018-08-23 22:38:16");
INSERT INTO `log` VALUES ("149", "L_149", "UPDATE `issue` SET `issue_id` = \'L_3\', `issue_status` = 0 WHERE `issue_id` = \'L_3\'", "0", "2018-08-23 22:38:16");
INSERT INTO `log` VALUES ("159", "L_150", "UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_19\', `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_19\'", "0", "2018-08-23 22:39:20");
INSERT INTO `log` VALUES ("160", "L_160", "UPDATE `issue` SET `manager_id` = \'IST_LIBRARY_1\', `issue_book_copy_accession_no` = \'L_c_19\', `issue_status` = 1, `issue_datetime` = \'2018-08-23 22:39:20\', `issue_deadline` = \'2018-09-07 16:30:00\' WHERE `issue_id` = \'L_3\'", "0", "2018-08-23 22:39:20");
INSERT INTO `log` VALUES ("161", "L_161", "UPDATE `book` SET `book_available` = 1 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:40:47");
INSERT INTO `log` VALUES ("162", "L_162", "UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_42\'", "0", "2018-08-23 22:40:47");
INSERT INTO `log` VALUES ("163", "L_163", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_4\', \'2018-08-23 22:40:47\', \'2018-09-07 16:30:00\', \'L_5\', \'L_c_42\', \'L_3\', \'IST_LIBRARY_1\', 1, \'6EKef65W\', \'0Qti8TVQ\', \'AovC$upZ\', \'yy&JQMHk\', \'lv3XNLlZ\', \'4Mw3xQ5@\', \'\')", "0", "2018-08-23 22:40:47");
INSERT INTO `log` VALUES ("164", "L_164", "UPDATE `book` SET `book_available` = 0 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:41:05");
INSERT INTO `log` VALUES ("165", "L_165", "UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_43\'", "0", "2018-08-23 22:41:05");
INSERT INTO `log` VALUES ("166", "L_166", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_5\', \'2018-08-23 22:41:05\', \'2018-09-07 16:30:00\', \'L_5\', \'L_c_43\', \'L_4\', \'IST_LIBRARY_1\', 1, \'sEq1aGtR\', \'Zzw4Y&2h\', \'&O9KtdKx\', \'r#@TBRPj\', \'QGwDrCbf\', \'MlzmomOm\', \'\')", "0", "2018-08-23 22:41:05");
INSERT INTO `log` VALUES ("176", "L_167", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_6\', \'2018-08-23 22:41:56\', \'2018-08-25 16:30:00\', \'L_5\', \'L_2\', 9, \'E3wTZbC8\', \'#f3kt2kK\', \'ExTNwj#w\', \'Jhw0mFrG\', \'J88Q8WAM\', \'e6IrUjyN\', \'\')", "0", "2018-08-23 22:41:56");
INSERT INTO `log` VALUES ("186", "L_177", "UPDATE `book` SET `book_id` = \'L_5\' WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:42:14");
INSERT INTO `log` VALUES ("187", "L_187", "UPDATE `issue` SET `issue_id` = \'L_6\', `issue_status` = 6 WHERE `issue_id` = \'L_6\'", "0", "2018-08-23 22:42:14");
INSERT INTO `log` VALUES ("188", "L_188", "UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 1 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:42:38");
INSERT INTO `log` VALUES ("189", "L_189", "UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_43\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_43\'", "0", "2018-08-23 22:42:38");
INSERT INTO `log` VALUES ("190", "L_190", "UPDATE `issue` SET `issue_id` = \'L_5\', `issue_status` = 3, `issue_return_datetime` = \'2018-08-23 22:42:38\' WHERE `issue_id` = \'L_5\'", "0", "2018-08-23 22:42:38");
INSERT INTO `log` VALUES ("200", "L_191", "UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 0 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:43:00");
INSERT INTO `log` VALUES ("201", "L_201", "UPDATE `issue` SET `issue_id` = \'L_6\', `issue_status` = 0 WHERE `issue_id` = \'L_6\'", "0", "2018-08-23 22:43:00");
INSERT INTO `log` VALUES ("202", "L_202", "UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 1 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:45:40");
INSERT INTO `log` VALUES ("203", "L_203", "UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_42\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_42\'", "0", "2018-08-23 22:45:40");
INSERT INTO `log` VALUES ("204", "L_204", "UPDATE `issue` SET `issue_id` = \'L_4\', `issue_status` = 3, `issue_return_datetime` = \'2018-08-23 22:45:40\' WHERE `issue_id` = \'L_4\'", "0", "2018-08-23 22:45:40");
INSERT INTO `log` VALUES ("205", "L_205", "UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_43\', `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_43\'", "0", "2018-08-23 22:45:54");
INSERT INTO `log` VALUES ("206", "L_206", "UPDATE `issue` SET `manager_id` = \'IST_LIBRARY_1\', `issue_book_copy_accession_no` = \'L_c_43\', `issue_status` = 1, `issue_datetime` = \'2018-08-23 22:45:54\', `issue_deadline` = \'2018-09-07 16:30:00\' WHERE `issue_id` = \'L_6\'", "0", "2018-08-23 22:45:54");
INSERT INTO `log` VALUES ("207", "L_207", "UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 2 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:47:13");
INSERT INTO `log` VALUES ("208", "L_208", "UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_43\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_43\'", "0", "2018-08-23 22:47:13");
INSERT INTO `log` VALUES ("209", "L_209", "UPDATE `issue` SET `issue_id` = \'L_6\', `issue_status` = 3, `issue_return_datetime` = \'2018-08-23 22:47:13\' WHERE `issue_id` = \'L_6\'", "0", "2018-08-23 22:47:13");
INSERT INTO `log` VALUES ("210", "L_210", "UPDATE `book` SET `book_available` = 1 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:47:39");
INSERT INTO `log` VALUES ("211", "L_211", "UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_42\'", "0", "2018-08-23 22:47:39");
INSERT INTO `log` VALUES ("212", "L_212", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_7\', \'2018-08-23 22:47:39\', \'2018-09-07 16:30:00\', \'L_5\', \'L_c_42\', \'L_3\', \'IST_LIBRARY_1\', 1, \'vbFLXyck\', \'wUQcyC2n\', \'#1EO7IMV\', \'uh5e1vQO\', \'mlqRNC7d\', \'SsyQon#n\', \'\')", "0", "2018-08-23 22:47:39");
INSERT INTO `log` VALUES ("213", "L_213", "UPDATE `book` SET `book_available` = 0 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:47:53");
INSERT INTO `log` VALUES ("214", "L_214", "UPDATE `book_copy` SET `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_43\'", "0", "2018-08-23 22:47:53");
INSERT INTO `log` VALUES ("215", "L_215", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_deadline`, `issue_book_id`, `issue_book_copy_accession_no`, `user_id`, `manager_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_8\', \'2018-08-23 22:47:53\', \'2018-09-07 16:30:00\', \'L_5\', \'L_c_43\', \'L_4\', \'IST_LIBRARY_1\', 1, \'LrbeIUtJ\', \'SDdY2&U@\', \'ejumQvk$\', \'6FxyqRYJ\', \'waStMijz\', \'F4I7mnoD\', \'\')", "0", "2018-08-23 22:47:53");
INSERT INTO `log` VALUES ("216", "L_216", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_9\', \'2018-08-23 22:48:31\', \'2018-08-25 16:30:00\', \'L_5\', \'L_2\', 9, \'jO4iyWqd\', \'8MfxHK50\', \'on%twrng\', \'xjGkpq%e\', \'v%gLhQx$\', \'f0RlclXw\', \'\')", "0", "2018-08-23 22:48:31");
INSERT INTO `log` VALUES ("226", "L_217", "UPDATE `book` SET `book_id` = \'L_5\' WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:48:56");
INSERT INTO `log` VALUES ("227", "L_227", "UPDATE `issue` SET `issue_id` = \'L_9\', `issue_status` = 6 WHERE `issue_id` = \'L_9\'", "0", "2018-08-23 22:48:56");
INSERT INTO `log` VALUES ("228", "L_228", "UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 1 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:49:24");
INSERT INTO `log` VALUES ("229", "L_229", "UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_42\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_42\'", "0", "2018-08-23 22:49:24");
INSERT INTO `log` VALUES ("230", "L_230", "UPDATE `issue` SET `issue_id` = \'L_7\', `issue_status` = 3, `issue_return_datetime` = \'2018-08-23 22:49:24\' WHERE `issue_id` = \'L_7\'", "0", "2018-08-23 22:49:24");
INSERT INTO `log` VALUES ("240", "L_231", "UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 0 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:49:42");
INSERT INTO `log` VALUES ("241", "L_241", "UPDATE `issue` SET `issue_id` = \'L_9\', `issue_status` = 0 WHERE `issue_id` = \'L_9\'", "0", "2018-08-23 22:49:42");
INSERT INTO `log` VALUES ("242", "L_242", "UPDATE `user` SET `user_name` = \'Md. Nahid Hasan\', `user_dept` = \'ECE\', `user_session` = \'2014\', `user_roll` = \'1572\', `user_phone` = \'01798462574\', `user_email` = \'nahid@gmail.com\', `user_username` = \'nahid\', `user_pass` = \'202cb962ac59075b964b07152d234b70\' WHERE `user_id` = \'L_3\'", "0", "2018-08-23 22:50:20");
INSERT INTO `log` VALUES ("243", "L_243", "INSERT INTO `issue` (`issue_id`, `issue_datetime`, `issue_auto_expire_datetime`, `issue_book_id`, `user_id`, `issue_status`, `issue_lend_user_code`, `issue_receive_user_code`, `issue_receive_admin_code`, `issue_fine_user_code`, `issue_fine_admin_code`, `issue_renew_user_code`, `issue_remarks`) VALUES (\'L_10\', \'2018-08-23 22:50:36\', \'2018-08-25 16:30:00\', \'L_5\', \'L_3\', 9, \'Rr01dBb$\', \'kYJTFU%f\', \'awJ5dLdE\', \'3qx1Hkqe\', \'Zu1t1o0D\', \'sA9myn7a\', \'\')", "0", "2018-08-23 22:50:36");
INSERT INTO `log` VALUES ("253", "L_244", "UPDATE `book` SET `book_id` = \'L_5\' WHERE `book_id` = \'L_5\'", "0", "2018-08-23 22:50:56");
INSERT INTO `log` VALUES ("254", "L_254", "UPDATE `issue` SET `issue_id` = \'L_10\', `issue_status` = 6 WHERE `issue_id` = \'L_10\'", "0", "2018-08-23 22:50:56");
INSERT INTO `log` VALUES ("255", "L_255", "UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_42\', `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_42\'", "0", "2018-08-23 22:57:17");
INSERT INTO `log` VALUES ("256", "L_256", "UPDATE `issue` SET `manager_id` = \'IST_LIBRARY_1\', `issue_book_copy_accession_no` = \'L_c_42\', `issue_status` = 1, `issue_datetime` = \'2018-08-23 22:57:17\', `issue_deadline` = \'2018-09-07 16:30:00\' WHERE `issue_id` = \'L_9\'", "0", "2018-08-23 22:57:17");
INSERT INTO `log` VALUES ("257", "L_257", "UPDATE `book` SET `book_url` = \' \' WHERE `book_id` = \'L_8\'", "0", "2018-08-23 22:59:00");
INSERT INTO `log` VALUES ("258", "L_258", "UPDATE `book` SET `book_title` = \'Data Structures\', `book_isbn` = \'978-12590299\', `publication_id` = \'L_7\', `book_edition` = \'1st\', `book_place_of_pub` = \'New York\', `book_year_of_pub` = \'2002\', `book_pages` = \'286\', `book_status` = \'1\', `book_url` = \'\', `book_url_unlocked` = \'1\', `book_remarks` = \'\' WHERE `book_id` = \'L_8\'", "0", "2018-08-23 22:59:28");
INSERT INTO `log` VALUES ("259", "L_259", "DELETE FROM `book_author` WHERE `book_id` = \'L_8\'", "0", "2018-08-23 22:59:28");
INSERT INTO `log` VALUES ("260", "L_260", "INSERT INTO `book_author` (`author_id`, `book_id`) VALUES (\'L_11\',\'L_8\')", "0", "2018-08-23 22:59:28");
INSERT INTO `log` VALUES ("261", "L_261", "DELETE FROM `book_category` WHERE `book_id` = \'L_8\'", "0", "2018-08-23 22:59:28");
INSERT INTO `log` VALUES ("262", "L_262", "INSERT INTO `book_category` (`book_id`, `category_id`) VALUES (\'L_8\',\'L_1\'), (\'L_8\',\'L_2\'), (\'L_8\',\'L_5\')", "0", "2018-08-23 22:59:28");
INSERT INTO `log` VALUES ("272", "L_263", "UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 1 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 23:00:01");
INSERT INTO `log` VALUES ("273", "L_273", "UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_43\', `book_copy_status` = 1 WHERE `book_copy_accession_no` = \'L_c_43\'", "0", "2018-08-23 23:00:01");
INSERT INTO `log` VALUES ("274", "L_274", "UPDATE `issue` SET `issue_id` = \'L_8\', `issue_status` = 3, `issue_return_datetime` = \'2018-08-23 23:00:01\' WHERE `issue_id` = \'L_8\'", "0", "2018-08-23 23:00:01");
INSERT INTO `log` VALUES ("284", "L_275", "UPDATE `book` SET `book_id` = \'L_5\', `book_available` = 0 WHERE `book_id` = \'L_5\'", "0", "2018-08-23 23:00:12");
INSERT INTO `log` VALUES ("285", "L_285", "UPDATE `issue` SET `issue_id` = \'L_10\', `issue_status` = 0 WHERE `issue_id` = \'L_10\'", "0", "2018-08-23 23:00:12");
INSERT INTO `log` VALUES ("286", "L_286", "UPDATE `book_copy` SET `book_copy_accession_no` = \'L_c_43\', `book_copy_status` = 0 WHERE `book_copy_accession_no` = \'L_c_43\'", "0", "2018-08-23 23:00:53");
INSERT INTO `log` VALUES ("287", "L_287", "UPDATE `issue` SET `manager_id` = \'IST_LIBRARY_1\', `issue_book_copy_accession_no` = \'L_c_43\', `issue_status` = 1, `issue_datetime` = \'2018-08-23 23:00:53\', `issue_deadline` = \'2018-09-07 16:30:00\' WHERE `issue_id` = \'L_10\'", "0", "2018-08-23 23:00:53");

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `manager`
-- ----------------------------
INSERT INTO `manager` VALUES ("1", "IST_LIBRARY_1", "admin", "202cb962ac59075b964b07152d234b70", "Muntasir Billah Munna", "01516180603", "kmmuntasir@gmail.com", "2", "0", "2018-08-26 00:40:10");
INSERT INTO `manager` VALUES ("3", "L_2", "khalil", "202cb962ac59075b964b07152d234b70", "Khalilullah", "234567", "khalil@mia.com", "0", "0", "2018-08-20 20:03:36");
INSERT INTO `manager` VALUES ("4", "L_3", "salma", "202cb962ac59075b964b07152d234b70", "Salma", "23455", "sal@ma.com", "1", "0", "2018-08-20 20:02:55");
INSERT INTO `manager` VALUES ("8", "L_7", "hello", "202cb962ac59075b964b07152d234b70", "Hello", "1239550", "ljasdf@lkj.com", "1", "0", "2018-08-23 22:34:04");

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `publication`
-- ----------------------------
INSERT INTO `publication` VALUES ("1", "L_1", "শিখা প্রকাশনী", "2018-08-23 21:16:31");
INSERT INTO `publication` VALUES ("2", "L_2", "TATA mCGRAW Hills", "2018-08-23 21:17:41");
INSERT INTO `publication` VALUES ("3", "L_3", "Gyankosh Prokashoni, Bangladesh", "2018-08-23 21:19:50");
INSERT INTO `publication` VALUES ("4", "L_4", "Prentice-Hall India", "2018-08-23 21:20:39");
INSERT INTO `publication` VALUES ("5", "L_5", "আশা প্রকাশনী", "2018-08-23 21:21:12");
INSERT INTO `publication` VALUES ("6", "L_6", "Yale Publishers", "2018-08-23 21:21:49");
INSERT INTO `publication` VALUES ("7", "L_7", "Schaum\'s Outlines", "2018-08-23 21:22:27");

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
INSERT INTO `server` VALUES ("1", "remote", "http://library.ist.edu.bd/index.php", "2018-08-23 22:35:28", "1", "1", "HF1EBAvrgB");

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
INSERT INTO `settings` VALUES ("1", "HF1EBAvrgB", "15", "2", "2", "BDT ", "/=", "1", "Institute of Science and Technology", "d9b968f458576bc4302a76fb7ff68c4c.png", "c47e97c062d1c304619ef00a915e11fe.ico", "House #54, Road #15/A, Dhanmondi, Dhaka-1209", "info@ist.edu.bd", "01711223344", "1");

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of `user`
-- ----------------------------
INSERT INTO `user` VALUES ("1", "L_1", "rubayet", "202cb962ac59075b964b07152d234b70", "Md. Rubayet Hossain", "01671900427", "rubu@gmail.com", "ljnKrJ1cJ%", "CSE", "1014", "2010", "0", "0", null, "0", "", "2018-08-23 21:44:31");
INSERT INTO `user` VALUES ("2", "L_2", "rashid", "202cb962ac59075b964b07152d234b70", "Md. Rashid Hossain", "01587960318", "rashid@gmail.com", "123", "CSE", "1057", "2009", "0", "0", null, "0", "", "2018-08-23 22:26:23");
INSERT INTO `user` VALUES ("3", "L_3", "nahid", "202cb962ac59075b964b07152d234b70", "Md. Nahid Hasan", "01798462574", "nahid@gmail.com", "456", "ECE", "1572", "2014", "0", "0", null, "0", "", "2018-08-23 22:50:20");
INSERT INTO `user` VALUES ("4", "L_4", "shahana", "8MNe%dEI", "Mst. Shahana Begum", "01978453251", "shahana@gmail.com", "789", "BBA", "1670", "2015", "0", "0", null, "0", "", "2018-08-23 22:27:38");
INSERT INTO `user` VALUES ("5", "L_5", "azad", "31VvnfA5", "Md. Azad Chowdhury", "8801798765432", "azad@gmail.com", "d499ac4cf956f42f", "CSE", "", "0000", "1", "1", "Professor", "0", "", "2018-08-23 21:50:45");
INSERT INTO `user` VALUES ("6", "L_6", "johir", "GUMv3GTl", "Md. Johirul Islam", "8801998765432", "johir@gmail.com", "9322f3949493b0e3", "ECE", "", "0000", "1", "2", "Asst. Professor", "0", "", "2018-08-23 21:50:51");
INSERT INTO `user` VALUES ("7", "L_7", "durjoy", "eFib9Oy&", "Md. Moyeenul Hasan Durjoy", "12355677888", "durjoy@mail.com", "4", "BBA", "1036", "2017", "1", "3", "Lecturer", "0", "", "2018-08-23 22:34:04");

