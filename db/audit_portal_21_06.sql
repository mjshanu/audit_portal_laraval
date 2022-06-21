-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 10:48 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `audit_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_calendar_map`
--

CREATE TABLE `audit_calendar_map` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_hol_map_id` bigint(20) UNSIGNED NOT NULL,
  `fk_hol_id` bigint(20) UNSIGNED NOT NULL,
  `optional` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_calendar_map`
--

INSERT INTO `audit_calendar_map` (`id`, `fk_hol_map_id`, `fk_hol_id`, `optional`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0', NULL, NULL),
(2, 1, 2, '0', NULL, NULL),
(3, 1, 3, '1', NULL, NULL),
(4, 1, 4, '0', NULL, NULL),
(5, 1, 5, '0', NULL, NULL),
(6, 1, 6, '0', NULL, NULL),
(7, 1, 7, '0', NULL, NULL),
(8, 1, 8, '0', NULL, NULL),
(9, 1, 11, '0', NULL, NULL),
(10, 2, 1, '0', NULL, NULL),
(11, 2, 2, '0', NULL, NULL),
(12, 2, 3, '0', NULL, NULL),
(13, 2, 4, '0', NULL, NULL),
(14, 2, 5, '0', NULL, NULL),
(15, 2, 6, '0', NULL, NULL),
(16, 2, 7, '0', NULL, NULL),
(17, 2, 8, '0', NULL, NULL),
(18, 2, 11, '0', NULL, NULL),
(19, 3, 15, '0', NULL, NULL),
(20, 3, 14, '0', NULL, NULL),
(21, 3, 13, '0', NULL, NULL),
(22, 3, 12, '0', NULL, NULL),
(23, 3, 11, '0', NULL, NULL),
(24, 3, 10, '0', NULL, NULL),
(25, 3, 2, '0', NULL, NULL),
(26, 3, 1, '0', NULL, NULL),
(27, 3, 6, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_department`
--

CREATE TABLE `audit_department` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_department`
--

INSERT INTO `audit_department` (`id`, `department_name`, `department_code`, `created_at`, `updated_at`) VALUES
(1, 'IT', 'IT', '2022-06-17 03:03:26', '2022-06-17 06:26:12'),
(2, 'HR', 'HR01', '2022-06-17 03:04:39', '2022-06-17 03:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `audit_designation`
--

CREATE TABLE `audit_designation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_department_id` bigint(20) UNSIGNED NOT NULL,
  `designation_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_designation`
--

INSERT INTO `audit_designation` (`id`, `designation_name`, `designation_code`, `level_type`, `fk_department_id`, `designation_status`, `created_at`, `updated_at`) VALUES
(1, 'Network Engineer', 'NE 01', 'level3', 1, '0', '2022-06-17 03:07:53', '2022-06-19 23:39:48'),
(2, 'Devops Engineer', 'DE', 'level3', 1, '0', '2022-06-17 03:08:02', '2022-06-19 23:12:18'),
(3, 'Module Lead', 'ML-01', 'level4', 1, '0', '2022-06-17 03:08:53', '2022-06-17 03:08:53'),
(5, 'QA Manager', 'QA 01', 'level5', 1, '0', '2022-06-17 03:08:54', '2022-06-19 23:22:12'),
(7, 'Sr Web Designer', 'WB 01', 'level3', 1, '0', '2022-06-17 03:09:53', '2022-06-17 03:09:53'),
(8, 'Sr Network Engineer', 'NE 02', 'level3', 1, '0', '2022-06-17 03:11:00', '2022-06-17 03:11:00'),
(9, 'Test Lead', 'TST 01', 'level4', 1, '0', '2022-06-17 03:12:01', '2022-06-19 23:25:10'),
(11, 'Dot Net Lead', 'DNL-01', 'level4', 1, '0', '2022-06-17 03:12:08', '2022-06-17 03:12:08'),
(12, 'Tech Lead', 'TL 01', 'level4', 1, '0', '2022-06-17 03:13:01', '2022-06-19 23:17:59'),
(14, 'Design Lead', 'DL-02', 'level4', 1, '0', '2022-06-17 03:15:06', '2022-06-17 03:15:06'),
(15, 'Project Lead', 'PL 01', 'level4', 1, '0', '2022-06-17 03:15:06', '2022-06-17 03:15:06'),
(16, 'Java Tech Lead', 'JTL 01', 'level5', 1, '0', '2022-06-17 03:16:24', '2022-06-17 03:16:24'),
(17, 'Java API Lead', 'JAPI01', 'level5', 1, '0', '2022-06-17 03:17:12', '2022-06-19 23:26:19'),
(18, 'Tech Lead Architect', 'TLA 01', 'level5', 1, '0', '2022-06-17 03:17:31', '2022-06-17 03:17:31'),
(19, 'Asst Project Manager', 'APM 01', 'level5', 1, '0', '2022-06-17 03:18:05', '2022-06-17 03:18:05'),
(20, 'Project Manager', 'PM 01', 'level6', 1, '0', '2022-06-17 03:18:48', '2022-06-17 03:18:48'),
(21, 'AI/ML Developer', 'AI/ML-01', 'level3', 1, '0', '2022-06-17 03:21:22', '2022-06-17 03:21:22'),
(22, 'Director -Technical', 'DTL01', 'level6', 1, '0', '2022-06-17 03:57:18', '2022-06-17 03:57:18'),
(23, 'Director -Engineering', 'DE01', 'level6', 1, '0', '2022-06-17 03:57:43', '2022-06-17 03:57:43'),
(24, 'UI Developer', 'UID-01', 'level3', 1, '0', '2022-06-17 03:57:46', '2022-06-17 03:57:46'),
(25, 'UI/UX Designer and Developer', 'UI/UXD-01', 'level3', 1, '0', '2022-06-17 03:58:44', '2022-06-19 23:18:12'),
(26, 'AI/ML Engineer', 'AI/MLE-01', 'level3', 1, '0', '2022-06-17 04:00:48', '2022-06-17 04:00:48'),
(27, 'HR - Recruiter', 'HRR-01', 'level4', 2, '0', '2022-06-17 04:01:31', '2022-06-17 04:01:31'),
(28, 'Software Test Engineer', 'STE-01', 'level3', 1, '0', '2022-06-17 04:02:34', '2022-06-17 04:02:34'),
(29, 'Jr. Software Engineer', 'JSE-01', 'level2', 1, '0', '2022-06-17 04:03:51', '2022-06-17 04:03:51'),
(30, 'Senior Software Engineer', 'SSE-01', 'level4', 1, '0', '2022-06-17 04:08:58', '2022-06-17 04:08:58'),
(31, 'Software Engineer', 'SE-01', 'level2', 1, '0', '2022-06-17 04:10:59', '2022-06-17 04:10:59'),
(32, 'Software Trainee', 'ST-01', 'level1', 1, '0', '2022-06-17 04:13:29', '2022-06-17 04:13:29'),
(33, 'Sr Project Manager', 'SR', 'level1', 1, '0', '2022-06-19 23:49:56', '2022-06-19 23:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `audit_employee`
--

CREATE TABLE `audit_employee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_c_id` int(11) NOT NULL,
  `e_desination` int(11) DEFAULT NULL,
  `e_code` bigint(20) NOT NULL,
  `e_joining_date` date NOT NULL,
  `e_company_email_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `e_contact_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_reporting_head` int(11) DEFAULT NULL,
  `e_gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_employee`
--

INSERT INTO `audit_employee` (`id`, `name`, `fk_c_id`, `e_desination`, `e_code`, `e_joining_date`, `e_company_email_id`, `e_contact_number`, `e_reporting_head`, `e_gender`, `e_location`, `password`, `created_at`, `updated_at`) VALUES
(1, 'shanu', 1, NULL, 218, '2022-03-12', 'shanu.kk@bourntec.com', NULL, NULL, NULL, NULL, '1aa143c5cc1e1614efec2594206aff3e', '2022-02-22 01:36:57', '2022-02-22 01:36:57'),
(2, 'admin', 0, NULL, 0, '0000-00-00', 'admin@bourntec.com', NULL, NULL, NULL, NULL, '1aa143c5cc1e1614efec2594206aff3e', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_employeeid`
--

CREATE TABLE `audit_employeeid` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `branch_name` varchar(20) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `code_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_employeeid`
--

INSERT INTO `audit_employeeid` (`id`, `emp_id`, `branch_name`, `created_at`, `code_status`) VALUES
(1, 200, 'CHN', '2022-02-17', 1),
(2, 201, 'CHN', '2022-02-17', 1),
(3, 202, 'CHN', '2022-02-17', 1),
(4, 203, 'CHN', '2022-02-17', 1),
(5, 204, 'CHN', '2022-02-17', 1),
(6, 205, 'CHN', '2022-02-17', 1),
(7, 206, 'CHN', '2022-02-17', 1),
(8, 207, 'CHN', '2022-02-17', 1),
(9, 208, 'CHN', '2022-02-17', 1),
(10, 209, 'CHN', '2022-02-17', 1),
(11, 210, 'CHN', '2022-02-17', 1),
(12, 211, 'CHN', '2022-02-17', 1),
(13, 212, 'CHN', '2022-02-17', 1),
(14, 213, 'CHN', '2022-02-17', 1),
(15, 214, 'CHN', '2022-02-17', 1),
(16, 215, 'CHN', '2022-02-17', 1),
(17, 216, 'CHN', '2022-02-17', 1),
(18, 217, 'CHN', '2022-02-21', 1),
(19, 218, 'CHN', '2022-02-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `audit_employee_basics`
--

CREATE TABLE `audit_employee_basics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_fk_des_id` bigint(20) UNSIGNED NOT NULL,
  `emp_joining_date` date NOT NULL,
  `emp_company_email_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_contact_number` bigint(20) DEFAULT NULL,
  `emp_gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_holiday_calander` bigint(20) UNSIGNED NOT NULL,
  `emp_region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `fk_emp_previous_exp` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_fk_dep` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_employee_basics`
--

INSERT INTO `audit_employee_basics` (`id`, `emp_name`, `emp_code`, `emp_fk_des_id`, `emp_joining_date`, `emp_company_email_id`, `emp_contact_number`, `emp_gender`, `emp_location`, `emp_holiday_calander`, `emp_region`, `status`, `fk_emp_previous_exp`, `image`, `emp_fk_dep`, `created_at`, `updated_at`) VALUES
(359, 'Anil T', 'BS0001', 23, '2010-09-20', 'anilt@bourntec.com', 9446819901, 'male', 'Kochi', 1, NULL, 'active', 11, 'men.png', 1, NULL, NULL),
(360, 'Delson Devessy', 'BS0002', 22, '2005-06-05', 'delson@bourntec.com', 9446131479, 'male', 'Kochi', 1, NULL, 'active', 2, 'men.png', 1, NULL, NULL),
(361, 'Fiso Mathew', 'BS0003', 33, '2005-05-15', 'fiso.mathew@bourntec.com', 9447139585, 'male', 'Kochi', 1, NULL, 'active', 1, 'men.png', 1, NULL, NULL),
(362, 'KRISHNACHANDRAN E S', 'BS0005', 16, '2007-07-16', 'krishna.s@bourntec.com', 9847978496, 'male', 'Kochi', 1, NULL, 'active', 1, 'men.png', 1, NULL, NULL),
(363, 'Arun Chacko', 'BS0007', 16, '2008-01-08', 'arun.chacko@bourntec.com', 9645084841, 'male', 'Kochi', 1, NULL, 'active', 1, 'men.png', 1, NULL, NULL),
(364, 'Nince Chellappen', 'BS0019', 15, '2011-01-03', 'nince.chellappan@bourntec.com', 9447578581, 'male', 'Kochi', 1, NULL, 'active', 3, 'men.png', 1, NULL, NULL),
(365, 'Rakesh Ravindran', 'BS0033', 9, '2011-08-29', 'Rakesh.r@bourntec.com ', 86064, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(366, 'Joseph C A', 'BS0034', 9, '2011-11-01', 'joseph.ca@bourntec.com', 9847570338, 'male', 'Kochi', 1, NULL, 'active', 3, 'men.png', 1, NULL, NULL),
(367, 'Shelin Santhosh', 'BS0038', 30, '2013-01-21', 'shelin.santhosh@bourntec.com', 9526968986, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(368, 'Varun Kumar A', 'BS0046', 33, '2014-04-28', 'varun.kumar@bourntec.com', 9037666155, 'male', 'Kochi', 1, NULL, 'active', 5, 'men.png', 1, NULL, NULL),
(369, 'Sujithlal K C', 'BS0047', 30, '2014-07-01', 'sujithlal.kc@bourntec.com', 9946267635, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(370, 'ABIN P JOY', 'BS0048', 8, '2014-06-16', 'abin.joy@bourntec.com', 9633718602, 'male', 'Kochi', 1, NULL, 'active', 3, 'men.png', 1, NULL, NULL),
(371, 'Melvin Moses', 'BS0049', 30, '2014-07-10', 'melvin.moses@bourntec.com', 9656568162, 'male', 'Kochi', 1, NULL, 'active', 1, 'men.png', 1, NULL, NULL),
(372, 'Gireesh Gopinath', 'BS0051', 30, '2015-07-15', 'gireesh.gopinath@bourntec.com', 94464, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(373, 'RESHMA PURUSHOTHAMAN', 'BS0055', 30, '2014-10-20', 'reshma.p@bourntec.com', 9544929748, 'female', 'Kochi', 1, NULL, 'active', 2, 'default-women.png', 1, NULL, NULL),
(374, 'LINTO THOMAS', 'BS0060', 7, '2015-07-13', 'linto.thomas@bourntec.com', 9946086904, 'male', 'Kochi', 1, NULL, 'active', 4, 'men.png', 1, NULL, NULL),
(375, 'MITHUN RAJ E K', 'BS0061', 30, '2015-07-06', 'mithun.raj@bourntec.com', 9562183533, 'male', 'Kochi', 1, NULL, 'active', 5, 'men.png', 1, NULL, NULL),
(376, 'Amal Chandra N A', 'BS0063', 30, '2015-09-28', 'Amal.chandra@bourntec.com', 9496850614, 'male', 'Kochi', 1, NULL, 'active', 2, 'men.png', 1, NULL, NULL),
(377, 'PRASHITH CHITHRANGADAN', 'BS0064', 30, '2016-11-16', 'prashith.c@bourntec.com', 9526438864, 'male', 'Kochi', 1, NULL, 'active', 2, 'men.png', 1, NULL, NULL),
(378, 'Shanu K K', 'BS0066', 30, '2015-12-15', 'shanu.kk@bourntec.com', 9656153432, 'female', 'Kochi', 1, NULL, 'active', 2, 'default-women.png', 1, NULL, NULL),
(379, 'NITHIN K P', 'BS0069', 28, '2016-04-25', 'nithin.kp@bourntec.com', 9846633771, 'male', 'Kochi', 1, NULL, 'active', 2, 'men.png', 1, NULL, NULL),
(380, 'Teenu Kuriakose', 'BS0072', 31, '2016-07-11', 'teenu.k@bourntec.com', 9656792472, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(381, 'Vipin MS', 'BS0074', 31, '2017-02-07', 'vipin.ms@bourntec.com', 9526580411, 'male', 'Kochi', 1, NULL, 'active', 3, 'men.png', 1, NULL, NULL),
(382, 'Nisha S Nair', 'BS0076', 31, '2017-11-08', 'nisha.surendran@bourntec.com', 9746069346, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(383, 'Reeba Mary Kurien', 'BS0078', 5, '2018-08-01', 'reeba.kurien@gmail.com', 9447391092, 'female', 'Kochi', 1, NULL, 'active', 11, 'default-women.png', 1, NULL, NULL),
(384, 'Manu Krishnan K', 'BS0079', 31, '2018-08-13', 'manu.krishnan@bourntec.com', 8281025623, 'male', 'Kochi', 1, NULL, 'active', 1, 'men.png', 1, NULL, NULL),
(385, 'Meenu Mohan', 'BS0080', 31, '2018-08-13', 'meenu.mohan@bourntec.com', 7025045332, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(386, 'Rinimol Antony', 'BS0081', 31, '2018-08-13', 'rinimol.antony@bourntec.com', 0, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(387, 'Akhil Anil', 'BS0082', 31, '2018-11-26', 'akhil.anil@bourntec.com', 8943041636, 'male', 'Kochi', 1, NULL, 'active', 1, 'men.png', 1, NULL, NULL),
(388, 'Nidheesh Kamal', 'BS0083', 31, '2018-11-14', 'nidheesh.kamal@bourntec.com', 9207004869, 'male', 'Kochi', 1, NULL, 'active', 2, 'men.png', 1, NULL, NULL),
(389, 'Jinto Varghese', 'BS0084', 31, '2019-11-04', 'jinto.varghese@bourntec.com', 9645494805, 'male', 'Kochi', 1, NULL, 'active', 2, 'men.png', 1, NULL, NULL),
(390, 'Joe Joseph', 'BS0085', 31, '2020-03-02', 'joe.joseph@bourntec.com', 9947062844, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(391, 'TINU K MATHEW', 'BS0086', 31, '2019-11-04', 'tinu.mathew@bourntec.com', 9495097607, 'male', 'Kochi', 1, NULL, 'active', 3, 'men.png', 1, NULL, NULL),
(392, 'Naveen Radhakrishnan', 'BS0087', 31, '2020-02-17', 'naveen.krishna@bourntec.com', 9745464962, 'male', 'Kochi', 1, NULL, 'active', 2, 'men.png', 1, NULL, NULL),
(393, 'Abin M U\n', 'BS0088', 1, '2020-03-02', 'abin.ullas@bourntec.com ', 9486491901, 'male', 'Kochi', 1, NULL, 'active', 4, 'men.png', 1, NULL, NULL),
(394, 'Athulya Sajeev\n', 'BS0089', 31, '2020-03-11', 'athulya.sajeev@bourntec.com', 7994914690, 'female', 'Kochi', 1, NULL, 'active', 3, 'default-women.png', 1, NULL, NULL),
(395, 'Anoop V S', 'BS0091', 18, '2020-06-07', 'anoop.vs@bourntec.com', 9946280402, 'male', 'Kochi', 1, NULL, 'active', 13, 'men.png', 1, NULL, NULL),
(396, 'Babu Varghese', 'BS0095', 18, '2020-07-06', 'babu.varughese@bourntec.com', 9446054578, 'male', 'Kochi', 1, NULL, 'active', 12, 'men.png', 1, NULL, NULL),
(397, 'Abhijith Lenin', 'BS0096', 2, '2020-07-01', 'abhijith.lenin@bourntec.com', 7907849841, 'male', 'Kochi', 1, NULL, 'active', 5, 'men.png', 1, NULL, NULL),
(398, 'Anish K George', 'BS0097', 11, '2020-10-12', 'anish.george@bourntec.com', 9447317348, 'male', 'Kochi', 1, NULL, 'active', 10, 'men.png', 1, NULL, NULL),
(399, 'Shijin Thomas', 'BS0098', 31, '2020-10-19', 'shijin.thomas@bourntec.com', 8086789123, 'male', 'Kochi', 1, NULL, 'active', 14, 'men.png', 1, NULL, NULL),
(400, 'Sreeraj S J', 'BS0100', 31, '2020-10-12', 'sreeraj.s@bourntec.com', 8129396543, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(401, 'Deepak D', 'BS0101', 3, '2020-10-01', 'deepak.d@bourntec.com', 8089905335, 'male', 'Kochi', 1, NULL, 'active', 6, 'men.png', 1, NULL, NULL),
(402, 'POORNIMA UNNIKRISHNAN', 'BS0105', 31, '2020-12-01', 'poornima.unnikrishnan@bourntec.com', 9495770811, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(403, 'Manju Mathew                            ', 'BS0106', 25, '2021-01-04', 'manju.mathew@bourntec.com', 8281093308, 'female', 'Kochi', 1, NULL, 'active', 3, 'default-women.png', 1, NULL, NULL),
(404, 'Devadath VV                                                             ', 'BS0109', 26, '2020-12-16', 'devadath.vasudevan@bourntec.com', 9642524926, 'male', 'Kochi', 1, NULL, 'active', 8, 'men.png', 1, NULL, NULL),
(405, 'Jimmy Jose                   ', 'BS0111', 31, '2021-01-11', 'jimmy.jose@bourntec.com', 9809894453, 'female', 'Kochi', 1, NULL, 'active', 6, 'default-women.png', 1, NULL, NULL),
(406, 'Soorya K                                                 ', 'BS0112', 26, '2021-01-13', 'soorya.k@bourntec.com', 9605905352, 'female', 'Kochi', 1, NULL, 'active', 4, 'default-women.png', 1, NULL, NULL),
(407, 'Simi Sam George                                     ', 'BS0114', 28, '2021-03-23', 'simi.sam@bourntec.com', 9567350247, 'female', 'Kochi', 1, NULL, 'active', 7, 'default-women.png', 1, NULL, NULL),
(408, 'Thomas Mathew', 'BS0116', 20, '2021-04-19', 'thomas.mathew@bourntec.com', 7406798807, 'male', 'Kochi', 1, NULL, 'active', 3, 'men.png', 1, NULL, NULL),
(409, 'Gouthami V.S', 'BS0118', 31, '2021-06-14', 'gouthami.v@bourntec.com', 9526983102, 'female', 'Kochi', 1, NULL, 'active', 15, 'default-women.png', 1, NULL, NULL),
(410, 'Anto k Antony', 'BS0120', 31, '2021-04-19', 'anto.antony@bourntec.com', 9895575590, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(411, 'Ahkin Jacob                                               ', 'BS0122', 29, '2021-04-05', 'ahkin.jacob@bourntec.com', 9567124638, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(412, 'Greeshma Jayan                                            ', 'BS0123', 29, '2021-04-05', 'greeshma.jayan@bourntec.com', 9846047326, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(413, 'Jini Thomas                                                    ', 'BS0124', 29, '2021-04-05', 'jini.thomas@bourntec.com', 7559834190, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(414, 'Namitha S                                                       ', 'BS0125', 29, '2021-04-05', 'namitha.s@bourntec.com', 9074913885, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(415, 'Minu N Sunil                                                   ', 'BS0126', 29, '2021-04-05', 'minu.sunil@bourntec.com', 9495051205, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(416, 'Akshay R M                                               ', 'BS0127', 29, '2021-04-05', 'akshay.rm@bourntec.com', 7593079701, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(417, 'Balaji V Shenoi                                           ', 'BS0128', 29, '2021-04-05', 'balaji.shenoi@bourntec.com', 9074264890, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(418, 'Sajin  P S                                            ', 'BS0129', 29, '2021-04-05', 'sajin.ps@bourntec.com', 7403653383, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(419, 'Maneesha Mohan                                          ', 'BS0130', 29, '2021-04-05', 'maneesha.mohan@bourntec.com', 9048876776, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(420, 'Vivek  P Varghese                                     ', 'BSO131', 29, '2021-04-05', 'vivek.varghese@bourntec.com', 95268, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(421, 'Ashapriya Sebastian                                      ', 'BS0132', 29, '2021-04-05', 'ashapriya.s@bourntec.com', 9496124194, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(422, 'Dhanesh C P                                            ', 'BS0133', 29, '2021-04-05', 'dhanesh.cp@bourntec.com', 9495269828, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(423, 'Aldrin Sunny', 'BS0134', 29, '2021-04-05', 'aldrin.sunny@bourntec.com', 94007, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(424, 'Honeymol Varghese                              ', 'BS0136', 29, '2021-04-12', 'honeymol.v@bourntec.com', 9495484218, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(425, 'Rubin Raj                                            ', 'BS0137', 29, '2021-04-12', 'rubin.raj@bourntec.com', 9400421460, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(426, 'Shon Koshy Shaji                                  ', 'BS0138', 29, '2021-04-12', 'shon.shaji@bourntec.com', 9497374083, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(427, 'Aryalekshmi P.S', 'BS0139', 32, '2021-04-13', 'Aryalakshmi.p@bourntec.com', 9037744386, 'female', 'Kochi', 1, NULL, 'active', 1, 'default-women.png', 1, NULL, NULL),
(428, 'Kiran A                                                      ', 'BS0140', 31, '2021-04-19', 'kiran.a@bourntec.com', 9744663023, 'male', 'Kochi', 1, NULL, 'active', 3, 'men.png', 1, NULL, NULL),
(429, 'Sanoj Mathew Vaidyan                             ', 'BS0151', 31, '2021-09-01', 'sanoj.mathew@bourntec.com', 9400975851, 'male', 'Kochi', 1, NULL, 'active', 8, 'men.png', 1, NULL, NULL),
(430, 'Renjith George', 'BS0153', 17, '2021-08-16', 'renjith.george@bourntec.com', 9946549300, 'male', 'Kochi', 1, NULL, 'active', 1, 'men.png', 1, NULL, NULL),
(431, 'Saiju J Paul', 'BS0158', 12, '2021-08-02', 'saiju.paul@bourntec.com', 9846888321, 'male', 'Kochi', 1, NULL, 'active', 14, 'men.png', 1, NULL, NULL),
(432, 'Nisha V Alias', 'BS0159', 30, '2021-08-02', 'nisha.alias@bourntec.com', 8547444380, 'female', 'Kochi', 1, NULL, 'active', 12, 'default-women.png', 1, NULL, NULL),
(433, 'Manju K J                                                ', 'BS0160', 30, '2021-07-19', 'manju.kj@bourntec.com', 9947436593, 'female', 'Kochi', 1, NULL, 'active', 17, 'default-women.png', 1, NULL, NULL),
(434, 'Kannan KS', 'BS0162', 31, '2021-07-19', 'kannan.ks@bourntec.com', 9895480082, 'male', 'Kochi', 1, NULL, 'active', 10, 'men.png', 1, NULL, NULL),
(435, 'Anandu Babu                                                  ', 'BS0163', 31, '2021-09-13', 'anandu.babu@bourntec.com', 8606042430, 'male', 'Kochi', 1, NULL, 'active', 2, 'men.png', 1, NULL, NULL),
(436, 'Jose Eldhose                                           ', 'BS0164', 31, '2021-10-04', 'jose.eldhose@bourntec.com', 9539561926, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(437, 'Emiya Tony                                                    ', 'BS0167', 32, '2021-09-01', 'emiya.tony@bourntec.com', 9496942968, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(438, 'Anitha T R                                                       ', 'BS0168', 32, '2021-09-01', 'anitha.tr@bourntec.com', 8590098900, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(439, 'Algy Rachel Mathew', 'BS0169', 32, '2021-09-01', 'algy.mathew@bourntec.com', 8547989184, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(440, 'Parameshwaran S                                           ', 'BS0170', 32, '2021-09-01', 'parameshwaran.s@bourntec.com', 9020406800, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(441, 'Amal P Varghese                                        ', 'BS0171', 32, '2021-09-01', 'amal.vargheses@bourntec.com', 6238132464, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(442, 'Jithu John                                        ', 'BS0172', 32, '2021-09-01', 'jithu.john@bourntec.com', 9846064903, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(443, 'Kishan C                                                         ', 'BS0173', 32, '2021-09-01', 'kishan.c@bourntec.com', 7558998976, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(444, 'Anandu Jayakumar                                        ', 'BS0174', 32, '2021-09-01', 'anandu.j@bourntec.com', 8921261058, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(445, 'Aswathy S', 'BS0175', 32, '2021-09-01', 'aswathy.s@bourntec.com', 8157995239, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(446, 'Kiran Gopi                                                 ', 'BS0176', 32, '2021-09-01', 'kiran.gopi@bourntec.com', 8129889199, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(447, 'Malu M                                                           ', 'BS0178', 32, '2021-09-01', 'malu.m@bourntec.com', 9061406720, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(448, 'Jeena M Roy                                        ', 'BS0179', 32, '2021-09-01', 'jeena.roy@bourntec.com', 9544924798, 'female', 'Kochi', 1, NULL, 'active', 1, 'default-women.png', 1, NULL, NULL),
(449, 'Karthik Vasudevan                                    ', 'BS0180', 32, '2021-09-06', 'karthik.v@bourntec.com', 7559893709, 'male', 'Kochi', 1, NULL, 'active', 3, 'men.png', 1, NULL, NULL),
(450, 'Liju Thomas                                             ', 'BS0181', 8, '2021-09-06', 'liju.thomas@bourntec.com', 9611437151, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(451, 'MIDHUN DAS', 'BS0182', 2, '2021-11-29', 'midhun.das@bourntec.com', 8907929204, 'male', 'Kochi', 1, NULL, 'active', 1, 'men.png', 1, NULL, NULL),
(452, 'Ashin Sajan                                                     ', 'BS0183', 32, '2021-09-20', 'ashin.sajan@bourntec.com', 8547470063, 'male', 'Kochi', 1, NULL, 'active', 6, 'men.png', 1, NULL, NULL),
(453, 'Arun Alias                                                                                                           ', 'BS0184', 14, '2021-11-08', 'arun.alias@bourntec.com', 9645807779, 'male', 'Kochi', 1, NULL, 'active', 14, 'men.png', 1, NULL, NULL),
(454, 'Jomini Thomas                                                               ', 'BS0186', 24, '2021-10-19', 'jomini.thomas@bourntec.com', 9400682549, 'female', 'Kochi', 1, NULL, 'active', 14, 'default-women.png', 1, NULL, NULL),
(455, 'Sunish K Thankachan                                              ', 'BS0187', 12, '2021-12-01', 'sunish.thankachan@bourntec.com', 9447512252, 'male', 'Kochi', 1, NULL, 'active', 3, 'men.png', 1, NULL, NULL),
(456, 'Annmol Santhosh', 'BS0188', 20, '2022-01-01', 'annmol.santhosh@bourntec.com', 9495514455, 'female', 'Kochi', 1, NULL, 'active', 2, 'default-women.png', 1, NULL, NULL),
(457, 'Josny Jose                                                               ', 'BS0189', 19, '2022-01-01', 'josny.jose@bourntec.com', 9447666280, 'female', 'Kochi', 1, NULL, 'active', 14, 'default-women.png', 1, NULL, NULL),
(458, 'Shyam D', 'BS0190', 3, '2021-12-01', 'shyam.d@bourntec.com', 9544471499, 'male', 'Kochi', 1, NULL, 'active', 19, 'men.png', 1, NULL, NULL),
(459, 'Sandra B C', 'BS0191', 32, '2022-02-07', 'sandra.dhiraj@bourntec.com', 8921667645, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(460, 'Jeena Thomas', 'BS0192', 32, '2022-02-07', 'jeena.thomas@bourntec.com', 7034578708, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(461, 'Aravind', 'BS0193', 32, '2022-02-07', 'aravind.anand@bourntec.com', 8111942760, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(462, 'Allan George', 'BS0194', 32, '2022-02-07', 'allan.george@bourntec.com', 9746289255, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(463, 'P H Nandu Krishna', 'BS0195', 32, '2022-02-07', 'nandu.krishna@bourntec.com', 9995415296, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(464, 'Esther Tomy', 'BS0196', 32, '2022-02-07', 'esther.tomy@bourntec.com', 6282835386, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(465, 'Rahul V R', 'BS0197', 32, '2022-02-07', 'rahul.vr@bourntec.com', 9037993964, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(466, 'Rohini P M', 'BS0198', 32, '2022-02-07', 'rohini.pm@bourntec.com', 9496188891, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(467, 'Jinsa Susan Jose', 'BS0199', 32, '2022-02-07', 'jinsa.jose@bourntec.com', 8547414127, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(468, 'Sarath G  Krishnan', 'BS0200', 32, '2022-02-07', 'sarath.krishnan@bourntec.com', 9074612632, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(469, 'Karthika J', 'BS0201', 32, '2022-02-07', 'karthika.j@bourntec.com', 7510903100, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(470, 'Nickson K Thomas', 'BS0202', 32, '2022-02-07', 'nickson.thomas@bourntec.com', 7012970842, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(471, 'Ginson Roice', 'BS0203', 32, '2022-02-07', 'ginson.roice@bourntec.com', 8848091309, 'male', 'Kochi', 1, NULL, 'active', 0, 'men.png', 1, NULL, NULL),
(472, 'Anju P B', 'BS0204', 32, '2022-02-07', 'anju.pb@bourntec.com', 9544680432, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(473, 'Praveena Prasannakumar', 'BS0205', 32, '2022-02-07', 'praveena.p@bourntec.com', 9074041592, 'female', 'Kochi', 1, NULL, 'active', 0, 'default-women.png', 1, NULL, NULL),
(474, 'Neethu Peter', 'BS0206', 31, '2022-03-16', 'neethu.peter@bourntec.com', 9526965149, 'female', 'Kochi', 1, NULL, 'active', 3, 'default-women.png', 1, NULL, NULL),
(475, 'Ananda Krishnan MD', 'BS0207', 31, '2022-04-18', 'anandakrishnan.md@bourntec.com', 7012974095, 'female', 'Kochi', 1, NULL, 'active', 3, 'default-women.png', 1, NULL, NULL),
(476, 'Sangeeth P Karun', 'BS0208', 31, '2022-04-09', '', 0, 'male', '', 1, NULL, 'active', 3, 'men.png', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_employee_designation_log`
--

CREATE TABLE `audit_employee_designation_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_employye_id` bigint(20) UNSIGNED NOT NULL,
  `fk_created_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_employee_head`
--

CREATE TABLE `audit_employee_head` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_emp_reporting` bigint(20) UNSIGNED NOT NULL,
  `fk_emp_functional_manager` bigint(20) UNSIGNED NOT NULL,
  `fk_created_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_employee_skillset`
--

CREATE TABLE `audit_employee_skillset` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_emp_id` bigint(20) UNSIGNED NOT NULL,
  `primary_skill` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_skill` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_employee_skillset`
--

INSERT INTO `audit_employee_skillset` (`id`, `fk_emp_id`, `primary_skill`, `secondary_skill`, `created_at`, `updated_at`) VALUES
(359, 359, 'Delivery', 'Process Management', NULL, NULL),
(360, 360, 'Java', '', NULL, NULL),
(361, 361, 'Java', 'Python', NULL, NULL),
(362, 362, 'Java', 'Oracle, Apache Tomcat , JBOSS, Spring, AWS,API Gateway', NULL, NULL),
(363, 363, 'Aws,Java,SpringBoot,REST,Spring Boot Microservices,Spring Security,Hibernate,JPA,J2EE,Elastic Search,Oracle,Mysql,PostgreSQL', 'JSP,SERVLET,AngularJS,Angular 7,HTML,CSS,Jquery,JavaScript,ANT,CVS,GIT,Aribaweb,JBOSS Application Server,WildFly,Tomcat,Sun App Server,Jenkins', NULL, NULL),
(364, 364, 'Java', 'JSF,Angular,Primefaces,PostgressSQL,Sybase,CSS', NULL, NULL),
(365, 365, 'Testing', 'Automation, Scrum Master', NULL, NULL),
(366, 366, 'QA', '', NULL, NULL),
(367, 367, 'Testing', '', NULL, NULL),
(368, 368, 'Process excellence, Portfolio, ITIL , ITSM, Projects In Controlled Environment (Prince 2), Agile, Lean, Scaled Agile Framework', ' Service Management, Process Management, Strategy Planning , System Analysis ,Lean process management', NULL, NULL),
(369, 369, 'Java', '', NULL, NULL),
(370, 370, 'ORACLE CLOUD INFRA', 'NETWORKING ', NULL, NULL),
(371, 371, 'Java', '', NULL, NULL),
(372, 372, 'Java', 'Microservice,spring ', NULL, NULL),
(373, 373, 'Java', 'Microservice,spring validator,StateMachine,Amazon AWS & S3Bucket,Node JS,MongoDB,Docker,Spring Security,Oracle', NULL, NULL),
(374, 374, 'React JS, JavaScript, HTML, CSS', 'Bootstrap, Photoshop, Illustrator', NULL, NULL),
(375, 375, 'Java, Angular', 'SPRING BOOT, STRAPI, MYSQL, ELASTIC SEARCH, CSS3, BOOTSTRAP, WIJMO, ', NULL, NULL),
(376, 376, 'Java, Angular', 'PostgresSQL,Jquery,JS,CSS3,Primefaces,', NULL, NULL),
(377, 377, 'Java', 'Node JS, AWS', NULL, NULL),
(378, 378, 'PHP,Mysql,Laravel,Wordpress', 'React,Jquery,Drupal', NULL, NULL),
(379, 379, 'Manual Testing', 'API testing, SQL, STLC', NULL, NULL),
(380, 380, 'Java, Angular', '', NULL, NULL),
(381, 381, 'Java, Angular', 'Spring, MySql, JS, Hibernet, springboot', NULL, NULL),
(382, 382, 'Java', 'PostgresSQL, Spring Boot,  Power BI', NULL, NULL),
(383, 383, 'Software Testing- API,Performance,Functional,UI and Website Management', 'Project Management, Administrative Management', NULL, NULL),
(384, 384, 'Java, Angular', 'MySQL, Elasticsearch, Angular JS, ', NULL, NULL),
(385, 385, 'Java, Angular', 'Apex, Salesforce, Database', NULL, NULL),
(386, 386, 'Java, Angular', 'PostgresSQL', NULL, NULL),
(387, 387, 'Python | Django | Flask | FastAPI', 'AWS, Git , Elasticsearch , Serverless , Docker , MySQL , PostgreSQL , HTML , CSS , Bootstrap , Angular', NULL, NULL),
(388, 388, 'Java, Angular', 'python ,nodejs,reactjs', NULL, NULL),
(389, 389, 'Java', 'Elastic search, Mysql, Jenkins', NULL, NULL),
(390, 390, 'Java', 'Node JS', NULL, NULL),
(391, 391, 'spring boot', 'sql', NULL, NULL),
(392, 392, 'Java', 'Node Js,AWS', NULL, NULL),
(393, 393, 'Networking, System Administrator ', 'Cloud , Windows Server Administration', NULL, NULL),
(394, 394, 'Java, Angular', 'Jenkins, Docker, Elasticsearch, ActiveMQ, Drools, Oracle, MYSql, XSLT, Django, Springboot, Ariba, JSP, JS, XML, Python', NULL, NULL),
(395, 395, 'Java', 'AWS', NULL, NULL),
(396, 396, 'Java', 'AWS', NULL, NULL),
(397, 397, 'AWS, AZURE CICD Docker K8s Openshift, CLoud and Linux', '', NULL, NULL),
(398, 398, '.Net, MS SQL', '', NULL, NULL),
(399, 399, '.Net, .net Core', 'Entity framework,  Mssql, html, css, js', NULL, NULL),
(400, 400, '.Net developer', 'Sql', NULL, NULL),
(401, 401, 'Java, Angular', 'AWS, Javascript, SQL', NULL, NULL),
(402, 402, 'Software Development', 'Software Testing', NULL, NULL),
(403, 403, 'HTML/HTML5, CSS3, JQuery,Boostarp', 'SASS, , java Script, Figma, Photoshop, Illustrator, react', NULL, NULL),
(404, 404, 'Machine Learning', 'Python, NLP', NULL, NULL),
(405, 405, 'Angular', 'javascript,nodejs', NULL, NULL),
(406, 406, 'Machine Learning', 'Python, DL, NLP', NULL, NULL),
(407, 407, 'Test Case Preparation, Understanding Manual testing process', 'Defect Tracking Tools (JIRA, Redmine and DevOps), JMeter, Selenium basics', NULL, NULL),
(408, 408, 'Microsoft Dynamics GP', 'D365 CE, VBA, SSRS, SmartConnect, Management Reporter, Integration Manager, SQL Server', NULL, NULL),
(409, 409, '.Net developer', 'Angular Developer', NULL, NULL),
(410, 410, 'Node JS', 'Power BI, React JS', NULL, NULL),
(411, 411, 'Node JS', 'PostgresSQL', NULL, NULL),
(412, 412, 'Java, Angular', 'Kendo', NULL, NULL),
(413, 413, 'Java, Angular', 'Kendo, Unqork', NULL, NULL),
(414, 414, 'Node JS', 'SQL', NULL, NULL),
(415, 415, 'Python', 'Elasticsearch,Flask', NULL, NULL),
(416, 416, 'Java, Angular', 'SQL, JS, JSP', NULL, NULL),
(417, 417, 'Java', 'Spring, Spring Boot, Elasticsearch', NULL, NULL),
(418, 418, 'Java', 'Unqork, SQL', NULL, NULL),
(419, 419, 'Java, Angular', 'Python,JavaScript,SQL,React JS', NULL, NULL),
(420, 420, 'Java, Spring Boot ,MYSQL', 'Angular', NULL, NULL),
(421, 421, 'Python', 'Elasticsearch, Flask', NULL, NULL),
(422, 422, 'Java, Angular', 'Kendo,Unqork', NULL, NULL),
(423, 423, 'Java, MySQL', 'Angular', NULL, NULL),
(424, 424, 'Java, Angular', '', NULL, NULL),
(425, 425, 'Python', 'Elasticsearch, pandas, Flask', NULL, NULL),
(426, 426, 'Python', 'Angular', NULL, NULL),
(427, 427, 'Java', 'Angular', NULL, NULL),
(428, 428, 'Python', 'ML', NULL, NULL),
(429, 429, 'Python, Web Frameworks and Testing Frameworks', 'Data Science, Front end technology', NULL, NULL),
(430, 430, 'Project Management ', 'J2EE', NULL, NULL),
(431, 431, 'Microsoft .NET Technologies', 'Microsoft SQL  ', NULL, NULL),
(432, 432, '.Net core Web API', 'SQL Server', NULL, NULL),
(433, 433, '.Net Web Apps', 'SQL, Linq', NULL, NULL),
(434, 434, '.Net C# MVC SQL', 'jQuery, JavaScript', NULL, NULL),
(435, 435, 'Java, Angular', 'PLSQL,JS,JSP', NULL, NULL),
(436, 436, 'Java', 'PLSQL,JS,JSP', NULL, NULL),
(437, 437, '.Net, Angular', 'SQL, HTML, JavaScript', NULL, NULL),
(438, 438, '.Net, React', 'SQL, Linq', NULL, NULL),
(439, 439, 'PowerApps, .Net', 'HTML,CSS,Javascript,SQL', NULL, NULL),
(440, 440, 'Powerapps,Python', 'Dotnet', NULL, NULL),
(441, 441, 'Java', '', NULL, NULL),
(442, 442, 'Python,ReactJS', 'SQL, HTML, CSS,JavaScript', NULL, NULL),
(443, 443, 'React, Python', 'SQL,datascience, ML', NULL, NULL),
(444, 444, 'Powerapps,.Net', 'SQL, HTML, CSS,JavaScript', NULL, NULL),
(445, 445, 'Python, Angular', 'Dotnet', NULL, NULL),
(446, 446, 'React, Python', 'data science,ML, HTML,CSS', NULL, NULL),
(447, 447, 'PowerApps,DotNet', 'SQL', NULL, NULL),
(448, 448, 'PowerApps,.Net', 'SQL,HTML,CSS,Javascript', NULL, NULL),
(449, 449, 'Python,Angular', 'SQL, HTML, CSS,JavaScript', NULL, NULL),
(450, 450, 'AWS', 'Linux', NULL, NULL),
(451, 451, 'Devops', 'OPENSHIFT,DOCKER,KUBERNETES,TERRAFORM', NULL, NULL),
(452, 452, '.Net, Angular', 'Python, react', NULL, NULL),
(453, 453, 'UI/UX, Graphic Design, Web Design', 'Presentation, Editing', NULL, NULL),
(454, 454, 'Angular,HTML,CSS', 'Kendo', NULL, NULL),
(455, 455, 'Java', 'SQL, JS, JSP', NULL, NULL),
(456, 456, '.Net, MS SQL', 'PowerApps', NULL, NULL),
(457, 457, 'Java', 'Spring Boot, Elastic Search, MySQL, HTML, SQL', NULL, NULL),
(458, 458, 'C#, Web Application, MVC, .NET Core', 'MSSQL, MySQL, WinForms', NULL, NULL),
(459, 459, 'Java', 'Python, HTML, SQL', NULL, NULL),
(460, 460, 'Java', 'JavaScript, HTML, SQL', NULL, NULL),
(461, 461, 'Java', 'Data Science, HTML, Python, SQL', NULL, NULL),
(462, 462, 'Java', 'SQL, HTML', NULL, NULL),
(463, 463, 'Java', 'JavaScript, Python, HTML', NULL, NULL),
(464, 464, 'Java', 'javaScript, SQL, Python, HTML', NULL, NULL),
(465, 465, 'Java', 'SQL, Python', NULL, NULL),
(466, 466, 'Java', 'Python, SQL', NULL, NULL),
(467, 467, 'Java', 'JavaScript, SQL', NULL, NULL),
(468, 468, 'Java', 'Python, SQL', NULL, NULL),
(469, 469, 'Java', 'Data Science AI, SQL, Python', NULL, NULL),
(470, 470, 'Java', 'SQL, Python', NULL, NULL),
(471, 471, 'Java', 'JavaScript, HTML, SQL', NULL, NULL),
(472, 472, 'Java', 'JavaScript, HTML, SQL', NULL, NULL),
(473, 473, 'Java', 'Django,javascript', NULL, NULL),
(474, 474, 'Manual Testing', 'Selenium basics, Postman,Jmeter, Python basics, Test case preparation', NULL, NULL),
(475, 475, 'Vulnerability Assessment and Penetration Testing', 'Networking and Infrastructure Management', NULL, NULL),
(476, 476, 'PowerApps,React JS,', 'SQL', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_holidays`
--

CREATE TABLE `audit_holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hol_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hol_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hol_date` date NOT NULL,
  `status` enum('active','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_holidays`
--

INSERT INTO `audit_holidays` (`id`, `hol_name`, `hol_day`, `hol_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mannam Jayanthi', 'Sunday', '2022-01-02', 'active', '2022-05-25 03:08:22', '2022-05-30 06:43:29'),
(2, 'Republic day', 'Wednesday', '2022-01-26', 'active', '2022-05-25 03:08:53', '2022-05-25 03:08:53'),
(3, 'Maha sivarathri', 'Tuesday', '2022-03-01', 'active', '2022-05-25 03:09:34', '2022-05-25 03:09:34'),
(4, 'Maundy thursday', 'Thursday', '2022-04-14', 'active', '2022-05-25 03:10:21', '2022-05-25 03:10:21'),
(5, 'Vishu', 'Friday', '2022-04-15', 'active', '2022-05-25 03:10:38', '2022-05-25 03:10:38'),
(6, 'Easter', 'Sunday', '2022-04-17', 'active', '2022-05-25 03:11:11', '2022-05-25 03:11:11'),
(7, 'Independence day', 'Monday', '2022-08-15', 'active', '2022-05-25 03:11:46', '2022-05-25 03:11:46'),
(8, 'Thiruvonam', 'Thursday', '2022-09-08', 'active', '2022-05-25 03:12:15', '2022-05-25 03:12:15'),
(9, 'Mahanavami', 'Tuesday', '2022-10-04', 'active', '2022-05-25 03:12:52', '2022-05-25 03:12:52'),
(10, 'Deepavali', 'Monday', '2022-10-24', 'active', '2022-05-25 03:14:08', '2022-05-25 03:14:08'),
(11, 'Christmas', 'Sunday', '2022-12-25', 'active', '2022-05-25 03:18:05', '2022-05-25 03:18:05'),
(12, 'Bhogi', 'Friday', '2022-01-14', 'active', '2022-05-25 03:18:50', '2022-05-25 03:18:50'),
(13, 'Holi', 'Friday', '2022-03-18', 'active', '2022-05-25 03:19:13', '2022-05-25 03:19:13'),
(14, 'Eid-al-fitr', 'Tuesday', '2022-05-03', 'active', '2022-05-25 03:19:47', '2022-05-25 03:19:47'),
(15, 'Dussehra', 'Wednesday', '2022-10-05', 'active', '2022-05-25 03:21:05', '2022-05-25 03:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `audit_holidays_calendar`
--

CREATE TABLE `audit_holidays_calendar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_hol_id` bigint(20) UNSIGNED NOT NULL,
  `hol_calendar_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hol_type` int(11) NOT NULL,
  `hol_location_project_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_holidays_calendar`
--

INSERT INTO `audit_holidays_calendar` (`id`, `fk_hol_id`, `hol_calendar_name`, `hol_type`, `hol_location_project_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kochi', 1, '1', 'Admin', '2022-05-25 03:22:42', '2022-05-25 03:22:42'),
(2, 1, 'Hyderabad', 1, '2', 'Admin', '2022-05-25 03:24:33', '2022-05-25 03:24:33'),
(3, 1, 'bhubaneswar', 1, '2', 'Admin', '2022-05-25 03:25:29', '2022-05-25 03:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `audit_org_type`
--

CREATE TABLE `audit_org_type` (
  `org_id` int(11) NOT NULL,
  `org_type` varchar(100) NOT NULL,
  `org_type_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_org_type`
--

INSERT INTO `audit_org_type` (`org_id`, `org_type`, `org_type_status`) VALUES
(1, 'Development', 1),
(2, 'Design', 1),
(3, 'Testing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `basic_information`
--

CREATE TABLE `basic_information` (
  `id` int(11) NOT NULL,
  `applied_date` date DEFAULT NULL,
  `post` varchar(100) DEFAULT NULL,
  `skillset` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `education` varchar(20) DEFAULT NULL,
  `total_exp` int(11) DEFAULT NULL,
  `ctc` int(11) DEFAULT NULL,
  `exp_ctc` int(11) DEFAULT NULL,
  `notice_prd` int(11) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `location` varchar(10) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `c_company` varchar(20) DEFAULT NULL,
  `domain_exp` int(11) DEFAULT NULL,
  `primary_skill` varchar(20) DEFAULT NULL,
  `sec_skill` varchar(20) DEFAULT NULL,
  `ref` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `job_id` int(11) NOT NULL DEFAULT 1,
  `title` varchar(20) NOT NULL DEFAULT 'JAVA DEVELOPER',
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `resume` varchar(500) DEFAULT NULL,
  `emp_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `basic_information`
--

INSERT INTO `basic_information` (`id`, `applied_date`, `post`, `skillset`, `email`, `contact_number`, `education`, `total_exp`, `ctc`, `exp_ctc`, `notice_prd`, `dob`, `location`, `name`, `c_company`, `domain_exp`, `primary_skill`, `sec_skill`, `ref`, `status`, `job_id`, `title`, `position`, `created_at`, `updated_at`, `resume`, `emp_status`) VALUES
(1, '2022-02-16', 'PHP Developer', 'PHP', 'mjshanukk@gmail.com', '1234567891', 'Btech', 2, 5, 6, 5, '2022-02-23', 'kochi', 'shanu', 'Bourntec', 5, NULL, NULL, 'reference', 'Inprogress', 1, 'JAVA DEVELOPER', 1, '2022-02-22 12:33:11', '2022-02-22 12:33:11', '1645513391.pdf', 1),
(2, '2022-02-24', 'PHP Developer', 'PHP', 'mjshanukk@gmail.com', '1234567891', 'Btech', 9, 10, 12, 10, '2022-02-24', 'kochi', 'Linto Thomas', 'Bourntec', 5, NULL, NULL, 'test', 'Release', 1, 'JAVA DEVELOPER', 1, '2022-02-22 12:35:02', '2022-02-22 12:35:02', '1645513502.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_company` int(11) NOT NULL,
  `branch_date` date NOT NULL,
  `branch_landline` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `branch_type`, `branch_code`, `branch_location`, `branch_email`, `branch_company`, `branch_date`, `branch_landline`, `created_at`, `updated_at`) VALUES
(1, 'Bourntec Kochi', 'Development', 'BK01', 'Kochi', 'kochi@bourntec.com', 1, '2022-04-28', 1524, '2022-05-25 03:03:34', '2022-05-26 23:12:08'),
(2, 'Bourntec Hyderabad', 'Development', 'BH02', 'Hyderabad', 'hyderabad@bourntec.com', 1, '2022-05-27', 1524, '2022-05-25 03:04:35', '2022-05-26 23:12:24'),
(3, 'Bourntec Bhubaneswar', 'Development', 'BB03', 'Bhubaneswar', 'bhubaneswar@bourntec.com', 1, '2022-05-27', 1524, '2022-05-25 03:06:06', '2022-05-26 23:22:10');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_log`
--

CREATE TABLE `candidate_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_can_id` int(11) NOT NULL,
  `status_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `whom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidate_log`
--

INSERT INTO `candidate_log` (`id`, `fk_can_id`, `status_name`, `created_at`, `updated_at`, `whom`) VALUES
(1, 1, 'Inprogress', '2022-02-03 07:14:16', '2022-02-03 07:14:16', 'admin'),
(2, 2, 'Inprogress', '2022-02-03 07:16:47', '2022-02-03 07:16:47', 'admin'),
(3, 3, 'Inprogress', '2022-02-03 12:53:46', '2022-02-03 12:53:46', 'admin'),
(4, 1, 'Schedule an Interview', '2022-02-08 09:24:56', '2022-02-08 09:24:56', 'admin'),
(5, 1, 'Offer letter genereted', '2022-02-10 09:25:17', '2022-02-10 09:25:17', 'admin'),
(6, 2, 'Schedule an Interview', '2022-02-14 04:52:35', '2022-02-14 04:52:35', 'admin'),
(7, 1, 'Inprogress', '2022-02-22 07:03:11', '2022-02-22 07:03:11', 'admin'),
(8, 2, 'Inprogress', '2022-02-22 07:05:02', '2022-02-22 07:05:02', 'admin'),
(9, 2, 'Schedule an Interview', '2022-02-22 07:05:32', '2022-02-22 07:05:32', 'admin'),
(10, 2, 'Offer letter genereted', '2022-02-22 07:05:49', '2022-02-22 07:05:49', 'admin'),
(11, 1, 'Rejected', '2022-06-15 12:42:07', '2022-06-15 12:42:07', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_branch_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_post` int(11) NOT NULL,
  `job_openings` int(11) NOT NULL,
  `job_experience` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_status` int(11) NOT NULL,
  `job_skillset` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_date_open` date NOT NULL,
  `job_date_close` date NOT NULL,
  `job_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `job_branch_id`, `job_id`, `job_post`, `job_openings`, `job_experience`, `job_status`, `job_skillset`, `job_date_open`, `job_date_close`, `job_location`, `job_description`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 2, '3', 1, 'php,aas,html', '2022-01-20', '2022-01-20', '1', 'test', '2022-01-20 04:51:44', '2022-05-30 05:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `job_post`
--

CREATE TABLE `job_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_post`
--

INSERT INTO `job_post` (`id`, `post_name`, `created_at`, `updated_at`) VALUES
(1, 'PHP Developer', NULL, NULL),
(2, 'Java Developer', NULL, NULL),
(3, 'Angular Developer', NULL, NULL),
(4, 'React Developer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2021_11_19_092642_create_organization_table', 1),
(12, '2021_11_30_071521_create_branches_table', 1),
(13, '2021_11_30_121908_create_job_post_table', 1),
(14, '2021_12_02_071548_create_job_table', 1),
(15, '2022_01_04_064430_create_status_information', 2),
(16, '2022_01_04_071552_create_candidate_log', 3),
(19, '2022_02_15_075539_create_audit_employee_table', 4),
(23, '2022_05_05_070731_create_audit_holidays_table', 5),
(24, '2022_05_05_073220_create_audit_holidays_calendar_table', 5),
(25, '2022_05_05_073638_create_audit_calendar_map_table', 5),
(26, '2022_05_17_085344_create_audit_department_table', 6),
(27, '2022_05_17_111850_create_audit_designation_table', 6),
(28, '2022_05_20_071246_create_audit_employee_basics_table', 7),
(29, '2022_05_20_082624_create_audit_employee_head_table', 7),
(30, '2022_05_20_084154_create_audit_employee_designation_log_table', 7),
(31, '2022_05_23_104930_create_audit_employee_skillset_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `offer_letter`
--

CREATE TABLE `offer_letter` (
  `offer_id` int(11) NOT NULL,
  `fk_can_id` int(11) NOT NULL,
  `offer_code` varchar(500) NOT NULL,
  `created_by` varchar(20) NOT NULL DEFAULT 'admin',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `offer_release_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_letter`
--

INSERT INTO `offer_letter` (`offer_id`, `fk_can_id`, `offer_code`, `created_by`, `created_at`, `offer_release_date`) VALUES
(1, 1, 'ENS/kakkanad/OL/20220210/20220312/201', 'admin', '2022-02-10 14:55:17', '2022-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `org_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_registration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `org_code`, `org_name`, `org_type`, `org_category`, `org_registration`, `org_location`, `created_at`, `updated_at`) VALUES
(1, 'B101', 'Bourntec', 'Company', 'IT service', '01800', 'India', '2022-05-25 03:02:28', '2022-05-30 06:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rejection_reason`
--

CREATE TABLE `rejection_reason` (
  `r_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `c_status` varchar(20) DEFAULT NULL,
  `reasons` varchar(30) DEFAULT NULL,
  `remarks` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rejection_reason`
--

INSERT INTO `rejection_reason` (`r_id`, `b_id`, `c_status`, `reasons`, `remarks`, `created_at`) VALUES
(1, 1, '1', 'personal reson', 'test', '2022-06-15 18:12:07');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_details`
--

CREATE TABLE `schedule_details` (
  `s_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `panelmembers` varchar(20) DEFAULT NULL,
  `interview_time` date DEFAULT NULL,
  `job_title` varchar(60) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `rating` varchar(5) DEFAULT NULL,
  `commemts` varchar(20) NOT NULL,
  `i_place` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_details`
--

INSERT INTO `schedule_details` (`s_id`, `b_id`, `panelmembers`, `interview_time`, `job_title`, `department`, `rating`, `commemts`, `i_place`) VALUES
(1, 1, 'testA,testB', '2022-02-09', 'Java Developer', 'Test', '5', 'test', 'kakkanad'),
(2, 2, 'testA,testB', '2022-02-24', 'Java Developer', 'Test', '5', 'test', 'kakkanad'),
(3, 2, 'testA,testB', '2022-02-24', 'Java Developer', 'Test', '5', 'test', 'kakkanad');

-- --------------------------------------------------------

--
-- Table structure for table `status_information`
--

CREATE TABLE `status_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `content` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL DEFAULT 'JAVA DEVELOPER',
  `name` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Inprogress',
  `Skill` varchar(100) NOT NULL DEFAULT 'HTML, CSS, JavaScript'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `content`, `title`, `name`, `status`, `Skill`) VALUES
(1, 'Dayle', 'JAVA DEVELOPER', '', 'Inprogress', 'HTML, CSS, JavaScript');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_calendar_map`
--
ALTER TABLE `audit_calendar_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_calendar_map_fk_hol_map_id_foreign` (`fk_hol_map_id`),
  ADD KEY `audit_calendar_map_fk_hol_id_foreign` (`fk_hol_id`);

--
-- Indexes for table `audit_department`
--
ALTER TABLE `audit_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_designation`
--
ALTER TABLE `audit_designation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_designation_fk_department_id_foreign` (`fk_department_id`);

--
-- Indexes for table `audit_employee`
--
ALTER TABLE `audit_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_employeeid`
--
ALTER TABLE `audit_employeeid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_employee_basics`
--
ALTER TABLE `audit_employee_basics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_employee_basics_emp_fk_des_id_foreign` (`emp_fk_des_id`),
  ADD KEY `audit_employee_basics_emp_holiday_calander_foreign` (`emp_holiday_calander`),
  ADD KEY `audit_employee_basics_emp_fk_dep_foreign` (`emp_fk_dep`);

--
-- Indexes for table `audit_employee_designation_log`
--
ALTER TABLE `audit_employee_designation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_employee_designation_log_fk_employye_id_foreign` (`fk_employye_id`),
  ADD KEY `audit_employee_designation_log_fk_created_id_foreign` (`fk_created_id`);

--
-- Indexes for table `audit_employee_head`
--
ALTER TABLE `audit_employee_head`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_employee_head_fk_emp_reporting_foreign` (`fk_emp_reporting`),
  ADD KEY `audit_employee_head_fk_emp_functional_manager_foreign` (`fk_emp_functional_manager`),
  ADD KEY `audit_employee_head_fk_created_id_foreign` (`fk_created_id`);

--
-- Indexes for table `audit_employee_skillset`
--
ALTER TABLE `audit_employee_skillset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_employee_skillset_fk_emp_id_foreign` (`fk_emp_id`);

--
-- Indexes for table `audit_holidays`
--
ALTER TABLE `audit_holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_holidays_calendar`
--
ALTER TABLE `audit_holidays_calendar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_holidays_calendar_fk_hol_id_foreign` (`fk_hol_id`);

--
-- Indexes for table `audit_org_type`
--
ALTER TABLE `audit_org_type`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `basic_information`
--
ALTER TABLE `basic_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_log`
--
ALTER TABLE `candidate_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_post`
--
ALTER TABLE `job_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_letter`
--
ALTER TABLE `offer_letter`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `rejection_reason`
--
ALTER TABLE `rejection_reason`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `schedule_details`
--
ALTER TABLE `schedule_details`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `status_information`
--
ALTER TABLE `status_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_calendar_map`
--
ALTER TABLE `audit_calendar_map`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `audit_department`
--
ALTER TABLE `audit_department`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_designation`
--
ALTER TABLE `audit_designation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `audit_employee`
--
ALTER TABLE `audit_employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_employeeid`
--
ALTER TABLE `audit_employeeid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `audit_employee_basics`
--
ALTER TABLE `audit_employee_basics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=477;

--
-- AUTO_INCREMENT for table `audit_employee_designation_log`
--
ALTER TABLE `audit_employee_designation_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_employee_head`
--
ALTER TABLE `audit_employee_head`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_employee_skillset`
--
ALTER TABLE `audit_employee_skillset`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=477;

--
-- AUTO_INCREMENT for table `audit_holidays`
--
ALTER TABLE `audit_holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `audit_holidays_calendar`
--
ALTER TABLE `audit_holidays_calendar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `audit_org_type`
--
ALTER TABLE `audit_org_type`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `basic_information`
--
ALTER TABLE `basic_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `candidate_log`
--
ALTER TABLE `candidate_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_post`
--
ALTER TABLE `job_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `offer_letter`
--
ALTER TABLE `offer_letter`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rejection_reason`
--
ALTER TABLE `rejection_reason`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule_details`
--
ALTER TABLE `schedule_details`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_information`
--
ALTER TABLE `status_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_calendar_map`
--
ALTER TABLE `audit_calendar_map`
  ADD CONSTRAINT `audit_calendar_map_fk_hol_id_foreign` FOREIGN KEY (`fk_hol_id`) REFERENCES `audit_holidays` (`id`),
  ADD CONSTRAINT `audit_calendar_map_fk_hol_map_id_foreign` FOREIGN KEY (`fk_hol_map_id`) REFERENCES `audit_holidays_calendar` (`id`);

--
-- Constraints for table `audit_designation`
--
ALTER TABLE `audit_designation`
  ADD CONSTRAINT `audit_designation_fk_department_id_foreign` FOREIGN KEY (`fk_department_id`) REFERENCES `audit_department` (`id`);

--
-- Constraints for table `audit_employee_basics`
--
ALTER TABLE `audit_employee_basics`
  ADD CONSTRAINT `audit_employee_basics_emp_fk_dep_foreign` FOREIGN KEY (`emp_fk_dep`) REFERENCES `audit_department` (`id`),
  ADD CONSTRAINT `audit_employee_basics_emp_fk_des_id_foreign` FOREIGN KEY (`emp_fk_des_id`) REFERENCES `audit_designation` (`id`),
  ADD CONSTRAINT `audit_employee_basics_emp_holiday_calander_foreign` FOREIGN KEY (`emp_holiday_calander`) REFERENCES `audit_holidays_calendar` (`id`);

--
-- Constraints for table `audit_employee_designation_log`
--
ALTER TABLE `audit_employee_designation_log`
  ADD CONSTRAINT `audit_employee_designation_log_fk_created_id_foreign` FOREIGN KEY (`fk_created_id`) REFERENCES `audit_holidays_calendar` (`id`),
  ADD CONSTRAINT `audit_employee_designation_log_fk_employye_id_foreign` FOREIGN KEY (`fk_employye_id`) REFERENCES `audit_holidays_calendar` (`id`);

--
-- Constraints for table `audit_employee_head`
--
ALTER TABLE `audit_employee_head`
  ADD CONSTRAINT `audit_employee_head_fk_created_id_foreign` FOREIGN KEY (`fk_created_id`) REFERENCES `audit_holidays_calendar` (`id`),
  ADD CONSTRAINT `audit_employee_head_fk_emp_functional_manager_foreign` FOREIGN KEY (`fk_emp_functional_manager`) REFERENCES `audit_employee_basics` (`id`),
  ADD CONSTRAINT `audit_employee_head_fk_emp_reporting_foreign` FOREIGN KEY (`fk_emp_reporting`) REFERENCES `audit_employee_basics` (`id`);

--
-- Constraints for table `audit_employee_skillset`
--
ALTER TABLE `audit_employee_skillset`
  ADD CONSTRAINT `audit_employee_skillset_fk_emp_id_foreign` FOREIGN KEY (`fk_emp_id`) REFERENCES `audit_employee_basics` (`id`);

--
-- Constraints for table `audit_holidays_calendar`
--
ALTER TABLE `audit_holidays_calendar`
  ADD CONSTRAINT `audit_holidays_calendar_fk_hol_id_foreign` FOREIGN KEY (`fk_hol_id`) REFERENCES `audit_holidays` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
