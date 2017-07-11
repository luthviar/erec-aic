-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2017 at 07:07 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_mpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `td_leave`
--

CREATE TABLE IF NOT EXISTS `td_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(25) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `leave_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_id` (`leave_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `td_leave`
--

INSERT INTO `td_leave` (`id`, `nik`, `name`, `leave_id`) VALUES
(17, '9090909', 'Jonathan', 13);

-- --------------------------------------------------------

--
-- Table structure for table `td_manpower`
--

CREATE TABLE IF NOT EXISTS `td_manpower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mpp` double NOT NULL DEFAULT '0',
  `actual` double NOT NULL DEFAULT '0',
  `process_in` double NOT NULL DEFAULT '0',
  `process_out` double NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL,
  `manpower_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `manpower_id` (`manpower_id`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `td_manpower`
--

INSERT INTO `td_manpower` (`id`, `mpp`, `actual`, `process_in`, `process_out`, `position_id`, `manpower_id`) VALUES
(18, 5, 4, -9, 0, 11, 9),
(19, 4, 2, 0, 0, 11, 11),
(20, 4, 6, -3, 0, 12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `td_request`
--

CREATE TABLE IF NOT EXISTS `td_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(25) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `join` date DEFAULT NULL,
  `request_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `td_request`
--

INSERT INTO `td_request` (`id`, `nik`, `name`, `join`, `request_id`) VALUES
(16, '90901', 'Jajang', '2017-04-04', 10),
(17, '90902', 'Hermanto', '2017-04-04', 10),
(18, '90904', 'Yuyun S', '2017-04-04', 10),
(19, NULL, NULL, '2017-04-09', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tm_area`
--

CREATE TABLE IF NOT EXISTS `tm_area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) NOT NULL,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tm_area`
--

