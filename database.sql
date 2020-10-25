-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2017 at 11:50 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
create table users(
    fname varchar(30) NOT NULL,
    lname varchar(30) NOT NULL,
    userName varchar(40) NOT NULL,
    email varchar(50) NOT NULL,
    pasword varchar(30) NOT NULL
);

create table admins(
  adminId int NOT NULL,
  adminName varchar(30) NOT NULL,
  email varchar(50) NOT NULL,
  pasword varchar(500) NOT NULL
);

INSERT INTO `admins` (`adminId`, `adminName`, `email`, `pasword`) VALUES ('1', 'Ramballabh', 'ramavpk@gmail.com', 'ramballabh');

CREATE TABLE `quiz` ( `eid` text NOT NULL, `title` varchar(100) NOT NULL, `sahi` int(11) NOT NULL, `wrong` int(11) NOT NULL, `total` int(11) NOT NULL, `time` bigint(20) NOT NULL, `intro` text NOT NULL, `tag` varchar(100) NOT NULL, `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ) ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE `questions` (
  `eid` text NOT NULL,
  `qid` text NOT NULL,
  `qns` text NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `options` (
  `qid` varchar(50) NOT NULL,
  `option` varchar(5000) NOT NULL,
  `optionid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
