-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 12:00 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gama_tw`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `players` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `restrictions` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`name`, `year`, `age`, `players`, `type`, `restrictions`, `description`, `image`) VALUES
('Le game', 2024, 18, 4, 'Video-Game', 'None', 'This is the first game in the Le game series to be released.', 'ruins.png'),
('Le game 2', 2034, 16, 2, 'Board-game', 'you need hands', 'The second iteration in the well known series of \"Le game\"', 'bigmarker.png');

-- --------------------------------------------------------

--
-- Table structure for table `game_category`
--

CREATE TABLE `game_category` (
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game_category`
--

INSERT INTO `game_category` (`name`, `category`) VALUES
('Le game', 'MOBA'),
('Le game', 'notgame'),
('Le game', 'isgame'),
('Le game 2', 'Shooter'),
('Le game 2', 'co-op');

-- --------------------------------------------------------

--
-- Table structure for table `target_audience`
--

CREATE TABLE `target_audience` (
  `name` varchar(100) NOT NULL,
  `target` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `target_audience`
--

INSERT INTO `target_audience` (`name`, `target`) VALUES
('Le game', 'Adults'),
('Le game', 'Kids'),
('Le game 2', 'Elderly'),
('Le game 2', 'Teens');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `game_category`
--
ALTER TABLE `game_category`
  ADD KEY `category_fk` (`name`);

--
-- Indexes for table `target_audience`
--
ALTER TABLE `target_audience`
  ADD KEY `target_fk` (`name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game_category`
--
ALTER TABLE `game_category`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`name`) REFERENCES `games` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `target_audience`
--
ALTER TABLE `target_audience`
  ADD CONSTRAINT `target_fk` FOREIGN KEY (`name`) REFERENCES `games` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
