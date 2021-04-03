-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2021 at 12:58 AM
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
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_designation_id` int(100) NOT NULL,
  `user_datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `user_salaryPerHour` int(100) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_state` varchar(100) NOT NULL,
  `user_zip` varchar(100) NOT NULL,
  `user_country` varchar(100) NOT NULL,
  `user_department_id` int(11) NOT NULL,
  `user_phone` text NOT NULL,
  `CreatedBY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_designation_id`, `user_datecreated`, `user_salaryPerHour`, `user_city`, `user_state`, `user_zip`, `user_country`, `user_department_id`, `user_phone`, `CreatedBY`) VALUES
(1, 'Selena Ng', 'SelenaNg@gmail.com', 'SelenaNg', 1, '2021-04-02 01:12:03', 50, 'Coquitlam', 'IL', '12312', 'Canada', 1, '', 0),
(2, 'Selena Ng Director', 'SelenaNgDirector@gmail.com', 'SelenaNgDirector', 2, '2021-04-02 01:12:03', 50, 'Coquitlam', 'IL', '12312', 'Canada', 1, '', 0),
(3, 'Selena Ng Employee', 'SelenaNgEmployee@gmail.com', 'SelenaNgEmployee', 3, '2021-04-02 01:12:03', 50, 'Coquitlam', 'IL', '12312', 'Canada', 1, '', 0),
(4, 'Selena Ng Employee2', 'SelenaNgEmployee2@gmail.com', 'SelenaNgEmployee2', 3, '2021-04-02 01:12:03', 50, 'Coquitlam', 'IL', '12312', 'Canada', 1, '', 0),
(5, 'teseses ts sd', 'SelenaNgEmployee34@gmail.com', '12345678', 3, '2021-04-04 01:50:52', 1255, 'chicago00', 'ILLL', '6006777', 'canadaaa', 1, '123123123123', 2),
(6, 'asesaed', 'SelenaNgEmplosdyee@gmail.com', '12345678', 3, '2021-04-04 01:55:57', 123, 'chicago', 'IL', '60067', 'canada', 1, '123123123123', 2),
(7, 'asdasd', 'SelenaNgEmployee3@gmail.com', '12345678', 3, '2021-04-04 02:59:56', 12, 'chicago', 'IL', '60067', 'canada', 1, '123123123123', 2),
(8, 'testing update', 'SelenaNgEmployee33@gmail.com', '12345678', 3, '2021-04-04 03:10:46', 123, 'chicagoo', 'ILL', '600677', 'canadaa', 1, '123123123123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_dailyreport`
--

CREATE TABLE `tbl_user_dailyreport` (
  `user_DailyReport_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_DailyReport_date` date NOT NULL,
  `user_DailyReport_TimeStart` time NOT NULL,
  `user_DailyReport_TimeEnd` time NOT NULL,
  `user_DailyReport_dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `user_DailyReport_isapproved` bit(2) NOT NULL,
  `user_DailyReport_TimeSpend` time NOT NULL,
  `user_DailyReport_isLeave` bit(2) NOT NULL,
  `user_DailyReport_LeaveDescription` text NOT NULL,
  `user_WeeklyReport_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_department`
--

CREATE TABLE `tbl_user_department` (
  `user_department_id` int(11) NOT NULL,
  `user_department_name` varchar(100) NOT NULL,
  `user_department_datecreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_designation`
--

CREATE TABLE `tbl_user_designation` (
  `user_designation_id` int(100) NOT NULL,
  `user_designation_name` varchar(100) NOT NULL,
  `user_designation_datecreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_designation`
--

INSERT INTO `tbl_user_designation` (`user_designation_id`, `user_designation_name`, `user_designation_datecreated`) VALUES
(1, 'CEO', '2021-04-02 01:08:13'),
(2, 'Director', '2021-04-02 01:08:22'),
(3, 'Employee', '2021-04-02 01:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_weeklyreport`
--

CREATE TABLE `tbl_user_weeklyreport` (
  `user_WeeklyReport_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_WeeklyReport_Startdate` date NOT NULL,
  `user_WeeklyReport_Enddate` date NOT NULL,
  `user_WeeklyReport_dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `user_WeeklyReport_isapproved` bit(2) NOT NULL,
  `user_WeeklyReport_TimeSpend` float NOT NULL,
  `user_WeeklyReport_SalaryPerHour` int(11) NOT NULL,
  `user_WeeklyReport_TotalSalary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_weeklyreport`
--

INSERT INTO `tbl_user_weeklyreport` (`user_WeeklyReport_id`, `user_id`, `user_WeeklyReport_Startdate`, `user_WeeklyReport_Enddate`, `user_WeeklyReport_dateCreated`, `user_WeeklyReport_isapproved`, `user_WeeklyReport_TimeSpend`, `user_WeeklyReport_SalaryPerHour`, `user_WeeklyReport_TotalSalary`) VALUES
(1, 3, '2021-04-05', '2021-04-11', '2021-04-03 01:42:21', b'00', 40, 10, 400);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_dailyreport`
--
ALTER TABLE `tbl_user_dailyreport`
  ADD PRIMARY KEY (`user_DailyReport_id`);

--
-- Indexes for table `tbl_user_department`
--
ALTER TABLE `tbl_user_department`
  ADD PRIMARY KEY (`user_department_id`);

--
-- Indexes for table `tbl_user_designation`
--
ALTER TABLE `tbl_user_designation`
  ADD PRIMARY KEY (`user_designation_id`);

--
-- Indexes for table `tbl_user_weeklyreport`
--
ALTER TABLE `tbl_user_weeklyreport`
  ADD PRIMARY KEY (`user_WeeklyReport_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user_dailyreport`
--
ALTER TABLE `tbl_user_dailyreport`
  MODIFY `user_DailyReport_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_department`
--
ALTER TABLE `tbl_user_department`
  MODIFY `user_department_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_designation`
--
ALTER TABLE `tbl_user_designation`
  MODIFY `user_designation_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user_weeklyreport`
--
ALTER TABLE `tbl_user_weeklyreport`
  MODIFY `user_WeeklyReport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
