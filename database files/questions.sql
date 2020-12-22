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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(255) NOT NULL,
  `text` varchar(500) NOT NULL,
  `hidden` varchar(10) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `hidden`) VALUES
(1, 'ഇന്നലെ വരെ ക്വാറന്റൈനിൽ ഉള്ളവരുടെ എണ്ണം?', 'true'),
(2, 'കഴിഞ്ഞ 24 മണിക്കൂറിനുള്ളിൽ ഹോം ക്വാറന്റൈനിൽ എത്തിച്ചേർന്നവരുടെ എണ്ണം?', 'true'),
(3, 'ഇന്ന് ഹോം ക്വാറന്റൈനിൽ ഉള്ളവരുടെ എണ്ണം?', 'true'),
(4, 'ഹോം ക്വാറന്റൈൻ പൂർത്തിയാക്കിവരുടെ എണ്ണം?', 'true'),
(5, 'കഴിഞ്ഞ 24 മണിക്കൂറിൽ ആശുപത്രിയിലേക്ക് മാറ്റിയവരുടെ എണ്ണം?', 'true'),
(6, 'ഇന്ന് ഹോം ക്വാറന്റൈൻ അവസാനിച്ചതും/മാറ്റിയവരുടെയും  എണ്ണം?', 'true'),
(7, 'ഹോം ക്വാറന്റൈനിൽ അവശേഷിക്കുന്നവരുടെ എണ്ണം?', 'true'),
(8, 'കഴിഞ്ഞ 24 മണിക്കൂറിനുളിൽ ക്വാറന്റൈൻ ലംഘനം നടത്തിയവരുടെ എണ്ണം?', 'false'),
(9, 'ഇന്സ്ടിട്യൂഷൻ ക്വാറന്റൈൻ സെന്ററുകളുടെ എണ്ണം?', 'false'),
(10, 'ഇന്സ്ടിട്യൂഷൻ ക്വാറന്റൈനിൽ ഉള്ള NRI കളുടെ എണ്ണം?', 'true'),
(11, 'ഇന്സ്ടിട്യൂഷൻ ക്വാറന്റൈനിൽ ഉള്ള NRK കളുടെ എണ്ണം?', 'true'),
(12, 'ഇന്സ്ടിട്യൂഷൻ ക്വാറന്റൈനിലുള്ളവരുടെ ആകെ എണ്ണം?', 'true'),
(13, 'പെയ്ഡ് ക്വാറന്റൈൻ സെന്ററുകളുടെ എണ്ണം?', 'false'),
(14, 'പെയ്ഡ് ക്വാറന്റൈനിലുള്ള NRI കളുടെ എണ്ണം?', 'true'),
(15, 'പെയ്ഡ് ക്വാറന്റൈനിലുള്ള NRK കളുടെ എണ്ണം?', 'true'),
(16, 'പെയ്ഡ് ക്വാറന്റൈനിലുള്ളവരുടെ ആകെ എണ്ണം?', 'true'),
(17, 'വീടുകളിലേക്ക് വിദേശത്തുനിന്ന് വരുന്നവരുടെ എണ്ണം?', 'false'),
(18, 'വീടുകളിലേക്ക് വിദേശത്തുനിന്ന് വരുന്നവരുടെ ആകെ എണ്ണം?', 'false'),
(19, 'വീടുകളിലേക്ക് ഇതരസംസ്ഥാനത്തുനിന്ന്  വരുന്നവരുടെ എണ്ണം?', 'false'),
(20, 'വീടുകളിലേക്ക് ഇതരസംസ്ഥാനത്തുനിന്ന്  വരുന്നവരുടെ ആകെ എണ്ണം?', 'false'),
(21, 'ഇതുവരെയുള്ള പോസിറ്റീവ് കേസുകളുടെ എണ്ണം?', 'true'),
(22, 'കഴിഞ്ഞ 24 മണിക്കൂറിനുള്ളിൽ സ്ഥിരീകരിച്ച പോസിറ്റീവ് കേസുകളുടെ എണ്ണം?', 'true'),
(23, 'ആകെ പോസിറ്റീവ് കേസുകളുടെ എണ്ണം?', 'true'),
(24, 'നിലവിൽ ആശുപത്രികളിൽ ചികിത്സയിലുള്ള പോസിറ്റീവ് കേസുകളുടെ എണ്ണം?', 'true'),
(25, 'വാർഡുകളിൽ സമ്പർക്കം മുഖേന ക്വാറന്റൈനിൽ ഉള്ളവരുടെ ആകെ എണ്ണം?', 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
