-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2022 at 11:24 AM
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
(1, 'shanu', 1, NULL, 218, '2022-03-12', 'shanu.kk@bourntec.com', NULL, NULL, NULL, NULL, '1aa143c5cc1e1614efec2594206aff3e', '2022-02-22 01:36:57', '2022-02-22 01:36:57');

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
(1, '2022-02-16', 'PHP Developer', 'PHP', 'mjshanukk@gmail.com', '1234567891', 'Btech', 2, 5, 6, 5, '2022-02-23', 'kochi', 'shanu', 'Bourntec', 5, NULL, NULL, 'reference', 'Inprogress', 1, 'JAVA DEVELOPER', 0, '2022-02-22 12:33:11', '2022-02-22 12:33:11', '1645513391.pdf', 1),
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
(1, 'B1', 'Development', 'S012', 'Kochi', 'encaps@bourntec.com', 1, '2022-02-10', 1524, '2022-02-03 01:41:27', '2022-02-03 01:41:27');

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
(10, 2, 'Offer letter genereted', '2022-02-22 07:05:49', '2022-02-22 07:05:49', 'admin');

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
(1, 1, 2, 1, 2, '3', 1, 'php,aas', '2022-01-20', '2022-01-20', '1', 'test', '2022-01-20 04:51:44', '2022-01-20 04:51:44');

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
(19, '2022_02_15_075539_create_audit_employee_table', 4);

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
(1, 'B101', 'Bourntec', 'Company', 'IT service', '01800', 'Kochi', '2022-02-03 01:39:50', '2022-02-03 01:39:50');

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
-- AUTO_INCREMENT for table `audit_employee`
--
ALTER TABLE `audit_employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audit_employeeid`
--
ALTER TABLE `audit_employeeid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidate_log`
--
ALTER TABLE `candidate_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
