-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2020 at 02:04 PM
-- Server version: 10.4.12-MariaDB-log
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `breakthechainDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(255) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `member` int(255) NOT NULL,
  `residency` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quarantine` date DEFAULT NULL,
  `q_mode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quarantine_lifted` date DEFAULT NULL,
  `covid_detected` date DEFAULT NULL,
  `by_contact` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recovered` date DEFAULT NULL,
  `demise` date DEFAULT NULL,
  `hospitalised` date DEFAULT NULL,
  `different` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `name`, `age`, `gender`, `phone`, `address`, `member`, `residency`, `quarantine`, `q_mode`, `quarantine_lifted`, `covid_detected`, `by_contact`, `recovered`, `demise`, `hospitalised`, `different`) VALUES
(16, 'Vishnu', '10', 'male', '1234567890', 'Irinjalakuda', 49, 'NRK', '2020-08-27', NULL, '2020-08-27', '2020-08-27', 'no', NULL, '2020-08-27', NULL, 'yes'),
(17, 'Vishnu', '20', 'male', '1234567890', 'Hello', 49, 'Keralite', '2020-08-27', NULL, NULL, NULL, NULL, '2020-08-27', NULL, NULL, 'no'),
(18, 'Visunu', '25', 'female', '4649797989', 'Zbzb', 49, 'Keralite', NULL, NULL, NULL, '2020-08-27', 'no', NULL, NULL, NULL, 'no'),
(19, 'Vishnu', '25', 'male', '26', 'Hhh', 49, 'Keralite', '2020-08-27', NULL, '2020-08-27', '2020-08-27', NULL, NULL, NULL, NULL, 'no'),
(20, 'Bxhzh', '64', 'male', '9898989898', 'Thh', 49, 'Keralite', '2020-08-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no'),
(21, '1233737', '65', 'male', '6868', 'Gzg', 49, 'Keralite', '2020-08-27', NULL, NULL, NULL, NULL, NULL, '2020-08-27', NULL, 'no'),
(22, 'name', '13', 'male', '09567836661', 'Moonupeedika', 49, 'Keralite', '2020-08-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no'),
(23, 'Vidhhx', '383', 'male', '376767', 'Bz', 49, 'Keralite', '2020-08-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no'),
(24, 'Hxhx', '25', 'female', '2155154', 'Gzgz', 49, 'Keralite', '2020-08-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no'),
(25, 'name', '20', 'male', '09567836661', 'Valappad', 49, 'NRK', '2020-08-27', NULL, NULL, NULL, NULL, NULL, '2020-08-28', NULL, 'no'),
(26, 'Vishdh', '25', 'female', '2580', 'Gsgs', 49, 'Keralite', NULL, NULL, NULL, NULL, NULL, '2020-08-27', NULL, NULL, 'no'),
(27, 'Akhil', '20', 'male', '9544997414', 'Valappad', 49, 'NRK', '2020-08-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no'),
(28, 'Akhil', '20', 'male', '9544997414', 'Valappad', 49, 'NRI', NULL, NULL, NULL, '2020-08-28', 'yes', NULL, NULL, '2020-08-29', 'no'),
(29, 'Akhil', '12', 'other', '9544997414', 'Valappad', 49, 'Keralite', NULL, NULL, NULL, '2020-08-28', 'no', NULL, NULL, NULL, 'no'),
(30, 'Jaefer', '21', 'other', '1234567890', 'Moonupeedika', 49, 'NRK', '2020-08-28', 'paid', NULL, NULL, NULL, NULL, NULL, NULL, 'no'),
(31, 'Akhil', '22', 'male', '9544997414', 'Valappad', 49, 'NRI', '2020-08-28', 'home', NULL, NULL, NULL, NULL, NULL, NULL, 'no'),
(32, 'Akhil', '20', 'male', '9544997414', 'Valappad', 49, 'Keralite', '2020-08-29', 'home', NULL, NULL, NULL, NULL, NULL, NULL, 'no'),
(33, 'Akhil', '22', 'male', '9544997414', 'Valappad', 49, 'Keralite', '2020-08-29', 'home', NULL, NULL, 'yes', NULL, NULL, NULL, 'no'),
(34, 'Akhil', '13', 'male', '9544997414', 'Valappad', 49, 'NRK', '2020-08-29', 'paid', NULL, NULL, 'yes', NULL, NULL, NULL, 'no'),
(35, 'Akhil', '22', 'male', '9544997414', 'Valappad', 49, 'NRI', '2020-08-29', 'home', NULL, NULL, 'yes', NULL, NULL, NULL, 'no'),
(36, 'Akhil', '19', 'male', '9544997414', 'Valappad', 49, 'NRK', NULL, NULL, NULL, '2020-08-29', 'no', NULL, NULL, '2020-08-29', 'no'),
(37, 'Abcd', '20', 'male', '1234567890', 'Abcdefg', 49, 'Keralite', '2020-09-11', 'home', '2020-09-11', NULL, 'yes', NULL, NULL, NULL, 'no'),
(38, 'Vishnu Murali', '13', 'male', '9567836661', 'Puthenchira East P.O.', 49, 'Keralite', '2020-09-14', 'home', NULL, NULL, 'yes', NULL, NULL, NULL, 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
