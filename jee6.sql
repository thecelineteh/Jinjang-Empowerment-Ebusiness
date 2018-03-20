-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2018 at 03:22 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

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
  `companyName` varchar(30) NOT NULL,
  `companyDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`userID`, `companyName`, `companyDescription`) VALUES
(2, 'SAS Fintech', 'This is a good company. This is a good company. This is a good company. This is a good company. This is a good company. This is a good company. This is a good company. This is a good company. This is a good company. '),
(3, 'Client', 'Client company'),
(6, 'Client2', 'GOOD company'),
(8, 'Adam Company', 'Adam Levine tribute');

-- --------------------------------------------------------

--
-- Table structure for table `jobapplication`
--

CREATE TABLE `jobapplication` (
  `applicationID` int(15) NOT NULL,
  `jobID` int(15) NOT NULL,
  `theJobSeeker` int(15) NOT NULL,
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
  `salaryPerHour` double(5,2) NOT NULL,
  `hoursPerWeek` int(3) NOT NULL,
  `durationInWeeks` int(3) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL,
  `theClient` int(15) NOT NULL,
  `theEmployee` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobposition`
--

INSERT INTO `jobposition` (`jobID`, `title`, `description`, `salaryPerHour`, `hoursPerWeek`, `durationInWeeks`, `address`, `city`, `status`, `theClient`, `theEmployee`) VALUES
(1, 'job position 1', '123', 2.00, 2, 4, 'sdfgsdfgsdfg', 'sdfgsdfg', 'AVAILABLE', 2, 0),
(2, 'job position 2', '123', 3.50, 6, 3, 'sdfgsdfgsdfg', 'sdfgsdfg', 'AVAILABLE', 2, 0),
(3, 'job position 3', '123', 1.50, 5, 1, 'sdfgsdfgsdfg', 'sdfgsdfg', 'AVAILABLE', 2, 0),
(4, 'job position 4', '123', 3.00, 6, 6, 'sdfgsdfgsdfg', 'sdfgsdfg', 'AVAILABLE', 2, 0),
(5, 'job position 5', 'asdf', 2.00, 4, 10, 'asdf', 'asdf', 'AVAILABLE', 2, 0),
(6, 'web developer', 'This is a very good job. This is a very good job. This is a very good job. This is a very good job. This is a very good job. This is a very good job. This is a very good job. This is a very good job. This is a very good job. ', 3.00, 8, 2, 'asdf', 'asdf', 'AVAILABLE', 2, 0),
(7, 'UX designer', 'Design UX', 1.50, 2, 3, '12356346', 'Kepong', 'ACCEPTED', 3, 1),
(8, 'job', 'job', 1.50, 5, 4, '3423', 'KL', 'AVAILABLE', 3, 0),
(9, 'another job', 'another job', 2.00, 3, 5, 'job address 1234', 'kl', 'AVAILABLE', 3, 0),
(10, 'Business Intelligent', 'to report intelligently', 2.00, 52, 1, 'fffffffff', 'Melaka', 'AVAILABLE', 8, 0),
(11, 'test job', 'test', 1.25, 6, 4, 'address test', 'KL', 'AVAILABLE', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobrequiredskill`
--

CREATE TABLE `jobrequiredskill` (
  `jobID` int(15) NOT NULL,
  `skillID` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobrequiredskill`
--

INSERT INTO `jobrequiredskill` (`jobID`, `skillID`) VALUES
(8, 2),
(8, 3),
(8, 4),
(9, 1),
(9, 2),
(11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker`
--

CREATE TABLE `jobseeker` (
  `userID` int(15) NOT NULL,
  `fullName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobseeker`
--

INSERT INTO `jobseeker` (`userID`, `fullName`) VALUES
(1, 'The name is Admin'),
(4, 'JS'),
(5, 'JobSeeker1'),
(7, 'Mary the Great');

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
  `skillID` int(15) NOT NULL,
  `skillName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`skillID`, `skillName`) VALUES
(1, 'weaving'),
(2, 'knitting'),
(3, 'baking'),
(4, 'UX design');

-- --------------------------------------------------------

--
-- Table structure for table `skillsets`
--

CREATE TABLE `skillsets` (
  `skillID` int(15) NOT NULL,
  `theJobSeeker` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skillsets`
--

INSERT INTO `skillsets` (`skillID`, `theJobSeeker`) VALUES
(1, 1),
(1, 5),
(1, 7),
(2, 1),
(2, 5),
(2, 7),
(3, 4),
(4, 1),
(4, 4),
(4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNo` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `userType` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `address`, `phoneNo`, `email`, `userType`) VALUES
(1, 'admin', 'admin', '123 STREET ', '65 213454365', 'admin@gmail.com', 'Job Seeker'),
(2, 'admin2', 'admin2', '123456', '789', 'admin2@hotmail.com', 'Client'),
(3, 'client', 'client', '', '1238912034', 'client@gmail.com', 'Client'),
(4, 'js', 'js', 'blah', '23489204', 'js@gmail.com', 'Job Seeker'),
(5, 'js2', 'js2', '543 Jalan T', '324723042', 'js1@hotmail.com', 'Job Seeker'),
(6, 'client2', 'client2', 'good street', '2347823', 'client2@gmail.com', 'Client'),
(7, 'mary', 'mary', 'Mary\'s house', '234789', 'mary@email.com', 'Job Seeker'),
(8, 'adam', 'adam', 'Street Adam', '93804234', 'adam@email.com', 'Client');

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
  ADD PRIMARY KEY (`applicationID`),
  ADD KEY `jobID` (`jobID`),
  ADD KEY `userID` (`theJobSeeker`);

--
-- Indexes for table `jobposition`
--
ALTER TABLE `jobposition`
  ADD PRIMARY KEY (`jobID`),
  ADD KEY `theClient` (`theClient`),
  ADD KEY `theEmployee` (`theEmployee`);

--
-- Indexes for table `jobrequiredskill`
--
ALTER TABLE `jobrequiredskill`
  ADD PRIMARY KEY (`jobID`,`skillID`),
  ADD KEY `skillID` (`skillID`);

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
  ADD PRIMARY KEY (`skillID`,`theJobSeeker`),
  ADD KEY `theJobSeeker` (`theJobSeeker`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobapplication`
--
ALTER TABLE `jobapplication`
  MODIFY `applicationID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobposition`
--
ALTER TABLE `jobposition`
  MODIFY `jobID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `skillID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD CONSTRAINT `jobapplication_ibfk_1` FOREIGN KEY (`jobID`) REFERENCES `jobposition` (`jobID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jobapplication_ibfk_2` FOREIGN KEY (`theJobSeeker`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `jobposition`
--
ALTER TABLE `jobposition`
  ADD CONSTRAINT `jobposition_ibfk_1` FOREIGN KEY (`theClient`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `jobrequiredskill`
--
ALTER TABLE `jobrequiredskill`
  ADD CONSTRAINT `jobrequiredskill_ibfk_1` FOREIGN KEY (`jobID`) REFERENCES `jobposition` (`jobID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jobrequiredskill_ibfk_2` FOREIGN KEY (`skillID`) REFERENCES `skill` (`skillID`) ON UPDATE CASCADE;

--
-- Constraints for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD CONSTRAINT `jobseeker_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`receiver`) REFERENCES `user` (`userID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `skillsets`
--
ALTER TABLE `skillsets`
  ADD CONSTRAINT `skillsets_ibfk_1` FOREIGN KEY (`theJobSeeker`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
