-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2022 at 06:17 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesspoint`
--

CREATE TABLE `accesspoint` (
  `accesspoint_id` int(10) UNSIGNED NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `division_id` varchar(30) DEFAULT NULL,
  `department_id` varchar(30) DEFAULT NULL COMMENT 'Designation Name',
  `accesspoint_type` varchar(100) DEFAULT NULL COMMENT 'Description',
  `accesspoint_name` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(60) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `accesspoint`
--

INSERT INTO `accesspoint` (`accesspoint_id`, `lead_id`, `division_id`, `department_id`, `accesspoint_type`, `accesspoint_name`, `status`, `created_by`, `created_date`, `modified_date`) VALUES
(1, '2', '8', 'No Department', 'Main Access', 'D Gate', 1, '2', '2021-05-05 10:23:47', '2021-05-05 10:23:47'),
(2, '2', '4', '4', 'Department Access', 'Room 405', 1, '2', '2021-05-05 11:45:40', '2021-05-05 11:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('641sihpu9kpql2eg8hqnraj2ps1i3i9s', '::1', 1632071437, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633323037313433373b757365725f646174617c613a31343a7b733a373a22757365725f6964223b733a313a2233223b733a373a226c6561645f6964223b733a313a2232223b733a343a22636f6465223b733a31303a22495354454d3030303033223b733a373a22726f6c655f6964223b733a313a2235223b733a343a22726f6c65223b733a383a22456d706c6f796565223b733a31303a2266697273745f6e616d65223b733a383a224b6172746869636b223b733a393a226c6173745f6e616d65223b733a313a2252223b733a393a22757365725f6e616d65223b733a31303a224b6172746869636b2052223b733a353a22656d61696c223b733a32303a226b6172746869636b7240696973632e61632e696e223b733a353a2270686f6e65223b733a31303a2239383736353433323130223b733a383a2270617373636f6465223b733a3132383a226635616433656635323963626632666363666130643731656466663233653536393263666238633566613061313261633735633930663562623764343962303238323966353538393535353461333033646363633938366432333164616465636363383237386562343733653230626634633331616436353734396235653038223b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323032312d30342d31312032333a34343a3338223b733a31333a226d6f6469666965645f64617465223b733a31393a22323032312d30392d30352031353a31333a3431223b7d),
('8ghgh02ildbujeb7574q782vrpmi17ji', '::1', 1631980296, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313938303239363b),
('a11mjme9ll39snvcpg3g7chl7kjupot7', '::1', 1632065245, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633323036353234353b),
('aus0k0bjiq51gqjlot7i8bs7kmr55vd2', '::1', 1631000616, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313030303539373b757365725f646174617c613a31343a7b733a373a22757365725f6964223b733a313a2231223b733a373a226c6561645f6964223b733a313a2232223b733a343a22636f6465223b733a31303a22495354454d3030303031223b733a373a22726f6c655f6964223b733a313a2233223b733a343a22726f6c65223b733a31353a2250726f6a656374204d616e61676572223b733a31303a2266697273745f6e616d65223b733a373a2253616e6a656576223b733a393a226c6173745f6e616d65223b733a353a224b756d6172223b733a393a22757365725f6e616d65223b733a31333a2253616e6a656576204b756d6172223b733a353a22656d61696c223b733a31373a2273616e6a65657640676d61696c2e636f6d223b733a353a2270686f6e65223b733a31303a2239383736353433323130223b733a383a2270617373636f6465223b733a3132383a226635616433656635323963626632666363666130643731656466663233653536393263666238633566613061313261633735633930663562623764343962303238323966353538393535353461333033646363633938366432333164616465636363383237386562343733653230626634633331616436353734396235653038223b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323032312d30342d31312032333a34343a3338223b733a31333a226d6f6469666965645f64617465223b733a31393a22323032312d30392d30352031353a31333a3433223b7d),
('gvcmgem2d4jb2l21on6kntb2lv83dbl1', '::1', 1631534772, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313533343737323b),
('h6m3okt8goq60u9b2v93hdm2m70ai28u', '::1', 1631985414, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313938353431343b),
('hverpsb77t5rbh6ugbjusonppa20df5u', '::1', 1631982700, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313938323639393b),
('j49gvq75epbrqmselnlvtcctuebihi02', '::1', 1632154051, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633323135333831323b),
('m4o5srs6fjgn4v1ntce4f772epo0adrd', '::1', 1631986256, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313938363038303b),
('s96fot9hr5gr71fbqe2kg7g00d08ipmt', '::1', 1631000492, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313030303337303b757365725f646174617c613a31343a7b733a373a22757365725f6964223b733a313a2233223b733a373a226c6561645f6964223b733a313a2232223b733a343a22636f6465223b733a31303a22495354454d3030303033223b733a373a22726f6c655f6964223b733a313a2235223b733a343a22726f6c65223b733a383a22456d706c6f796565223b733a31303a2266697273745f6e616d65223b733a383a224b6172746869636b223b733a393a226c6173745f6e616d65223b733a313a2252223b733a393a22757365725f6e616d65223b733a31303a224b6172746869636b2052223b733a353a22656d61696c223b733a32303a226b6172746869636b7240696973632e61632e696e223b733a353a2270686f6e65223b733a31303a2239383736353433323130223b733a383a2270617373636f6465223b733a3132383a226635616433656635323963626632666363666130643731656466663233653536393263666238633566613061313261633735633930663562623764343962303238323966353538393535353461333033646363633938366432333164616465636363383237386562343733653230626634633331616436353734396235653038223b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323032312d30342d31312032333a34343a3338223b733a31333a226d6f6469666965645f64617465223b733a31393a22323032312d30392d30352031353a31333a3431223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(10) UNSIGNED NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `division_id` varchar(30) DEFAULT NULL,
  `department` varchar(250) DEFAULT NULL COMMENT 'Name of entity like Super Admin, Nodal Agency/Institute etc',
  `department_prefix` varchar(60) DEFAULT NULL,
  `department_brief` text DEFAULT NULL COMMENT 'Description',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(60) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `lead_id`, `division_id`, `department`, `department_prefix`, `department_brief`, `status`, `created_by`, `created_date`, `modified_date`) VALUES
(1, '2', '4', 'Centre for Infrastructure, Sustainable Transportation and Urban Planning (CiSTUP)', 'CiSTUP', NULL, 1, '2', '2021-05-04 10:12:58', '2021-05-04 10:55:46'),
(2, '2', '4', 'Centre for Biosystems Science and Engineering (BSSE)', 'BSSE', NULL, 1, '2', '2021-05-04 11:05:57', '2021-05-04 11:05:57'),
(3, '2', '4', 'Centre for Society and Policy (CSP)', 'CSP', NULL, 1, '2', '2021-05-04 11:06:11', '2021-05-04 11:06:11'),
(4, '2', '4', 'Centre for Nano Science and Engineering (CeNSE)', 'CeNSE', NULL, 1, '2', '2021-05-04 11:06:23', '2021-05-04 11:06:23'),
(5, '2', '4', 'Department of Computational and Data Sciences (CDS)', 'CDS', NULL, 1, '2', '2021-05-04 11:06:35', '2021-05-04 11:06:35'),
(6, '2', '4', 'Department of Management Studies (MS)', 'MS', NULL, 1, '2', '2021-05-04 11:06:52', '2021-05-04 11:06:52'),
(7, '2', '4', 'Interdisciplinary Centre for Energy Research (ICER)', 'ICER', NULL, 1, '2', '2021-05-04 11:07:18', '2021-05-04 11:07:18'),
(8, '2', '4', 'Interdisciplinary mathematical sciences', 'IMS', NULL, 1, '2', '2021-05-04 11:07:32', '2021-05-04 11:07:32'),
(9, '2', '4', 'Interdisciplinary Centre for Water Research (ICWaR)', 'ICWaR', NULL, 1, '2', '2021-05-04 11:07:47', '2021-05-04 11:07:47'),
(10, '2', '4', 'Robert Bosch Centre for Cyber Physical Systems (RBCCPS)', 'RBCCPS', NULL, 1, '2', '2021-05-04 11:07:59', '2021-05-04 11:07:59'),
(11, '2', '4', 'Supercomputer Education and Research Centre (SERC)', 'SERC', NULL, 1, '2', '2021-05-04 11:08:12', '2021-05-04 11:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(10) UNSIGNED NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `division_id` varchar(30) DEFAULT NULL,
  `department_id` varchar(100) DEFAULT NULL COMMENT 'Designation Name',
  `designation` varchar(100) DEFAULT NULL COMMENT 'Description',
  `designation_prefix` varchar(60) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(60) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `lead_id`, `division_id`, `department_id`, `designation`, `designation_prefix`, `status`, `created_by`, `created_date`, `modified_date`) VALUES
(1, '2', '4', '4', 'Sample Designation', 'SD', 1, '2', '2021-05-05 06:10:19', '2021-05-05 06:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `division_id` int(10) UNSIGNED NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `division` varchar(360) DEFAULT NULL COMMENT 'Division Name',
  `division_prefix` varchar(60) DEFAULT NULL,
  `division_brief` text DEFAULT NULL COMMENT 'Description',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(60) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`division_id`, `lead_id`, `division`, `division_prefix`, `division_brief`, `status`, `created_by`, `created_date`, `modified_date`) VALUES
(1, '2', 'Division of Biological Sciences', 'DBS', NULL, 1, NULL, '2021-05-04 05:32:54', '2021-05-04 05:33:24'),
(2, '2', 'Division of Chemical Sciences', 'DCS', NULL, 1, NULL, '2021-05-04 05:32:57', '2021-05-04 05:33:53'),
(3, '2', 'Division of Electrical, Electronics, and Computer Science (EECS)', 'DEECS', NULL, 1, '2', '2021-05-04 05:33:00', '2021-05-04 05:51:39'),
(4, '2', 'Division of Interdisciplinary Sciences', 'DIS', NULL, 1, NULL, '2021-05-04 05:33:03', '2021-05-04 05:34:22'),
(5, '2', 'Division of Mechanical Sciences', 'DMS', NULL, 1, NULL, '2021-05-04 05:33:05', '2021-05-04 05:34:33'),
(6, '2', 'Division of Physical and Mathematical Sciences', 'DPMS', NULL, 1, NULL, '2021-05-04 05:33:07', '2021-05-04 05:34:51'),
(7, '2', 'Centres under the Director', 'CUD', NULL, 1, NULL, '2021-05-04 05:33:11', '2021-05-04 05:35:07'),
(8, '2', 'Autonomous Societies / Centres', 'ASC', NULL, 1, '2', '2021-05-04 05:33:11', '2021-05-04 05:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `istem_user_roles`
--

CREATE TABLE `istem_user_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `roles` varchar(45) NOT NULL DEFAULT '' COMMENT 'Name of entity like Super Admin, Nodal Agency/Institute etc',
  `roles_to` varchar(60) DEFAULT NULL,
  `roles_prefix` varchar(45) NOT NULL DEFAULT '' COMMENT 'Short Code for Entity',
  `role_brief` varchar(100) NOT NULL DEFAULT '' COMMENT 'Description',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(60) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `istem_user_roles`
