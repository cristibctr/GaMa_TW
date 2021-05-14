-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2021 at 10:16 PM
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
  `cover_image` varchar(50) NOT NULL,
  `game_image` varchar(50) NOT NULL,
  `votes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`name`, `year`, `age`, `players`, `type`, `restrictions`, `description`, `cover_image`, `game_image`, `votes`) VALUES
('Catan', 2003, 10, 2, 'Board-Game', 'none', 'Catan, previously known as The Settlers of Catan or simply Settlers, is a multiplayer board game designed by Klaus Teuber. It was first published in 1995 in Germany by Franckh-Kosmos Verlag (Kosmos) as Die Siedler von Catan. Players take on the roles of settlers, each attempting to build and develop holdings while trading and acquiring resources. Players gain points as their settlements grow; the first to reach a set number of points, typically 10, wins. The game and its many expansions are also published by Catan Studio, Filosofia, GP, Inc., 999 Games, Κάισσα, and Devir. ', 'Catan-2015-boxart.jpg', 'catan.jpg', 1),
('Connect Four', 2006, 6, 2, 'Board-Game', 'none', 'Connect Four is a two-player connection board game, in which the players choose a color and then take turns dropping colored discs into a seven-column, six-row vertically suspended grid. The pieces fall straight down, occupying the lowest available space within the column. The objective of the game is to be the first to form a horizontal, vertical, or diagonal line of four of one\'s own discs. Connect Four is a solved game. The first player can always win by playing the right moves. ', 'connect-four.jpg', 'connect_four.jpg', 2),
('CS GO', 2012, 18, 10, 'Video-Game', 'Microphone required', 'Counter-Strike: Global Offensive (CS:GO) is a multiplayer first-person shooter developed by Valve and Hidden Path Entertainment. It is the fourth game in the Counter-Strike series. Developed for over two years, Global Offensive was released for Windows, macOS, Xbox 360, and PlayStation 3 in August 2012, and for Linux in 2014. Valve still regularly updates the game, both with smaller balancing patches and larger content additions.\r\nThe most common game modes involve the Terrorists planting a bomb while Counter-Terrorists attempt to stop them, or Counter-Terrorists attempting to rescue hostages that the Terrorists have captured. ', 'csgo.jpg', 'csgo_game.jpg', 1),
('Cyberpunk', 2020, 18, 1, 'Video-Game', 'Graphic scenes', 'Cyberpunk 2077 is a 2020 action role-playing video game developed and published by CD Projekt. The story takes place in Night City, an open world set in the Cyberpunk universe. Players assume the first-person perspective of a customisable mercenary known as V, who can acquire skills in hacking and machinery with options for melee and ranged combat. The game was developed using the REDengine 4 by a team of around 500 people, exceeding the number that worked on the studio\'s previous game The Witcher 3: Wild Hunt (2015). It received praise for its narrative, setting, and graphics, although some of its gameplay elements received mixed responses, while its themes and representation of transgender characters received scrutiny. Cyberpunk 2077 was also widely criticized for bugs, particularly in the console versions which suffered from performance issues; Sony removed it from the PlayStation Store on 17 December 2020. CD Projekt became subject to investigations and class-action lawsuits for their perceived attempts in downplaying the severity of the game\'s technical issues before release. ', 'cyberpunk.jpeg', 'cyberpunk.jpg', 1),
('DOTA 2', 2013, 16, 10, 'Video-Game', 'None', 'Dota 2 is a multiplayer online battle arena (MOBA) video game developed and published by Valve. The game is a sequel to Defense of the Ancients (DotA), which was a community-created mod for Blizzard Entertainment\'s Warcraft III: Reign of Chaos. Dota 2 is played in matches between two teams of five players, with each team occupying and defending their own separate base on the map. Each of the ten players independently controls a powerful character, known as a \"hero\", who all have unique abilities and differing styles of play. During a match players collect experience points and items for their heroes to successfully defeat the opposing team\'s heroes in player versus player combat. A team wins by being the first to destroy the other team\'s \"Ancient\", a large structure located within their base. ', 'Dota2.jpg', 'dota2.png', 0),
('HALF-LIFE ALYX', 2020, 18, 1, 'Video-Game', 'VR headset needed', 'Half-Life: Alyx is a 2020 virtual reality (VR) first-person shooter developed and published by Valve. Set between the events of Half-Life (1998) and Half-Life 2 (2004), players control Alyx Vance on a mission to seize a superweapon belonging to the alien Combine. Players use VR to interact with the environment and fight enemies, using \"gravity gloves\" to manipulate objects, similarly to the gravity gun from Half-Life 2. Traditional Half-Life elements return, such as physics puzzles, combat, exploration and survival horror elements. ', 'HF_Alyx.jpg', 'half-life-alyx.jpg', 0),
('Monopoly', 2005, 10, 3, 'Board-Game', 'Requires a lot of time to finish', 'Monopoly is a board game currently published by Hasbro. In the game, players roll two six-sided dice to move around the game board, buying and trading properties, and developing them with houses and hotels. Players collect rent from their opponents, with the goal being to drive them into bankruptcy. Money can also be gained or lost through Chance and Community Chest cards, and tax squares; players can end up in jail, from which they cannot move until they have met one of several conditions. The game has numerous house rules, and hundreds of different editions exist, as well as many spin-offs and related media. Monopoly has become a part of international popular culture, having been licensed locally in more than 103 countries and printed in more than 37 languages. ', 'Monopoly.jpg', 'Monopoly.jpg', 0),
('Scrabble', 1986, 5, 2, 'Board-Game', 'Large vocabulary', 'Scrabble is a word game in which two to four players score points by placing tiles, each bearing a single letter, onto a game board divided into a 15×15 grid of squares. The tiles must form words that, in crossword fashion, read left to right in rows or downward in columns, and be included in a standard dictionary or lexicon. The game is played by two to four players on a square game board imprinted with a 15×15 grid of cells (individually known as \"squares\"), each of which accommodates a single letter tile. In official club and tournament games, play is between two players or, occasionally, between two teams, each of which collaborates on a single rack.', 'scrabble.jpg', 'scrabble.jpg', 0);

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
('Monopoly', 'Economic simulation'),
('Catan', 'Family-Game'),
('Connect Four', 'Family-game'),
('Scrabble', 'Word game'),
('CS GO', 'Multiplayer'),
('CS GO', 'Shooter'),
('CS GO', 'Esport'),
('Cyberpunk', 'Single-player'),
('Cyberpunk', 'Action'),
('Cyberpunk', 'RPG'),
('DOTA 2', 'Multiplayer'),
('DOTA 2', 'MOBA'),
('HALF-LIFE ALYX', 'Single-player'),
('HALF-LIFE ALYX', 'First-person shooter');

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
('Monopoly', 'Families'),
('Monopoly', 'Teens'),
('Catan', 'Family'),
('Catan', 'Children'),
('Catan', 'Teens'),
('Connect Four', 'Children'),
('Scrabble', 'Allages'),
('CS GO', 'Teens'),
('CS GO', 'Adults'),
('Cyberpunk', 'Teens'),
('Cyberpunk', 'Adults'),
('DOTA 2', 'Teens'),
('DOTA 2', 'Adults'),
('HALF-LIFE ALYX', 'Adults'),
('HALF-LIFE ALYX', 'VRenthusiasts');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `admin`) VALUES
('admin', 'admin@admin.com', '$argon2id$v=19$m=65536,t=4,p=1$N0JlcWNVRGZtZTk1bExTSg$0yc7CQ22IRWGV76pSyNW782fS6A4d035PuvNRwHozJA', 1),
('cristi', 'cristian.bucataru@yahoo.com', '$argon2id$v=19$m=65536,t=4,p=1$UEoyelBJOWoyc2hqcm8ybg$TQlkNHokq3TDKN69s8OnuPV8NLwl61xPvz2RiEdlPsE', 0),
('inachero', 'inachero@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VlFzN2h0cGxtdHBoTEtMUQ$6qsQuSW5ni7LHZgzoE8PT3PfWm5tSXzJIQkzqBtL1ok', 0),
('neterian', 'neterian@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bHVic05vSnRoVzlvemcvdA$FytM/bQw2VysfpnkMLDUQ59M3jKg7bG4aXM0r0voTBY', 0),
('onercuti', 'onercuti@protonmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VUlQL2VjR1VKamhTLllaUA$AJLzJ010gAcqjlzk7uwupEzKWSxyisuF85aTqhvzLq0', 0),
('thumnard', 'thumnard@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$cmZhYy90dTlYa1FKdTRRUQ$KgdJ6zL6hQk5fGFf00ADiBYpRtmVe+BVUwGTjVT6/sU', 0),
('usturyse', 'usturyse@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VHFMTmxIdmp4U2RwVHgzVQ$HRUOEK7BGM0phl8SFfiVR+EiIopWm+zrRybbJa5fQ+4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_vote`
--

CREATE TABLE `user_vote` (
  `username` varchar(255) NOT NULL,
  `game_name` varchar(100) NOT NULL,
  `vote_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_vote`
--

INSERT INTO `user_vote` (`username`, `game_name`, `vote_type`) VALUES
('cristi', 'Connect Four', 'upvote'),
('cristi', 'Catan', 'upvote'),
('cristi', 'Cyberpunk', 'downvote'),
('admin', 'CS GO', 'upvote'),
('admin', 'Connect Four', 'upvote');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_vote`
--
ALTER TABLE `user_vote`
  ADD KEY `fk_game` (`game_name`),
  ADD KEY `fk_username` (`username`);

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

--
-- Constraints for table `user_vote`
--
ALTER TABLE `user_vote`
  ADD CONSTRAINT `fk_game` FOREIGN KEY (`game_name`) REFERENCES `games` (`name`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
