-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2020 at 01:07 AM
-- Server version: 10.3.23-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acrobatdmscom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(250) NOT NULL,
  `date_added` date NOT NULL,
  `added_by` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `date_added`, `added_by`) VALUES
(10, 'Department 1', '2020-05-11', 'Zaid Ali Shamsi'),
(11, 'IT', '2020-05-14', 'Zaid Ali Shamsi'),
(12, 'abcd', '2020-05-14', ''),
(13, 'IT', '2020-05-15', 'Zaid Ali Shamsi');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `added_to` varchar(200) NOT NULL,
  `added_date` varchar(100) NOT NULL,
  `dept_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `file_name`, `file`, `added_by`, `added_to`, `added_date`, `dept_name`) VALUES
(36, 'File', '547-Usama CV.pdf', 'Usama Tahir', '', '05/11/2020', 'Sub Department 1');

-- --------------------------------------------------------

--
-- Table structure for table `subdepartments`
--

CREATE TABLE `subdepartments` (
  `subdept_id` int(11) NOT NULL,
  `subdept_name` varchar(250) NOT NULL,
  `parent_dept` varchar(250) NOT NULL,
  `added_date` date NOT NULL,
  `added_by` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subdepartments`
--

INSERT INTO `subdepartments` (`subdept_id`, `subdept_name`, `parent_dept`, `added_date`, `added_by`) VALUES
(7, 'Sub Department 1', 'Department 1', '2020-05-11', 'Zaid Ali Shamsi'),
(8, 'xyz', 'abcd', '2020-05-14', '');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_title` varchar(250) NOT NULL,
  `completion_date` varchar(250) NOT NULL,
  `task_details` varchar(250) NOT NULL,
  `assigned_to` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `assigned_on` varchar(250) NOT NULL,
  `task_comments` varchar(200) NOT NULL,
  `completed_on` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_title`, `completion_date`, `task_details`, `assigned_to`, `status`, `assigned_on`, `task_comments`, `completed_on`) VALUES
(6, 'Task', '05/14/2020', 'ijhklnkljkom,lmkohohjio', 'Maheen Israr', 'Completed', '05/11/2020', 'Task is done', '05/11/2020'),
(7, 'jhijhkl', '05/30/2020', 'tugjkkljohio', 'Usama Tahir', 'Completed', '05/11/2020', 'Done\r\n', '05/11/2020'),
(8, 'test', '05/31/2020', 'nkhjiijnkmnkl l', 'Usama Tahir', 'Completed', '05/14/2020', 'task completed', '05/14/2020');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_pass` varchar(20) NOT NULL,
  `user_phone` varchar(250) NOT NULL,
  `user_designation` varchar(250) NOT NULL,
  `user_salary` varchar(250) NOT NULL,
  `user_dept` varchar(250) NOT NULL,
  `user_role` varchar(20) NOT NULL,
  `date_joined` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `user_pass`, `user_phone`, `user_designation`, `user_salary`, `user_dept`, `user_role`, `date_joined`) VALUES
(9, 'Zaid Ali Shamsi', 'zaid@zaid.com', '4321', '', '', '', '', 'Admin', '2020-05-10'),
(10, 'Maheen Israr', 'maheen@maheen.com', '1234', '0301-7140532', 'Manager', '12,000', 'Department 1', 'Manager', '2020-05-11'),
(11, 'Usama Tahir', 'usama@usama.com', '3344', '0301-7878778', 'Employee', '10,000', 'Department 1', 'Employee', '2020-05-11'),
(12, 'Uzair Ahmad', 'uzair@uzair.com', '1234', '09900-', 'djklfj', '-9909', 'abcd', 'Manager', '2020-05-15'),
(13, 'Usama Tahir', 'utahir10@gmail.com', '1234', '', '', '', '', 'Admin', '2020-05-15'),
(17, 'muneeb', 'muneeb@muneeb.com', '1234', '03007520681', 'abc', '2555', 'Department 1 ', 'Admin', '2020-06-04'),
(18, 'muneeb', 'muneeb@muneeb.com', '1234', '03007520681', 'abc', '2555', 'IT ', 'Admin', '2020-06-04'),
(19, 'maha', 'maha@maha.com', '1234', '', '', '', 'Department 1 ', 'Manager', '2020-06-09'),
(20, 'muneeb', 'muneeb.hfd552@gmail.com', '1234', '03007520681', 'abc', '2555', 'IT ', 'Manager', '2020-06-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `subdepartments`
--
ALTER TABLE `subdepartments`
  ADD PRIMARY KEY (`subdept_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `subdepartments`
--
ALTER TABLE `subdepartments`
  MODIFY `subdept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
