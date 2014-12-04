/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : ptnn

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2014-12-04 14:12:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for answers
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionId` int(11) NOT NULL,
  `value` text NOT NULL,
  `valueTrue` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of answers
-- ----------------------------
INSERT INTO `answers` VALUES ('1', '1', 'Nhà văn', '0');
INSERT INTO `answers` VALUES ('2', '1', 'Nhà thơ', '1');
INSERT INTO `answers` VALUES ('3', '1', 'Họa sĩ', '0');
INSERT INTO `answers` VALUES ('4', '1', 'Nhà báo', '0');
INSERT INTO `answers` VALUES ('7', '2', 'Truyện Kiều', '1');
INSERT INTO `answers` VALUES ('8', '2', 'Lục Vân Tiên', '0');
INSERT INTO `answers` VALUES ('9', '2', 'Biệt đội xe không kính', '0');
INSERT INTO `answers` VALUES ('10', '2', 'Chiếc lá cuối cùng', '0');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `parent` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Phát triển ngôn ngữ', '0', '0');
INSERT INTO `categories` VALUES ('2', 'Phát triển chủ điểm', '0', '0');
INSERT INTO `categories` VALUES ('3', 'Quan sát', '0', '0');
INSERT INTO `categories` VALUES ('4', 'Phát triển trí tưởng tượng, khả năng sáng tạo', '0', '0');
INSERT INTO `categories` VALUES ('5', 'Trò chơi', '0', '0');
INSERT INTO `categories` VALUES ('6', 'Kiểm tra, đánh giá', '0', '0');
INSERT INTO `categories` VALUES ('7', 'Từ', '1', '0');
INSERT INTO `categories` VALUES ('8', 'Câu', '1', '0');
INSERT INTO `categories` VALUES ('9', 'Đoạn văn', '1', '0');
INSERT INTO `categories` VALUES ('10', 'Bài văn', '1', '0');
INSERT INTO `categories` VALUES ('11', 'Tả con vật', '2', '0');
INSERT INTO `categories` VALUES ('12', 'Tả người', '2', '0');
INSERT INTO `categories` VALUES ('13', 'Tả đồ vật', '2', '0');
INSERT INTO `categories` VALUES ('14', 'Tả cây cối', '2', '0');
INSERT INTO `categories` VALUES ('15', 'Tả cảnh', '2', '0');
INSERT INTO `categories` VALUES ('16', 'Hướng dẫn cách quan sát', '3', '0');
INSERT INTO `categories` VALUES ('17', 'Bài tập quan sát', '3', '0');
INSERT INTO `categories` VALUES ('18', 'Hướng dẫn cách liên tưởng, tưởng tượng', '4', '0');
INSERT INTO `categories` VALUES ('19', 'Bài tập liên tưởng, tưởng tượng', '4', '0');
INSERT INTO `categories` VALUES ('20', 'Trò chơi phát triển ngôn ngữ', '5', '0');
INSERT INTO `categories` VALUES ('21', 'Trờ chơi phát triển kỹ năng liên tưởng, tưởng tượng', '5', '0');
INSERT INTO `categories` VALUES ('22', 'Cuộc thi', '6', '0');
INSERT INTO `categories` VALUES ('23', 'Kiểm tra định kì', '6', '0');

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('1', 'Nguyễn Du là ai ', '7');
INSERT INTO `questions` VALUES ('2', 'Tác phẩm nào của Nguyễn Du trong các tác phẩm dưới đây', '7');

-- ----------------------------
-- Table structure for sync_table
-- ----------------------------
DROP TABLE IF EXISTS `sync_table`;
CREATE TABLE `sync_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `line_data` text NOT NULL,
  `v` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sync_table
