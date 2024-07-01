-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 06:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_contact`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_Message` (IN `fname` VARCHAR(20), IN `lname` VARCHAR(50), IN `email` VARCHAR(100), IN `phone` VARCHAR(11), IN `subject` INT, IN `message` TEXT)   BEGIN

DECLARE uId INT DEFAULT NULL;
SELECT tbl_contact.contact_Id
INTO uId
FROM tbl_contact
WHERE tbl_contact.contact_EMail=email
AND tbl_contact.contact_Phone=phone;

IF uId IS NULL THEN

INSERT INTO tbl_contact (tbl_contact.contact_FName, tbl_contact.contact_SName, tbl_contact.contact_EMail, tbl_contact.contact_Phone)
VALUES (fname, lname, email, phone);

SELECT LAST_INSERT_ID() INTO uId;

END IF;

INSERT INTO tbl_message (tbl_message.contact_Id, tbl_message.subject_Id, tbl_message.msg_Text)
VALUES (uId, subject, message);

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `contact_Id` int(11) NOT NULL,
  `contact_FName` varchar(20) NOT NULL,
  `contact_SName` varchar(50) NOT NULL,
  `contact_EMail` varchar(100) NOT NULL,
  `contact_Phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`contact_Id`, `contact_FName`, `contact_SName`, `contact_EMail`, `contact_Phone`) VALUES
(1, 'Tamas', 'Varga', 'vargata77@googlemail.com', '07868517309'),
(2, 'TAMAS', 'VARGA', 'vargatam@yahoo.com', '07868517309');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `msg_Id` int(11) NOT NULL,
  `contact_Id` int(11) NOT NULL,
  `subject_Id` int(11) NOT NULL,
  `msg_Text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`msg_Id`, `contact_Id`, `subject_Id`, `msg_Text`) VALUES
(1, 1, 1, 'Where am I?'),
(2, 2, 3, 'I\'m not happy'),
(3, 2, 2, 'Please call me');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `subject_Id` int(11) NOT NULL,
  `subject_Text` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`subject_Id`, `subject_Text`) VALUES
(1, 'Enquiry'),
(2, 'Call Back'),
(3, 'Complaint');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD UNIQUE KEY `contact_Id` (`contact_Id`),
  ADD KEY `contact_EMail` (`contact_EMail`,`contact_Phone`),
  ADD KEY `contact_Id_2` (`contact_Id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD UNIQUE KEY `msg_Id` (`msg_Id`),
  ADD KEY `contact_Id` (`contact_Id`) USING BTREE,
  ADD KEY `subject_Id` (`subject_Id`) USING BTREE;

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD UNIQUE KEY `subject_Id` (`subject_Id`),
  ADD KEY `subject_Id_2` (`subject_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `contact_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `msg_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `subject_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
