-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 12:15 PM
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
  `post` varchar(60) DEFAULT NULL,
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
  `post_dummy` varchar(200) NOT NULL DEFAULT 'JAVA DEVELOPER',
  `title` varchar(20) NOT NULL DEFAULT 'JAVA DEVELOPER',
  `position` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `basic_information`
--

INSERT INTO `basic_information` (`id`, `applied_date`, `post`, `skillset`, `email`, `contact_number`, `education`, `total_exp`, `ctc`, `exp_ctc`, `notice_prd`, `dob`, `location`, `name`, `c_company`, `domain_exp`, `primary_skill`, `sec_skill`, `ref`, `status`, `post_dummy`, `title`, `position`) VALUES
(2, '2021-11-10', 'PHP Developer', 'PHP,mySQl', 'mjshanukk@gmail.com', '1234567891', 'Btech', 5, 5, 6, 5, '2021-11-11', 'kakkanad', 'shanu', 'cts', 5, 'JAVA,PHP', 'Testing', 'Test', 'Schedule', 'JAVA DEVELOPER', 'JAVA DEVELOPER', 1),
(3, '2021-11-24', 'Designer', 'PHP,mySQl', 'lintothomas15@gmail.com', '9846758425', 'Btech', 10, 5, 6, 9, '2021-11-17', 'kakkanad', 'Linto', '2', 5, 'jva,mysql', 'php,laravel', 'testing', 'Rejection', 'JAVA DEVELOPER', 'JAVA DEVELOPER', 3),
(12, NULL, 'UI/UX designer', 'Html,css', 'manjumathew@bourntec.com', '1234567891', 'Btech', 10, 5, 6, NULL, NULL, NULL, 'Manju Mathew', NULL, NULL, NULL, NULL, NULL, 'Waiting', 'JAVA DEVELOPER', 'JAVA DEVELOPER', 2),
(13, '2021-11-24', 'Java Developer', 'Java,php', 'mjshanukk@gmail.com', '1234567891', 'Btech', 10, 5, 6, 10, '2021-11-11', 'kochi', 'Test', 'kkj', 5, 'vb', 'bv', 'bv', 'Rejection', 'JAVA DEVELOPER', 'JAVA DEVELOPER', 2),
(17, '2021-11-11', '.Net Developer', '.net,mysql,java', 'testb@gmail.com', '1234567891', 'Btech', 10, 5, 6, 2, '2021-11-18', 'kochi', 'Test B', 'kkj', 5, 'jhs', 'asa', 'sas', 'Rejection', 'JAVA DEVELOPER', 'JAVA DEVELOPER', 1);

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
  `branch_date` datetime NOT NULL,
  `branch_landline` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 1, 1, 3, 2, '2', 0, 'php,aas', '2021-12-04', '2021-12-25', 'Kochi', 'xzxz bvbfdfd', '2021-12-02 02:25:05', '2021-12-03 05:42:35'),
(2, 1, 2, 2, 5, '5', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '2021-12-16', '2021-12-23', 'Kochi', 'asas', '2021-12-02 02:33:37', '2021-12-02 02:33:37');

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
(14, '2021_12_02_071548_create_job_table', 1);

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
  `reasons` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rejection_reason`
--

INSERT INTO `rejection_reason` (`r_id`, `b_id`, `c_status`, `reasons`) VALUES
(1, 1, 'test', 'rejected'),
(2, 2, 'test', 'rejected'),
(3, 3, 'test', 'rejected'),
(4, 1, NULL, NULL),
(5, 2, NULL, NULL),
(6, 3, NULL, NULL),
(7, 4, NULL, NULL),
(8, 5, NULL, NULL),
(9, 6, NULL, NULL),
(10, 7, NULL, NULL),
(11, 8, NULL, NULL),
(12, 9, NULL, NULL),
(13, 10, NULL, NULL),
(14, 11, NULL, NULL),
(15, 12, NULL, NULL),
(16, 13, NULL, NULL),
(17, 14, NULL, NULL),
(18, 15, NULL, NULL),
(19, 16, NULL, NULL),
(20, 17, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_details`
--

CREATE TABLE `schedule_details` (
  `s_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `panelmembers` varchar(20) DEFAULT NULL,
  `interview_time` varchar(20) DEFAULT NULL,
  `job_title` varchar(60) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `rating` varchar(5) NOT NULL,
  `commemts` varchar(20) NOT NULL,
  `i_place` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_details`
--

INSERT INTO `schedule_details` (`s_id`, `b_id`, `panelmembers`, `interview_time`, `job_title`, `department`, `rating`, `commemts`, `i_place`) VALUES
(1, 1, 'team A,Team B', '2021-10-04', 'test', 'Department', '5', 'test', 'kochi'),
(2, 2, 'team A,Team B', '2021-10-04', 'test', 'Department', '5', 'test', 'kochi'),
(3, 3, 'team A,Team B', '2021-10-04', 'test', 'Department', '5', 'test', 'kochi'),
(4, 1, 'ABC,CDF', '2021-11-04', 'Software Engineer', 'PHP', '5', 'test', 'KOCHi'),
(5, 2, 'ABC,CDE', '2021-11-10', 'php developer', 'Test', '5', 'test', 'kakkanad'),
(6, 3, 'ABC,CDE', '2021-11-09', 'Java Developer', 'Java', '5', 'test', 'kakkanad'),
(7, 4, 'ABC,CDE', '2021-11-09', 'Java Developer', 'Java', '5', 'test', 'kakkanad'),
(8, 5, 'ABC,CDE', '2021-11-09', 'Java Developer', 'Java', '5', 'test', 'kakkanad'),
(9, 6, 'ABC,CDE', '2021-11-09', 'Java Developer', 'Java', '5', 'test', 'kakkanad'),
(10, 7, NULL, NULL, NULL, NULL, '5', 'test', NULL),
(11, 8, NULL, NULL, NULL, NULL, '5', 'test', NULL),
(12, 9, NULL, NULL, NULL, NULL, '5', 'test', NULL),
(13, 10, NULL, NULL, NULL, NULL, '5', 'test', NULL),
(14, 11, NULL, NULL, NULL, NULL, '5', 'test', NULL),
(15, 12, 'ABC,CDE', '2021-11-18', 'UI/Ux designer', 'Test', '5', 'test', 'kakkanad'),
(16, 13, NULL, NULL, NULL, NULL, '5', 'test', NULL),
(17, 14, 'ABC,CDE', '2021-11-17', NULL, NULL, '5', 'test', 'kochi'),
(18, 15, NULL, NULL, NULL, NULL, '5', 'test', NULL),
(19, 16, NULL, NULL, NULL, NULL, '5', 'test', NULL),
(20, 17, 'ABC,CDE', '2021-11-12', NULL, NULL, '5', 'test', NULL);

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
-- AUTO_INCREMENT for table `audit_org_type`
--
ALTER TABLE `audit_org_type`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `basic_information`
--
ALTER TABLE `basic_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_post`
--
ALTER TABLE `job_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rejection_reason`
--
ALTER TABLE `rejection_reason`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `schedule_details`
--
ALTER TABLE `schedule_details`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
