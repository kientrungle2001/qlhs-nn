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
  `categoryIds` varchar(500) NOT NULL,			/* list_category_id*/
  `level` tinyint(4) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_create` datetime NOT NULL,
  `admin_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `admin_modify` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- @nguyenson update 07/01/2015
-- Table structure for table `question_types`
--

CREATE TABLE IF NOT EXISTS `questiontype` (		/* question_types*/
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
