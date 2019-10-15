-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 11, 2011 at 04:12 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `student`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `id` int(2) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `confirm` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(1000) NOT NULL default 'xyz',
  `status` varchar(50) NOT NULL default 'xyz',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` (`id`, `name`, `password`, `confirm`, `email`, `image`, `status`) VALUES 
(1, '".$name."', '".$pswd."', '".$confirm."', '".$email."', 'xyz', 'Active'),
(2, 'dfsd', 'dfdsf', 'dsfdsf', 'sddfdsf', 'xyz', 'Active'),
(3, '', '', '', '', 'xyz', 'Active'),
(4, 'gg', 'gdfg', 'gfdgfd', 'gfgfdgd', 'xyz', 'Active'),
(5, '".$name."', '".$password."', '".$confirm."', '".$email."', 'xyz', 'xyz'),
(6, 'gfgf', 'fgfd', 'dfgdfg', 'dfgfdgdf', 'xyz', 'xyz'),
(7, 'dfdsf', 'sdfds', 'sdfdsf', 'sdfsdfsd', 'xyz', 'xyz'),
(8, 'sdfsd', 'sdfsd', 'fdsfsd', 'sdfsdf', 'xyz', 'xyz'),
(9, 'dasds', 'sdfds', 'dfdsf', 'sdfsds', 'xyz', 'xyz'),
(10, 'ggd', 'fgdf', 'fgfd', 'dfgfd', 'xyz', 'xyz'),
(11, 'ggdfgdfg', 'gdfgd', 'dfgdfg', 'fgdfgfd', 'xyz', 'xyz'),
(12, 'anil', 'anil', 'anil', 'anil', 'xyz', 'xyz'),
(13, 'anil', 'anil', 'anil', 'anil', '', 'xyz'),
(14, 'anil', 'anil', 'anil', 'anil', '', 'xyz'),
(15, 'hh', 'hh', 'hh', 'hh', 'pc1.jpg', 'xyz'),
(16, 'ff', 'ff', 'ff', 'ff', 'Flowers2.jpg', 'xyz');
