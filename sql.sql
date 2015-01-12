--
-- Database: `ptnn`
--

-- --------------------------------------------------------

--
-- @nguyenson update 07/01/2015
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `categoryIds` varchar(500) NOT NULL, 			/* list_category_id*/
  `level` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `admin_create` int(11) NOT NULL,
  `admin_modify` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- @nguyenson update 07/01/2015
-- Table structure for table `question_types`
--

CREATE TABLE IF NOT EXISTS `questiontype` (    /* question_types*/
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `admin_create` int(11) NOT NULL,
  `admin_modify` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- @nguyenson update 07/01/2015
-- Table structure for table `answers`
-- status TRUE or FALSE
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionId` int(11) NOT NULL,				/* question_id*/
  `value` text NOT NULL, 						/* content*/
  `valueTrue` tinyint(1) NOT NULL DEFAULT '0',	/* status*/
  `description` text,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `admin_create` int(11) NOT NULL,
  `admin_modify` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;