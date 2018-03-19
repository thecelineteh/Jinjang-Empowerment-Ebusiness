-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2018 at 09:49 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jee`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `userID` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `companyName` varchar(30) NOT NULL,
  `companyDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`userID`, `username`, `companyName`, `companyDescription`) VALUES
(1, 'client', 'SAS Fintech', 'This is a good company. This is a good company. This is a good company. This is a good company. This is a good company. This is a good company. This is a good company. This is a good company. This is a good company. ');

-- --------------------------------------------------------

--
-- Table structure for table `jobapplication`
--

CREATE TABLE `jobapplication` (
  `applicationID` varchar(15) NOT NULL,
  `jobID` varchar(30) NOT NULL,
  `applicant` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobposition`
--

CREATE TABLE `jobposition` (
  `jobID` int(15) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `salary` int(7) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL,
  `company` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobposition`
--

INSERT INTO `jobposition` (`jobID`, `title`, `description`, `salary`, `address`, `city`, `status`, `company`) VALUES
(1, 'job position 2', '123', 345, 'sdfgsdfgsdfg', 'sdfgsdfg', 'AVAILABLE', 0),
(2, 'job position 2', '123', 345, 'sdfgsdfgsdfg', 'sdfgsdfg', 'AVAILABLE', 0),
(3, 'job position 2', '123', 345, 'sdfgsdfgsdfg', 'sdfgsdfg', 'AVAILABLE', 0),
(4, 'job position 2', '123', 345, 'sdfgsdfgsdfg', 'sdfgsdfg', 'AVAILABLE', 0),
(5, 'job position 1', 'asdf', 123, 'asdf', 'asdf', 'AVAILABLE', 0),
(6, 'web developer', 'This is a very good job. This is a very good job. This is a very good job. This is a very good job. This is a very good job. This is a very good job. This is a very good job. This is a very good job. This is a very good job. ', 233, 'asdf', 'asdf', 'AVAILABLE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobrequiredskill`
--

CREATE TABLE `jobrequiredskill` (
  `jobID` varchar(15) NOT NULL,
  `skillID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker`
--

CREATE TABLE `jobseeker` (
  `userID` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobseeker`
--

INSERT INTO `jobseeker` (`userID`, `username`, `fullName`) VALUES
(1, 'admin2', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageID` int(15) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `sender` int(15) NOT NULL,
  `receiver` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `skillID` varchar(15) NOT NULL,
  `skillName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skillsets`
--

CREATE TABLE `skillsets` (
  `skillID` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phoneNo` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `userType` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `address`, `phoneNo`, `email`, `userType`) VALUES
(1, 'admin', 'admin', '123', '123', '123@hotmail.com', 'job seeker'),
(2, 'admin2', '123', '', 'asdf@asdf.com', '234', 'job seeker'),
(3, 'adrian', '123', '123', '123', '123', 'client'),
(4, 'client', '123', '', 'asdf@asdf.com', '234', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD PRIMARY KEY (`applicationID`);

--
-- Indexes for table `jobposition`
--
ALTER TABLE `jobposition`
  ADD PRIMARY KEY (`jobID`),
  ADD UNIQUE KEY `jobID` (`jobID`);

--
-- Indexes for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `receiver` (`receiver`),
  ADD KEY `sender` (`sender`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`skillID`);

--
-- Indexes for table `skillsets`
--
ALTER TABLE `skillsets`
  ADD PRIMARY KEY (`skillID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `userID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobposition`
--
ALTER TABLE `jobposition`
  MODIFY `jobID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobseeker`
--
ALTER TABLE `jobseeker`
  MODIFY `userID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD CONSTRAINT `jobseeker_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`receiver`) REFERENCES `user` (`userID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
