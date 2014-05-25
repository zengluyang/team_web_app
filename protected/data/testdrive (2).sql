-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014 年 05 月 19 日 09:16
-- 服务器版本: 5.5.32
-- PHP 版本: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `testdrive`
--
CREATE DATABASE IF NOT EXISTS `testdrive` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `testdrive`;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_paper`
--

CREATE TABLE IF NOT EXISTS `tbl_paper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info` mediumtext COLLATE utf8_bin NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `pass_date` date DEFAULT NULL,
  `pub_date` date DEFAULT NULL,
  `index_date` date DEFAULT NULL,
  `sci_number` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ei_number` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `istp_number` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `is_first_grade` tinyint(1) DEFAULT NULL,
  `is_core` tinyint(1) DEFAULT NULL,
  `other_pub` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `is_journal` tinyint(1) DEFAULT NULL,
  `is_conference` tinyint(1) DEFAULT NULL,
  `is_intl` tinyint(1) DEFAULT NULL,
  `is_domestic` tinyint(1) DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8_bin NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_content` mediumblob NOT NULL,
  `is_high_level` tinyint(1) DEFAULT NULL,
  `maintainer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_paper_ibfk_1` (`maintainer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2447 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_paper_people`
--

CREATE TABLE IF NOT EXISTS `tbl_paper_people` (
  `paper_id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `seq` int(11) DEFAULT NULL,
  PRIMARY KEY (`paper_id`,`people_id`),
  KEY `tbl_paper_people_ibfk_2` (`people_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_paper_project_fund`
--

CREATE TABLE IF NOT EXISTS `tbl_paper_project_fund` (
  `paper_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `seq` int(11) DEFAULT NULL,
  PRIMARY KEY (`paper_id`,`project_id`),
  KEY `tbl_paper_project_ibfk_2` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_paper_project_reim`
--

CREATE TABLE IF NOT EXISTS `tbl_paper_project_reim` (
  `paper_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `seq` int(11) DEFAULT NULL,
  PRIMARY KEY (`paper_id`,`project_id`),
  KEY `tbl_paper_project_ibfk_2` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_patent`
--

CREATE TABLE IF NOT EXISTS `tbl_patent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `app_date` date NOT NULL,
  `app_number` varchar(255) COLLATE utf8_bin NOT NULL,
  `auth_number` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `auth_date` date DEFAULT NULL,
  `is_intl` tinyint(1) NOT NULL,
  `is_domestic` tinyint(1) NOT NULL,
  `abstract` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1034 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_patent_people`
--

CREATE TABLE IF NOT EXISTS `tbl_patent_people` (
  `patent_id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  PRIMARY KEY (`patent_id`,`people_id`),
  KEY `tbl_patent_people_ibfk_2` (`people_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_people`
--

CREATE TABLE IF NOT EXISTS `tbl_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=196 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fund_number` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `is_intl` tinyint(1) DEFAULT NULL,
  `is_national` tinyint(1) DEFAULT NULL,
  `is_provincial` tinyint(1) DEFAULT NULL,
  `is_city` tinyint(1) DEFAULT NULL,
  `is_school` tinyint(1) DEFAULT NULL,
  `is_enterprise` tinyint(1) DEFAULT NULL,
  `is_NSF` tinyint(1) DEFAULT NULL,
  `is_973` tinyint(1) DEFAULT NULL,
  `is_863` tinyint(1) DEFAULT NULL,
  `is_NKTRD` tinyint(1) DEFAULT NULL,
  `is_DFME` tinyint(1) DEFAULT NULL,
  `is_major` tinyint(1) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `deadline_date` date DEFAULT NULL,
  `conclude_date` date DEFAULT NULL,
  `app_date` date DEFAULT NULL,
  `pass_date` date DEFAULT NULL,
  `app_fund` decimal(15,2) DEFAULT NULL,
  `pass_fund` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=141 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_project_people_execute`
--

CREATE TABLE IF NOT EXISTS `tbl_project_people_execute` (
  `project_id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  PRIMARY KEY (`project_id`,`people_id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_project_people_liability`
--

CREATE TABLE IF NOT EXISTS `tbl_project_people_liability` (
  `project_id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  PRIMARY KEY (`project_id`,`people_id`),
  KEY `tbl_paper_people_liability_ibfk_2` (`people_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `is_paper` tinyint(1) DEFAULT NULL,
  `is_project` tinyint(1) DEFAULT NULL,
  `is_patent` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- 限制导出的表
--

--
-- 限制表 `tbl_paper`
--
ALTER TABLE `tbl_paper`
  ADD CONSTRAINT `tbl_paper_ibfk_1` FOREIGN KEY (`maintainer_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tbl_paper_project_fund`
--
ALTER TABLE `tbl_paper_project_fund`
  ADD CONSTRAINT `tbl_project_people_fund_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_project_people_fund_ibfk_2` FOREIGN KEY (`paper_id`) REFERENCES `tbl_paper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tbl_paper_project_reim`
--
ALTER TABLE `tbl_paper_project_reim`
  ADD CONSTRAINT `tbl_project_people_reim_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_project_people_reim_ibfk_2` FOREIGN KEY (`paper_id`) REFERENCES `tbl_paper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tbl_patent_people`
--
ALTER TABLE `tbl_patent_people`
  ADD CONSTRAINT `tbl_patent_people_ibfk_1` FOREIGN KEY (`patent_id`) REFERENCES `tbl_patent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_patent_people_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tbl_project_people_execute`
--
ALTER TABLE `tbl_project_people_execute`
  ADD CONSTRAINT `tbl_project_people_execute_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_project_people_execute_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tbl_project_people_liability`
--
ALTER TABLE `tbl_project_people_liability`
  ADD CONSTRAINT `tbl_project_people_liability_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_project_people_liability_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
