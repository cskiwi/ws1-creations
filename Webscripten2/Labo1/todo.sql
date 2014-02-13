-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 19, 2012 at 02:05 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

DROP DATABASE IF EXISTS `todo`;
CREATE DATABASE `todo` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE `todo`;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

DROP TABLE IF EXISTS `todolist`;
CREATE TABLE `todolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `what` varchar(255) NOT NULL,
  `priority` enum('high','normal','low') NOT NULL,
  `added_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`id`, `user_id`, `what`, `priority`, `added_on`) VALUES
(1, 1, 'A very urgent task', 'high', '2012-12-03 13:56:08'),
(2, 1, 'A normal priority task', 'normal', '2012-12-03 13:56:08'),
(3, 1, 'A low priority task', 'low', '2012-12-03 13:56:08'),
(4, 2, 'A very urgent task', 'high', '2012-12-19 13:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'bramus', '$1$WcKBgQfa$41VRSoNdRrllVs9DyqQHV/'),
(2, 'rogier', '$1$TG/Jg8M4$WGWLZQTIUyEsdGWhBWzLy0');