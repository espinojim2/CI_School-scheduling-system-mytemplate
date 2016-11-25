-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2015 at 02:31 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mnhs`
--

-- --------------------------------------------------------

--
-- Table structure for table `sys_account_type`
--

CREATE TABLE IF NOT EXISTS `sys_account_type` (
  `accountTypeId` int(2) NOT NULL AUTO_INCREMENT,
  `accountType` varchar(20) NOT NULL,
  `accntclass` varchar(50) NOT NULL COMMENT 'classification of account',
  PRIMARY KEY (`accountTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sys_account_type`
--

INSERT INTO `sys_account_type` (`accountTypeId`, `accountType`, `accntclass`) VALUES
(1, 'Superadmin', 'S'),
(3, 'Teacher User', 'E'),
(4, 'Registrar', 'R'),
(5, 'Student User', 'ST');

-- --------------------------------------------------------

--
-- Table structure for table `sys_account_type_template`
--

CREATE TABLE IF NOT EXISTS `sys_account_type_template` (
  `pageTemplateId` int(10) NOT NULL,
  `accountTypeId` int(2) NOT NULL,
  `pageId` int(10) NOT NULL,
  `aview` tinyint(1) NOT NULL COMMENT '1=show 0=hidden ',
  PRIMARY KEY (`pageTemplateId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_account_type_template`
--

INSERT INTO `sys_account_type_template` (`pageTemplateId`, `accountTypeId`, `pageId`, `aview`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 1),
(13, 1, 13, 1),
(14, 1, 14, 1),
(15, 1, 15, 1),
(16, 1, 16, 1),
(17, 1, 17, 1),
(18, 3, 6, 1),
(19, 5, 6, 1),
(20, 3, 1, 1),
(21, 4, 1, 1),
(22, 4, 6, 1),
(23, 4, 4, 1),
(24, 4, 7, 1),
(25, 4, 9, 1),
(26, 4, 17, 1),
(27, 4, 10, 1),
(28, 4, 11, 1),
(29, 4, 5, 1),
(30, 4, 16, 1),
(31, 4, 12, 0),
(32, 4, 13, 0),
(33, 4, 14, 0),
(34, 4, 15, 0),
(35, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_levels`
--

