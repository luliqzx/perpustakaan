-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2016 at 09:27 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ntmc`
--

-- --------------------------------------------------------

--
-- Table structure for table `fact_driver_location`
--

CREATE TABLE IF NOT EXISTS `fact_driver_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` varchar(45) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `company_name` varchar(45) NOT NULL,
  `driver_name` varchar(45) NOT NULL,
  `plat_license` varchar(45) NOT NULL,
  `container_number` varchar(24) NOT NULL,
  `insurance` varchar(45) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fact_driver_location`
--

INSERT INTO `fact_driver_location` (`id`, `card_id`, `driver_id`, `company_name`, `driver_name`, `plat_license`, `container_number`, `insurance`, `lat`, `lng`, `active`, `created`, `updated`) VALUES
(1, '801889949890000000019102', 19, 'PT Laut Sentosa Makmur', 'Daniel Tandjung', 'B1234AB', '-', '123312', -6.117793, 106.892381, 1, '2016-07-31 00:00:00', '2016-07-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gcm_users`
--

CREATE TABLE IF NOT EXISTS `gcm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` varchar(45) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `gcm_id` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gcm_users`
--

INSERT INTO `gcm_users` (`id`, `card_id`, `driver_id`, `gcm_id`, `active`, `created`, `updated`) VALUES
(1, '801889949890000000019102', 19, 'asdasdqweqweqw', 1, '2016-07-31 00:00:00', '2016-07-31 17:15:10'),
(2, '801889949890000000023805', 23, 'APA91bE7XL8XDnHV1VP-i-Zli-gm-3HdMCdjUyJUeWgbRkaYq4LDx67ECeV1-LLw1tMz9CatAchXN-06R3qvy8up6nIEYpIvb6WS_oBMEGM7osjJj3U2OS8', 1, '2016-07-31 17:15:28', '2016-07-31 19:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `last_driver_location`
--

CREATE TABLE IF NOT EXISTS `last_driver_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` varchar(45) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `last_driver_location`
--

INSERT INTO `last_driver_location` (`id`, `card_id`, `driver_id`, `lat`, `lng`, `active`, `created`, `updated`) VALUES
(1, '801889949890000000019102', 19, -6.117793, 106.892381, 1, '2016-07-31 00:00:00', '2016-07-31 00:00:00'),
(2, '801889949890000000023805', 23, -6.117793, 106.892381, 1, '2016-07-31 18:06:09', '0000-00-00 00:00:00'),
(3, '801889949890000000023805', 23, -6.117793, 106.892381, 1, '2016-07-31 18:06:28', '0000-00-00 00:00:00'),
(4, '801889949890000000023805', 23, -6.117793, 106.892381, 1, '2016-07-31 18:45:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `log_panic`
--

CREATE TABLE IF NOT EXISTS `log_panic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` varchar(45) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `panic_id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `log_panic`
--

INSERT INTO `log_panic` (`id`, `card_id`, `driver_id`, `lat`, `lng`, `panic_id`, `msg`, `level`, `active`, `created`, `updated`) VALUES
(1, '2147483647', 23, -6.117793, 106.892381, 1, 'ada deh', 1, 1, '2016-07-31 17:56:40', '0000-00-00 00:00:00'),
(2, '2147483647', 23, -6.117793, 106.892381, 1, 'ada deh', 1, 1, '2016-07-31 17:57:19', '0000-00-00 00:00:00'),
(3, '801889949890000000023805', 23, -6.117793, 106.892381, 1, 'ada deh', 1, 1, '2016-07-31 17:57:38', '0000-00-00 00:00:00'),
(4, '801889949890000000023805', 23, -6.117793, 106.892381, 1, 'ada deh', 1, 1, '2016-07-31 17:57:52', '0000-00-00 00:00:00'),
(5, '801889949890000000023805', 23, -6.117793, 106.892381, 1, 'ada deh', 1, 1, '2016-07-31 18:45:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_panic`
--

CREATE TABLE IF NOT EXISTS `master_panic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `master_panic`
--

INSERT INTO `master_panic` (`id`, `name`, `deskripsi`, `active`, `created`, `updated`) VALUES
(1, 'Panic 1', 'Ada lah', 1, '2016-07-31 00:00:00', '2016-07-31 00:00:00'),
(2, 'Panic 2', 'Ada lah 2', 1, '2016-07-31 00:00:00', '2016-07-31 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
