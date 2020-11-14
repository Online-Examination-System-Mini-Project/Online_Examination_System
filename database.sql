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

create table superadmin(
  sadminId int NOT NULL,
  sadminName varchar(30) NOT NULL,
  email varchar(50) NOT NULL,
  pasword varchar(500) NOT NULL
);

INSERT INTO `superadmin` (`sadminId`, `sadminName`, `email`, `pasword`) VALUES ('1', 'Ramballabh', 'ramballabh.agrawal_cs18@gla.ac.in', 'ramballabh');
INSERT INTO `superadmin` (`sadminId`, `sadminName`, `email`, `pasword`) VALUES ('2', 'Gopal Tiwari', 'gopal.tiwari_cs18@gla.ac.in', 'gopaltiwari');
INSERT INTO `superadmin` (`sadminId`, `sadminName`, `email`, `pasword`) VALUES ('3', 'Vineet Agrawal', 'vineet.agrawal_cs18@gla.ac.in', 'vineetagrawal');
INSERT INTO `superadmin` (`sadminId`, `sadminName`, `email`, `pasword`) VALUES ('4', 'Ayush goyal', 'ayush.goyal_cs18@gla.ac.in', 'ayushgoyal');
INSERT INTO `superadmin` (`sadminId`, `sadminName`, `email`, `pasword`) VALUES ('5', 'Naveen Gupta', 'naveen.gupta_cs18@gla.ac.in', 'naveengupta');

CREATE TABLE `quiz` ( `eid` text NOT NULL, `title` varchar(100) NOT NULL, `Creator's email` varchar(100) NOT NULL, `sahi` int(11) NOT NULL, `wrong` int(11) NOT NULL, `total` int(11) NOT NULL, `time` bigint(20) NOT NULL, `intro` text NOT NULL, `tag` varchar(100) NOT NULL, `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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


CREATE TABLE `answer` (
  `qid` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `feedback` (
  `id` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50)NOT NULL,
  `subject` varchar(500) NOT NULL,
  `feedback` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `rank` (
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminId`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

ALTER TABLE `admins`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;