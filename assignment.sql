-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2018 at 02:44 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admin1`
--

CREATE TABLE IF NOT EXISTS `admin1` (
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin1`
--

INSERT INTO `admin1` (`username`, `password`) VALUES
('thecoupledradiation', 'Alig_123'),
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bidder`
--

CREATE TABLE IF NOT EXISTS `bidder` (
  `b_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `warning` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `bidder`
--

INSERT INTO `bidder` (`b_id`, `name`, `username`, `password`, `email`, `phone_no`, `warning`) VALUES
(9, 'tej2', 'tejveer12345', 'tejveer123', 'tejveersharma384@gmail.com', '9045704462', 'sent'),
(10, 'tejveer', 'tejveer123', 'tejveer123', 'tejveer1994@gmail.com', '9045704463', 'sent');

-- --------------------------------------------------------

--
-- Table structure for table `bidder_item`
--

CREATE TABLE IF NOT EXISTS `bidder_item` (
  `i_id` int(5) NOT NULL DEFAULT '0',
  `b_id` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`i_id`,`b_id`),
  KEY `b_id` (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidder_item`
--

INSERT INTO `bidder_item` (`i_id`, `b_id`) VALUES
(1, 9),
(1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `i_id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `buy_now_price` int(10) DEFAULT NULL,
  `min_bid_price` int(10) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `curr_bid_price` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `s_id` int(5) DEFAULT NULL,
  `image1` varchar(200) DEFAULT NULL,
  `image2` varchar(200) DEFAULT NULL,
  `image3` varchar(200) DEFAULT NULL,
  `curr_bidder_id` int(5) DEFAULT NULL,
  `mail_status` varchar(25) DEFAULT NULL,
  `warning` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`i_id`),
  KEY `s_id` (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`i_id`, `title`, `category`, `buy_now_price`, `min_bid_price`, `brand`, `start_date`, `end_date`, `curr_bid_price`, `status`, `description`, `s_id`, `image1`, `image2`, `image3`, `curr_bidder_id`, `mail_status`, `warning`) VALUES
(1, 'dfgg', 'Sporting Goods', 40, 30, 'dfdf', '2018-05-14', '2018-05-31', 150, 'Expired', 'dfdsafe', 14, '3.jpg', '6.jpg', '1.jpg', 10, NULL, NULL),
(2, 'sff', 'Electronics', 6, 3, 'aa', '2018-05-22', '2018-05-24', 3, 'Expired', 'sss', 15, 'scan0001.jpg', 'scan0001.jpg', 'scan0001.jpg', 0, NULL, NULL),
(3, 'Check', 'Others', 2345, 200, 'Person', '2018-09-03', '2018-09-30', 200, 'Available', 'njsfjndsfjdsnfjk', 15, 'IMG-20180329-WA0003.jpg', 'IMG-20180329-WA0003.jpg', 'IMG-20180329-WA0003.jpg', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `b_id` int(5) DEFAULT NULL,
  `s_id` int(5) DEFAULT NULL,
  `rating` varchar(1) DEFAULT NULL,
  `comments` text,
  `who` varchar(10) DEFAULT NULL,
  KEY `b_id` (`b_id`),
  KEY `s_id` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `s_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `warning` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`s_id`, `name`, `username`, `password`, `email`, `phone_no`, `warning`) VALUES
(14, 'ravi sharma', 'ravisharma', 'ravi1234', 'ravisharma2@gmail.com', '9856324578', NULL),
(15, 'tejveer sharma', 'tejveer123', 'tejveer1234', 'tejveer123@gmail.com', '9045704463', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidder_item`
--
ALTER TABLE `bidder_item`
  ADD CONSTRAINT `bidder_item_ibfk_1` FOREIGN KEY (`i_id`) REFERENCES `item` (`i_id`),
  ADD CONSTRAINT `bidder_item_ibfk_2` FOREIGN KEY (`b_id`) REFERENCES `bidder` (`b_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `seller` (`s_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `bidder` (`b_id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `seller` (`s_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
