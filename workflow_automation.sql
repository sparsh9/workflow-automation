-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2021 at 07:28 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `appointment_alert`
--

CREATE TABLE `appointment_alert` (
  `date` date NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `action_performed` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_alert`
--

INSERT INTO `appointment_alert` (`date`, `email_address`, `action_performed`) VALUES
('2021-07-25', 'test@test.com', 'New appointment set'),
('2021-07-25', 'test@test.com', 'New appointment set'),
('2021-08-05', 'sparsh@gmail.com', 'New appointment set');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_trigger`
--

CREATE TABLE `appointment_trigger` (
  `appointment_trigger` varchar(20) NOT NULL,
  `appointment_action` varchar(50) NOT NULL,
  `appointment_scheduled_email` varchar(100) DEFAULT NULL,
  `appointment_scheduled_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_trigger`
--

INSERT INTO `appointment_trigger` (`appointment_trigger`, `appointment_action`, `appointment_scheduled_email`, `appointment_scheduled_date`) VALUES
('appointment_trigger', 'appointment_scheduled', 'test@test.in', '2021-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `call_alert`
--

CREATE TABLE `call_alert` (
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
('85749621', '78541233', '2021-07-24', '00:01:52', 'New call received'),
('789456562', '789951265', '2021-08-04', '00:00:52', 'New call made'),
('789965222', '789552222', '2021-08-04', '00:01:52', 'New call received'),
('87456223', '78945221', '2021-08-04', '00:00:52', 'New call made');

-- --------------------------------------------------------

--
-- Table structure for table `call_trigger`
--

CREATE TABLE `call_trigger` (
  `call_trigger` varchar(20) NOT NULL,
  `call_action` varchar(20) NOT NULL,
  `call_from` varchar(15) DEFAULT NULL,
  `call_to` varchar(15) DEFAULT NULL,
  `call_date` date DEFAULT NULL,
  `call_duration` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `call_trigger`
--

INSERT INTO `call_trigger` (`call_trigger`, `call_action`, `call_from`, `call_to`, `call_date`, `call_duration`) VALUES
('call_trigger', 'call_made', '784', '745', '2021-08-06', '78'),
('call_trigger', 'call_received', '741', '562', '2021-08-06', '74');

-- --------------------------------------------------------

--
-- Table structure for table `email_alert`
--

CREATE TABLE `email_alert` (
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
('sparsh@gmail.com', 'Test', 'Test', '2021-07-24', 'New email sent'),
('sparshgarg@gmail.com', 'Test activity', 'This is a test body', '2021-08-04', 'New email sent');

-- --------------------------------------------------------

--
-- Table structure for table `made_call`
--

CREATE TABLE `made_call` (
  `call_from` varchar(15) NOT NULL,
  `call_to` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `duration` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `made_call`
--

INSERT INTO `made_call` (`call_from`, `call_to`, `date`, `duration`) VALUES
('8574961235', '7896541232', '2021-07-24', '00:00:52'),
('789456562', '789951265', '2021-08-04', '00:00:52'),
('87456223', '78945221', '2021-08-04', '00:00:52');

--
-- Triggers `made_call`
--
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

CREATE TABLE `received_call` (
  `call_from` varchar(15) NOT NULL,
  `call_to` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `received_call`
--

INSERT INTO `received_call` (`call_from`, `call_to`, `date`, `duration`) VALUES
('85749621', '78541233', '2021-07-24', '00:01:52'),
('789965222', '789552222', '2021-08-04', '00:01:52');

--
-- Triggers `received_call`
--
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

CREATE TABLE `received_sms` (
  `sent_from` varchar(15) NOT NULL,
  `sent_to` varchar(15) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `received_sms`
--

INSERT INTO `received_sms` (`sent_from`, `sent_to`, `date`) VALUES
('78541269', '78953223', '2021-08-04');

--
-- Triggers `received_sms`
--
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

CREATE TABLE `send_email` (
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
('sparsh@gmail.com', 'Test', 'Test', '2021-07-24'),
('sparshgarg@gmail.com', 'Test activity', 'This is a test body', '2021-08-04');

--
-- Triggers `send_email`
--
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

CREATE TABLE `sent_sms` (
  `sent_from` varchar(15) NOT NULL,
  `sent_to` varchar(15) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sent_sms`
--

INSERT INTO `sent_sms` (`sent_from`, `sent_to`, `date`) VALUES
('98574566', '78965455', '2021-07-24'),
('855746655', '785455555', '2021-08-04'),
('85745656', '78854525', '2021-08-04');

--
-- Triggers `sent_sms`
--
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

CREATE TABLE `set_appointment` (
  `date` date NOT NULL,
  `email_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `set_appointment`
--

INSERT INTO `set_appointment` (`date`, `email_address`) VALUES
('2021-07-25', 'test@test.com'),
('2021-07-25', 'test@test.com'),
('2021-08-05', 'sparsh@gmail.com');

--
-- Triggers `set_appointment`
--
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

CREATE TABLE `sms_alert` (
  `sent_from` varchar(15) NOT NULL,
  `sent_to` varchar(15) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action_performed` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_alert`
--

INSERT INTO `sms_alert` (`sent_from`, `sent_to`, `date`, `action_performed`) VALUES
('98574566', '78965455', '2021-07-24 00:00:00', 'New sms sent'),
('855746655', '785455555', '2021-08-04 00:00:00', 'New sms sent'),
('78541269', '78953223', '2021-08-04 00:00:00', 'New sms received'),
('85745656', '78854525', '2021-08-04 00:00:00', 'New sms sent');

-- --------------------------------------------------------

--
-- Table structure for table `sms_trigger`
--

CREATE TABLE `sms_trigger` (
  `sms_trigger` varchar(20) NOT NULL,
  `sms_action` varchar(20) NOT NULL,
  `sms_from` varchar(15) DEFAULT NULL,
  `sms_to` varchar(15) DEFAULT NULL,
  `sms_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_trigger`
--

INSERT INTO `sms_trigger` (`sms_trigger`, `sms_action`, `sms_from`, `sms_to`, `sms_date`) VALUES
('sms_trigger', 'sms_sent', '1234', '5678', '2021-08-06'),
('sms_trigger', 'sms_sent', '1234', '5678', '2021-08-06'),
('sms_trigger', 'sms_sent', '1234', '4567', '2021-08-07'),
('sms_trigger', 'sms_sent', '1234', '4567', '2021-08-07'),
('sms_trigger', 'sms_sent', '1234', '4567', '2021-08-07'),
('sms_trigger', 'sms_sent', '1234', '4567', '2021-08-07'),
('sms_trigger', 'sms_received', '8521', '4512', '2021-08-07'),
('sms_trigger', 'sms_sent', '7845', '45612', '2021-08-06'),
('sms_trigger', 'sms_sent', '7845', '45612', '2021-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `triggers`
--

CREATE TABLE `triggers` (
  `id` int(11) NOT NULL,
  `triggers` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `triggers`
--

INSERT INTO `triggers` (`id`, `triggers`) VALUES
(1, 'Call'),
(2, 'Sms'),
(3, 'Appointment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `triggers`
--
ALTER TABLE `triggers`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
