-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2014 at 10:11 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ptnn`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
`id` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `value` text NOT NULL,
  `valueTrue` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `questionId`, `value`, `valueTrue`) VALUES
(1, 1, 'Nhà văn', 0),
(2, 1, 'Nhà thơ', 1),
(3, 1, 'Họa sĩ', 0),
(4, 1, 'Nhà báo', 0),
(7, 2, 'Truyện Kiều', 1),
(8, 2, 'Lục Vân Tiên', 0),
(9, 2, 'Biệt đội xe không kính', 0),
(10, 2, 'Chiếc lá cuối cùng', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `parent` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent`, `status`) VALUES
(1, 'Phát triển ngôn ngữ', 0, 0),
(2, 'Phát triển chủ điểm', 0, 0),
(3, 'Quan sát', 0, 0),
(4, 'Phát triển trí tưởng tượng, khả năng sáng tạo', 0, 0),
(5, 'Trò chơi', 0, 0),
(6, 'Kiểm tra, đánh giá', 0, 0),
(7, 'Từ', 1, 0),
(8, 'Câu', 1, 0),
(9, 'Đoạn văn', 1, 0),
(10, 'Bài văn', 1, 0),
(11, 'Tả con vật', 2, 0),
(12, 'Tả người', 2, 0),
(13, 'Tả đồ vật', 2, 0),
(14, 'Tả cây cối', 2, 0),
(15, 'Tả cảnh', 2, 0),
(16, 'Hướng dẫn cách quan sát', 3, 0),
(17, 'Bài tập quan sát', 3, 0),
(18, 'Hướng dẫn cách liên tưởng, tưởng tượng', 4, 0),
(19, 'Bài tập liên tưởng, tưởng tượng', 4, 0),
(20, 'Trò chơi phát triển ngôn ngữ', 5, 0),
(21, 'Trờ chơi phát triển kỹ năng liên tưởng, tưởng tượng', 5, 0),
(22, 'Cuộc thi', 6, 0),
(23, 'Kiểm tra định kì', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
`id` int(10) NOT NULL,
  `name` text NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `name`, `categoryId`) VALUES
(1, 'Nguyễn Du là ai ', 7),
(2, 'Tác phẩm nào của Nguyễn Du trong các tác phẩm dưới đây', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
