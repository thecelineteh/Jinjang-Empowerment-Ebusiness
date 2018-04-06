-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2018 at 04:00 PM
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
  `companyName` varchar(30) NOT NULL,
  `companyDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`userID`, `companyName`, `companyDescription`) VALUES
(2, 'Healthcare NGO', 'Healthcare NGO is a good company');

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

--
-- Dumping data for table `jobapplication`
--

INSERT INTO `jobapplication` (`applicationID`, `jobID`, `theJobSeeker`, `status`) VALUES
(1, 3, 1, 'ACCEPTED'),
(2, 1, 3, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `jobposition`
--

CREATE TABLE `jobposition` (
  `jobID` int(15) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `salaryPerHour` double(5,2) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL,
  `theClient` int(15) NOT NULL,
  `theEmployee` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobposition`
--

INSERT INTO `jobposition` (`jobID`, `title`, `description`, `salaryPerHour`, `startDate`, `endDate`, `startTime`, `endTime`, `address`, `city`, `status`, `theClient`, `theEmployee`) VALUES
(1, 'Test', 'Currently seeking a part time knitter for charity drive event.', 1.50, '2018-04-03', '2018-04-10', '12:00:00', '15:00:00', '21B, Jalan Cantik, 78430, Kuala Lumpur', 'Kuala Lumpur', 'AVAILABLE', 2, 0),
(2, 'UX designer', 'Design modern UX interface for our company\'s financial department', 2.00, '2018-03-23', '2018-03-30', '17:00:00', '20:00:00', '56 Bubbly Road', 'At Home', 'NOT AVAILABLE', 2, 1),
(3, 'Babysitter', 'Babysitter for kindergarten during a day trip. For more info, please send a message.', 2.00, '2018-04-20', '2018-05-01', '08:00:00', '15:00:00', '12 Street, Jalan 9, Sekolah Kinder', 'Kuala Lumpur', 'AVAILABLE', 2, 0),
(4, 'Weaving', 'Weaving fabrics', 1.00, '2018-04-25', '2018-04-30', '10:00:00', '15:30:00', '239 Street', 'Kuala Lumpur', 'AVAILABLE', 2, 0);

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
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 3),
(2, 4),
(3, 5),
(4, 1);

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
(1, 'Leah A/P Pradeep'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageID` int(15) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sender` int(15) NOT NULL,
  `receiver` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messageID`, `subject`, `content`, `date`, `sender`, `receiver`) VALUES
(1, 'New Work', 'test message', '2018-04-04 13:59:28', 2, 1);

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
(4, 'cooking'),
(5, 'babysitting');

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
(1, 'leah', 'leah123', '123 Street, Kuala Lumpur', '0118348199', 'leahemail@hotmail.com', 'Job Seeker'),
(2, 'ngo', 'ngo123', '9 Jalan Istimewa, NGO Berhad', '0129384654', 'ngo@gmail.com', 'Client'),
(3, 'admin', 'admin', '', '123', 'aasdf@hotmai.com', 'Job Seeker');

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
  MODIFY `applicationID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobposition`
--
ALTER TABLE `jobposition`
  MODIFY `jobID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `skillID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