CREATE TABLE IF NOT EXISTS `sys_levels` (
  `lvlid` int(10) NOT NULL,
  `lvlcode` text NOT NULL,
  `lvlname` text NOT NULL,
  `seq` int(10) NOT NULL,
  `remark` int(2) NOT NULL,
  PRIMARY KEY (`lvlid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_levels`
--

INSERT INTO `sys_levels` (`lvlid`, `lvlcode`, `lvlname`, `seq`, `remark`) VALUES
(1, 'HS1', 'First Year HS', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_module`
--

CREATE TABLE IF NOT EXISTS `sys_module` (
  `moduleId` int(10) NOT NULL AUTO_INCREMENT,
  `moduleOrder` varchar(50) NOT NULL,
  `moduleAlias` text NOT NULL,
  `moduleName` varchar(50) NOT NULL,
  PRIMARY KEY (`moduleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sys_module`
--

INSERT INTO `sys_module` (`moduleId`, `moduleOrder`, `moduleAlias`, `moduleName`) VALUES
(1, '1', 'home', 'Home'),
(2, '3', 'human_resource', 'Human Resource'),
(3, '7', 'setup', 'Setup'),
(4, '8', 'privilege', 'Privilege'),
(5, '6', 'account_management', 'Account Management'),
(6, '2', 'profile', 'Profile'),
(7, '4', 'registrar', 'Registrar'),
(8, '5', 'reports', 'Reports');

-- --------------------------------------------------------

--
-- Table structure for table `sys_p_account`
--

CREATE TABLE IF NOT EXISTS `sys_p_account` (
  `accountId` int(11) NOT NULL,
  `pid` int(10) NOT NULL,
  `accountTypeId` int(2) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `accountStatus` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT 'active=1 inactive=0',
  PRIMARY KEY (`accountId`),
  KEY `pid` (`pid`),
  KEY `accountTypeId` (`accountTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_p_account`
--

INSERT INTO `sys_p_account` (`accountId`, `pid`, `accountTypeId`, `username`, `password`, `accountStatus`, `active`) VALUES
(1, 1, 1, 'superadmin', '1a1dc91c907325c69271ddf0c944bc72', 1, 1),
(2, 2, 1, 'username', '1a1dc91c907325c69271ddf0c944bc72', 1, 1),
(3, 3, 5, 'jamesreed', '1a1dc91c907325c69271ddf0c944bc72', 1, 1),
(4, 5, 5, 'piolopascual', '1a1dc91c907325c69271ddf0c944bc72', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_p_authorization`
--

CREATE TABLE IF NOT EXISTS `sys_p_authorization` (
  `accountId` int(10) NOT NULL,
  `pageId` int(10) NOT NULL,
  `aview` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_p_authorization`
--

INSERT INTO `sys_p_authorization` (`accountId`, `pageId`, `aview`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(1, 7, 1),
(1, 9, 1),
(1, 10, 1),
(1, 11, 1),
(1, 12, 1),
(1, 13, 1),
(1, 14, 1),
(1, 15, 1),
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(2, 4, 1),
(2, 5, 1),
(2, 6, 1),
(2, 7, 1),
(2, 9, 1),
(2, 10, 1),
(2, 11, 1),
(2, 12, 1),
(2, 13, 1),
(2, 14, 1),
(2, 15, 1),
(1, 16, 1),
(2, 16, 1),
(1, 17, 1),
(2, 17, 1),
(3, 6, 1),
(3, 1, 1),
(4, 6, 1),
(4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_p_person`
--

CREATE TABLE IF NOT EXISTS `sys_p_person` (
  `pid` int(10) NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `ename` text NOT NULL,
  `gender` varchar(1) NOT NULL,
  `bdate` date NOT NULL,
  `bplace` text NOT NULL,
  `imgId` int(10) NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `remark` int(2) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_p_person`
--

INSERT INTO `sys_p_person` (`pid`, `fname`, `mname`, `lname`, `ename`, `gender`, `bdate`, `bplace`, `imgId`, `email`, `contact`, `remark`) VALUES
(1, 'James', 'Protacio', 'Reed', '', 'm', '1995-06-13', '', 0, 'jamesreed@gmail.com', '09272522276', 1),
(2, 'John', 'Ferdinand', 'Kennedy', '', 'm', '2015-12-03', '', 0, '', '098743535353', 1),
(3, 'James', '', 'Reed', '', 'm', '1995-12-16', 'Albay', 0, 'j@yahoo.com', '', 1),
(4, 'Jehova', '', 'Jaira', '', 'm', '2015-12-23', '', 0, '', '', 1),
(5, 'Piolo', '', 'Pascual', '', 'm', '2007-02-14', 'Albay', 0, 'p@yahoo.com', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_rooms`
--

CREATE TABLE IF NOT EXISTS `sys_rooms` (
  `roomid` int(10) NOT NULL,
  `roomcode` text NOT NULL,
  `roomname` text NOT NULL,
  `remark` int(2) NOT NULL,
  PRIMARY KEY (`roomid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_rooms`
--

INSERT INTO `sys_rooms` (`roomid`, `roomcode`, `roomname`, `remark`) VALUES
(1, 'R1', 'Room 1', 1),
(2, 'R2', 'Room 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_schedule`
--

CREATE TABLE IF NOT EXISTS `sys_schedule` (
  `schedid` int(10) NOT NULL,
  `syid` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `lvlid` int(10) NOT NULL,
  `sectid` int(10) NOT NULL,
  `roomid` int(10) NOT NULL,
  `day` text NOT NULL,
  `stime` text NOT NULL,
  `etime` text NOT NULL,
  `remark` int(2) NOT NULL,
  PRIMARY KEY (`schedid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_schedule`
--

INSERT INTO `sys_schedule` (`schedid`, `syid`, `pid`, `lvlid`, `sectid`, `roomid`, `day`, `stime`, `etime`, `remark`) VALUES
(1, 1, 2, 1, 1, 1, 'monday', '7:0', '8:0', 1),
(2, 1, 2, 1, 1, 1, 'monday', '8:0', '9:0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_schoolyear`
--

CREATE TABLE IF NOT EXISTS `sys_schoolyear` (
  `syid` int(10) NOT NULL,
  `strt` date NOT NULL COMMENT 'start of School Year',
  `end` date NOT NULL COMMENT 'End of S.Y',
  `remark` int(2) NOT NULL COMMENT '1-enabled 2=disabled',
  PRIMARY KEY (`syid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_schoolyear`
--

INSERT INTO `sys_schoolyear` (`syid`, `strt`, `end`, `remark`) VALUES
(1, '2015-12-15', '2016-12-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_sections`
--

CREATE TABLE IF NOT EXISTS `sys_sections` (
  `sectid` int(10) NOT NULL,
  `lvlid` int(10) NOT NULL,
  `sectcode` text NOT NULL,
  `sectname` text NOT NULL,
  `sectdesc` text NOT NULL,
  `seq` int(10) NOT NULL,
  `remark` int(2) NOT NULL,
  PRIMARY KEY (`sectid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_sections`
--

INSERT INTO `sys_sections` (`sectid`, `lvlid`, `sectcode`, `sectname`, `sectdesc`, `seq`, `remark`) VALUES
(1, 1, 'HSS1', 'Section 1', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_systempages`
--

CREATE TABLE IF NOT EXISTS `sys_systempages` (
  `id` int(10) NOT NULL,
  `pageId` int(10) NOT NULL,
  `pageOrder` int(10) NOT NULL,
  `pageAlias` varchar(100) NOT NULL,
  `pageName` varchar(100) NOT NULL,
  `moduleId` int(10) NOT NULL,
  `iconId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pageId` (`pageId`),
  KEY `moduleId` (`moduleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_systempages`
--

INSERT INTO `sys_systempages` (`id`, `pageId`, `pageOrder`, `pageAlias`, `pageName`, `moduleId`, `iconId`) VALUES
(1, 1, 1, 'dashboard', 'Main Page', 1, 0),
(2, 2, 1, 'system_template', 'System Pages', 4, 0),
(3, 3, 2, 'system_privilege', 'System Privilege', 4, 0),
(4, 4, 1, 'personnel_information', 'Personnel Information', 2, 0),
(5, 5, 1, 'user_accounts', 'User Accounts', 5, 0),
(6, 6, 1, 'my_schedule', 'My Schedule', 6, 0),
(7, 7, 1, 'schedule_management', 'Schedule Management', 7, 0),
(9, 9, 3, 'student_information', 'Student Information', 7, 0),
(10, 10, 1, 'class_schedule', 'Class Schedule', 8, 0),
(11, 11, 2, 'teacher_schedule', 'Teacher Schedule', 8, 0),
(12, 12, 1, 'schoolyear_setup', 'School Year Management', 3, 0),
(13, 13, 2, 'room_management', 'Room Management', 3, 0),
(14, 14, 3, 'level_setup', 'Level Setup', 3, 0),
(15, 15, 4, 'section_setup', 'Section Setup', 3, 0),
(16, 16, 2, 'student_user_account', 'Student User Accounts', 5, 0),
(17, 17, 4, 'teacher_assignment', 'Teacher Assignment', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sys_s_registration`
--

CREATE TABLE IF NOT EXISTS `sys_s_registration` (
  `enrollid` int(10) NOT NULL,
  `syid` int(10) NOT NULL,
  `lvlid` int(10) NOT NULL,
  `sectid` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `remark` int(2) NOT NULL,
  PRIMARY KEY (`enrollid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_s_registration`
--

INSERT INTO `sys_s_registration` (`enrollid`, `syid`, `lvlid`, `sectid`, `pid`, `remark`) VALUES
(1, 1, 1, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_s_student`
--

CREATE TABLE IF NOT EXISTS `sys_s_student` (
  `pid` int(10) NOT NULL,
  `student_id` text NOT NULL,
  `yoe` text NOT NULL COMMENT 'Year of Entry',
  `count` text NOT NULL COMMENT 'student id code counter',
  `remark` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_s_student`
--

INSERT INTO `sys_s_student` (`pid`, `student_id`, `yoe`, `count`, `remark`) VALUES
(3, '2015-000001', '2015', '000001', 1),
(5, '2015-000002', '2015', '000002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_teacher_assign`
--

CREATE TABLE IF NOT EXISTS `sys_teacher_assign` (
  `pid` int(10) NOT NULL,
  `syid` int(10) NOT NULL,
  `isteacher` int(2) NOT NULL,
  `remark` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_teacher_assign`
--

INSERT INTO `sys_teacher_assign` (`pid`, `syid`, `isteacher`, `remark`) VALUES
(1, 1, 0, 1),
(2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_passwords`
--

CREATE TABLE IF NOT EXISTS `sys_user_passwords` (
  `accountId` int(10) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_user_passwords`
--

INSERT INTO `sys_user_passwords` (`accountId`, `password`) VALUES
(2, 'pass'),
(3, 'pass'),
(4, 'pass');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
