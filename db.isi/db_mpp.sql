-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2017 at 08:29 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
`id` int(11) NOT NULL,
  `nik` varchar(25) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `leave_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
`id` int(11) NOT NULL,
  `mpp` double NOT NULL DEFAULT '0',
  `actual` double NOT NULL DEFAULT '0',
  `process_in` double NOT NULL DEFAULT '0',
  `process_out` double NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL,
  `manpower_id` int(11) NOT NULL
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
`id` int(11) NOT NULL,
  `nik` varchar(25) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `join` date DEFAULT NULL,
  `request_id` int(11) NOT NULL
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
`area_id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
`authority_id` int(11) NOT NULL,
  `authority_name` varchar(255) NOT NULL,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
`company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_phone` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_address` tinytext,
  `company_image` tinytext,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tm_company`
--

INSERT INTO `tm_company` (`company_id`, `company_name`, `company_phone`, `company_email`, `company_address`, `company_image`, `last_user`, `last_edited`) VALUES
(1, 'AerofoodACS', '0214307911', 'support@twa.com', 'Jl. Prof. Dr. Soepomo No.45. <br />\r\nTebet - Jaksel', '41.png', 1, '2017-04-20 07:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `tm_department`
--

CREATE TABLE IF NOT EXISTS `tm_department` (
`department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Non Active, 1=Active',
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tm_department`
--

INSERT INTO `tm_department` (`department_id`, `department_name`, `department_status`, `last_user`, `last_edited`) VALUES
(7, 'HOSPITAL', 1, 1, '2017-04-20 07:25:23'),
(8, 'TOWN', 1, 1, '2017-04-20 07:25:32'),
(9, 'HRD', 1, 1, '2017-04-20 07:28:28'),
(10, 'ACCOUNTING', 1, 1, '2017-04-20 07:28:38'),
(11, 'PURCHASING', 1, 1, '2017-04-20 07:28:49'),
(12, 'MARKETING', 1, 1, '2017-04-20 07:28:59'),
(13, 'INFORMATION TEKNOLOGI', 1, 1, '2017-04-20 07:29:35');

-- --------------------------------------------------------

--
-- Table structure for table `tm_position`
--

CREATE TABLE IF NOT EXISTS `tm_position` (
`position_id` int(11) NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `position_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Non Active, 1=Active',
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tm_position`
--

INSERT INTO `tm_position` (`position_id`, `position_name`, `position_status`, `last_user`, `last_edited`) VALUES
(11, 'ADMIN OFFICER', 1, 1, '2017-04-20 10:00:26'),
(12, 'SITE MANAGER', 1, 1, '2017-04-20 09:59:50'),
(13, 'STOREMAN', 1, 1, '2017-04-20 10:00:42'),
(14, 'HEAD ADMINISTRATION', 1, 1, '2017-04-20 10:00:15'),
(15, 'CAPTAIN', 1, 1, '2017-04-20 10:00:56'),
(16, 'WAITER/SS', 1, 1, '2017-04-20 10:01:21'),
(17, 'CHEF', 1, 1, '2017-04-20 10:01:30'),
(18, 'SOUS CHEF', 1, 1, '2017-04-20 10:01:52'),
(19, 'HEAD GIZI', 1, 1, '2017-04-20 10:02:05'),
(20, 'AHLI GIZI', 1, 1, '2017-04-20 10:02:18'),
(21, 'QHSE OFFICER', 1, 1, '2017-04-20 10:02:43'),
(22, 'COOK LEADER', 1, 1, '2017-04-20 10:03:02'),
(23, 'SENIOR COOK', 1, 1, '2017-04-20 10:03:14'),
(24, 'SENIOR PASTRY COOK', 1, 1, '2017-04-20 10:03:33'),
(25, 'JUNIOR COOK', 1, 1, '2017-04-20 10:03:47'),
(26, 'JUNIOR PASTRY COOK', 1, 1, '2017-04-20 10:04:02'),
(27, 'COOK HELPER', 1, 1, '2017-04-20 10:04:43'),
(28, 'STEWARD', 1, 1, '2017-04-20 10:05:02'),
(29, 'TEAM LEADER', 1, 1, '2017-04-20 10:05:23'),
(30, 'OPRATOR CLEANER', 1, 1, '2017-04-20 10:05:50'),
(31, 'OPERATOR GARDENER', 1, 1, '2017-04-20 10:06:16'),
(32, 'DRIVER', 1, 1, '2017-04-20 10:06:35'),
(33, 'COST OFFICER', 1, 1, '2017-04-20 10:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `tm_preference`
--

CREATE TABLE IF NOT EXISTS `tm_preference` (
`preference_id` int(11) NOT NULL,
  `preference_hometittle` varchar(255) DEFAULT NULL,
  `preference_homedescription` text,
  `preference_messagetittle` varchar(255) DEFAULT NULL,
  `preference_messagedescription` text,
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
`unit_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Non Active, 1=Active',
  `last_user` int(11) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tm_unit`
--

INSERT INTO `tm_unit` (`unit_id`, `unit_name`, `unit_status`, `last_user`, `last_edited`) VALUES
(6, 'RS HUSADA', 1, 1, '2017-04-20 10:07:17'),
(7, 'MHT', 1, 1, '2017-04-20 10:07:57'),
(8, 'MHJS', 1, 1, '2017-04-20 10:08:08'),
(9, 'RSPI PURI', 1, 1, '2017-04-20 10:08:43'),
(10, 'RSPI BINTARO', 1, 1, '2017-04-20 10:08:54'),
(11, 'PERTAMEDIKA', 1, 1, '2017-04-20 10:09:01'),
(12, 'RS GRAHA KEDOYA', 1, 1, '2017-04-20 10:09:29'),
(13, 'GITC CANTEEN', 1, 1, '2017-04-20 10:18:14'),
(14, 'ACS CANTEEN', 1, 1, '2017-04-20 10:18:25'),
(15, 'CANDRA ASRI', 1, 1, '2017-04-20 10:18:56'),
(16, 'SMI', 1, 1, '2017-04-20 10:19:01'),
(17, 'MCCI', 1, 1, '2017-04-20 10:19:07'),
(18, 'BSI', 1, 1, '2017-04-20 10:19:13'),
(19, 'AMOCO', 1, 1, '2017-04-20 10:19:20'),
(20, 'BRANCH CILEGON', 1, 1, '2017-04-20 10:19:38'),
(21, 'HEAD OFFICE', 1, 1, '2017-04-20 10:19:53'),
(22, 'NURUL FIKRI', 1, 1, '2017-04-20 10:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `tm_user`
--

CREATE TABLE IF NOT EXISTS `tm_user` (
`user_id` int(11) NOT NULL,
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
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tm_user`
--

INSERT INTO `tm_user` (`user_id`, `user_name`, `user_password`, `user_fullname`, `user_email`, `user_image`, `user_status`, `last_login`, `authority_id`, `area_id`, `last_user`, `last_edited`) VALUES
(1, 'admin', 'admin', 'Administrator', 'ladur.cobain@gmail.com', 'default-avatar-160.png', 1, '2017-04-20 09:18:58', 1, 1, 1, '2017-04-20 07:18:58'),
(2, 'dinie', '123456', 'Dinie Dianie', 'ladur.cobain@gmail.com', NULL, 1, '2016-05-18 09:35:52', 1, 1, 1, '2017-04-09 11:40:45'),
(5, 'sm_facility', '123456', 'SM Facility', 'ladur.cobain@gmail.com', '', 1, '2017-04-09 18:27:59', 2, 2, 1, '2017-04-09 11:27:59'),
(6, 'um_facility', '123456', 'UM Facility', 'ladur.cobain@gmail.com', '', 1, '2017-04-09 18:32:01', 3, 2, 1, '2017-04-09 11:32:01'),
(7, 'rec_facility', '123456', 'REC Facility', 'ladur.cobain@gmail.com', '', 1, '2017-04-09 18:42:36', 6, 2, 1, '2017-04-09 11:42:36'),
(8, 'sm_hospital', '123456', 'SM Hospital', 'ladur.cobain@gmail.com', '', 1, '2017-04-09 17:37:01', 2, 4, 1, '2017-04-09 10:40:11'),
(9, 'um_hospital', '123456', 'UM Hospital', 'ladur.cobain@gmail.com', '', 1, '2017-04-04 06:47:38', 3, 4, 1, '2017-04-09 10:40:13'),
(10, 'rec_hospital', '123456', 'REC Hospital', 'ladur.cobain@gmail.com', '', 1, '2017-03-26 18:49:50', 6, 4, 1, '2017-04-09 10:40:14'),
(11, 'manager_ho', '123456', 'Manager HO', 'ladur.cobain@gmail.com', '', 1, '2017-04-04 06:08:31', 4, 1, 1, '2017-04-09 10:40:16'),
(12, 'emhc_ho', '123456', 'EMHC_HO', 'ladur.cobain@gmail.com', '', 1, '2017-04-23 13:20:38', 5, 1, 1, '2017-04-23 11:20:38'),
(13, 'rec_ho', '123456', 'REC HO', 'ladur.cobain@gmail.com', NULL, 1, '2017-03-15 00:44:27', 6, 1, 1, '2017-04-09 10:40:21'),
(14, 'b.atik', '123456', 'Baitul Atik', 'b.atik@aerofood.co.id', '', 1, NULL, 2, 4, 1, '2017-04-21 02:33:02'),
(15, 'e.afianto', '123456', 'Eko Afianto', 'e.afianto@aerofood.co.id', '', 1, NULL, 2, 4, 1, '2017-04-21 02:40:37'),
(16, 'r.hakim', '123456', 'Ridwan Hakim', 'r.hakim@aerofood.co.id', '', 1, NULL, 2, 4, 1, '2017-04-21 02:41:54'),
(17, 't.widodo', '123456', 'Tri Widodo', 't.widodo@aerofood.co.id', '', 1, NULL, 2, 4, 1, '2017-04-21 02:42:44'),
(18, 'f.ade', '123456', 'Franky Ade Wandra', 'f.ade@aerofood.co.id', '', 1, NULL, 2, 3, 1, '2017-04-21 02:44:55'),
(19, 'h.ambarwati', '123456', 'Hany Ambarwati', 'h.ambarwati@aerofood.co.id', '', 1, NULL, 2, 4, 1, '2017-04-21 02:45:56'),
(20, 'mr.efendi', '123456', 'Mujibur Rohman Efendi', 'mr.efendi@aerofood.co.id', '', 1, NULL, 2, 3, 1, '2017-04-21 02:46:52'),
(21, '-t.cornelis', '123456', 'Teguh Cornelis', 't.cornelis@aerofood.co.id', '', 1, NULL, 2, 3, 1, '2017-04-21 02:47:52'),
(22, 'd.setiadarma', '123456', 'Deni Setia Darma', 'd.setiadarma@aerofood.co.id', '', 1, NULL, 2, 3, 1, '2017-04-21 02:48:54'),
(23, 'c.permadi', '123456', 'Canra Permadi', 'c.permadi@aerofood.co.id', '', 1, NULL, 2, 3, 1, '2017-04-21 03:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `tp_leave`
--

CREATE TABLE IF NOT EXISTS `tp_leave` (
`leave_id` int(11) NOT NULL,
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
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
`manpower_id` int(11) NOT NULL,
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
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
`request_id` int(11) NOT NULL,
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
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tp_request`
--

INSERT INTO `tp_request` (`request_id`, `request_code`, `request_overdue`, `request_date`, `request_time`, `request_count`, `request_description`, `request_status`, `prepared_id`, `approval1_date`, `approval1_time`, `approval1_description`, `approval1_id`, `approval2_date`, `approval2_time`, `approval2_description`, `approval2_id`, `recruitment_date`, `recruitment_time`, `recruitment_description`, `recruitment_id`, `closed_date`, `closed_time`, `closed_description`, `closed_id`, `mpp_id`, `area_id`, `last_user`, `last_edited`) VALUES
(10, 'RQT1704001', '2017-04-04', '2017-04-04', '06:39:56', 3, 'Minta 3', 7, 8, '2017-04-04', '06:42:53', 'Setuju', 9, '2017-04-04', '06:44:14', 'Boleh lah', 12, '2017-04-04', '06:49:05', 'NIh', 10, '2017-04-04', '06:49:24', 'Closed', 8, 18, 4, 0, '2017-04-03 23:49:24'),
(11, 'RQT1704002', '2017-04-09', '2017-04-09', '18:23:27', 1, 'Minta 1', 5, 5, '2017-04-09', '18:31:50', 'setujui 1', 6, '2017-04-09', '18:40:25', 'setuju ok', 12, '2017-04-09', '18:42:20', 'nih', 7, '2017-04-09', '18:44:46', 'Closed', 5, 20, 2, 0, '2017-04-09 11:55:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_leave`
--
ALTER TABLE `td_leave`
 ADD PRIMARY KEY (`id`), ADD KEY `leave_id` (`leave_id`);

--
-- Indexes for table `td_manpower`
--
ALTER TABLE `td_manpower`
 ADD PRIMARY KEY (`id`), ADD KEY `manpower_id` (`manpower_id`), ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `td_request`
--
ALTER TABLE `td_request`
 ADD PRIMARY KEY (`id`), ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `tm_area`
--
ALTER TABLE `tm_area`
 ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `tm_authority`
--
ALTER TABLE `tm_authority`
 ADD PRIMARY KEY (`authority_id`);

--
-- Indexes for table `tm_company`
--
ALTER TABLE `tm_company`
 ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tm_department`
--
ALTER TABLE `tm_department`
 ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tm_position`
--
ALTER TABLE `tm_position`
 ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `tm_preference`
--
ALTER TABLE `tm_preference`
 ADD PRIMARY KEY (`preference_id`);

--
-- Indexes for table `tm_unit`
--
ALTER TABLE `tm_unit`
 ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `tm_user`
--
ALTER TABLE `tm_user`
 ADD PRIMARY KEY (`user_id`), ADD KEY `authority_id` (`authority_id`), ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `tp_leave`
--
ALTER TABLE `tp_leave`
 ADD PRIMARY KEY (`leave_id`), ADD KEY `prepared_id` (`prepared_id`), ADD KEY `approval1_id` (`approval_id`), ADD KEY `mpp_id` (`mpp_id`), ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `tp_manpower`
--
ALTER TABLE `tp_manpower`
 ADD PRIMARY KEY (`manpower_id`), ADD KEY `area_id` (`area_id`), ADD KEY `department_id` (`department_id`), ADD KEY `unit_id` (`unit_id`), ADD KEY `prepared_id` (`prepared_id`), ADD KEY `approval1_id` (`approval_id`);

--
-- Indexes for table `tp_request`
--
ALTER TABLE `tp_request`
 ADD PRIMARY KEY (`request_id`), ADD KEY `prepared_id` (`prepared_id`), ADD KEY `approval1_id` (`approval1_id`,`approval2_id`,`recruitment_id`), ADD KEY `approval2_id` (`approval2_id`), ADD KEY `recruitment_id` (`recruitment_id`), ADD KEY `mpp_id` (`mpp_id`), ADD KEY `area_id` (`area_id`), ADD KEY `closed_id` (`closed_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `td_leave`
--
ALTER TABLE `td_leave`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `td_manpower`
--
ALTER TABLE `td_manpower`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `td_request`
--
ALTER TABLE `td_request`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tm_area`
--
ALTER TABLE `tm_area`
MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tm_authority`
--
ALTER TABLE `tm_authority`
MODIFY `authority_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tm_company`
--
ALTER TABLE `tm_company`
MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tm_department`
--
ALTER TABLE `tm_department`
MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tm_position`
--
ALTER TABLE `tm_position`
MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tm_preference`
--
ALTER TABLE `tm_preference`
MODIFY `preference_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tm_unit`
--
ALTER TABLE `tm_unit`
MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tm_user`
--
ALTER TABLE `tm_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tp_leave`
--
ALTER TABLE `tp_leave`
MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tp_manpower`
--
ALTER TABLE `tp_manpower`
MODIFY `manpower_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tp_request`
--
ALTER TABLE `tp_request`
MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
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
