-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 12:03 PM
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
('6mljom3jan0mrir4bk2k69ckfsmq8vkh', '::1', 1652176977, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635323137363737383b757365725f646174617c613a32393a7b733a373a22757365725f6964223b733a313a2238223b733a373a226c6561645f6964223b733a313a2232223b733a343a22636f6465223b733a31303a22495354454d3030303038223b733a373a22726f6c655f6964223b733a313a2234223b733a393a226163636573735f6964223b733a313a2234223b733a31333a226465706172746d656e745f6964223b733a313a2237223b733a31343a2264657369676e6174696f6e5f6964223b733a323a223135223b733a31303a2266697273745f6e616d65223b733a383a224b6172746869636b223b733a31313a226d6964646c655f6e616d65223b733a303a22223b733a393a226c6173745f6e616d65223b733a363a2252616d657368223b733a393a22757365725f6e616d65223b733a31363a224b6172746869636b202052616d657368223b733a31313a226465736372697074696f6e223b733a32383a2253656e696f7220466163696c69747920546563686e6f6c6f67697374223b733a353a22656d61696c223b733a32303a226b6172746869636b7240696973632e61632e696e223b733a353a2270686f6e65223b733a31303a2239303437383337373031223b733a383a22656d705f74797065223b733a383a22436f6e7472616374223b733a31343a22656d705f73746172745f64617465223b733a31303a2231302d30352d32303232223b733a31323a22656d705f656e645f64617465223b733a31303a2231302d30352d32303232223b733a31323a226a6f696e696e675f64617465223b733a383a22312d352d32303233223b733a383a2270617373636f6465223b733a3132383a223262363234363065306661323337366366613330393738323336353734303763323336373539663561643439643731323834383361643565653061396434306230613062323233376431383366386337666233643938316266656233323738613564613064343538383234663037616638366338363366303166653832666464223b733a373a2261646472657373223b733a393a2242656e67616c6f7265223b733a343a2263697479223b733a393a2242656e67616c6f7265223b733a353a227374617465223b733a393a224b61726e6174616b61223b733a373a2270696e636f6465223b733a363a22353630303130223b733a31323a227265706f7274696e675f746f223b733a333a22322c33223b733a383a22757365725f706963223b733a33313a2231363532313734303131494d4732303232303130323133303033362e6a7067223b733a31333a22757365725f646f63756d656e74223b4e3b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323032322d30352d31302031343a34333a3331223b733a31333a226d6f6469666965645f64617465223b733a31393a22323032322d30352d31302031353a31393a3437223b7d);

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
(1, '2', NULL, 'Board of Directors', 'BD', 'This is an operational center of the software company. It’s here where C-level managers handle the strategic decisions in the organization. Usually they report to the captain of the ship - Managing Director.', 1, '2', '2022-05-10 06:52:46', '2022-05-10 06:52:46'),
(2, '2', NULL, 'Administration', 'AD', 'This department mostly takes care of every financial aspect among the company. Also their aim is to control document flow and all settlements with partners.', 1, '2', '2022-05-10 06:53:16', '2022-05-10 08:05:35'),
(3, '2', NULL, 'HR Department', 'HR', 'Their main objective is to create the best possible team of dedicated and reliable employees as possible. Not only to recruit the most relevant new ones, but also to train the ones already employed. They are also aimed at staff development programs, improvement of staff efficiency and career pathing. Moreover, the HR department plays an important role in creating and implementing health and safety regulations within the company.', 1, '2', '2022-05-10 06:53:32', '2022-05-10 06:53:32'),
(4, '2', NULL, 'Marketing Department', 'SALES-MD', '\r\nLong story short they are responsible for creating the company\'s image on the market. Starting from the design of the website, through advertising, presence on industry portals and press releases. The main task of the marketing department is to make the company visible to a potentially interested customer.\r\n\r\nCurious what else does marketing department in the software house? For example - they develop a content marketing strategy! You can see the video explaining it\'s importance in the video below (ENG subtitles available).', 1, '2', '2022-05-10 06:54:48', '2022-05-10 06:54:48'),
(5, '2', NULL, 'Business Development Department', 'BD', 'Usually it is the Business Manager who is the first to have contact with the potential customer. If you meet the representative of the company at trade fairs and industry events, there’s a big chance it’s him/her. This person is responsible for the entire client’s life cycle within the company. Starting from initial contact, through presentation of the offer, sales negotiations, as well as support during the implementation phase. Within some business departments there are dedicated specialists, Account Managers, who are responsible only for current clients. Business development department is not only responsible for ongoing customer service, but also for creating and implementing the company’s sales strategy, choosing the right tools and shaping sales processes.\r\n', 1, '2', '2022-05-10 06:55:14', '2022-05-10 06:55:14'),
(6, '2', NULL, 'UX/UI Department', 'FD', 'It’s here where the graphic part of the project is created. Graphic Designers develop artworks and wireframes based on data collected through meticulous sociological and psychological research. As a result they design the whole application and its individual components. While creating the product, they work closely with the IT Department.', 1, '2', '2022-05-10 06:55:34', '2022-05-10 06:55:34'),
(7, '2', NULL, 'IT Department', 'IT', 'It’s the core of every software house company. It’s created by the group of professionals who are doing the actual technical part of the project. Usually duties within this department are divided among Developers, Project Managers and QA specialists.', 1, '2', '2022-05-10 06:55:50', '2022-05-10 06:55:50');

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
(1, '2', '1', 'Chief Executive Officer', 'CEO', 'The CEO is the head of the executive team and manages the day to day operations of the organisation, its people and resources. The CEO implements the strategy approved by the board and ensures that the organisation\'s structure and processes meet the ', 1, '2', '2022-05-10 07:04:35', '2022-05-10 07:04:35'),
(2, '2', '1', 'Executive Director', 'ED', 'An Executive Director is the working director of an organization whom we can say a full-time employee. It is also known as inside or internal director. Generally, it has a specified role in finance director, marketing operations etc on regular basis', 1, '2', '2022-05-10 07:09:10', '2022-05-10 07:09:10'),
(3, '2', '1', ' Non-Executive Director', 'NED', ' Adjective [ADJECTIVE noun] Someone who has a non-executive position in a company or organization gives advice but is not responsible for making decisions or ensuring that decisions are carried out.', 1, '2', '2022-05-10 07:10:46', '2022-05-10 07:10:46'),
(4, '2', '1', 'Chief Operating Officer', 'COO', 'What Is a Chief Operating Officer (COO)? The chief operating officer (COO) is a senior executive tasked with overseeing the day-to-day administrative and operational functions of a business. The COO typically reports directly to the chief executive o', 1, '2', '2022-05-10 07:25:54', '2022-05-10 07:25:54'),
(5, '2', '2', 'Admin', 'AD', 'Admin', 1, '2', '2022-05-10 07:29:07', '2022-05-10 07:29:07'),
(6, '2', '2', 'Admin Assistant', 'ADA', 'Secretaries and administrative assistants maintain databases and filing systems. Secretaries and administrative assistants do routine clerical and organizational tasks. They arrange files, prepare documents, schedule appointments, and support other s', 1, '2', '2022-05-10 07:41:37', '2022-05-10 07:41:37'),
(7, '2', '3', 'Recruiter', 'HR', 'What does a Recruiter do? Recruiters find and attract qualified applicants for open positions. They review resumes, focusing on skills matching up best to the requirements at hand and interview candidates until they find just what an employer is look', 1, '2', '2022-05-10 07:45:59', '2022-05-10 07:45:59'),
(8, '2', '3', 'Corporate Recruiter', 'CR', 'Recruiters find and attract qualified applicants for open positions. They review resumes, focusing on skills matching up best to the requirements at hand and interview candidates until they find just what an employer is looking for.', 1, '2', '2022-05-10 07:46:28', '2022-05-10 07:46:28'),
(9, '2', '3', 'HR Manager', 'HRM', 'Recruiters find and attract qualified applicants for open positions. They review resumes, focusing on skills matching up best to the requirements at hand and interview candidates until they find just what an employer is looking for.', 1, '2', '2022-05-10 07:46:51', '2022-05-10 07:46:51'),
(10, '2', '3', 'Human Resources Director', 'HRD', 'Recruiters find and attract qualified applicants for open positions. They review resumes, focusing on skills matching up best to the requirements at hand and interview candidates until they find just what an employer is looking for.', 1, '2', '2022-05-10 07:53:16', '2022-05-10 07:53:16'),
(11, '2', '3', 'HR Coordinator', 'HRC', 'Recruiters find and attract qualified applicants for open positions. They review resumes, focusing on skills matching up best to the requirements at hand and interview candidates until they find just what an employer is looking for.', 1, '2', '2022-05-10 07:53:37', '2022-05-10 07:53:37'),
(12, '2', '3', 'Headhunter', 'HDH', 'Recruiters find and attract qualified applicants for open positions. They review resumes, focusing on skills matching up best to the requirements at hand and interview candidates until they find just what an employer is looking for.', 1, '2', '2022-05-10 07:54:01', '2022-05-10 07:54:01'),
(13, '2', '7', 'IT Head', 'ITH', 'IT managers are information technology professionals who plan, direct and oversee activities dealing with a company\'s computer and information systems. The IT manager coordinates jobs related to the hardware, software and network that the business us', 1, '2', '2022-05-10 07:55:30', '2022-05-10 07:55:30'),
(14, '2', '7', 'Technology manager', 'TM', 'Technology managers help an organization with the oversight, direction, and maintenance of their technological systems. This role can be specialized into numerous areas: cybersecurity, industrial automation, cloud computing, the internet of things (I', 1, '2', '2022-05-10 07:56:26', '2022-05-10 07:56:26'),
(15, '2', '7', 'Senior Facility Technologist', 'SFT', 'Also known as a software engineer, a senior developer performs various development duties, such as coding and web development. Senior developers may specialize in a specific area, oversee projects, and manage junior developers.', 1, '2', '2022-05-10 07:59:59', '2022-05-10 07:59:59'),
(16, '2', '7', 'Facility Technologist', 'FT', 'Also known as a software engineer, a senior developer performs various development duties, such as coding and web development. Senior developers may specialize in a specific area, oversee projects, and manage junior developers.', 1, '2', '2022-05-10 08:00:24', '2022-05-10 08:00:24');

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
(11, 1, 0, '2', 'Roles', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-05 05:59:38'),
(12, 0, 11, '2', 'Modules', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-04 06:53:01'),
(13, 0, 11, '2', 'Role Access', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-10 08:10:16'),
(14, 0, 11, '2', 'User Access', 'All the user task will be maintained here', '4', 1, '2022-04-29 12:21:45', '2022-05-10 08:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `role_id` varchar(30) DEFAULT NULL,
  `module_id` varchar(30) DEFAULT NULL,
  `module` text DEFAULT NULL,
  `read` int(11) DEFAULT 0,
  `write` int(11) DEFAULT 0,
  `delete` int(11) DEFAULT 0,
  `create` int(11) DEFAULT 0,
  `import` int(11) DEFAULT 0,
  `export` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(30) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `lead_id`, `role_id`, `module_id`, `module`, `read`, `write`, `delete`, `create`, `import`, `export`, `status`, `created_by`, `created_date`, `modified_date`) VALUES
(1, '2', '2', '1', 'Dashboard', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(2, '2', '2', '2', 'Project', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(3, '2', '2', '3', 'Taskboard', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(4, '2', '2', '4', 'User', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(5, '2', '2', '5', 'Todo List', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(6, '2', '2', '6', 'Master', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(7, '2', '2', '7', 'Department', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(8, '2', '2', '8', 'Designation', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(9, '2', '2', '9', 'Client', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(10, '2', '2', '10', 'Vendor', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(11, '2', '2', '11', 'Roles', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(12, '2', '2', '12', 'Modules', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 05:48:01'),
(13, '2', '2', '13', 'Role Access', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 08:10:25'),
(14, '2', '2', '14', 'User Access', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 05:48:01', '2022-05-10 08:10:28'),
(15, '2', '4', '1', 'Dashboard', 1, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(16, '2', '4', '2', 'Project', 1, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(17, '2', '4', '3', 'Taskboard', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(18, '2', '4', '4', 'User', 1, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(19, '2', '4', '5', 'Todo List', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(20, '2', '4', '6', 'Master', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(21, '2', '4', '7', 'Department', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(22, '2', '4', '8', 'Designation', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(23, '2', '4', '9', 'Client', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(24, '2', '4', '10', 'Vendor', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(25, '2', '4', '11', 'Roles', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(26, '2', '4', '12', 'Modules', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(27, '2', '4', '13', 'Role Access', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(28, '2', '4', '14', 'User Access', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:25:42', '2022-05-10 09:25:42'),
(29, '2', '3', '1', 'Dashboard', 1, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(30, '2', '3', '2', 'Project', 1, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(31, '2', '3', '3', 'Taskboard', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(32, '2', '3', '4', 'User', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(33, '2', '3', '5', 'Todo List', 1, 1, 1, 1, 1, 1, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(34, '2', '3', '6', 'Master', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(35, '2', '3', '7', 'Department', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(36, '2', '3', '8', 'Designation', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(37, '2', '3', '9', 'Client', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(38, '2', '3', '10', 'Vendor', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(39, '2', '3', '11', 'Roles', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(40, '2', '3', '12', 'Modules', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(41, '2', '3', '13', 'Role Access', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13'),
(42, '2', '3', '14', 'User Access', 0, 0, 0, 0, 0, 0, 1, '2', '2022-05-10 09:51:13', '2022-05-10 09:51:13');

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
(1, 'ISTEMP00001', '2', 'Indian Science, Technology and Engineering facilities Map (I-STEM)', 'Dynamic and interactive national portal, which hosts various scientific programs', 'Aatma Nirbhar Bharat in their mind, nature, and behaviour and work with full dedication to optimize the usage of the resources established across the country, using taxpayer’s money i.e. public fund. With these concepts, the portal was launched and dedicated to the nation by the Honourable Prime Minister of India, Shri Narendra Modi, on Jan 03, 2020. It has now entered in Phase-II, w.e.f. Aug 2021.', 'Internal', '', '2,3,4,5,6,7,8,9,10,11,12,13', '1-1-2018', '1-1-2018', '1-5-2026', 'Confidential', '', '1652175650sample.pdf', 'New Project', '2', 1, '2022-05-10 09:40:50', '2022-05-10 15:10:50');

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
(1, '2', '1', 'Atma Nirbhar Initiatives (Self Reliant)', 'sample', '4', 1, '2022-04-28 06:22:42', '2022-05-04 00:22:05'),
(2, '2', '1', 'Kaushal Bharat (Skill Development)', 'sample', '4', 1, '2022-04-29 01:21:08', '2022-05-04 00:23:08'),
(3, '2', '1', 'R & D Infrastructure Map (Facilities On Map)', 'sample', '4', 1, '2022-05-02 21:54:01', '2022-05-04 00:23:07'),
(4, '2', '1', 'Digital Catalogue<br>(Technology Products)', 'sample', '4', 1, '2022-05-04 00:21:44', '2022-05-04 00:23:10'),
(5, '2', '1', 'Supplier Map', 'sample', '4', 1, '2022-05-04 00:21:44', '2022-05-04 00:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `role` varchar(45) NOT NULL DEFAULT '' COMMENT 'Name of entity like Super Admin, Nodal Agency/Institute etc',
  `role_prefix` varchar(45) NOT NULL DEFAULT '' COMMENT 'Short Code for Entity',
  `role_brief` text DEFAULT NULL COMMENT 'Description',
  `created_by` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Organisational Entities/Hierarchy';

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `lead_id`, `role`, `role_prefix`, `role_brief`, `created_by`, `status`, `created_date`, `modified_date`) VALUES
(1, '1', 'Owner', 'OW', '', NULL, 1, '2022-05-10 05:45:36', '2022-05-10 05:45:36'),
(2, '2', 'Super Admin', 'SA', 'A Super Administrator is a user who has complete access to all objects, folders, role templates, and groups in the system. A deployment can have one or more Super Administrators. A Super Administrator can create users, groups, and other super administrators.', NULL, 1, '2022-05-10 05:45:36', '2022-05-10 08:22:08'),
(3, '2', 'Admin', 'AD', 'Access control administration is the collection of tasks and duties assigned to an administrator to manage user accounts, access, and accountability. A system\'s security is based on effective administration of access controls.', NULL, 1, '2022-05-10 05:45:36', '2022-05-10 08:22:43'),
(4, '2', 'User', 'EMP', 'Least Authorization ', NULL, 1, '2022-05-10 05:45:36', '2022-05-10 08:28:34');

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

-- --------------------------------------------------------

--
-- Table structure for table `task_comments`
--

CREATE TABLE `task_comments` (
  `task_comment_id` int(9) UNSIGNED NOT NULL,
  `lead_id` varchar(30) DEFAULT NULL,
  `task_id` varchar(30) DEFAULT NULL,
  `comment_replay` int(11) DEFAULT 0,
  `comment_replay_id` int(11) DEFAULT 0,
  `comment` text DEFAULT NULL,
  `comment_attachment` varchar(250) DEFAULT NULL,
  `comment_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `commented_by` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `task_status` varchar(60) NOT NULL DEFAULT 'Planned',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'wa9CG1xGOZV37MB', '2', 'Event Certificate need to be designed', 'Test Todo', '05/10/2022', '05/10/2022', 'Medium', '8', NULL, '8', 0, 1, '2022-05-10 10:02:42', '2022-05-10 15:32:53');

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
(1, '1', 'GC00001', 1, '1', '1', '1', 'G C', NULL, 'Brothers', 'GC Brothers', NULL, '', '9876543210', NULL, NULL, NULL, NULL, 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-04-11 18:14:38', '2022-05-05 15:04:12'),
(2, '2', 'ISTEM00002', 2, '2', '1', '1', 'Sanjeev', '', 'Kumar', 'Sanjeev Kumar', 'Supmer Admin', 'sanjeev@gmail.com', '9876543210', '', '', '', '', 'f5ad3ef529cbf2fccfa0d71edff23e5692cfb8c5fa0a12ac75c90f5bb7d49b02829f55895554a303dccc986d231dadeccc8278eb473e20bf4c31ad65749b5e08', 'Bengalore', 'Bengalore', 'Karnataka', '560010', NULL, '1652173153user2.png', NULL, 1, '2021-04-11 18:14:38', '2022-05-10 14:29:13'),
(3, '2', 'ISTEM00003', 3, '3', '7', '13', 'Arvindha', '', 'B N', 'Arvindha  B N', 'IT Head', 'aravindabn@iisc.ac.in', '080-23607022', 'Contract', '10-05-2022', '10-05-2022', '10-5-2022', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bangalore', 'Karnataka', '560010', '2', '1652172768user.png', NULL, 1, '2022-05-10 08:52:48', '2022-05-10 15:20:15'),
(4, '2', 'ISTEM00004', 4, '4', '7', '14', 'Shailesh', '', 'Sharma', 'Shailesh  Sharma', 'Technology manager', 'shaileshs@iisc.ac.in', '9672472877', 'Contract', '10-05-2022', '10-05-2022', '10-5-2022', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bengalore', 'Karnataka', '560012', '2', '1652173376user2.png', NULL, 1, '2022-05-10 09:02:56', '2022-05-10 15:20:11'),
(5, '2', 'ISTEM00005', 4, '4', '7', '15', 'Sweta', '', 'Mukherjee', 'Sweta  Mukherjee', 'Senior Facility Technologist', 'msweta@iisc.ac.in', '08022932680', 'Contract', '10-05-2022', '10-05-2022', '10-5-2022', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bengalore', 'Karnataka', '560012', '2', '1652173474user1.png', NULL, 1, '2022-05-10 09:04:34', '2022-05-10 15:20:09'),
(6, '2', 'ISTEM00006', 4, '4', '7', '15', 'Narmdeshwar', '', 'Pandey', 'Narmdeshwar  Pandey', 'Senior Facility Technologist', 'narmdeshwarp@iisc.ac.in', '9342770330', 'Contract', '10-05-2022', '10-05-2022', '10-5-2022', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bengalore', 'Karnataka', '560012', '2,3', '1652173737user2.png', NULL, 1, '2022-05-10 09:08:57', '2022-05-10 15:20:07'),
(7, '2', 'ISTEM00007', 4, '4', '7', '16', 'Pooja', '', 'Punetha', 'Pooja  Punetha', 'Facility Technologist', 'ppooja@iisc.ac.in', '7080533824', 'Contract', '10-05-2022', '10-05-2022', '10-5-2023', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bengalore', 'Karnataka', '560012', '2', '1652173855user.png', NULL, 1, '2022-05-10 09:10:55', '2022-05-10 15:19:54'),
(8, '2', 'ISTEM00008', 4, '4', '7', '15', 'Karthick', '', 'Ramesh', 'Karthick  Ramesh', 'Senior Facility Technologist', 'karthickr@iisc.ac.in', '9047837701', 'Contract', '10-05-2022', '10-05-2022', '1-5-2023', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bengalore', 'Karnataka', '560010', '2,3', '1652174011IMG20220102130036.jpg', NULL, 1, '2022-05-10 09:13:31', '2022-05-10 15:19:47'),
(9, '2', 'ISTEM00009', 4, '4', '2', '6', 'R J', '', 'Manjunatha', 'R J  Manjunatha', 'Admin Assistant', 'manjunatharj@iisc.ac.in', '08022932680', 'Contract', '10-05-2022', '10-05-2022', '1-5-2023', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bengalore', 'Karnataka', '560012', '2', '1652174468user2.png', NULL, 1, '2022-05-10 09:21:08', '2022-05-10 15:19:46'),
(10, '2', 'ISTEM00010', 4, '4', '2', '6', 'S', '', 'Pushpa', 'S Pushpa', 'Admin Assistant', 'pushpas@iisc.ac.in', '08022932680', 'Contract', '10-05-2022', '10-05-2022', '1-5-2023', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bengalore', 'Karnataka', '560012', '2', '1652174468user2.png', NULL, 1, '2022-05-10 09:21:08', '2022-05-10 15:19:44'),
(11, '2', 'ISTEM00011', 4, '4', '7', '16', 'P', '', 'Sasikumar', 'P  Sasikumar', 'Facility Technologist', 'sasikumarp@iisc.ac.in', '7702436156', 'Contract', '10-05-2022', '10-05-2022', '1-5-2023', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bengalore', 'Karnatak', '560012', '2,3', '1652174858user.png', NULL, 1, '2022-05-10 09:27:38', '2022-05-10 15:19:42'),
(12, '2', 'ISTEM00012', 4, '4', '7', '16', 'U', '', 'Geethanjali', 'U  Geethanjali', 'Facility Technologist', 'geethanjaliu@iisc.ac.in', '9740383725', 'Contract', '10-05-2022', '10-05-2022', '1-5-2023', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bengalore', 'Karnataka', '560012', '2', '1652174957user2.png', NULL, 1, '2022-05-10 09:29:17', '2022-05-10 15:19:41'),
(13, '2', 'ISTEM00013', 4, '4', '7', '15', 'Pawan', '', 'Baisoya', 'Pawan  Baisoya', 'Senior Facility Technologist', 'pawank@iisc.ac.in', '8810552217', 'Contract', '10-05-2022', '10-05-2022', '1-5-2023', '2b62460e0fa2376cfa3097823657407c236759f5ad49d7128483ad5ee0a9d40b0a0b2237d183f8c7fb3d981bfeb3278a5da0d458824f07af86c863f01fe82fdd', 'Bengalore', 'Bengalore', 'Karnataka', '560010', '2,3', '1652175058user2.png', NULL, 1, '2022-05-10 09:30:58', '2022-05-10 15:19:38');

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
-- Indexes for table `task_comments`
--
ALTER TABLE `task_comments`
  ADD PRIMARY KEY (`task_comment_id`);

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
  MODIFY `accesspoint_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `division_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `istem_user_roles`
--
ALTER TABLE `istem_user_roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_comments`
--
ALTER TABLE `task_comments`
  MODIFY `task_comment_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_todo`
--
ALTER TABLE `task_todo`
  MODIFY `task_todo_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `todo_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
