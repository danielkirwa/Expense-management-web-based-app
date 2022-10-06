-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2022 at 11:23 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `expense_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `billID` int(11) NOT NULL AUTO_INCREMENT,
  `billname` varchar(50) NOT NULL,
  `billdescription` varchar(256) NOT NULL,
  `dateofadd` date NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`billID`),
  KEY `db` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`billID`, `billname`, `billdescription`, `dateofadd`, `pid`) VALUES
(1, 'Electricity', 'Electric power', '2022-08-28', 987456),
(2, 'Water', 'For water supply', '2022-08-28', 987456),
(3, 'Mill', 'Milling', '2022-08-28', 454545),
(4, 'fee', 'school fee', '2022-09-08', 987456);

-- --------------------------------------------------------

--
-- Table structure for table `billstransaction`
--

CREATE TABLE IF NOT EXISTS `billstransaction` (
  `billtransactionID` int(11) NOT NULL AUTO_INCREMENT,
  `billtransactiondate` date NOT NULL,
  `billtrasactionamount` int(30) NOT NULL,
  `billtrasactionstatus` varchar(30) NOT NULL,
  `billID` int(3) NOT NULL,
  PRIMARY KEY (`billtransactionID`),
  KEY `billID` (`billID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `billstransaction`
--

INSERT INTO `billstransaction` (`billtransactionID`, `billtransactiondate`, `billtrasactionamount`, `billtrasactionstatus`, `billID`) VALUES
(1, '2022-08-29', 2000, 'piad', 1),
(2, '2022-08-29', 344, 'piad', 1),
(3, '2022-09-20', 2100, 'piad', 2);

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE IF NOT EXISTS `emergency` (
  `emergencyID` int(11) NOT NULL AUTO_INCREMENT,
  `purpose` varchar(50) NOT NULL,
  `dateadded` date NOT NULL,
  `emergencydescription` varchar(256) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`emergencyID`),
  KEY `de` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`emergencyID`, `purpose`, `dateadded`, `emergencydescription`, `pid`) VALUES
(2, 'Medical', '2022-08-29', 'For medical emergency', 987456);

-- --------------------------------------------------------

--
-- Table structure for table `emergencytrsansction`
--

