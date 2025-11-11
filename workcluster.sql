-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2025 at 10:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workcluster`
--

-- --------------------------------------------------------

--
-- Table structure for table `direprojects`
--

CREATE TABLE `direprojects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `progress` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `direprojects`
--

INSERT INTO `direprojects` (`id`, `title`, `description`, `progress`, `created_at`) VALUES
(1, 'Mobile App', 'Redesign project', 75, '2025-07-08 04:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `date_uploaded` date DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `size`, `date_uploaded`, `icon`) VALUES
(1, 'Design Guide.pdf', '1.2 MB', '2025-07-23', 'doc.text');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `tag_code` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `system_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `noti`
--

CREATE TABLE `noti` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `noti`
--

INSERT INTO `noti` (`id`, `title`, `description`, `created_at`) VALUES
(1, 'Welcome', 'Your project dashboard is ready.', '2025-07-08 04:57:36'),
(2, 'Welcome', 'Your project dashboard is ready.', '2025-07-08 04:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `s_no` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `notification_id` int(255) NOT NULL,
  `message` longtext NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`s_no`, `user_id`, `notification_id`, `message`, `is_read`, `created_at`) VALUES
(3, 111272303, 575, 'This is a sample notification.', 0, '2025-06-03 06:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_items`
--

CREATE TABLE `portfolio_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` enum('image','video','document') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_settings`
--

CREATE TABLE `privacy_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `profile_visibility` enum('Public','Private') DEFAULT 'Public',
  `contact_information` enum('Everyone','Connections Only') DEFAULT 'Connections Only',
  `portfolio_access` enum('Public','Private','Connections Only') DEFAULT 'Public'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `selectedRole` varchar(100) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `dateOfBirth` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `maritalStatus` varchar(50) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `emailAddress` varchar(100) DEFAULT NULL,
  `permanentAddress` text DEFAULT NULL,
  `currentAddress` text DEFAULT NULL,
  `empId` varchar(50) DEFAULT NULL,
  `jobTitle` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `dateOfJoining` varchar(50) DEFAULT NULL,
  `reportingTo` varchar(100) DEFAULT NULL,
  `employeeType` varchar(50) DEFAULT NULL,
  `highestQualification` varchar(100) DEFAULT NULL,
  `yearOfPassing` varchar(20) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `previousCompany` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `skillsTechnologiesUsed` text DEFAULT NULL,
  `bankName` varchar(100) DEFAULT NULL,
  `accountNumber` varchar(50) DEFAULT NULL,
  `ifscCode` varchar(20) DEFAULT NULL,
  `panCardNumber` varchar(20) DEFAULT NULL,
  `aadharNumber` varchar(20) DEFAULT NULL,
  `passportNumber` varchar(20) DEFAULT NULL,
  `emergencyContactName` varchar(100) DEFAULT NULL,
  `emergencyContactRelation` varchar(50) DEFAULT NULL,
  `emergencyContactAddress` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `s_no` int(11) NOT NULL,
  `project_id` int(255) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('','Active','Completed','On-Going','Pending','Overdue') NOT NULL,
  `user_id` int(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`s_no`, `project_id`, `name`, `description`, `start_date`, `end_date`, `status`, `user_id`, `created_at`) VALUES
(3, 983, 'Test Project', 'This is a test project uploaded for testing purpose', '2025-06-03', '2025-06-03', 'Active', 111272303, '2025-06-03 06:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `s_no` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `project_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `role` enum('','Project Manager','Team Lead','UI/UX Designer','Front end Developer','Backend Developer','QA Tester','DevOps Engineer') NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`s_no`, `team_id`, `project_id`, `user_id`, `role`, `added_at`) VALUES
(5, 864, 983, 113829662, 'UI/UX Designer', '2025-06-03 10:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE `project_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`id`, `status`, `percentage`) VALUES
(1, 'Completed', 40.00),
(2, 'In Progress', 40.00),
(3, 'Delayed', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `project_tasks`
--

CREATE TABLE `project_tasks` (
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `due_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recent_documents`
--

CREATE TABLE `recent_documents` (
  `id` int(11) NOT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `date_uploaded` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recent_documents`
--

INSERT INTO `recent_documents` (`id`, `document_name`, `size`, `date_uploaded`, `icon`) VALUES
(1, 'Project Brief.pdf', '2.4 MB', 'Today', 'doc.richtext'),
(2, 'Design Assets.zip', '156 MB', 'Yesterday', 'archivebox'),
(3, 'Meeting Notes.doc', '875 KB', '2 days ago', 'doc.text');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `participants` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `s_no` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `date` date NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('','Submitted','Not Submitted','Pending') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`s_no`, `user_id`, `date`, `content`, `status`, `created_at`) VALUES
(1, 111272303, '2025-06-03', 'This is a sample report for testing purpose', 'Submitted', '2025-06-03 15:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `s_no` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `due_date` date NOT NULL,
  `priority` enum('','High','Low','Medium') NOT NULL,
  `status` enum('','Completed','Not Completed','Pending','Overdue') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `s_no` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `team_name` varchar(500) NOT NULL,
  `team_size` int(11) NOT NULL,
  `assigned_count` int(11) NOT NULL,
  `total_projects` int(11) NOT NULL,
  `ongoing_projects` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`s_no`, `team_id`, `team_name`, `team_size`, `assigned_count`, `total_projects`, `ongoing_projects`) VALUES
(1, 864, 'Team A', 8, 5, 10, '1');

-- --------------------------------------------------------

--
-- Table structure for table `team_tasks`
--

CREATE TABLE `team_tasks` (
  `id` int(11) NOT NULL,
  `quarter` varchar(10) DEFAULT NULL,
  `team` varchar(100) DEFAULT NULL,
  `task_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_tasks`
--

INSERT INTO `team_tasks` (`id`, `quarter`, `team`, `task_count`) VALUES
(1, 'Q1', 'Team A', 60),
(2, 'Q1', 'Team B', 75),
(3, 'Q1', 'Team C', 70),
(4, 'Q2', 'Team A', 80),
(5, 'Q2', 'Team B', 85),
(6, 'Q2', 'Team C', 78),
(7, 'Q3', 'Team A', 90),
(8, 'Q3', 'Team B', 88),
(9, 'Q3', 'Team C', 85),
(10, 'Q4', 'Team A', 95),
(11, 'Q4', 'Team B', 92),
(12, 'Q4', 'Team C', 90);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `tag_code` varchar(20) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `designation`, `date_of_birth`, `tag_code`, `phone_number`, `email_address`, `password`) VALUES
(1, 'Robert Downey JR', 'Android Developer', '', '', '9876543210', 'ironman@gmail.com', '$2y$10$0VLOCH2ymWU6zdEMWo6fZOmXmiP8rudVJpme8fz29YkZ.3hfqFth6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `s_no` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `full_name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone_number` varchar(500) NOT NULL,
  `password_hash` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `employee_type` varchar(50) DEFAULT NULL,
  `reporting_to` varchar(100) DEFAULT NULL,
  `highest_qualification` varchar(100) DEFAULT NULL,
  `year_of_passing` year(4) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `previous_companies` text DEFAULT NULL,
  `designations` text DEFAULT NULL,
  `duration` text DEFAULT NULL,
  `skills_used` text DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL,
  `pan_card_number` varchar(20) DEFAULT NULL,
  `aadhaar_number` varchar(20) DEFAULT NULL,
  `passport_number` varchar(20) DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_phone` varchar(20) DEFAULT NULL,
  `emergency_contact_relationship` varchar(50) DEFAULT NULL,
  `emergency_contact_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`s_no`, `user_id`, `user_type`, `full_name`, `email`, `phone_number`, `password_hash`, `created_at`, `date_of_birth`, `gender`, `marital_status`, `nationality`, `permanent_address`, `current_address`, `employee_id`, `job_title`, `department`, `date_of_joining`, `employee_type`, `reporting_to`, `highest_qualification`, `year_of_passing`, `university`, `specialization`, `previous_companies`, `designations`, `duration`, `skills_used`, `bank_name`, `account_number`, `ifsc_code`, `pan_card_number`, `aadhaar_number`, `passport_number`, `emergency_contact_name`, `emergency_contact_phone`, `emergency_contact_relationship`, `emergency_contact_address`) VALUES
(6, 113829662, 'Employee', 'Rohith', 'employeerohit@gmail.com', '9876543210', '$2y$10$1cgbyVHoJtZiShE/rk4wgOzZRihQ4eSvpq7ORK50N9XLOvkf3AcNC', '2025-06-03 05:37:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 111272303, 'Director', 'Rohit', 'rohit@gmail.com', '8778393218', '$2y$10$Jo8dA6uvJuCLcvETc8.My.kMRjwNxkKw.kcLY9yyzDqwUbfKDjRH6', '2025-06-03 05:39:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 115636798, 'admin', 'Loki', 'loki@gmail.com', '0987654321', '$2y$10$tllOP8BHGYZ0R7QqrQOGWe2fx1byn.bIXC7jcm0LN7x8ofdqMHGI.', '2025-07-12 11:10:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 113823799, 'employee', 'Ram', 'ram@gmail.com', '9987654321', '$2y$10$.ckEPOcQ/O1IgIEu9f3y0ep4wKJTzzgk9epD412pUfjQqRbXuwrdu', '2025-07-12 11:13:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 113554128, 'employee', 'Sp', 'sp@gmail.com', '9997654321', '$2y$10$8Uy3dZJhMyyhXb75051ZIOFnUflYBrUA8YLq.A4CoKtcasAy3c7Ay', '2025-07-12 11:21:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `project_updates` tinyint(1) DEFAULT 1,
  `casting_calls` tinyint(1) DEFAULT 1,
  `collaboration_requests` tinyint(1) DEFAULT 1,
  `profile_visibility` varchar(20) DEFAULT 'Public',
  `portfolio_access` varchar(20) DEFAULT 'Public',
  `contact_information` varchar(50) DEFAULT 'Connections Only'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `direprojects`
--
ALTER TABLE `direprojects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noti`
--
ALTER TABLE `noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `fk_notifications_user` (`user_id`);

--
-- Indexes for table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `privacy_settings`
--
ALTER TABLE `privacy_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `fk_project_id` (`project_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `fk_project_members_user` (`user_id`),
  ADD KEY `fk_project_members_project` (`project_id`),
  ADD KEY `fk_team_id` (`team_id`);

--
-- Indexes for table `project_status`
--
ALTER TABLE `project_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_tasks`
--
ALTER TABLE `project_tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `fk_project_tasks_project` (`project_id`);

--
-- Indexes for table `recent_documents`
--
ALTER TABLE `recent_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `fk_reports_user` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `fk_tasks_user` (`user_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`s_no`),
  ADD UNIQUE KEY `team_id` (`team_id`);

--
-- Indexes for table `team_tasks`
--
ALTER TABLE `team_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `direprojects`
--
ALTER TABLE `direprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `noti`
--
ALTER TABLE `noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_settings`
--
ALTER TABLE `privacy_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_tasks`
--
ALTER TABLE `project_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_projects_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `fk_project_members_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `fk_project_members_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`);

--
-- Constraints for table `project_tasks`
--
ALTER TABLE `project_tasks`
  ADD CONSTRAINT `fk_project_tasks_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