--

INSERT INTO `istem_user_roles` (`role_id`, `roles`, `roles_to`, `roles_prefix`, `role_brief`, `status`, `created_by`, `created_date`, `modified_date`) VALUES
(1, 'ISTEM', 'Self', 'IS', 'Super Admin Entity for Overall Administration/Control', 1, NULL, NULL, '2021-04-21 09:15:50'),
(2, 'REGIONAL CENTRE', 'Self', 'ND', 'Nodal Agencies to Control/Monitor ISTEM', 1, NULL, NULL, '2021-04-21 09:15:52'),
(3, 'INSTITUTE', 'Institution', 'IN', 'Institue which is the provider of Equipments/facilities', 1, NULL, NULL, '2021-04-21 09:16:02'),
(4, 'DEPARTMENT', 'Users', 'DP', 'Department inside the Institute', 1, NULL, NULL, '2021-04-21 09:16:13'),
(5, 'FACILITIES', 'Users', 'FC', 'Facilities inside the Institute', 1, NULL, NULL, '2021-04-21 09:16:14'),
(6, 'FACULTY', 'Users', 'FL', 'Faculties', 1, NULL, NULL, '2021-04-21 09:16:16'),
(7, 'FACILITY INCHARGE', 'Users', 'FI', 'Facility Incharges', 1, NULL, NULL, '2021-04-21 09:16:19'),
(8, 'OPERATOR', 'Users', 'OP', 'Equipment Operators', 1, NULL, NULL, '2021-04-21 09:16:17'),
(9, 'EQUIPMENT', 'Users', 'EQ', 'Equipments', 1, NULL, NULL, '2021-04-21 09:16:20'),
(10, 'FUNDING AGENCY REPRESENTATIVE', 'Users', 'FA', 'FUNDING AGENCY REPRESENTATIVE', 1, NULL, NULL, '2021-04-21 09:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `lead_id` int(11) NOT NULL,
  `lead_code` varchar(50) DEFAULT NULL,
  `lead_name` varchar(250) DEFAULT NULL,
  `lead_type` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `alternative_phone_number` varchar(20) DEFAULT NULL,
  `lead_address` varchar(250) DEFAULT NULL,
  `lead_postcode` int(30) DEFAULT NULL,
  `lead_taluk` varchar(100) DEFAULT NULL,
  `lead_city` varchar(100) DEFAULT NULL,
  `lead_state` varchar(100) DEFAULT NULL,
  `lead_logo` varchar(250) DEFAULT NULL,
  `lead_status` varchar(60) DEFAULT NULL,
  `created_by` varchar(60) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`lead_id`, `lead_code`, `lead_name`, `lead_type`, `email`, `phone_number`, `alternative_phone_number`, `lead_address`, `lead_postcode`, `lead_taluk`, `lead_city`, `lead_state`, `lead_logo`, `lead_status`, `created_by`, `status`, `created_date`, `modified_date`) VALUES
