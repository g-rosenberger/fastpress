-- Adminer 4.7.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';

CREATE TABLE `cat` (
  `catRelated` text NOT NULL,
  `catName` text NOT NULL,
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `catDescription` text NOT NULL,
  PRIMARY KEY (`catId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `fp` (
  `pImgAlt` tinyint(4) NOT NULL,
  `pImgUrl` text NOT NULL,
  `pKeywords` text NOT NULL,
  `pUrl` text NOT NULL,
  `pId` int(11) NOT NULL AUTO_INCREMENT,
  `pTitle` text NOT NULL,
  `pSubtitle` text NOT NULL,
  `pDate` datetime NOT NULL,
  `pCategory` text NOT NULL,
  PRIMARY KEY (`pId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2019-03-24 08:35:06