-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2013 at 09:10 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sentimento`
--

-- --------------------------------------------------------

--
-- Table structure for table `excel_input`
--

CREATE TABLE IF NOT EXISTS `excel_input` (
  `id` varchar(20) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `request_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `excel_output`
--

CREATE TABLE IF NOT EXISTS `excel_output` (
  `id` varchar(20) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request_id` varchar(20) NOT NULL,
  `sentiment` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_input`
--

CREATE TABLE IF NOT EXISTS `facebook_input` (
  `id` varchar(200) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `like_count` int(11) NOT NULL DEFAULT '0',
  `request_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_output`
--

CREATE TABLE IF NOT EXISTS `facebook_output` (
  `id` varchar(200) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `like_count` int(11) NOT NULL DEFAULT '0',
  `request_id` varchar(20) NOT NULL,
  `sentiment` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spice_input`
--

CREATE TABLE IF NOT EXISTS `spice_input` (
  `id` varchar(20) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `likes_count` int(11) NOT NULL DEFAULT '0',
  `request_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spice_output`
--

CREATE TABLE IF NOT EXISTS `spice_output` (
  `id` varchar(20) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `likes_count` int(11) NOT NULL DEFAULT '0',
  `request_id` int(11) NOT NULL,
  `sentiment` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `twitter_input`
--

CREATE TABLE IF NOT EXISTS `twitter_input` (
  `id` varchar(100) NOT NULL,
  `text` varchar(500) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `retweet_count` int(11) NOT NULL DEFAULT '0',
  `request_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `twitter_output`
--

CREATE TABLE IF NOT EXISTS `twitter_output` (
  `id` varchar(100) NOT NULL,
  `text` varchar(500) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `retweet_count` int(11) NOT NULL DEFAULT '0',
  `request_id` varchar(20) NOT NULL,
  `sentiment` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