(1, 'INS0001', 'GC Brothers', 'Owner', 'gcbrothers@gmail.com', '09868263821', '9620203281', 'SF-26, Centre for Nano Science and Engineering (CeNSE),\r\nIndian Institute of ScienceBengaluru', 560012, 'Bengaluru', 'Bengaluru', 'Karnataka ', NULL, NULL, 'Super Admin', 1, '2021-04-12 06:41:47', '2021-09-05 08:47:45'),
(2, 'INS0002', 'Indian Institute of Science', 'Client', 'iisc@gmail.com', '09868263821', '9620203281', 'SF-26, Centre for Nano Science and Engineering (CeNSE),\r\nIndian Institute of Science', 560012, 'Bengaluru', 'Bengaluru', 'Karnataka ', NULL, NULL, 'Super Admin', 1, '2021-04-12 06:41:47', '2021-04-25 05:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(9) UNSIGNED NOT NULL,
  `project_code` varchar(30) DEFAULT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `motto` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `signed_on` varchar(30) DEFAULT NULL,
  `creator` varchar(30) DEFAULT NULL,
  `team` varchar(60) NOT NULL,
  `attachment` varchar(250) DEFAULT NULL,
  `project_status` varchar(60) NOT NULL DEFAULT 'New Project',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_code`, `lead_id`, `title`, `motto`, `description`, `signed_on`, `creator`, `team`, `attachment`, `project_status`, `status`, `created_date`, `modified_date`) VALUES
(1, 'FtSGeaMVEaH8tJg', '2', 'I-STEM Linking Researchers and Resources', 'All India Portal Web and App Design', 'Indian Science, Technology and Engineering facilities Map (I-STEM) is a dynamic and interactive national portal, which hosts various scientific programs, initiated by office of the Principal Scientific Adviser, Govt. of India.The main objective of having this portal (developed using public fund) is to provide support to needy researchers in different ways and strengthen the R&D ecosystem to fulfil the necessity of people of the country.', '09/08/2021', '1', '1,2,3,4,5,6,7', NULL, 'New Project', 1, '2021-09-06 03:37:28', '2021-09-06 12:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(9) UNSIGNED NOT NULL,
  `task_code` varchar(30) DEFAULT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_from` varchar(30) DEFAULT NULL,
  `date_to` varchar(30) DEFAULT NULL,
  `priority` varchar(30) DEFAULT NULL,
  `assign_to` varchar(60) NOT NULL,
  `followers` varchar(60) DEFAULT NULL,
  `attachment` varchar(250) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `task_status` varchar(60) NOT NULL DEFAULT 'Planned',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_code`, `lead_id`, `title`, `description`, `date_from`, `date_to`, `priority`, `assign_to`, `followers`, `attachment`, `created_by`, `status`, `task_status`, `created_date`, `modified_date`) VALUES
(1, 'FtSGeaMVEaH8tJg', '2', 'Event', 'Sample Task', '09/06/2021', '09/08/2021', 'Low', '3', '1,2', NULL, '1', 1, 'Planned', '2021-09-06 03:37:28', '2021-09-06 09:07:28'),
(2, 'Bepg8VzMjN0Cxwy', '2', 'Reports', 'All kind usage log in report format', '08/01/2021', '09/09/2021', 'Medium', '5', '1,2,3,4', NULL, '3', 1, 'Planned', '2021-09-06 05:16:47', '2021-09-06 10:47:20'),
(3, '8Qkw1L5AtWdXSST', '2', 'Event', 'test Task to idea', '09/16/2021', '09/24/2021', 'High', '3,4,5', '1,2', NULL, '3', 1, 'Planned', '2021-09-07 07:41:30', '2021-09-07 13:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `todo_id` int(9) UNSIGNED NOT NULL,
  `todo_code` varchar(30) DEFAULT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `todo` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_from` varchar(30) DEFAULT NULL,
  `date_to` varchar(30) DEFAULT NULL,
  `priority` varchar(30) DEFAULT NULL,
  `assign_to` varchar(60) NOT NULL,
  `attachment` varchar(250) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `todo_status` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`todo_id`, `todo_code`, `lead_id`, `todo`, `description`, `date_from`, `date_to`, `priority`, `assign_to`, `attachment`, `created_by`, `todo_status`, `status`, `created_date`, `modified_date`) VALUES
