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