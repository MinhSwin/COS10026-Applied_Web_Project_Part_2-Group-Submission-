-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 28, 2026 at 06:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_members`
--

CREATE TABLE `about_members` (
  `id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `first_project` text NOT NULL,
  `second_project` text NOT NULL,
  `quote_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_members`
--

INSERT INTO `about_members` (`id`, `member_name`, `first_project`, `second_project`, `quote_text`) VALUES
(1, 'SereyBoth', 'Developed the About page and contributed to the project presentation structure.', 'Completed Tasks 1, 2, and 7, including PHP includes, database settings, about table integration, and presentation management (presentation order and timing).', 'Success is not final, failure is not fatal.'),
(2, 'Minh', 'Developed the Apply page and form structure.', 'Completed Tasks 3 and 4, including the EOI database table and process_eoi.php validation system.', 'Do something today your future self will thank you for.'),
(3, 'Jack', 'Developed the Jobs page and database-driven job listings.', 'Completed Task 5 and part of Task 6, including the users table and login authentication system.', 'Dream big and dare to fail.'),
(4, 'Kevin', 'Developed the Homepage and shared UI styling.', 'Completed the remaining parts of Task 6, including manage.php HR manager queries and EOI management features.', 'Great things never come from comfort zones.');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `job_reference` varchar(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `date_of_birth` varchar(10) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `street_address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` varchar(20) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skills` text NOT NULL,
  `other_skills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_list`
--

CREATE TABLE `jobs_list` (
  `id` int(11) NOT NULL,
  `reference_code` varchar(20) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `salary` varchar(100) NOT NULL,
  `report_to` varchar(255) NOT NULL,
  `responsibilities` text NOT NULL,
  `essential_requirements` text NOT NULL,
  `preferable_requirement` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs_list`
--

INSERT INTO `jobs_list` (`id`, `reference_code`, `job_title`, `description`, `salary`, `report_to`, `responsibilities`, `essential_requirements`, `preferable_requirement`) VALUES
(3, 'ABC10', 'Renewable Energy Engineer', 'Design and implement solar and wind energy systems for clients', '$80,000 - $110,000', 'Engineering Manager', 'Design and implement green energy systems (solar, wind)| Conduct assessment and ability to implement on site area| Ensure compliance with environmental regulations', 'Bachelor\'s degree in Electrical Engineering| Knowledge of how the solar and wind systems works| Ability to design and implement the solar and wind systems', 'Professional engineering certification| Have 1-2 years of experience as a renewable energy engineer'),
(4, 'ABC20', 'Energy Solution Consultant', 'Analyze energy usage data and help client develop strategies to implement sustainable energy systems', '$70,000 - $90,000', 'Sustainability Manager', 'Analyze and report to client on their energy consumption| Develop sustainability energy systems plans| Support and persuade client to use our solar and wind systems', 'Bachelor\'s degree in Marketing or Environmental Science|Strong data analysis and communication skills', 'Have 1-2 years of working as an energy solution consultant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$vtMIYrOrjLUIhA4WvVMCNeASwx3sz276m6kDhgxUOVxlfCSzOtJm2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_members`
--
ALTER TABLE `about_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_list`
--
ALTER TABLE `jobs_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_members`
--
ALTER TABLE `about_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs_list`
--
ALTER TABLE `jobs_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