CREATE TABLE IF NOT EXISTS `emergencytrsansction` (
  `emergencytransactionID` int(11) NOT NULL AUTO_INCREMENT,
  `emergencytransactiondate` date NOT NULL,
  `emergencytrasactionamount` varchar(30) NOT NULL,
  `emergencytransactionstatus` varchar(30) NOT NULL,
  `emergencyID` int(3) NOT NULL,
  PRIMARY KEY (`emergencytransactionID`),
  KEY `emergencyID` (`emergencyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `persondetails`
--

CREATE TABLE IF NOT EXISTS `persondetails` (
  `personID` int(11) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `othername` varchar(30) NOT NULL,
  `phone` int(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `incomesourse` varchar(50) NOT NULL,
  PRIMARY KEY (`personID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persondetails`
--

INSERT INTO `persondetails` (`personID`, `surname`, `othername`, `phone`, `email`, `dateofbirth`, `gender`, `incomesourse`) VALUES
(454545, 'test', 'tets', 12589634, 'test@gmail.com', '2022-05-28', 'MALE', 'Business'),
(987456, 'Edwin', 'Marita', 785236541, 'marita@gmail.com', '2022-08-28', 'MALE', 'Business'),
(41441441, 'BEN', 'OKOTH', 789898670, 'beb@gmail.com', '2022-09-14', 'MALE', 'job');

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

CREATE TABLE IF NOT EXISTS `savings` (
  `savingID` int(11) NOT NULL AUTO_INCREMENT,
  `savingpurpose` varchar(50) NOT NULL,
  `savingtarget` varchar(30) NOT NULL,
  `savingdateoppened` date NOT NULL,
  `savingdateclosed` date NOT NULL,
  `savingname` varchar(30) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`savingID`),
  KEY `dsa` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`savingID`, `savingpurpose`, `savingtarget`, `savingdateoppened`, `savingdateclosed`, `savingname`, `pid`) VALUES
(4, 'School fees for University', '25000', '2022-08-29', '2022-12-30', 'School fee', 454545);

-- --------------------------------------------------------

--
-- Table structure for table `savingtransaction`
--

CREATE TABLE IF NOT EXISTS `savingtransaction` (
  `savingtransactiondat` date NOT NULL,
  `savingtransactionamount` int(11) NOT NULL,
  `savingtransactionsatus` int(11) NOT NULL,
  `savingID` int(11) NOT NULL,
  PRIMARY KEY (`savingID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shopping`
--

CREATE TABLE IF NOT EXISTS `shopping` (
  `shoppingID` int(11) NOT NULL AUTO_INCREMENT,
  `shoppingname` varchar(50) NOT NULL,
  `shoppingdescription` varchar(50) NOT NULL,
  `shoopingdateadded` date NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`shoppingID`),
  KEY `ds` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `shopping`
--

INSERT INTO `shopping` (`shoppingID`, `shoppingname`, `shoppingdescription`, `shoopingdateadded`, `pid`) VALUES
(2, 'School', 'School shopping', '2022-08-29', 987456),
(3, 'Kitchen', 'Kitchen utilities', '2022-08-29', 987456),
(4, 'owen', 'kitchen', '2022-09-09', 987456),
(5, 'oven', 'kitchen', '2022-09-09', 987456),
(6, 'oven', 'kitchen', '2022-09-08', 987456),
(7, 'KETTLE', 'kitchen', '2022-09-07', 987456);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingtransaction`
--

CREATE TABLE IF NOT EXISTS `shoppingtransaction` (
  `shoppingtransactionID` int(11) NOT NULL AUTO_INCREMENT,
  `shoppingtransactionamount` int(30) NOT NULL,
  `shoppingtransactiondate` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `shoppingID` int(3) NOT NULL,
  PRIMARY KEY (`shoppingtransactionID`),
  KEY `fkshopptrs` (`shoppingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `shoppingtransaction`
--

INSERT INTO `shoppingtransaction` (`shoppingtransactionID`, `shoppingtransactionamount`, `shoppingtransactiondate`, `status`, `shoppingID`) VALUES
(3, 3567, '2022-09-09', 'PAUD', 6),
(4, 4500, '2022-09-07', 'PAID', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userusername` varchar(64) NOT NULL,
  `userpassword` varchar(64) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userusername`, `userpassword`, `pid`) VALUES
('job@gmail.com', '963852', 123456),
('marita@gmail.com', '123456', 987456),
('beb@gmail.com', '101010', 41441441);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `db` FOREIGN KEY (`pid`) REFERENCES `persondetails` (`personID`) ON UPDATE CASCADE;

--
-- Constraints for table `billstransaction`
--
ALTER TABLE `billstransaction`
  ADD CONSTRAINT `fk-bill-billtrs` FOREIGN KEY (`billID`) REFERENCES `bills` (`billID`) ON UPDATE CASCADE;

--
-- Constraints for table `emergency`
--
ALTER TABLE `emergency`
  ADD CONSTRAINT `de` FOREIGN KEY (`pid`) REFERENCES `persondetails` (`personID`) ON UPDATE CASCADE;

--
-- Constraints for table `emergencytrsansction`
--
ALTER TABLE `emergencytrsansction`
  ADD CONSTRAINT `fkemtrs` FOREIGN KEY (`emergencyID`) REFERENCES `emergency` (`emergencyID`) ON UPDATE CASCADE;

--
-- Constraints for table `savings`
--
ALTER TABLE `savings`
  ADD CONSTRAINT `dsa` FOREIGN KEY (`pid`) REFERENCES `persondetails` (`personID`) ON UPDATE CASCADE;

--
-- Constraints for table `shopping`
--
ALTER TABLE `shopping`
  ADD CONSTRAINT `ds` FOREIGN KEY (`pid`) REFERENCES `persondetails` (`personID`) ON UPDATE CASCADE;

--
-- Constraints for table `shoppingtransaction`
--
ALTER TABLE `shoppingtransaction`
  ADD CONSTRAINT `fkshopptrs` FOREIGN KEY (`shoppingID`) REFERENCES `shopping` (`shoppingID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