INSERT INTO `tm_area` (`area_id`, `area_name`, `last_user`, `last_edited`) VALUES
(1, 'HO', 1, '2017-03-02 17:00:00'),
(2, 'FACILITY', 1, '2017-03-02 17:00:00'),
(3, 'TOWN', 1, '2017-03-02 17:00:00'),
(4, 'HOSPITAL', 1, '2017-03-02 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tm_authority`
--

CREATE TABLE IF NOT EXISTS `tm_authority` (
  `authority_id` int(11) NOT NULL AUTO_INCREMENT,
  `authority_name` varchar(255) NOT NULL,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`authority_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tm_authority`
--

INSERT INTO `tm_authority` (`authority_id`, `authority_name`, `last_user`, `last_edited`) VALUES
(1, 'Administrator', 1, '2017-02-26 17:53:20'),
(2, 'SM', 1, '2017-03-03 07:58:45'),
(3, 'UM', 1, '2017-03-03 07:58:55'),
(4, 'MANAGER', 1, '2017-03-03 07:59:09'),
(5, 'EMHC', 1, '2017-03-03 07:59:28'),
(6, 'RECRUITMENT', 1, '2017-03-03 07:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `tm_company`
--

CREATE TABLE IF NOT EXISTS `tm_company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `company_phone` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_address` tinytext,
  `company_image` tinytext,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tm_company`
--

INSERT INTO `tm_company` (`company_id`, `company_name`, `company_phone`, `company_email`, `company_address`, `company_image`, `last_user`, `last_edited`) VALUES
(1, 'TERBANG KE PERTH', '0214307911', 'support@twa.com', 'Jl. Prof. Dr. Soepomo No.45. <br />\r\nTebet - Jaksel', '41.png', 1, '2017-02-26 18:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `tm_department`
--

CREATE TABLE IF NOT EXISTS `tm_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `department_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Non Active, 1=Active',
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tm_department`
--

INSERT INTO `tm_department` (`department_id`, `department_name`, `department_status`, `last_user`, `last_edited`) VALUES
(7, 'HRD', 1, 1, '2017-03-19 20:07:12'),
(8, 'Finance', 1, 1, '2017-03-19 20:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `tm_position`
--

CREATE TABLE IF NOT EXISTS `tm_position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(255) NOT NULL,
  `position_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Non Active, 1=Active',
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tm_position`
--

INSERT INTO `tm_position` (`position_id`, `position_name`, `position_status`, `last_user`, `last_edited`) VALUES
(11, 'Senior GA', 1, 1, '2017-03-19 20:07:38'),
(12, 'Junior GA', 1, 1, '2017-03-19 20:07:38'),
(13, 'Senior Tax', 1, 1, '2017-03-19 20:08:00'),
(14, 'Junior Tax', 1, 1, '2017-03-19 20:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `tm_preference`
--

CREATE TABLE IF NOT EXISTS `tm_preference` (
  `preference_id` int(11) NOT NULL AUTO_INCREMENT,
  `preference_hometittle` varchar(255) DEFAULT NULL,
  `preference_homedescription` text,
  `preference_messagetittle` varchar(255) DEFAULT NULL,
  `preference_messagedescription` text,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`preference_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tm_preference`
--

INSERT INTO `tm_preference` (`preference_id`, `preference_hometittle`, `preference_homedescription`, `preference_messagetittle`, `preference_messagedescription`, `last_user`, `last_edited`) VALUES
(1, 'Content Management System', 'Website ini merupakan website internal dan digunakan untuk tujuan / kegiatan / keperluan internal Perusahaan, dan kandungan konten yang ada di dalamnya hanya ditujukan oleh orang, dan atau kelompok tertentu yang telah terundang untuk mengunjungi website ini, apabila Anda tidak sengaja membuka atau sebelumnya telah ter-buka di gadget/desktop view Anda, kami mohon silakan Anda tutup halaman web ini.', 'Cara Pengunaan Situs', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices sapien vel felis mattis mollis. Duis scelerisque tellus sit amet vestibulum rhoncus. Maecenas varius blandit orci, quis fermentum justo bibendum quis. Cras lacinia lorem ut lectus porta interdum. Etiam sit amet lorem felis. Quisque varius arcu ex, non consequat sapien pharetra et. Donec quis ex eget sem posuere pretium sed ut nulla. Nunc porta sapien vitae nisl scelerisque dapibus. Sed cursus eget felis a cursus. Vestibulum a dapibus ante, eget pharetra eros. Nulla luctus purus ac laoreet pulvinar. Quisque ut urna eget felis condimentum dignissim at nec velit. Morbi et ex at neque pulvinar auctor. Sed semper, est sed posuere condimentum, justo magna volutpat est, eu ornare metus neque in velit. Vivamus pellentesque arcu sed erat varius, non feugiat justo dapibus. Integer bibendum rhoncus diam, a mollis nibh convallis non.', 1, '2017-01-08 21:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `tm_unit`
--

CREATE TABLE IF NOT EXISTS `tm_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) NOT NULL,
  `unit_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Non Active, 1=Active',
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tm_unit`
--

INSERT INTO `tm_unit` (`unit_id`, `unit_name`, `unit_status`, `last_user`, `last_edited`) VALUES
(6, 'RS Siloam', 1, 1, '2017-03-19 20:08:24'),
(7, 'RS Tarakan', 1, 1, '2017-03-19 20:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `tm_user`
--

CREATE TABLE IF NOT EXISTS `tm_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) NOT NULL,
  `user_password` varchar(25) NOT NULL,
  `user_fullname` varchar(50) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` tinytext,
  `user_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Non Active, 1=Active',
  `last_login` datetime DEFAULT NULL,
  `authority_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `authority_id` (`authority_id`),
  KEY `area_id` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tm_user`
--

INSERT INTO `tm_user` (`user_id`, `user_name`, `user_password`, `user_fullname`, `user_email`, `user_image`, `user_status`, `last_login`, `authority_id`, `area_id`, `last_user`, `last_edited`) VALUES
(1, 'admin', 'admin', 'Administrator', 'ladur.cobain@gmail.com', 'default-avatar-160.png', 1, '2017-04-09 17:43:24', 1, 1, 1, '2017-04-09 10:43:24'),
(2, 'dinie', '123456', 'Dinie Dianie', 'ladur.cobain@gmail.com', NULL, 1, '2016-05-18 09:35:52', 1, 1, 1, '2017-04-09 11:40:45'),
(5, 'sm_facility', '123456', 'SM Facility', 'ladur.cobain@gmail.com', '', 1, '2017-04-09 18:27:59', 2, 2, 1, '2017-04-09 11:27:59'),
(6, 'um_facility', '123456', 'UM Facility', 'ladur.cobain@gmail.com', '', 1, '2017-04-09 18:32:01', 3, 2, 1, '2017-04-09 11:32:01'),
(7, 'rec_facility', '123456', 'REC Facility', 'ladur.cobain@gmail.com', '', 1, '2017-04-09 18:42:36', 6, 2, 1, '2017-04-09 11:42:36'),
(8, 'sm_hospital', '123456', 'SM Hospital', 'ladur.cobain@gmail.com', '', 1, '2017-04-09 17:37:01', 2, 4, 1, '2017-04-09 10:40:11'),
(9, 'um_hospital', '123456', 'UM Hospital', 'ladur.cobain@gmail.com', '', 1, '2017-04-04 06:47:38', 3, 4, 1, '2017-04-09 10:40:13'),
(10, 'rec_hospital', '123456', 'REC Hospital', 'ladur.cobain@gmail.com', '', 1, '2017-03-26 18:49:50', 6, 4, 1, '2017-04-09 10:40:14'),
(11, 'manager_ho', '123456', 'Manager HO', 'ladur.cobain@gmail.com', '', 1, '2017-04-04 06:08:31', 4, 1, 1, '2017-04-09 10:40:16'),
(12, 'emhc_ho', '123456', 'EMHC_HO', 'ladur.cobain@gmail.com', '', 1, '2017-04-09 18:41:05', 5, 1, 1, '2017-04-09 11:41:05'),
(13, 'rec_ho', '123456', 'REC HO', 'ladur.cobain@gmail.com', NULL, 1, '2017-03-15 00:44:27', 6, 1, 1, '2017-04-09 10:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `tp_leave`
--

CREATE TABLE IF NOT EXISTS `tp_leave` (
  `leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_code` varchar(10) NOT NULL,
  `leave_date` date NOT NULL,
  `leave_time` time NOT NULL,
  `leave_count` double NOT NULL DEFAULT '0',
  `leave_description` tinytext,
  `leave_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Confirmation, 1=Approved, 2=Rejected, 3=Approval 1, 4=Approval 2, 5=Approval Recruitment, 6=Canceled, 7=Closed, 8=Finished, 9=On Progress',
  `prepared_id` int(11) NOT NULL,
  `approval_date` date DEFAULT NULL,
  `approval_time` time DEFAULT NULL,
  `approval_description` tinytext,
  `approval_id` int(11) DEFAULT NULL,
  `mpp_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`leave_id`),
  KEY `prepared_id` (`prepared_id`),
  KEY `approval1_id` (`approval_id`),
  KEY `mpp_id` (`mpp_id`),
  KEY `area_id` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tp_leave`
--

INSERT INTO `tp_leave` (`leave_id`, `leave_code`, `leave_date`, `leave_time`, `leave_count`, `leave_description`, `leave_status`, `prepared_id`, `approval_date`, `approval_time`, `approval_description`, `approval_id`, `mpp_id`, `area_id`, `last_user`, `last_edited`) VALUES
(13, 'OUT1704001', '2017-04-04', '06:10:46', 1, 'Leave 1', 7, 8, '2017-04-04', '06:37:09', 'Ok', 9, 18, 4, 8, '2017-04-03 23:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `tp_manpower`
--

CREATE TABLE IF NOT EXISTS `tp_manpower` (
  `manpower_id` int(11) NOT NULL AUTO_INCREMENT,
  `manpower_date` date NOT NULL,
  `manpower_time` time NOT NULL,
  `manpower_description` tinytext,
  `manpower_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Non Active, 1=Active',
  `area_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `prepared_id` int(11) NOT NULL,
  `approval_date` date DEFAULT NULL,
  `approval_time` time DEFAULT NULL,
  `approval_description` tinytext,
  `approval_id` int(11) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Confirmation, 1=Approved, 2=Rejected, 3=Approval 1, 4=Approval 2, 5=Approval Recruitment, 6=Canceled, 7=Closed, 8=Finished, 9=On Progress',
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`manpower_id`),
  KEY `area_id` (`area_id`),
  KEY `department_id` (`department_id`),
  KEY `unit_id` (`unit_id`),
  KEY `prepared_id` (`prepared_id`),
  KEY `approval1_id` (`approval_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tp_manpower`
--

INSERT INTO `tp_manpower` (`manpower_id`, `manpower_date`, `manpower_time`, `manpower_description`, `manpower_status`, `area_id`, `department_id`, `unit_id`, `prepared_id`, `approval_date`, `approval_time`, `approval_description`, `approval_id`, `is_approved`, `last_user`, `last_edited`) VALUES
(9, '2017-04-04', '05:00:14', 'Hospital - Fin. RS Siloam', 1, 4, 8, 6, 12, '2017-04-04', '05:52:31', 'Silahkan', 8, 1, 12, '2017-04-03 23:07:37'),
(11, '2017-04-04', '05:55:38', 'HO - HRD', 1, 1, 7, 6, 12, '2017-04-04', '06:06:38', 'Sudah di proses', 11, 1, 12, '2017-04-03 23:07:35'),
(12, '2017-04-09', '17:37:24', NULL, 1, 2, 8, 6, 12, '2017-04-09', '18:01:01', 'Okelah', 5, 1, 12, '2017-04-09 11:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `tp_request`
--

CREATE TABLE IF NOT EXISTS `tp_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_code` varchar(10) NOT NULL,
  `request_overdue` date NOT NULL,
  `request_date` date NOT NULL,
  `request_time` time NOT NULL,
  `request_count` double NOT NULL DEFAULT '0',
  `request_description` tinytext,
  `request_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Confirmation, 1=Approved, 2=Rejected, 3=Approval 1, 4=Approval 2, 5=Approval Recruitment, 6=Canceled, 7=Closed, 8=Processing, 9=On Progress',
  `prepared_id` int(11) NOT NULL,
  `approval1_date` date DEFAULT NULL,
  `approval1_time` time DEFAULT NULL,
  `approval1_description` tinytext,
  `approval1_id` int(11) DEFAULT NULL,
  `approval2_date` date DEFAULT NULL,
  `approval2_time` time DEFAULT NULL,
  `approval2_description` tinytext,
  `approval2_id` int(11) DEFAULT NULL,
  `recruitment_date` date DEFAULT NULL,
  `recruitment_time` time DEFAULT NULL,
  `recruitment_description` tinytext,
  `recruitment_id` int(11) DEFAULT NULL,
  `closed_date` date DEFAULT NULL,
  `closed_time` time DEFAULT NULL,
  `closed_description` tinytext,
  `closed_id` int(11) DEFAULT NULL,
  `mpp_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`request_id`),
  KEY `prepared_id` (`prepared_id`),
  KEY `approval1_id` (`approval1_id`,`approval2_id`,`recruitment_id`),
  KEY `approval2_id` (`approval2_id`),
  KEY `recruitment_id` (`recruitment_id`),
  KEY `mpp_id` (`mpp_id`),
  KEY `area_id` (`area_id`),
  KEY `closed_id` (`closed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tp_request`
--

INSERT INTO `tp_request` (`request_id`, `request_code`, `request_overdue`, `request_date`, `request_time`, `request_count`, `request_description`, `request_status`, `prepared_id`, `approval1_date`, `approval1_time`, `approval1_description`, `approval1_id`, `approval2_date`, `approval2_time`, `approval2_description`, `approval2_id`, `recruitment_date`, `recruitment_time`, `recruitment_description`, `recruitment_id`, `closed_date`, `closed_time`, `closed_description`, `closed_id`, `mpp_id`, `area_id`, `last_user`, `last_edited`) VALUES
(10, 'RQT1704001', '2017-04-04', '2017-04-04', '06:39:56', 3, 'Minta 3', 7, 8, '2017-04-04', '06:42:53', 'Setuju', 9, '2017-04-04', '06:44:14', 'Boleh lah', 12, '2017-04-04', '06:49:05', 'NIh', 10, '2017-04-04', '06:49:24', 'Closed', 8, 18, 4, 0, '2017-04-03 23:49:24'),
(11, 'RQT1704002', '2017-04-09', '2017-04-09', '18:23:27', 1, 'Minta 1', 5, 5, '2017-04-09', '18:31:50', 'setujui 1', 6, '2017-04-09', '18:40:25', 'setuju ok', 12, '2017-04-09', '18:42:20', 'nih', 7, '2017-04-09', '18:44:46', 'Closed', 5, 20, 2, 0, '2017-04-09 11:55:27');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `td_leave`
--
ALTER TABLE `td_leave`
  ADD CONSTRAINT `td_leave_ibfk_1` FOREIGN KEY (`leave_id`) REFERENCES `tp_leave` (`leave_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `td_manpower`
--
ALTER TABLE `td_manpower`
  ADD CONSTRAINT `td_manpower_ibfk_1` FOREIGN KEY (`manpower_id`) REFERENCES `tp_manpower` (`manpower_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `td_manpower_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `tm_position` (`position_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `td_request`
--
ALTER TABLE `td_request`
  ADD CONSTRAINT `td_request_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `tp_request` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tm_user`
--
ALTER TABLE `tm_user`
  ADD CONSTRAINT `tm_user_ibfk_1` FOREIGN KEY (`authority_id`) REFERENCES `tm_authority` (`authority_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_user_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `tm_area` (`area_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tp_leave`
--
ALTER TABLE `tp_leave`
  ADD CONSTRAINT `tp_leave_ibfk_1` FOREIGN KEY (`prepared_id`) REFERENCES `tm_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_leave_ibfk_5` FOREIGN KEY (`mpp_id`) REFERENCES `td_manpower` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_leave_ibfk_6` FOREIGN KEY (`area_id`) REFERENCES `tm_area` (`area_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_leave_ibfk_7` FOREIGN KEY (`approval_id`) REFERENCES `tm_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tp_manpower`
--
ALTER TABLE `tp_manpower`
  ADD CONSTRAINT `tp_manpower_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `tm_area` (`area_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_manpower_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `tm_department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_manpower_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `tm_unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_manpower_ibfk_7` FOREIGN KEY (`prepared_id`) REFERENCES `tm_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_manpower_ibfk_8` FOREIGN KEY (`approval_id`) REFERENCES `tm_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tp_request`
--
ALTER TABLE `tp_request`
  ADD CONSTRAINT `tp_request_ibfk_1` FOREIGN KEY (`prepared_id`) REFERENCES `tm_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_request_ibfk_2` FOREIGN KEY (`approval1_id`) REFERENCES `tm_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_request_ibfk_3` FOREIGN KEY (`approval2_id`) REFERENCES `tm_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_request_ibfk_4` FOREIGN KEY (`recruitment_id`) REFERENCES `tm_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_request_ibfk_5` FOREIGN KEY (`mpp_id`) REFERENCES `td_manpower` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_request_ibfk_6` FOREIGN KEY (`area_id`) REFERENCES `tm_area` (`area_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_request_ibfk_7` FOREIGN KEY (`closed_id`) REFERENCES `tm_user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
