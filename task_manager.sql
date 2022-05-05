-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2022 at 05:55 AM
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
('4qoggovjc3je4r68mpdcf46bhokphb44', '127.0.0.1', 1651722708, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635313732323730383b757365725f646174617c613a32383a7b733a373a22757365725f6964223b733a313a2234223b733a373a226c6561645f6964223b733a313a2232223b733a343a22636f6465223b733a31303a22495354454d3030303034223b733a373a22726f6c655f6964223b733a323a223131223b733a31333a226465706172746d656e745f6964223b733a313a2235223b733a31343a2264657369676e6174696f6e5f6964223b733a313a2234223b733a31303a2266697273745f6e616d65223b733a383a224b6172746869636b223b733a31313a226d6964646c655f6e616d65223b733a303a22223b733a393a226c6173745f6e616d65223b733a363a2252616d657368223b733a393a22757365725f6e616d65223b733a31363a224b6172746869636b202052616d657368223b733a31313a226465736372697074696f6e223b733a32303a2246756c6c20537461636b20446576656c6f706572223b733a353a22656d61696c223b733a32303a226b6172746869636b7240696973632e61632e696e223b733a353a2270686f6e65223b733a31303a2239383736353433323130223b733a383a22656d705f74797065223b733a383a22436f6e7472616374223b733a31343a22656d705f73746172745f64617465223b733a393a2231382d362d32303231223b733a31323a22656d705f656e645f64617465223b733a393a2233312d332d32303233223b733a31323a226a6f696e696e675f64617465223b733a393a2231382d312d32303231223b733a383a2270617373636f6465223b733a3132383a226635616433656635323963626632666363666130643731656466663233653536393263666238633566613061313261633735633930663562623764343962303238323966353538393535353461333033646363633938366432333164616465636363383237386562343733653230626634633331616436353734396235653038223b733a373a2261646472657373223b733a393a2242616e67616c6f7265223b733a343a2263697479223b733a393a2242616e67616c6f7265223b733a353a227374617465223b733a393a224b61726e6174616b61223b733a373a2270696e636f6465223b733a363a22353630303130223b733a31323a227265706f7274696e675f746f223b733a333a22322c33223b733a383a22757365725f706963223b733a33313a2231363530393638333034494d4732303232303130323133303232352e6a7067223b733a31333a22757365725f646f63756d656e74223b4e3b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323032322d30342d32362031353a34383a3234223b733a31333a226d6f6469666965645f64617465223b733a31393a22323032322d30342d32362032303a33353a3431223b7d),
('gvthedfiu2fprp4trcbe78crm3qikvnl', '::1', 1651591200, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635313539313230303b757365725f646174617c613a32383a7b733a373a22757365725f6964223b733a313a2234223b733a373a226c6561645f6964223b733a313a2232223b733a343a22636f6465223b733a31303a22495354454d3030303034223b733a373a22726f6c655f6964223b733a323a223131223b733a31333a226465706172746d656e745f6964223b733a313a2235223b733a31343a2264657369676e6174696f6e5f6964223b733a313a2234223b733a31303a2266697273745f6e616d65223b733a383a224b6172746869636b223b733a31313a226d6964646c655f6e616d65223b733a303a22223b733a393a226c6173745f6e616d65223b733a363a2252616d657368223b733a393a22757365725f6e616d65223b733a31363a224b6172746869636b202052616d657368223b733a31313a226465736372697074696f6e223b733a32303a2246756c6c20537461636b20446576656c6f706572223b733a353a22656d61696c223b733a32303a226b6172746869636b7240696973632e61632e696e223b733a353a2270686f6e65223b733a31303a2239383736353433323130223b733a383a22656d705f74797065223b733a383a22436f6e7472616374223b733a31343a22656d705f73746172745f64617465223b733a393a2231382d362d32303231223b733a31323a22656d705f656e645f64617465223b733a393a2233312d332d32303233223b733a31323a226a6f696e696e675f64617465223b733a393a2231382d312d32303231223b733a383a2270617373636f6465223b733a3132383a226635616433656635323963626632666363666130643731656466663233653536393263666238633566613061313261633735633930663562623764343962303238323966353538393535353461333033646363633938366432333164616465636363383237386562343733653230626634633331616436353734396235653038223b733a373a2261646472657373223b733a393a2242616e67616c6f7265223b733a343a2263697479223b733a393a2242616e67616c6f7265223b733a353a227374617465223b733a393a224b61726e6174616b61223b733a373a2270696e636f6465223b733a363a22353630303130223b733a31323a227265706f7274696e675f746f223b733a333a22322c33223b733a383a22757365725f706963223b733a33313a2231363530393638333034494d4732303232303130323133303232352e6a7067223b733a31333a22757365725f646f63756d656e74223b4e3b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323032322d30342d32362031353a34383a3234223b733a31333a226d6f6469666965645f64617465223b733a31393a22323032322d30342d32362032303a33353a3431223b7d),
('hamrmanna9f7dfb2qq0hlb0du89naoeb', '::1', 1651553501, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635313535333530313b),
('ngadv96kk1c3v4dq6c1qb8nmdjchqj26', '::1', 1651676350, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635313637363335303b),
('qvlaun8ucno2793qfqgnoovaaeu3340u', '::1', 1651685743, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635313638353436303b757365725f646174617c613a32383a7b733a373a22757365725f6964223b733a313a2234223b733a373a226c6561645f6964223b733a313a2232223b733a343a22636f6465223b733a31303a22495354454d3030303034223b733a373a22726f6c655f6964223b733a323a223131223b733a31333a226465706172746d656e745f6964223b733a313a2235223b733a31343a2264657369676e6174696f6e5f6964223b733a313a2234223b733a31303a2266697273745f6e616d65223b733a383a224b6172746869636b223b733a31313a226d6964646c655f6e616d65223b733a303a22223b733a393a226c6173745f6e616d65223b733a363a2252616d657368223b733a393a22757365725f6e616d65223b733a31363a224b6172746869636b202052616d657368223b733a31313a226465736372697074696f6e223b733a32303a2246756c6c20537461636b20446576656c6f706572223b733a353a22656d61696c223b733a32303a226b6172746869636b7240696973632e61632e696e223b733a353a2270686f6e65223b733a31303a2239383736353433323130223b733a383a22656d705f74797065223b733a383a22436f6e7472616374223b733a31343a22656d705f73746172745f64617465223b733a393a2231382d362d32303231223b733a31323a22656d705f656e645f64617465223b733a393a2233312d332d32303233223b733a31323a226a6f696e696e675f64617465223b733a393a2231382d312d32303231223b733a383a2270617373636f6465223b733a3132383a226635616433656635323963626632666363666130643731656466663233653536393263666238633566613061313261633735633930663562623764343962303238323966353538393535353461333033646363633938366432333164616465636363383237386562343733653230626634633331616436353734396235653038223b733a373a2261646472657373223b733a393a2242616e67616c6f7265223b733a343a2263697479223b733a393a2242616e67616c6f7265223b733a353a227374617465223b733a393a224b61726e6174616b61223b733a373a2270696e636f6465223b733a363a22353630303130223b733a31323a227265706f7274696e675f746f223b733a333a22322c33223b733a383a22757365725f706963223b733a33313a2231363530393638333034494d4732303232303130323133303232352e6a7067223b733a31333a22757365725f646f63756d656e74223b4e3b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323032322d30342d32362031353a34383a3234223b733a31333a226d6f6469666965645f64617465223b733a31393a22323032322d30342d32362032303a33353a3431223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_code` varchar(30) DEFAULT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `gst` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(30) DEFAULT NULL,
  `client_logo` varchar(100) DEFAULT NULL,
  `created_by` varchar(60) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_code`, `lead_id`, `name`, `description`, `email`, `phone`, `gst`, `address`, `city`, `state`, `pincode`, `client_logo`, `created_by`, `status`, `created_date`, `modified_date`) VALUES
