-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2018 at 07:52 AM
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
  `username` varchar(30) NOT NULL,
  `companyName` varchar(30) NOT NULL,
  `companyDescription` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`username`, `companyName`, `companyDescription`) VALUES
('celine', 'sas', '');

-- --------------------------------------------------------

--
-- Table structure for table `jobapplication`
--

CREATE TABLE `jobapplication` (
  `applicationID` varchar(15) NOT NULL,
  `jobID` varchar(15) NOT NULL,
  `applicant` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobposition`
--

CREATE TABLE `jobposition` (
  `jobID` varchar(15) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `salaryPerHour` double(5,2) NOT NULL,
  `hoursPerWeek` int(3) NOT NULL,
  `durationInWeeks` int(3) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL,
  `theClient` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobposition`
--

INSERT INTO `jobposition` (`jobID`, `title`, `description`, `salaryPerHour`, `hoursPerWeek`, `durationInWeeks`, `address`, `city`, `status`, `theClient`) VALUES
('J1', 'job position', 'job position for weaving', 1.00, 3, 6, '1212 Jln Beta', 'KL', 'AVAILABLE', 'celine');

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
  `username` varchar(30) NOT NULL,
  `fullName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobseeker`
--

INSERT INTO `jobseeker` (`username`, `fullName`) VALUES
('admin', 'Admin Name'),
('admin2', 'Admin2');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageID` varchar(15) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `sender` varchar(30) NOT NULL,
  `receiver` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `skillID` varchar(15) NOT NULL,
  `skillName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`skillID`, `skillName`) VALUES
('SK1', 'weaving'),
('SK2', 'knitting'),
('SK3', 'baking');

-- --------------------------------------------------------

--
-- Table structure for table `skillset`
--

CREATE TABLE `skillset` (
  `username` varchar(30) NOT NULL,
  `skillID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skillset`
--

INSERT INTO `skillset` (`username`, `skillID`) VALUES
('admin', 'SK2'),
('admin', 'SK3'),
('celine', 'SK2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phoneNo` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `userType` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `address`, `phoneNo`, `email`, `userType`) VALUES
('admin', 'admin', '123 Street', '123', '123@hotmail.com', 'Job Seeker'),
('admin2', 'admin2', 'Admin Address Street 11', '019999999', 'admin2@gmail.com', 'Job Seeker'),
('adrian', 'adrian', '8 Road', '123', '123', 'Client'),
('celine', 'celine', 'Jalan Merah', '0192823473', 'celine@gmail.com', 'Client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD PRIMARY KEY (`applicationID`,`jobID`,`applicant`),
  ADD KEY `fk_jobapplication_jobID` (`jobID`),
  ADD KEY `fk_jobapplication_applicant` (`applicant`);

--
-- Indexes for table `jobposition`
--
ALTER TABLE `jobposition`
  ADD PRIMARY KEY (`jobID`,`theClient`),
  ADD KEY `fk_jobpos_theClient` (`theClient`);

--
-- Indexes for table `jobrequiredskill`
--
ALTER TABLE `jobrequiredskill`
  ADD PRIMARY KEY (`jobID`,`skillID`),
  ADD KEY `fk_reqskill_skillID` (`skillID`);

--
-- Indexes for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `FK1` (`receiver`),
  ADD KEY `FK2` (`sender`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`skillID`);

--
-- Indexes for table `skillset`
--
ALTER TABLE `skillset`
  ADD PRIMARY KEY (`username`,`skillID`),
  ADD KEY `fk_skillset_skillID` (`skillID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_client_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD CONSTRAINT `fk_jobapplication_applicant` FOREIGN KEY (`applicant`) REFERENCES `user` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jobapplication_jobID` FOREIGN KEY (`jobID`) REFERENCES `jobposition` (`jobID`) ON UPDATE CASCADE;

--
-- Constraints for table `jobposition`
--
ALTER TABLE `jobposition`
  ADD CONSTRAINT `fk_jobpos_theClient` FOREIGN KEY (`theClient`) REFERENCES `user` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `jobrequiredskill`
--
ALTER TABLE `jobrequiredskill`
  ADD CONSTRAINT `fk_reqskill_jobID` FOREIGN KEY (`jobID`) REFERENCES `jobposition` (`jobID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reqskill_skillID` FOREIGN KEY (`skillID`) REFERENCES `skill` (`skillID`) ON UPDATE CASCADE;

--
-- Constraints for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD CONSTRAINT `fk_jobseeker_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_receiver` FOREIGN KEY (`receiver`) REFERENCES `user` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_message_sender` FOREIGN KEY (`sender`) REFERENCES `user` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `skillset`
--
ALTER TABLE `skillset`
  ADD CONSTRAINT `fk_skillset_skillID` FOREIGN KEY (`skillID`) REFERENCES `skill` (`skillID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_skillset_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
