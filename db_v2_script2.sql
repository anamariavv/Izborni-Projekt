-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 16, 2021 at 03:32 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `internship_id` varchar(64) NOT NULL,
  `company_id` varchar(64) NOT NULL,
  `student_oib` bigint(20) NOT NULL,
  `acceptance` varchar(64) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`internship_id`,`student_oib`,`company_id`),
  KEY `fk_internship_has_student_student1_idx` (`student_oib`),
  KEY `fk_internship_has_student_internship1_idx` (`internship_id`,`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `website` varchar(64) DEFAULT NULL,
  `description` mediumtext,
  `logo` varchar(1024) DEFAULT NULL,
  `field` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `user_level_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_company_user_level1_idx` (`user_level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
CREATE TABLE IF NOT EXISTS `education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_year` int(11) DEFAULT NULL,
  `end_year` int(11) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `country` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `resume_id` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_education_resume1_idx` (`resume_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `internship`
--

DROP TABLE IF EXISTS `internship`;
CREATE TABLE IF NOT EXISTS `internship` (
  `id` varchar(64) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `position` varchar(45) NOT NULL,
  `description` mediumtext,
  `city` varchar(64) NOT NULL,
  `requirements` mediumtext NOT NULL,
  `status` tinytext NOT NULL,
  `salary` int(11) NOT NULL,
  `deadline` date NOT NULL,
  `company_id` varchar(64) NOT NULL,
  PRIMARY KEY (`id`,`company_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_internship_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
CREATE TABLE IF NOT EXISTS `keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL,
  `word` varchar(32) NOT NULL,
  `resume_id` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_keyword_resume_idx` (`resume_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `level` int(11) NOT NULL,
  `resume_id` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_language_resume1_idx` (`resume_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notif_text` mediumtext NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'unread',
  `student_oib` bigint(20) DEFAULT NULL,
  `company_id` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notification_student1_idx` (`student_oib`),
  KEY `fk_notification_company1_idx` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

DROP TABLE IF EXISTS `resume`;
CREATE TABLE IF NOT EXISTS `resume` (
  `id` varchar(64) NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `description` mediumtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(64) NOT NULL DEFAULT 'pending',
  `text` longtext NOT NULL,
  `company_id` varchar(64) NOT NULL,
  `student_oib` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_review_company1_idx` (`company_id`),
  KEY `fk_review_student1_idx` (`student_oib`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `level` int(11) NOT NULL,
  `resume_id` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_skill_resume1_idx` (`resume_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `oib` bigint(20) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `city` varchar(64) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `university` varchar(128) NOT NULL,
  `picture` varchar(1024) DEFAULT NULL,
  `user_level_id` int(11) NOT NULL,
  `password` varchar(64) NOT NULL,
  `resume_id` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`oib`),
  UNIQUE KEY `oib_UNIQUE` (`oib`),
  KEY `fk_student_user_level1_idx` (`user_level_id`),
  KEY `fk_student_resume1_idx` (`resume_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

DROP TABLE IF EXISTS `user_level`;
CREATE TABLE IF NOT EXISTS `user_level` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `type`) VALUES
(1, 'administrator'),
(2, 'student'),
(3, 'company');

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

DROP TABLE IF EXISTS `work_experience`;
CREATE TABLE IF NOT EXISTS `work_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `start_month` varchar(45) DEFAULT NULL,
  `end_month` varchar(45) DEFAULT NULL,
  `start_year` int(11) DEFAULT NULL,
  `end_year` int(11) DEFAULT NULL,
  `description` longtext,
  `resume_id` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_work_experience_resume1_idx` (`resume_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `fk_internship_has_student_internship1` FOREIGN KEY (`internship_id`,`company_id`) REFERENCES `internship` (`id`, `company_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_internship_has_student_student1` FOREIGN KEY (`student_oib`) REFERENCES `student` (`oib`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk_company_user_level1` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `fk_education_resume1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `internship`
--
ALTER TABLE `internship`
  ADD CONSTRAINT `fk_internship_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keyword`
--
ALTER TABLE `keyword`
  ADD CONSTRAINT `fk_keyword_resume1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `language`
--
ALTER TABLE `language`
  ADD CONSTRAINT `fk_language_resume1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_notification_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notification_student1` FOREIGN KEY (`student_oib`) REFERENCES `student` (`oib`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_student1` FOREIGN KEY (`student_oib`) REFERENCES `student` (`oib`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `fk_skill_resume1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_resume1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_user_level1` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD CONSTRAINT `fk_work_experience_resume1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