(1, 'ISTEMC00005', '2', 'Karthick Ramesh', 'Enter User Descriptio', 'karthick@gmail.co', '9047837701', 'GST123', 'Enter your Addres', 'Bangalor', 'Karnatak', '56001', '1651142365job.jpg', '4', 1, '2022-04-28 10:25:49', '2022-04-28 11:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
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
(1, '2', '4', 'Management Department', 'MD', 'Admin Staff Admin Staff Admin Staff Admin Staff Admin Staff Admin Staff Admin Staff Admin Staff\r\n', 1, '2', '2021-05-04 10:12:58', '2022-04-21 17:36:48'),
(2, '2', '4', 'Admin Department (Accounts and Finance)', 'AD', 'Test Desc', 1, '2', '2021-05-04 11:05:57', '2022-04-27 04:08:44'),
(3, '2', '4', 'Human Resource', 'HR', 'Test Desc', 1, '2', '2021-05-04 11:06:11', '2022-04-27 04:08:54'),
(4, '2', '4', 'Sales and Marketing (Business development)', 'SM', 'Test Desc', 1, '2', '2021-05-04 11:06:23', '2022-04-27 04:11:17'),
(5, '2', '4', 'Technical Department (Research and development)', 'TD', 'Test Desc', 1, '2', '2021-05-04 11:06:35', '2022-04-27 04:09:03'),
(6, '2', '4', 'Non Technical Department', 'NTD', 'Test Desc', 1, '2', '2021-05-04 11:06:52', '2022-04-27 04:09:15'),
(7, '2', '4', 'IT services', 'IT', NULL, 0, '2', '2021-05-04 11:07:18', '2022-04-26 11:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `department_id` varchar(100) DEFAULT NULL COMMENT 'Designation Name',
  `designation` varchar(100) DEFAULT NULL COMMENT 'Description',
  `designation_prefix` varchar(60) DEFAULT NULL,
  `designation_brief` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(60) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `lead_id`, `department_id`, `designation`, `designation_prefix`, `designation_brief`, `status`, `created_by`, `created_date`, `modified_date`) VALUES
(1, '2', '', 'Managing Director', 'MD', 'Test Desc', 1, '2', '2021-05-05 06:10:19', '2022-04-27 04:41:22'),
(2, '2', '', 'Admin Staff', 'AS', 'Admin Staff Admin Staff Admin Staff Admin Staff Admin Staff Admin Staff Admin Staff Admin Staff', 1, '2', '2021-05-05 06:10:19', '2022-04-21 17:36:19'),
(3, '2', '', 'Facility Technologist', 'FT', 'Test Desc', 1, '2', '2021-05-05 06:10:19', '2022-04-27 04:41:48'),
(4, '2', '', 'Senior Facility Technologist', 'SFT', 'Test Desc', 1, '2', '2021-05-05 06:10:19', '2022-04-27 04:41:54'),
(5, '2', '', 'HR Manager', 'HRM', 'Test Desc', 1, '2', '2021-05-05 06:10:19', '2022-04-27 04:41:58');

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
  `prefix` varchar(30) DEFAULT NULL,
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

INSERT INTO `leads` (`lead_id`, `lead_code`, `prefix`, `lead_name`, `lead_type`, `email`, `phone_number`, `alternative_phone_number`, `lead_address`, `lead_postcode`, `lead_taluk`, `lead_city`, `lead_state`, `lead_logo`, `lead_status`, `created_by`, `status`, `created_date`, `modified_date`) VALUES
(1, 'L0001', 'GC', 'GC Brothers', 'Owner', 'gcbrothers@gmail.com', '09868263821', '9620203281', 'SF-26, Centre for Nano Science and Engineering (CeNSE),\r\nIndian Institute of ScienceBengaluru', 560012, 'Bengaluru', 'Bengaluru', 'Karnataka ', NULL, NULL, 'Super Admin', 1, '2021-04-12 06:41:47', '2022-04-21 05:10:25'),
(2, 'L0002', 'ISTEM', 'Indian Institute of Science', 'Client', 'iisc@gmail.com', '09868263821', '9620203281', 'SF-26, Centre for Nano Science and Engineering (CeNSE),\r\nIndian Institute of Science', 560012, 'Bengaluru', 'Bengaluru', 'Karnataka ', NULL, NULL, 'Super Admin', 1, '2021-04-12 06:41:47', '2022-04-21 05:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(10) UNSIGNED NOT NULL,
  `log_module` varchar(45) DEFAULT NULL COMMENT 'Name of entity like Super Admin, Nodal Agency/Institute etc',
  `log_details` varchar(45) DEFAULT NULL COMMENT 'Short Code for Entity',
  `log_post` text DEFAULT NULL COMMENT 'Description',
  `log_date` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(10) UNSIGNED NOT NULL,
  `sub_module` int(11) NOT NULL,
  `main_module_id` int(11) NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL COMMENT 'Name of entity like Super Admin, Nodal Agency/Institute etc',
  `module_description` text DEFAULT NULL COMMENT 'Description',
  `created_by` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `sub_module`, `main_module_id`, `lead_id`, `module`, `module_description`, `created_by`, `status`, `created_date`, `modified_date`) VALUES
(1, 0, 0, '2', 'Dashboard', 'All the info it contains', '4', 1, '2022-04-29 07:22:20', '2022-04-29 07:22:20'),
(2, 0, 0, '2', 'Project', 'It have all the project which is created admin', '4', 1, '2022-04-29 07:25:48', '2022-04-29 10:16:01'),
(3, 0, 0, '2', 'Taskboard', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-04-29 12:21:45'),
(4, 0, 0, '2', 'User', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-04-29 12:21:45'),
(5, 0, 0, '2', 'Todo List', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-04-29 12:21:45'),
(6, 1, 0, '2', 'Master', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-04 06:47:10'),
(7, 0, 6, '2', 'Department', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-04 06:46:48'),
(8, 0, 6, '2', 'Designation', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-04 06:46:48'),
(9, 0, 6, '2', 'Client', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-04 13:55:51'),
(10, 0, 6, '2', 'Vendor', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-04 06:46:48'),
(11, 1, 0, '2', 'Roles & Permissions', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-04 06:52:10'),
(12, 0, 11, '2', 'Modules', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-04 06:53:01'),
(13, 0, 11, '2', 'Role Based Access', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-04 06:53:08'),
(14, 0, 11, '2', 'User Based Access', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-04 06:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `role_id` varchar(30) DEFAULT NULL,
  `module_id` varchar(30) DEFAULT NULL,
  `module_read` int(11) DEFAULT 0,
  `module_write` int(11) DEFAULT 0,
  `module_delete` int(11) DEFAULT 0,
  `module_create` int(11) DEFAULT 0,
  `module_import` int(11) DEFAULT 0,
  `module_export` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(30) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `lead_id`, `role_id`, `module_id`, `module_read`, `module_write`, `module_delete`, `module_create`, `module_import`, `module_export`, `status`, `created_by`, `created_date`, `modified_date`) VALUES
(1, '2', '2', '1', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(2, '2', '2', '2', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(3, '2', '2', '3', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(4, '2', '2', '4', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(5, '2', '2', '5', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(6, '2', '2', '6', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(7, '2', '2', '7', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(8, '2', '2', '8', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(9, '2', '2', '9', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(10, '2', '2', '10', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(11, '2', '2', '11', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(12, '2', '2', '12', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(13, '2', '2', '13', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41'),
(14, '2', '2', '14', 0, 1, 0, 1, 1, 0, 1, '4', '2022-05-04 17:35:13', '2022-05-04 17:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(9) UNSIGNED NOT NULL,
  `project_code` varchar(30) DEFAULT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `scope` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `project_type` varchar(100) DEFAULT NULL,
  `client` varchar(60) DEFAULT NULL,
  `team` varchar(60) DEFAULT NULL,
  `signed_on` varchar(30) DEFAULT NULL,
  `start_date` varchar(60) DEFAULT NULL,
  `handover_date` varchar(60) DEFAULT NULL,
  `budget_type` varchar(60) DEFAULT NULL,
  `budget_amount` varchar(100) DEFAULT NULL,
  `attachment` varchar(250) DEFAULT NULL,
  `project_status` varchar(60) NOT NULL DEFAULT 'New Project',
  `created_by` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_code`, `lead_id`, `title`, `scope`, `description`, `project_type`, `client`, `team`, `signed_on`, `start_date`, `handover_date`, `budget_type`, `budget_amount`, `attachment`, `project_status`, `created_by`, `status`, `created_date`, `modified_date`) VALUES
(1, 'ISTEMP00001', '2', 'I-STEM', 'Dynamic and interactive national portal, which hosts various scientific programs,', 'Indian Science, Technology and Engineering facilities Map (I-STEM) is a dynamic and interactive national portal, which hosts various scientific programs, initiated by office of the Principal Scientific Adviser, Govt. of India. The main objective of having this portal (developed using public fund) is to provide support to needy researchers in different ways and strengthen the R&D ecosystem to fulfil the necessity of people of the country. The supports planned through these programs through this unique portal are designed in such a way that every researcher inculcate the concept of the Aatma Nirbhar Bharat in their mind, nature, and behaviour and work with full dedication to optimize the usage of the resources established across the country, using taxpayer’s money i.e. public fund. With these concepts, the portal was launched and dedicated to the nation by the Honourable Prime Minister of India, Shri Narendra Modi, on Jan 03, 2020. It has now entered in Phase-II, w.e.f. Aug 2021.', 'Internal', '', '2,3,4', '04-05-2022', '04-05-2022', '04-05-2022', 'Confidential', '', '1651643431sample.pdf', 'On Going', '4', 1, '2022-05-04 05:50:31', '2022-05-04 11:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `project_modules`
--

CREATE TABLE `project_modules` (
  `module_id` int(10) UNSIGNED NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `project_id` varchar(30) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL COMMENT 'Name of entity like Super Admin, Nodal Agency/Institute etc',
  `module_description` text DEFAULT NULL COMMENT 'Description',
  `created_by` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `project_modules`
--

INSERT INTO `project_modules` (`module_id`, `lead_id`, `project_id`, `module`, `module_description`, `created_by`, `status`, `created_date`, `modified_date`) VALUES
(1, '2', '1', 'Atma Nirbhar Initiatives (Self Reliant)', 'sample', '4', 1, '2022-04-28 11:52:42', '2022-05-04 05:52:05'),
(2, '2', '1', 'Kaushal Bharat (Skill Development)', 'sample', '4', 1, '2022-04-29 06:51:08', '2022-05-04 05:53:08'),
(3, '2', '1', 'R & D Infrastructure Map (Facilities On Map)', 'sample', '4', 1, '2022-05-03 03:24:01', '2022-05-04 05:53:07'),
(4, '2', '1', 'Digital Catalogue<br>(Technology Products)', 'sample', '4', 1, '2022-05-04 05:51:44', '2022-05-04 05:53:10'),
(5, '2', '1', 'Supplier Map', 'sample', '4', 1, '2022-05-04 05:51:44', '2022-05-04 05:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `role` varchar(45) NOT NULL DEFAULT '' COMMENT 'Name of entity like Super Admin, Nodal Agency/Institute etc',
  `role_prefix` varchar(45) NOT NULL DEFAULT '' COMMENT 'Short Code for Entity',
  `role_brief` varchar(100) NOT NULL DEFAULT '' COMMENT 'Description',
  `created_by` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `lead_id`, `role`, `role_prefix`, `role_brief`, `created_by`, `status`, `created_date`, `modified_date`) VALUES
(1, '1', 'Owner', 'OW', 'Super Admin Overall Administration/Control', NULL, 2, '2022-04-29 07:37:59', '2022-04-29 07:15:51'),
(2, '2', 'Super Admin', 'SAD', 'Super Admin Overall Administration/Control', NULL, 1, '2022-04-29 07:37:59', '2022-04-29 07:15:48'),
(3, '2', 'Admin', 'AD', 'Software Controller', NULL, 1, '2022-04-29 07:37:59', '2022-04-29 07:16:12'),
(4, '2', 'User', 'US', 'User inside the Organization', NULL, 1, '2022-04-29 07:37:59', '2022-04-29 07:11:55'),
(5, '2', 'Employee', 'EMP', 'All staff of the org', '4', 0, '2022-04-29 09:42:35', '2022-04-29 09:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(9) UNSIGNED NOT NULL,
  `task_code` varchar(30) DEFAULT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `project_id` varchar(30) DEFAULT NULL,
  `project_module_id` varchar(30) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_from` varchar(30) DEFAULT NULL,
  `date_to` varchar(30) DEFAULT NULL,
  `priority` varchar(30) DEFAULT NULL,
  `assign_to` varchar(60) NOT NULL,
  `followers` varchar(60) DEFAULT NULL,
  `task_attachment` varchar(250) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `task_status` varchar(60) NOT NULL DEFAULT 'Planned',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_code`, `lead_id`, `project_id`, `project_module_id`, `title`, `description`, `date_from`, `date_to`, `priority`, `assign_to`, `followers`, `task_attachment`, `created_by`, `status`, `task_status`, `created_date`, `modified_date`) VALUES
(1, 'ISTEMT00001', '2', '1', '3', 'Search Equipment With Distance', 'Need to give distance option to filter nearby equipment', '04-05-2022', '06/01/2022', 'Medium', '4', '2,4', '1651647796sample.pdf', '4', 1, 'On Hold', '2022-05-04 07:03:16', '2022-05-04 16:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `task_todo`
--

CREATE TABLE `task_todo` (
  `task_todo_id` int(9) UNSIGNED NOT NULL,
  `task_todo_code` varchar(30) DEFAULT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `task_id` varchar(30) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `task_todo_attachment` varchar(100) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `tasktodo_status` varchar(60) NOT NULL DEFAULT 'Draft',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task_todo`
--

INSERT INTO `task_todo` (`task_todo_id`, `task_todo_code`, `lead_id`, `task_id`, `title`, `description`, `task_todo_attachment`, `created_by`, `status`, `tasktodo_status`, `created_date`, `modified_date`) VALUES
(1, 'ISTEMTT00001', '2', NULL, 'sample', 'sample', '1651649043sample.pdf', '4', 1, 'Completed', '2022-05-04 07:24:03', '2022-05-04 16:30:13'),
(2, 'ISTEMTT00002', '2', NULL, 'sample', 'sample', '1651649043sample.pdf', '4', 1, 'Queued', '2022-05-04 07:24:03', '2022-05-04 15:07:43'),
(3, 'ISTEMTT00003', '2', NULL, 'sample', 'sample', '1651649043sample.pdf', '4', 1, 'On Hold', '2022-05-04 07:24:03', '2022-05-04 15:09:05');

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
(1, 'FtSGeaMVEaH8tJg', '2', 'Event', NULL, '09/06/2021', '09/08/2021', 'Low', '3', NULL, '1', 0, 1, '2021-09-06 03:37:28', '2022-04-20 16:21:37'),
(2, 'Bepg8VzMjN0Cxwy', '2', 'Reports', NULL, '08/01/2021', '09/09/2021', 'Medium', '5', NULL, '3', 0, 1, '2021-09-06 05:16:47', '2021-09-06 11:59:55'),
(3, 'VEKfjpcLmSiWYPr', '2', 'Event Certificate need to be designed', 'Sample', '09/06/2021', '09/08/2021', 'Medium', '3', NULL, '3', 0, 1, '2021-09-06 06:23:47', '2022-04-20 16:21:34'),
(4, 'IRSMuyae3eFFypb', '2', 'Event Certificate need to be designed', 'Sample', '09/15/2021', '09/15/2021', 'Low', '1', NULL, '1', 0, 1, '2021-09-07 04:39:29', '2022-04-20 10:15:13'),
(5, 'Kxzo1AbkVe87ouL', '2', 'Event Certificate need to be designed', 'sdsd', '', '', 'Low', '1', NULL, '3', 1, 1, '2022-04-20 10:51:29', '2022-04-20 16:21:29'),
(6, 'nQ2oETRCQYeUmpx', '2', '', '', '', '', '', '', NULL, '4', 1, 1, '2022-04-26 05:43:29', '2022-04-26 11:13:29'),
(7, 'oBlLmtfFByxE0xu', '2', 'Event Certificate need to be designed', 'xz', '', '', 'Low', '2', NULL, '4', 1, 1, '2022-04-26 05:43:44', '2022-04-26 11:13:44'),
(8, 'dqKrhhMxwP9XZMg', '2', 'Event Certificate need to be designed', 'df', '', '', 'Low', '4', NULL, '4', 1, 1, '2022-04-26 05:44:02', '2022-05-04 16:33:48'),
(9, 'gnot9AE1mQGtC5a', '2', '', '', '05/04/2022', '05/04/2022', '', '', NULL, '4', 1, 1, '2022-05-04 11:03:34', '2022-05-04 16:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `code` varchar(30) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `access_id` varchar(30) DEFAULT NULL,
  `department_id` varchar(30) DEFAULT NULL,
  `designation_id` varchar(30) DEFAULT NULL,
  `first_name` varchar(60) DEFAULT NULL,
  `middle_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(60) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `emp_type` varchar(60) DEFAULT NULL,
  `emp_start_date` varchar(60) DEFAULT NULL,
  `emp_end_date` varchar(60) DEFAULT NULL,
  `joining_date` varchar(60) DEFAULT NULL,
  `passcode` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(30) DEFAULT NULL,
  `reporting_to` varchar(60) DEFAULT NULL,
  `user_pic` varchar(250) DEFAULT NULL,
  `user_document` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `lead_id`, `code`, `role_id`, `access_id`, `department_id`, `designation_id`, `first_name`, `middle_name`, `last_name`, `user_name`, `description`, `email`, `phone`, `emp_type`, `emp_start_date`, `emp_end_date`, `joining_date`, `passcode`, `address`, `city`, `state`, `pincode`, `reporting_to`, `user_pic`, `user_document`, `status`, `created_date`, `modified_date`) VALUES
(1, '1', 'GC00001', 1, NULL, '1', '1', 'G C', NULL, 'Brothers', 'GC Brothers', NULL, '', '9876543210', NULL, NULL, NULL, NULL, 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-04-11 18:14:38', '2022-04-22 13:14:20'),
(2, '2', 'ISTEM00002', 2, NULL, '1', '1', 'Sanjeev', NULL, 'Kumar', 'Sanjeev Kumar', NULL, 'sanjeev@gmail.com', '9876543210', NULL, NULL, NULL, NULL, 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-04-11 18:14:38', '2022-04-26 11:21:13'),
(3, '2', 'ISTEM00003', 4, NULL, '5', '4', 'Arvindha ', '', 'B N', 'Arvindha   B N', 'Server Side Developer', 'arvindhabn@iisc.ac.in', '9876543210', NULL, NULL, NULL, NULL, 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', 'Bangalore', 'Bangalore', 'Karnataka', '560010', '2', '1650952938user.png', NULL, 1, '2022-04-26 06:02:18', '2022-05-05 09:06:52'),
(4, '2', 'ISTEM00004', 4, NULL, '5', '4', 'Karthick', '', 'Ramesh', 'Karthick  Ramesh', 'Full Stack Developer', 'karthickr@iisc.ac.in', '9876543210', 'Contract', '18-6-2021', '31-3-2023', '18-1-2021', 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', 'Bangalore', 'Bangalore', 'Karnataka', '560010', '2,3', '1650968304IMG20220102130225.jpg', NULL, 1, '2022-04-26 10:18:24', '2022-05-05 09:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `vendor_code` varchar(30) DEFAULT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `gst` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(30) DEFAULT NULL,
  `vendor_logo` varchar(100) DEFAULT NULL,
  `created_by` varchar(60) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_code`, `lead_id`, `name`, `description`, `email`, `phone`, `gst`, `address`, `city`, `state`, `pincode`, `vendor_logo`, `created_by`, `status`, `created_date`, `modified_date`) VALUES
(1, 'ISTEMC00005', '2', 'Karthick Ramesh', 'Enter User Descriptio', 'karthick@gmail.co', '9047837701', 'GST123', 'Enter your Addres', 'Bangalor', 'Karnatak', '56001', '1651142365job.jpg', '4', 1, '2022-04-28 10:25:49', '2022-04-28 11:10:48');

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
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

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
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `project_modules`
--
ALTER TABLE `project_modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_todo`
--
ALTER TABLE `task_todo`
  ADD PRIMARY KEY (`task_todo_id`);

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
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesspoint`
--
ALTER TABLE `accesspoint`
  MODIFY `accesspoint_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_modules`
--
ALTER TABLE `project_modules`
  MODIFY `module_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_todo`
--
ALTER TABLE `task_todo`
  MODIFY `task_todo_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `todo_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
