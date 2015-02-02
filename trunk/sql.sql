--
-- Database: `ptnn`
--

-- --------------------------------------------------------

--
-- @nguyenson update 07/01/2015
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request` varchar(500) NOT NULL,
  `name` text NOT NULL,
  `categoryIds` varchar(500) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_create` datetime NOT NULL,
  `admin_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `admin_modify` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- @nguyenson update 07/01/2015
-- Table structure for table `question_types`
--

CREATE TABLE IF NOT EXISTS `questiontype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `request` varchar(500) NOT NULL,
  `question_type` varchar(255) NOT NULL,
  `group_question` varchar(225) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `admin_create` int(11) NOT NULL,
  `admin_modify` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- @nguyenson update 29/01/2015
-- Table structure for table `answers_question_tn`
--

CREATE TABLE IF NOT EXISTS `answers_question_tn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `content_full` varchar(500) NOT NULL,
  `recommend` text NOT NULL,
  `date_modify` datetime DEFAULT NULL,
  `admin_modify` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- @nguyenson update 29/01/2015
-- Table structure for table `answers_question_topic`
--

CREATE TABLE IF NOT EXISTS `answers_question_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answers_question_tn_id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `questiontype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `request` varchar(500) NOT NULL,
  `question_type` varchar(255) NOT NULL,
  `group_question` varchar(225) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `admin_create` int(11) NOT NULL,
  `admin_modify` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;