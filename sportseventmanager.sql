-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2019 at 01:56 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportseventmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `club`
--
-- Creation: Apr 23, 2019 at 11:49 AM
--

CREATE TABLE `club` (
  `clubId` int(11) NOT NULL,
  `clubName` varchar(500) NOT NULL,
  `description` varchar(600) NOT NULL,
  `creationDate` date NOT NULL,
  `founderUid` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `club`:
--   `founderUid`
--       `user` -> `uid`
--   `type`
--       `sport` -> `sport_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--
-- Creation: Apr 23, 2019 at 11:52 AM
--

CREATE TABLE `event` (
  `eventId` int(11) NOT NULL,
  `eventName` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(500) DEFAULT NULL,
  `addedByUid` int(11) NOT NULL,
  `forClub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `event`:
--   `addedByUid`
--       `user` -> `uid`
--   `forClub`
--       `club` -> `clubId`
--

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--
-- Creation: Apr 23, 2019 at 10:35 AM
--

CREATE TABLE `sport` (
  `sport_id` int(11) NOT NULL,
  `sportName` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `sport`:
--

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`sport_id`, `sportName`) VALUES
(1, 'Basket Ball');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Apr 23, 2019 at 10:31 AM
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `about` varchar(500) DEFAULT NULL,
  `forgetPasswordQA` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `user`:
--

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `userName`, `fullName`, `email`, `password`, `about`, `forgetPasswordQA`) VALUES
(1, 'hazal', 'Mehreen Athar', 'mehreen23@gmail.com', '123456', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`clubId`),
  ADD UNIQUE KEY `clubName` (`clubName`),
  ADD KEY `founderUid` (`founderUid`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `addedByUid` (`addedByUid`),
  ADD KEY `forClub` (`forClub`);

--
-- Indexes for table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`sport_id`),
  ADD UNIQUE KEY `sportName` (`sportName`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `clubId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `sport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ibfk_1` FOREIGN KEY (`founderUid`) REFERENCES `user` (`uid`),
  ADD CONSTRAINT `club_ibfk_2` FOREIGN KEY (`type`) REFERENCES `sport` (`sport_id`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`addedByUid`) REFERENCES `user` (`uid`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`forClub`) REFERENCES `club` (`clubId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
