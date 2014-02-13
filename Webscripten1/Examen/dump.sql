-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2014 at 10:37 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sws_groep2`
--
CREATE DATABASE IF NOT EXISTS `sws_groep2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sws_groep2`;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `title`) VALUES
(1, 'Animation'),
(2, 'Action'),
(3, 'Adventure'),
(4, 'Comedy'),
(5, 'Drama'),
(6, 'Romance'),
(7, 'Biography'),
(8, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `cover_extension` enum('gif','png','jpg') NOT NULL DEFAULT 'jpg',
  `added_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `year`, `user_id`, `genre_id`, `cover_extension`, `added_on`) VALUES
(1, 'Futurama: Bender''s Big Score', 2007, 1, 4, 'jpg', '2014-01-17 21:38:23'),
(2, 'Futurama: The Beast with a Billion Backs', 2008, 1, 4, 'jpg', '2014-01-19 21:38:23'),
(3, 'Futurama: Bender''s Game', 2008, 1, 4, 'jpg', '2014-01-20 21:38:23'),
(4, 'Futurama: Into the Wild Green Yonder', 2009, 1, 4, 'jpg', '2014-01-23 21:38:23'),
(5, 'Toy Story', 1995, 2, 1, 'jpg', '2014-01-24 21:38:23'),
(6, 'Toy Story 2', 1999, 2, 1, 'jpg', '2014-01-25 21:38:23'),
(7, 'Toy Story 3', 2010, 1, 1, 'jpg', '2014-01-26 21:38:23'),
(8, 'Forrest Gump', 1994, 2, 5, 'png', '2014-01-27 21:38:23'),
(9, 'Moneyball', 2011, 2, 8, 'jpg', '2014-01-28 21:38:23'),
(10, 'The Wolf of Wall Street', 2013, 1, 7, 'jpg', '2014-01-28 21:47:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'bramus', '$1$X02p4VMa$4V59VvoTZuUpAIyufuk3n1'),
(2, 'rogier', '$1$o0ZwMglZ$fJuQHUTySWLhayPj1Fl7L1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
