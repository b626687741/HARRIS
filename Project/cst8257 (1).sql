-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2018 at 05:39 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cst8257`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessibility`
--

CREATE TABLE `accessibility` (
  `Accessibility_Code` varchar(16) NOT NULL,
  `Description` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accessibility`
--

INSERT INTO `accessibility` (`Accessibility_Code`, `Description`) VALUES
('private', 'Accessible only by the owner'),
('shared', 'Accessible by the owner and friends');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `Album_Id` int(11) NOT NULL,
  `Title` varchar(256) NOT NULL,
  `Description` varchar(3000) DEFAULT NULL,
  `Date_Updated` date NOT NULL,
  `Owner_Id` varchar(16) NOT NULL,
  `Accessibility_Code` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`Album_Id`, `Title`, `Description`, `Date_Updated`, `Owner_Id`, `Accessibility_Code`) VALUES
(35, 'RE: We Are Lying to People', 'This is a Test', '2018-01-09', '1234', 'shared'),
(33, 'asdasd', '', '2018-01-08', '1234', 'private'),
(34, 'This is a Test', 'Test Me!', '2018-01-08', '1233', 'shared'),
(36, 'Trip', 'This is from my trip to places in 2017!', '2018-01-09', '1234', 'shared'),
(37, 'My Trip', 'My new trip', '2018-01-09', '1234', 'private');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Comment_Id` int(11) NOT NULL,
  `Author_Id` varchar(16) NOT NULL,
  `Picture_Id` int(11) NOT NULL,
  `Comment_Text` varchar(3000) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `Friend_RequesterId` varchar(16) NOT NULL,
  `Friend_RequesteeId` varchar(16) NOT NULL,
  `Status` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`Friend_RequesterId`, `Friend_RequesteeId`, `Status`) VALUES
('1233', '1235', 'accepted'),
('1233', '1234', 'accepted'),
('1111', '1234', 'request');

-- --------------------------------------------------------

--
-- Table structure for table `friendshipstatus`
--

CREATE TABLE `friendshipstatus` (
  `Status_Code` varchar(16) NOT NULL,
  `Description` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendshipstatus`
--

INSERT INTO `friendshipstatus` (`Status_Code`, `Description`) VALUES
('accepted', 'The request to become a  friend has been accepted'),
('request', 'A   request has been sent to   become a  friend');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `Picture_Id` int(11) NOT NULL,
  `Album_Id` int(11) NOT NULL,
  `FileName` varchar(255) NOT NULL,
  `Title` varchar(256) NOT NULL,
  `Description` varchar(3000) DEFAULT NULL,
  `Date_Added` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`Picture_Id`, `Album_Id`, `FileName`, `Title`, `Description`, `Date_Added`) VALUES
(3, 33, 'Capture.PNG', 'asdasd', 'asdasd', '2018-01-08'),
(7, 35, 'AC_1.jpg', 'These Are Test', '', '2018-01-09'),
(5, 34, 'AC.jpg', 'Test\'s', 'Test Me', '2018-01-09'),
(6, 34, 'AC.png', 'Test\'s', 'Test Me', '2018-01-09'),
(8, 35, 'AC_1.png', 'These Are Test', '', '2018-01-09'),
(9, 36, 'IMG_0528.JPG', 'asdasd', 'adsasd', '2018-01-09'),
(10, 36, 'IMG_0552.JPG', 'sick pics', '', '2018-01-09'),
(11, 36, 'IMG_0559.JPG', 'sick pics', '', '2018-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` varchar(16) NOT NULL,
  `Name` varchar(256) NOT NULL,
  `Phone` varchar(16) DEFAULT NULL,
  `Password` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `Name`, `Phone`, `Password`) VALUES
('1234', 'Connor', '613-613-6465', 'cc9f816a42431cf852cdc7a3fad42a6f65ffce24'),
('1233', 'Test Add', '659-234-5223', 'cc9f816a42431cf852cdc7a3fad42a6f65ffce24'),
('1235', 'Another Test', '613-652-5844', 'cc9f816a42431cf852cdc7a3fad42a6f65ffce24'),
('1212', 'James Cameron', '563-254-2324', 'cc9f816a42431cf852cdc7a3fad42a6f65ffce24'),
('1111', 'pizzapants', '555-555-5555', 'cc9f816a42431cf852cdc7a3fad42a6f65ffce24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`Album_Id`),
  ADD KEY `Owner_Id` (`Owner_Id`),
  ADD KEY `Accessibility_Code` (`Accessibility_Code`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Comment_Id`),
  ADD KEY `Author_Id` (`Author_Id`),
  ADD KEY `Picture_Id` (`Picture_Id`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD KEY `Friend_RequesterId` (`Friend_RequesterId`),
  ADD KEY `Friend_RequesteeId` (`Friend_RequesteeId`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `friendshipstatus`
--
ALTER TABLE `friendshipstatus`
  ADD PRIMARY KEY (`Status_Code`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`Picture_Id`),
  ADD KEY `Album_Id` (`Album_Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `Album_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `Comment_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `Picture_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
