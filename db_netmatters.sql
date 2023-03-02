-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2023 at 08:41 PM
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
-- Database: `db_netmatters`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getNews` ()   BEGIN
SELECT
    category_name,
    news_img,
    news_title,
    news_content,
    news_date,
    poster_name
FROM tbl_news
    INNER JOIN tbl_categories
    	ON tbl_news.category_id = tbl_categories.category_id
    INNER JOIN tbl_poster
    	ON tbl_news.poster_id = tbl_poster.poster_id
ORDER BY tbl_news.news_date DESC
LIMIT 3;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `saveContact` (IN `cName` VARCHAR(50), IN `cCo` VARCHAR(50), IN `cMail` VARCHAR(30), IN `cPhone` VARCHAR(13), OUT `cId` INT)   BEGIN
INSERT INTO tbl_contacts (
    contact_name,
    contact_company,
    contact_email,
    contact_phone)
VALUES (
    cName,
    cCo,
	cMail,
	cPhone);
SELECT LAST_INSERT_ID() INTO cId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `saveEnquiry` (IN `cName` VARCHAR(50), IN `cCo` VARCHAR(50), IN `cMail` VARCHAR(30), IN `cPhone` VARCHAR(13), IN `mSubj` VARCHAR(50), IN `mCont` TEXT, INOUT `cId` INT)   BEGIN
CALL saveContact(
	cName,
	cCo,
	cMail,
	cPhone,
	cId);
CALL saveMsg(
    cId,
    mSubj,
    mCont);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `saveMarketing` (IN `mName` VARCHAR(50), IN `mEmail` VARCHAR(50))   BEGIN
INSERT INTO `tbl_marketing` (
    `market_name`,
    `market_email`)
VALUES (
    mName,
    mEmail);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `saveMsg` (IN `cId` INT, IN `mSubj` VARCHAR(50), IN `mCont` TEXT)   BEGIN
INSERT INTO `tbl_messages` (
    `contact_id`,
    `msg_subject`,
    `msg_content`)
VALUES (
    cId,
    mSubj,
    mCont);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`) VALUES
(0, 'news'),
(1, 'careers'),
(2, 'insights'),
(3, 'case studies');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contacts`
--

CREATE TABLE `tbl_contacts` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_company` varchar(50) NOT NULL,
  `contact_email` varchar(30) NOT NULL,
  `contact_phone` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_marketing`
--

CREATE TABLE `tbl_marketing` (
  `market_id` int(11) NOT NULL,
  `market_name` varchar(50) NOT NULL,
  `market_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `msg_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `msg_subject` varchar(50) NOT NULL,
  `msg_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `news_id` int(11) NOT NULL,
  `news_content` text NOT NULL,
  `news_title` varchar(100) NOT NULL,
  `news_img` varchar(100) NOT NULL,
  `news_date` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`news_id`, `news_content`, `news_title`, `news_img`, `news_date`, `category_id`, `poster_id`) VALUES
(0, 'As we step into a new year, we would like to take some time to look back on yet another successful y...', 'Netmatters End-Of-Year Staff Awards 2022', 'netmatters-end-of-year-staff-vFeS.png', '2022-12-23', 0, 0),
(1, 'The Client The Girls&#39; Day School Trust (GDST) is the UK&#39;s leading family of 25 independent girls&#39; sc...', 'Our Digital Marketing Partnership With The Gi...', 'our-digital-marketing-CpeX.png', '2022-12-20', 3, 0),
(2, 'This article showcases how a combined website and software solution can be implemented to create an...', 'One Traveller - Web Case Study', 'one-traveller-xEYm.png', '2022-12-15', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poster`
--

CREATE TABLE `tbl_poster` (
  `poster_id` int(11) NOT NULL,
  `poster_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_poster`
--

INSERT INTO `tbl_poster` (`poster_id`, `poster_name`) VALUES
(0, 'Netmatters');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_marketing`
--
ALTER TABLE `tbl_marketing`
  ADD PRIMARY KEY (`market_id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `poster_id` (`poster_id`);

--
-- Indexes for table `tbl_poster`
--
ALTER TABLE `tbl_poster`
  ADD PRIMARY KEY (`poster_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_marketing`
--
ALTER TABLE `tbl_marketing`
  MODIFY `market_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_poster`
--
ALTER TABLE `tbl_poster`
  MODIFY `poster_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
