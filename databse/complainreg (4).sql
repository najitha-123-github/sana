-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 11:07 AM
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
-- Database: `complainreg`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `name` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `phno` int(12) NOT NULL,
  `complaint_type` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `complaint_detail` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `suspect_name` varchar(30) NOT NULL,
  `details` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `officerid` varchar(30) NOT NULL,
  `complaint_id` int(10) NOT NULL,
  `voice` varchar(255) NOT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`name`, `dob`, `address`, `phno`, `complaint_type`, `date`, `complaint_detail`, `photo`, `suspect_name`, `details`, `email`, `officerid`, `complaint_id`, `voice`, `status`) VALUES
('shaharban', '2004-03-24', 'karimattom h,kummanode,pattimattom po,683562', 2147483647, 'Blackmail', '2024-09-29', 'wretyuio9ip[;uhgfdxcvbnm,', '', 'hafiz', 'a boy with specs and ugly smile', 'shaharban@gmail.com', '7', 37, 'uploads/audio/66f8e5564e3e8.mp3', 'accepted'),
('sana', '2005-03-09', 'fxdcgvhbjnm', 789456123, 'Blackmail', '2024-09-30', 'fghjkm,l', '', '', '', 'sana@gmail.com', '8', 38, '', 'FIR'),
('ziyana', '2004-09-24', 'aesdftghjkl,;', 1234567890, 'Threats', '2024-09-30', 'srdtfvgnjkm', 'Screenshot 2024-09-19 152910.png', 'THUFAIL PB', 'wesrdtghuijokl;', 'ziyana@gmail.com', '8', 39, 'uploads/audio/66fa40d391c40.mp3', 'accepted'),
('MidhunaAnubhav', '2024-09-30', 'Kalamassery', 2147483647, 'Threats', '2026-12-25', 'Sexjual Hault', 'Aboutus.png', 'Adam', 'werrtr', 'midhu@gmail.com', '0', 40, 'uploads/audio/66fa4cfac43c1.mp3', 'declined'),
('fathima', '2002-05-12', 'wertyuio', 2147483647, 'Threats', '2024-06-23', 'sdtfyghij', '', '3w45r67yuoip', 'eswsrdthyujkl;', 'fathima@gmail.com', '0', 41, '', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `usertype` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`email`, `password`, `usertype`) VALUES
('admin@gmail.com', 'admincreg', 2),
('imran@gmail.com', 'imran123', 1),
('akbar@gmail.com', 'akbar123', 1),
('shaharban@gmail.com', 'shahar@321', 0),
('sana@gmail.com', 'sana@123', 0),
('ziyana@gmail.com', '1234567890', 0),
('midhu@gmail.com', '8940846316', 0),
('abc@gmail.com', 'abc123', 1),
('fathima@gmail.com', 'Fathima@123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `senderid` int(15) NOT NULL,
  `complaintid` int(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `senderid`, `complaintid`, `timestamp`) VALUES
(43, 'hello', 36, 38, '2024-10-06 07:39:04'),
(48, 'hii', 8, 38, '2024-10-06 07:54:49'),
(52, 'whats the status of my case?', 36, 38, '2024-10-06 08:02:33'),
(53, 'hhhh', 35, 37, '2024-10-09 04:45:14'),
(54, 'utuyyu', 7, 1, '2024-10-09 04:45:58'),
(55, 'iutitiu', 7, 1, '2024-10-09 04:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `officerid` int(20) NOT NULL,
  `position` varchar(30) NOT NULL,
  `phonenum` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `name` varchar(30) NOT NULL,
  `passwordoff` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`officerid`, `position`, `phonenum`, `dob`, `name`, `passwordoff`, `email`) VALUES
(7, 'si', '7894561230', '2024-09-09', 'imran', 'imran123', 'imran@gmail.com'),
(8, 'ci', '1234567890', '2024-09-29', 'akbar', 'akbar123', 'akbar@gmail.com'),
(11, 'constable', '4567891230', '2024-09-30', 'afnan', 'afnan@gmail.com', 'akbar@gmail.com'),
(12, 'ci', '1234567890', '2000-03-24', 'abc', 'abc123', 'abc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `officer_reviews`
--

CREATE TABLE `officer_reviews` (
  `id` int(11) NOT NULL,
  `officer_id` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `officer_reviews`
--

INSERT INTO `officer_reviews` (`id`, `officer_id`, `review`, `user_id`) VALUES
(4, 8, 'AESRDTKL;', 37);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `complaint_id`, `officer_id`, `user_id`, `reason`, `request_date`, `status`) VALUES
(3, 37, 7, 35, 'like to change  officer', '2024-09-29 22:02:40', 'successful'),
(4, 39, 7, 37, 'awesrdtfyuhiokpl', '2024-09-30 06:13:26', 'successful');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(70) NOT NULL,
  `phno` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `usid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `dob`, `address`, `phno`, `password`, `usid`) VALUES
('shaharban', 'shaharban@gmail.com', '2004-03-24', 'karimattom h,kummanode,pattimattom po,683562', '9564585658', 'shahar@321', 35),
('sana', 'sana@gmail.com', '2005-03-09', 'fxdcgvhbjnm', '789456123', 'sana@123', 36),
('ziyana', 'ziyana@gmail.com', '2004-09-24', 'aesdftghjkl,;', '1234567890', '1234567890', 37),
('fathima', 'fathima@gmail.com', '2002-05-12', 'wertyuio', '4321567890', 'Fathima@123', 39);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`officerid`);

--
-- Indexes for table `officer_reviews`
--
ALTER TABLE `officer_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `officerid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `officer_reviews`
--
ALTER TABLE `officer_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
