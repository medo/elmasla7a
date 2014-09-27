-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2014 at 08:38 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elmsl7a`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `imagePath` varchar(300) NOT NULL,
  `price` int(11) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `quantity`, `imagePath`, `price`, `summary`) VALUES
(1, 'Apple iPhone 5S', 10, 'http://cf4.souqcdn.com/item/2013/10/22/57/54/74/2/item_M_5754742_3518911.jpg', 5499, ''),
(2, 'Apple iPad Air', 7, 'http://cf3.souqcdn.com/item/2013/10/23/62/76/31/2/item_M_6276312_3528682.jpg', 5151, ''),
(3, 'Apple Macbook Air', 12, 'http://cf2.souqcdn.com/item/40/81/27/9/item_M_4081279_942036.jpg', 10000, ''),
(4, 'MacBook Pro With Retina Display', 3, 'http://cf3.souqcdn.com/item/2013/11/13/63/28/21/4/item_M_6328214_3621445.jpg', 23899, ''),
(5, 'Apple iPhone Bluetooth', 25, 'http://cf2.souqcdn.com/item/2014/01/14/65/08/41/9/item_M_6508419_3983072.jpg', 138, ''),
(6, 'Power Charger for MacBook Pro', 9, 'http://cf3.souqcdn.com/item/2014/05/17/69/44/28/2/item_M_6944282_4718816.jpg', 450, ''),
(7, 'Apple Magic Mouse', 1, 'http://cf3.souqcdn.com/item/65/82/36/item_M_658236_556136.jpg', 699, ''),
(8, 'Apple Earpods With Remote And Mic', 0, 'http://cf3.souqcdn.com/item/2013/08/28/56/75/40/3/item_M_5675403_2783321.jpg', 45, '');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`,`itemId`),
  KEY `itemId` (`itemId`),
  KEY `userId_2` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profilePicturePath` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `profilePicturePath`) VALUES
(1, 'Mohamed', 'Bassem', 'test@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'http://www.amdadjusters.org/amd/images/profileholder.gif');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `FK_Transaction_Item_itemId` FOREIGN KEY (`itemId`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Transaction_User_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