-- ----------------------------
INSERT INTO `sync_table` VALUES ('1', 'insert into `user`(name,username,password,email,birthday,address,phone,idpassport,iddate,idplace) values (\'\',\'nghj\',\'d41d8cd98f00b204e9800998ecf8427e\',\'kieunghia.cntt@gmail.com\',\'\',\'\',\'\',\'\',\'\',\'\')', '74');
INSERT INTO `sync_table` VALUES ('2', 'insert into `user`(name,username,password,email,birthday,address,phone,idpassport,iddate,idplace) values (\'\',\'nghu\',\'d41d8cd98f00b204e9800998ecf8427e\',\'kieunghia.cntt@gmail.com\',\'\',\'\',\'\',\'\',\'\',\'\')', '75');
INSERT INTO `sync_table` VALUES ('3', 'update user set `key`=\'cfcd208495d565ef66e7dff9f98764da\' where 1 AND (`username`=\'nghu\')', '76');
INSERT INTO `sync_table` VALUES ('4', 'update user set `key`=\'70b6a7366568c36bb3f8b448f60eb5c2\' where 1 AND ((`email`=\'kieunghia.cntt@gmail.com\') and (`status`=1))', '77');
INSERT INTO `sync_table` VALUES ('5', 'update user set `key`=\'70b6a7366568c36bb3f8b448f60eb5c2\' where 1 AND ((`email`=\'kieunghia.cntt@gmail.com\') and (`status`=1))', '78');
INSERT INTO `sync_table` VALUES ('6', 'update user set `key`=\'cfcd208495d565ef66e7dff9f98764da\' where 1 AND ((`email`=\'kieunghia.cntt@gmail.com\') and (`status`=1))', '79');
INSERT INTO `sync_table` VALUES ('7', 'update user set `key`=\'cfcd208495d565ef66e7dff9f98764da\' where 1 AND ((`email`=\'kieunghia.cntt@gmail.com\') and (`status`=1))', '80');
INSERT INTO `sync_table` VALUES ('8', 'update user set `key`=\'cfcd208495d565ef66e7dff9f98764da\' where 1 AND ((`email`=\'kieunghia.cntt@gmail.com\') and (`status`=1))', '81');
INSERT INTO `sync_table` VALUES ('9', 'update user set `key`=\'cfcd208495d565ef66e7dff9f98764da\' where 1 AND ((`email`=\'kieunghia.cntt@gmail.com\') and (`status`=1))', '82');
INSERT INTO `sync_table` VALUES ('10', 'update user set `key`=\'cfcd208495d565ef66e7dff9f98764da\' where 1 AND ((`email`=\'kieunghia.cntt@gmail.com\') and (`status`=1))', '83');
INSERT INTO `sync_table` VALUES ('11', 'update user set `key`=\'cfcd208495d565ef66e7dff9f98764da\' where 1 AND ((`email`=\'kieunghia.cntt@gmail.com\') and (`status`=1))', '84');
INSERT INTO `sync_table` VALUES ('12', 'update user set `key`=\'cfcd208495d565ef66e7dff9f98764da\' where 1 AND ((`email`=\'kieunghia.cntt@gmail.com\') and (`status`=1))', '85');
INSERT INTO `sync_table` VALUES ('13', 'update user set `key`=\'cfcd208495d565ef66e7dff9f98764da\' where 1 AND ((`email`=\'kieunghia.cntt@gmail.com\') and (`status`=1))', '86');
INSERT INTO `sync_table` VALUES ('14', 'insert into `user`(name,username,password,email,birthday,address,phone,idpassport,iddate,idplace) values (\'\',\'uuuuu\',\'d41d8cd98f00b204e9800998ecf8427e\',\'kieunghia.cntt@gmail.com\',\'\',\'\',\'\',\'\',\'\',\'\')', '87');
INSERT INTO `sync_table` VALUES ('15', 'update user set `key`=\'cfcd208495d565ef66e7dff9f98764da\' where 1 AND (`username`=\'uuuuu\')', '88');
INSERT INTO `sync_table` VALUES ('16', 'insert into `user`(name,username,password,email,birthday,address,phone,idpassport,iddate,idplace) values (\'\',\'222\',\'d41d8cd98f00b204e9800998ecf8427e\',\'kieunghia.cntt@gmail.com\',\'\',\'\',\'\',\'\',\'\',\'\')', '89');
INSERT INTO `sync_table` VALUES ('17', 'update user set `key`=\'bcbe3365e6ac95ea2c0343a2395834dd\' where 1 AND (`username`=\'222\')', '90');
INSERT INTO `sync_table` VALUES ('18', 'update user set `password`=\'8298934c\' where 1 AND ((`password`=\'8298934c\') and (`status`=1))', '91');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` int(255) DEFAULT NULL,
  `idpassport` int(255) DEFAULT NULL,
  `iddate` date DEFAULT NULL,
  `idplace` varchar(255) DEFAULT NULL,
  `key` varchar(255) NOT NULL,
  `status` smallint(1) unsigned zerofill DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'nghia', 'kieunghia', '123456789', 'kieunghia.cntt@gmail.com', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('2', 'quy', 'phungquy', '1234556789', 'phungquy@gmail.com', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('3', 'Nguyá»…n HoÃ ng Gia Báº£o', '', 'be83ab3ecd0db773eb2dc1b0a17836a1', '', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('4', 'Hoangf huyen', 'hoanghuyen', 'e10adc3949ba59abbe56e057f20f883e', '', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('5', 'Nguyá»…n HoÃ ng Gia Báº£o', 'admin', 'd9729feb74992cc3482b350163a1a010', '', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('6', 'Nguyá»…n HoÃ ng Gia Báº£o', 'hainam', 'd29aaa0b9cd402b4bfe2395a805f9ada', 'kieunghia.cntt@gmail.com', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('7', 'halkfdsjfkdl', 'manhha', 'ec37aa25501f5aea74d5eb3d19b08333', 'kfsdjfklfz@kgjk.com', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('8', 'dsfsf', 'hiiiiiiiiiiiiiii', '9dcb9a084eb0e0386e537f52f35df923', 'kfsdjfklfz@kgjk.com', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('9', 'test', 'test', 'e10adc3949ba59abbe56e057f20f883e', 'test@gmail.com', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('10', 'skdfjdskf', 'kjdfhsjk', '34c80a3b1100e2a03bb57e340f6f87e0', 'kjszfhdjk@jkf.xom', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('11', '', 'hiiiiiiiiiiiiiii12', '2467d3744600858cc9026d5ac6005305', 'hoangmanhha@gmail.com', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('12', '', 'hiiiiiiiiiiiiiii121', 'd41d8cd98f00b204e9800998ecf8427e', 'hoangmanhha@gmail.com', null, null, null, null, null, null, '', null);
INSERT INTO `user` VALUES ('13', 'Kiá»u NghÄ©a', 'kieunghia.cntt', 'e10adc3949ba59abbe56e057f20f883e', 'kieunghia.cntt1223@gmail.com', '0000-00-00', 'dsafsaf', '2147483647', '2147483647', '2014-12-24', 'hn', '', null);
INSERT INTO `user` VALUES ('14', '', 'test123', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt23@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('15', '', 'fgdfgdfgd', 'd41d8cd98f00b204e9800998ecf8427e', 'kfsz@kgjk.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('16', 'BÃ¹i Trá»±c', 'test1234', 'd41d8cd98f00b204e9800998ecf8427e', 'buitruc1610@gmail.com', '0000-00-00', 'hÃ  ná»™i', '2147483647', '2147483647', '2014-12-11', 'hn', '', null);
INSERT INTO `user` VALUES ('17', 'kieu nghia', 'buitruc123122', 'd821ccb2d1bee4e137cb6aab9106d3a4', 'kieunghia.nextnobel.jsc.edu@gmail.com', '0000-00-00', 'dsfdf', '2147483647', '2147483647', '2014-12-31', 'fdsfdf', '', null);
INSERT INTO `user` VALUES ('18', '', '34543646', '2a7ce1428e2a84de2e37e5f6914ddb1e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('19', '', '23344', '3564fc23b32d4e6d9598cc3f04533dbd', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('20', '', 'test34353535', '895f2763e107c68925d5b45dbaed3e34', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('21', '', 'test34353535dff', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('22', '', 'fdfdfdf', '5d5cc48db70ecce234a443a9a05d66ee', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('23', '', 'fgh', 'c767198f585684f0541661af4ea6dbd5', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('24', '', 'fd', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('25', '', 'ff', 'ece926d8c0356205276a45266d361161', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('26', '', 'rr', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('27', '', 'rrrr', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('28', '', 'bbbbbb', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('29', '', 'ggggg', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('30', '', 'hhh', 'd41d8cd98f00b204e9800998ecf8427e', '', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('31', '', 'f', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('32', '', 'ww', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('33', '', 'hhhhh', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('34', '', 'bbb', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('35', '', 'gghjj', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('36', '', 'gghhhh', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('37', '', 'testjjjjj', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('38', '', 'nnn', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('39', '', '3333', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('40', '', 'gggggggggggg', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('41', '', 'gggggg', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', null);
INSERT INTO `user` VALUES ('42', '', 'fu', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('43', '', '33333', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('44', '', '33333q', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('45', '', '121212', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('46', '', '1212121', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('47', '', 'wwww', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('48', '', 'ddÄ‘', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('49', '', 'jjjj', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('50', '', 'yyyyy', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('51', '', 'ngh', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('52', '', 'nghj', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', '', '0');
INSERT INTO `user` VALUES ('53', '', 'nghu', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', 'cfcd208495d565ef66e7dff9f98764da', '0');
INSERT INTO `user` VALUES ('54', '', 'uuuuu', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', 'cfcd208495d565ef66e7dff9f98764da', '0');
INSERT INTO `user` VALUES ('55', '', '222', 'd41d8cd98f00b204e9800998ecf8427e', 'kieunghia.cntt@gmail.com', '0000-00-00', '', '0', '0', '0000-00-00', '', 'bcbe3365e6ac95ea2c0343a2395834dd', '0');
