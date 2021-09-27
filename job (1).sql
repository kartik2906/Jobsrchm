-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 08, 2020 at 07:45 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job`
--

-- --------------------------------------------------------

--
-- Table structure for table `Applied_job`
--

CREATE TABLE `Applied_job` (
  `recruiterid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `afirstname` text NOT NULL,
  `alastname` text NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Applied_job`
--

INSERT INTO `Applied_job` (`recruiterid`, `userid`, `afirstname`, `alastname`, `filename`) VALUES
(1, 2, 'John', 'Doe', 'Kartik updated cv.docx'),
(1, NULL, 'micahel', 'king', 'Kartik updated cv.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(1, NULL, 'kane', 'williamson', 'Cover_Letter.docx'),
(1, NULL, 'Kartik', 'williamson', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Cover_Letter.docx'),
(3, 2, 'John', 'Doe', 'Cover_Letter.docx'),
(2, 2, 'John', 'Doe', 'Cover_Letter.docx'),
(4, 2, 'John', 'Doe', 'Cover_Letter.docx'),
(1, NULL, 'micahel', 'jason', 'Mitie.docx');

-- --------------------------------------------------------

--
-- Table structure for table `Recruiter`
--

CREATE TABLE `Recruiter` (
  `recruiterid` int(11) NOT NULL,
  `jobtype` varchar(255) NOT NULL,
  `jobdescription` varchar(255) NOT NULL,
  `postdate` date NOT NULL,
  `duedate` date NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Recruiter`
--

INSERT INTO `Recruiter` (`recruiterid`, `jobtype`, `jobdescription`, `postdate`, `duedate`, `location`) VALUES
(1, 'Web developer', 'lorem ipsum  lorem ipsum  lorem ipsum  lorem ipsum  lorem ipsum  lorem ipsum  lorem ipsum  lorem ipsum  lorem ipsum  lorem ipsum  lorem ipsum  lorem ipsum  lorem ipsum  lorem  ', '2020-04-02', '2020-04-29', 'London'),
(2, 'Information Technology', 'lorem ipsum lore  lorem ipsum lore  lorem ipsum lore  lorem ipsum lore  lorem ipsum lore  lorem ipsum lore ', '2020-04-20', '2020-04-30', 'London'),
(3, 'web desiger', 'fasdds afdfsdfa afddsf dsfds dfd fd dfad adfds d', '2020-04-28', '2020-04-30', 'Manchester'),
(4, 'HTML content', 'dsfsdf dsf ds fwefwef ewf ewfe fwef ewfe few ewf', '2020-04-28', '2020-04-30', 'Manchester');

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `roleid` int(11) NOT NULL,
  `rolename` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`roleid`, `rolename`) VALUES
(1, 'User'),
(2, 'Recruiter');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `roleid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `emailverify` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`firstname`, `lastname`, `email`, `username`, `passwords`, `roleid`, `userid`, `token`, `emailverify`) VALUES
('John', 'Doe', 'kjaipracas@gmail.com', 'king007', '$2y$10$XIUGi5iIyNyL2LneOZlgd.xqVBKbZnMO1t68G0JjVqJ/SE.Lk5CTG', 1, 2, 'cbbd9c1974d9ff2ed9c45b7bda9c56dd', 0),
('micahel', 'jason', 'kjaipracas@gmail.com', 'jjaipracas', '$2y$10$o.5dxWS5i5vc5QLonTS30.LFVJlfTr/ZxFq9WA2zL2tpcu596qyV6', 1, 3, '30af6d9e2a0841f5a558a45de92ba624', 0),
('micahel', 'jason', 'kjaipracas@gmail.com', 'minimi002', '$2y$10$QMgzl2hOxPQo8bOGLAImT..c64Ci34M0jrO3rw2ZnwPuJH1h4Bma.', 2, 4, '927828df41751f59efcc7b6cd42f6c14', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Applied_job`
--
ALTER TABLE `Applied_job`
  ADD KEY `recruiterid` (`recruiterid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `Recruiter`
--
ALTER TABLE `Recruiter`
  ADD PRIMARY KEY (`recruiterid`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `userid_2` (`userid`),
  ADD KEY `roleid` (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Recruiter`
--
ALTER TABLE `Recruiter`
  MODIFY `recruiterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Applied_job`
--
ALTER TABLE `Applied_job`
  ADD CONSTRAINT `applied_job_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `User` (`userid`),
  ADD CONSTRAINT `applied_job_ibfk_2` FOREIGN KEY (`recruiterid`) REFERENCES `Recruiter` (`recruiterid`);

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `Role` (`roleid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