(1, 'FtSGeaMVEaH8tJg', '2', 'Event', NULL, '09/06/2021', '09/08/2021', 'Low', '3', NULL, '1', 0, 1, '2021-09-06 03:37:28', '2021-09-07 13:09:50'),
(2, 'Bepg8VzMjN0Cxwy', '2', 'Reports', NULL, '08/01/2021', '09/09/2021', 'Medium', '5', NULL, '3', 0, 1, '2021-09-06 05:16:47', '2021-09-06 11:59:55'),
(3, 'VEKfjpcLmSiWYPr', '2', 'Event Certificate need to be designed', 'Sample', '09/06/2021', '09/08/2021', 'Medium', '3', NULL, '3', 0, 1, '2021-09-06 06:23:47', '2021-09-07 13:09:46'),
(4, 'IRSMuyae3eFFypb', '2', 'Event Certificate need to be designed', 'Sample', '09/15/2021', '09/15/2021', 'Low', '1', NULL, '1', 0, 1, '2021-09-07 04:39:29', '2021-09-07 10:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(9) UNSIGNED NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `code` varchar(30) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `role` varchar(250) DEFAULT NULL,
  `first_name` varchar(60) DEFAULT NULL,
  `last_name` varchar(60) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `passcode` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `lead_id`, `code`, `role_id`, `role`, `first_name`, `last_name`, `user_name`, `email`, `phone`, `passcode`, `status`, `created_date`, `modified_date`) VALUES
