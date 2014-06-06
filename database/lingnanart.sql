delimiter $$

DROP DATABASE IF EXISTS `lingnanart`$$
CREATE DATABASE `lingnanart` /*!40100 DEFAULT CHARACTER SET utf8 */$$

delimiter $$

USE `lingnanart`

delimiter $$

DROP TABLE IF EXISTS `news`$$

delimiter $$

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `author` varchar(45) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `class` int(11) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$

delimiter $$

DROP TABLE IF EXISTS `photo_album`$$

delimiter $$

CREATE TABLE `photo_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$

delimiter $$

DROP TABLE IF EXISTS `teacher`$$

delimiter $$

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `class` TINYINT NOT NULL,
  `photo` varchar(100) NOT NULL,
  `desc` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$

delimiter $$

DROP TABLE IF EXISTS `work`$$

delimiter $$

CREATE TABLE `work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `src` varchar(70) NOT NULL,
  `finish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL DEFAULT '0',
  `id_album` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `work_fk_photo_album` (`id_album`),
  CONSTRAINT `work_fk_photo_album` FOREIGN KEY (`id_album`) REFERENCES `photo_album` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$

delimiter $$

DROP TABLE IF EXISTS `admin`$$

delimiter $$

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `truename` varchar(45) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'root',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$



