-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 24, 2021 at 01:02 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workflow_automation`
--
CREATE DATABASE IF NOT EXISTS `workflow_automation` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `workflow_automation`;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_alert`
--

DROP TABLE IF EXISTS `appointment_alert`;
CREATE TABLE IF NOT EXISTS `appointment_alert` (
  `date` date NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `action_performed` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_alert`
--

INSERT INTO `appointment_alert` (`date`, `email_address`, `action_performed`) VALUES
('2021-07-25', 'test@test.com', 'New appointment set'),
('2021-07-25', 'test@test.com', 'New appointment set');

-- --------------------------------------------------------

--
-- Table structure for table `call_alert`
--

DROP TABLE IF EXISTS `call_alert`;
CREATE TABLE IF NOT EXISTS `call_alert` (
  `call_from` varchar(15) NOT NULL,
  `call_to` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `duration` time NOT NULL,
  `action_performed` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `call_alert`
--

INSERT INTO `call_alert` (`call_from`, `call_to`, `date`, `duration`, `action_performed`) VALUES
('8574961235', '7896541232', '2021-07-24', '00:00:52', 'New call made'),
('85749621', '78541233', '2021-07-24', '00:01:52', 'New call received');

-- --------------------------------------------------------

--
-- Table structure for table `email_alert`
--

DROP TABLE IF EXISTS `email_alert`;
CREATE TABLE IF NOT EXISTS `email_alert` (
  `email_id` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `action_performed` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_alert`
--

INSERT INTO `email_alert` (`email_id`, `subject`, `body`, `date`, `action_performed`) VALUES
('sparsh@test.com', 'test', 'test test', '2021-07-24', 'New email sent'),
('sparsh@test.com', 'test', 'test test', '2021-07-24', 'New email sent'),
('sparsh@gmail.com', 'Test', 'Test', '2021-07-24', 'New email sent');

-- --------------------------------------------------------

--
-- Table structure for table `made_call`
--

DROP TABLE IF EXISTS `made_call`;
CREATE TABLE IF NOT EXISTS `made_call` (
  `call_from` varchar(15) NOT NULL,
  `call_to` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `duration` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `made_call`
--

INSERT INTO `made_call` (`call_from`, `call_to`, `date`, `duration`) VALUES
('8574961235', '7896541232', '2021-07-24', '00:00:52');

--
-- Triggers `made_call`
--
DROP TRIGGER IF EXISTS `after call made`;
DELIMITER $$
CREATE TRIGGER `after call made` AFTER INSERT ON `made_call` FOR EACH ROW BEGIN 
INSERT into call_alert VALUES(NEW.call_from, NEW.call_to, NEW.date, NEW.duration , "New call made");
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `received_call`
--

DROP TABLE IF EXISTS `received_call`;
CREATE TABLE IF NOT EXISTS `received_call` (
  `call_from` varchar(15) NOT NULL,
  `call_to` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `received_call`
--

INSERT INTO `received_call` (`call_from`, `call_to`, `date`, `duration`) VALUES
('85749621', '78541233', '2021-07-24', '00:01:52');

--
-- Triggers `received_call`
--
DROP TRIGGER IF EXISTS `after call received`;
DELIMITER $$
CREATE TRIGGER `after call received` AFTER INSERT ON `received_call` FOR EACH ROW BEGIN 
INSERT into call_alert VALUES(NEW.call_from, NEW.call_to, NEW.date, NEW.duration, "New call received");
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `received_sms`
--

DROP TABLE IF EXISTS `received_sms`;
CREATE TABLE IF NOT EXISTS `received_sms` (
  `sent_from` varchar(15) NOT NULL,
  `sent_to` varchar(15) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `received_sms`
--
DROP TRIGGER IF EXISTS `after message received`;
DELIMITER $$
CREATE TRIGGER `after message received` AFTER INSERT ON `received_sms` FOR EACH ROW BEGIN 
INSERT into sms_alert VALUES(NEW.sent_from, NEW.sent_to, NEW.date, "New sms received");
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `send_email`
--

DROP TABLE IF EXISTS `send_email`;
CREATE TABLE IF NOT EXISTS `send_email` (
  `email_id` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `send_email`
--

INSERT INTO `send_email` (`email_id`, `subject`, `body`, `date`) VALUES
('sparsh@test.com', 'test', 'test test', '2021-07-24'),
('sparsh@test.com', 'test', 'test test', '2021-07-24'),
('sparsh@gmail.com', 'Test', 'Test', '2021-07-24');

--
-- Triggers `send_email`
--
DROP TRIGGER IF EXISTS `after sending email`;
DELIMITER $$
CREATE TRIGGER `after sending email` AFTER INSERT ON `send_email` FOR EACH ROW BEGIN 
INSERT into email_alert VALUES(NEW.email_id, NEW.subject, NEW.body, NEW.date,"New email sent");
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sent_sms`
--

DROP TABLE IF EXISTS `sent_sms`;
CREATE TABLE IF NOT EXISTS `sent_sms` (
  `sent_from` varchar(15) NOT NULL,
  `sent_to` varchar(15) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sent_sms`
--

INSERT INTO `sent_sms` (`sent_from`, `sent_to`, `date`) VALUES
('98574566', '78965455', '2021-07-24');

--
-- Triggers `sent_sms`
--
DROP TRIGGER IF EXISTS `after sms sent`;
DELIMITER $$
CREATE TRIGGER `after sms sent` AFTER INSERT ON `sent_sms` FOR EACH ROW BEGIN 
INSERT into sms_alert VALUES(NEW.sent_from, NEW.sent_to, NEW.date, "New sms sent");
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `set_appointment`
--

DROP TABLE IF EXISTS `set_appointment`;
CREATE TABLE IF NOT EXISTS `set_appointment` (
  `date` date NOT NULL,
  `email_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `set_appointment`
--

INSERT INTO `set_appointment` (`date`, `email_address`) VALUES
('2021-07-25', 'test@test.com'),
('2021-07-25', 'test@test.com');

--
-- Triggers `set_appointment`
--
DROP TRIGGER IF EXISTS `after setting appointment`;
DELIMITER $$
CREATE TRIGGER `after setting appointment` AFTER INSERT ON `set_appointment` FOR EACH ROW BEGIN
INSERT into appointment_alert VALUES (NEW.date, NEW.email_address, "New appointment set");
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sms_alert`
--

DROP TABLE IF EXISTS `sms_alert`;
CREATE TABLE IF NOT EXISTS `sms_alert` (
  `sent_from` varchar(15) NOT NULL,
  `sent_to` varchar(15) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action_performed` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_alert`
--

INSERT INTO `sms_alert` (`sent_from`, `sent_to`, `date`, `action_performed`) VALUES
('98574566', '78965455', '2021-07-24 00:00:00', 'New sms sent');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