(1, '2', 'ISTEM00001', 3, 'Project Manager', 'Sanjeev', 'Kumar', 'Sanjeev Kumar', 'sanjeev@gmail.com', '9876543210', 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', 1, '2021-04-11 18:14:38', '2021-09-05 15:13:43'),
(2, '2', 'ISTEM00002', 4, 'Team Leader', 'Aravinda', 'B N', 'Aravinda B N', 'aravinda@gmail.com', '9876543210', 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', 1, '2021-04-11 18:14:38', '2021-09-05 15:13:38'),
(3, '2', 'ISTEM00003', 5, 'Employee', 'Karthick', 'R', 'Karthick R', 'karthickr@iisc.ac.in', '9876543210', 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', 1, '2021-04-11 18:14:38', '2021-09-05 15:13:41'),
(4, '2', 'ISTEM00004', 5, 'Employee', 'Narmadeshwar', 'Pandy', 'Narmadeshwar Pandy', 'np@iisc.ac.in', '9876543210', 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', 1, '2021-04-11 18:14:38', '2021-09-05 15:13:45'),
(5, '2', 'ISTEM00005', 5, 'Employee', 'Sasi', 'Kumar', 'Sasi Kumar P', 'skp@iisc.ac.in', '9876543210', 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', 1, '2021-04-11 18:14:38', '2021-09-05 15:13:47'),
(6, '2', 'ISTEM00006', 5, 'Employee', 'Sweta', 'Mukherjee', 'Sweta Mukherjee', 'Sweta@iisc.ac.in', '9876543210', 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', 1, '2021-04-11 18:14:38', '2021-09-05 15:13:52'),
(7, '2', 'ISTEM00007', 5, 'Employee', 'SasSumegha', 'Nadkarni', 'Sumegha Nadkarni', 'sumegha@iisc.ac.in', '9876543210', 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', 1, '2021-04-11 18:14:38', '2021-09-05 15:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `roles` varchar(45) NOT NULL DEFAULT '' COMMENT 'Name of entity like Super Admin, Nodal Agency/Institute etc',
  `roles_prefix` varchar(45) NOT NULL DEFAULT '' COMMENT 'Short Code for Entity',
  `role_brief` varchar(100) NOT NULL DEFAULT '' COMMENT 'Description',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `roles`, `roles_prefix`, `role_brief`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Super Admin', 'SAD', 'Super Admin Overall Administration/Control', 2, NULL, '2021-08-30 05:54:33'),
(2, 'Admin', 'AD', 'Software Controller', 2, NULL, '2021-08-30 05:54:20'),
(3, 'Project Manager', 'PM', 'Project Manager inside the Organization', 1, NULL, '2021-09-04 14:39:27'),
(4, 'Team Leader', 'TL', 'Team Leader inside the Organization', 1, NULL, '2021-08-30 05:53:32'),
(5, 'Employee', 'EMP', 'Employee inside the Organization', 1, NULL, '2021-08-30 05:53:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesspoint`
--
ALTER TABLE `accesspoint`
  ADD PRIMARY KEY (`accesspoint_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`division_id`);

--
-- Indexes for table `istem_user_roles`
--
ALTER TABLE `istem_user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`lead_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`todo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesspoint`
--
ALTER TABLE `accesspoint`
  MODIFY `accesspoint_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `division_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `istem_user_roles`
--
ALTER TABLE `istem_user_roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `lead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `todo_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
