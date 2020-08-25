-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2020 at 01:40 PM
-- Server version: 10.3.22-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mushpgwz_leaderboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `user` varchar(500) NOT NULL,
  `feedback` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`user`, `feedback`) VALUES
('sodiq.akinjobi@gmail.com_', 'Thank youuuuu'),
('sodiq.akinjobi@gmail.com_', 'ffffff');
-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `id` int(11) NOT NULL,
  `nickname` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `track` varchar(225) NOT NULL,
  `level` varchar(255) NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaderboard`
--

INSERT INTO `leaderboard` (`id`, `nickname`, `email`, `track`, `level`, `score`) VALUES
(1, 'geektutor', 'sodiq.akinjobi@gmail.com', 'mobile', 'Beginner', 149);


-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `track` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `url` varchar(225) NOT NULL,
  `task_day` varchar(20) NOT NULL,
  `comments` text DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `sub_date` date NOT NULL,
  `feedback` text NOT NULL,
  `cohort` int(100) NOT NULL DEFAULT 1,
  `level` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `user`, `track`, `url`, `task_day`, `comments`, `points`, `sub_date`, `feedback`, `cohort`, `level`) VALUES
(1, 'sodiq.akinjobi@gmail.com', 'mobile', 'https://dartpad.dev/49b0f943c29789c68e0319e1f35e3cb2', 'Day 1', 'I experimented with implementing my solution with while or for and decided to submit the while version', 14, '2020-05-01', 'Simple and effective ðŸ‘', 1, 'Beginner');
-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `task_day` int(255) NOT NULL,
  `track` varchar(1000) NOT NULL,
  `task` text NOT NULL,
  `level` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `task_day`, `track`, `task`, `level`) VALUES
(1, 1, 'python', '<p><strong>Day 1: Perfect Square</strong></p>\r\n<p>Create a function <strong>is_perfect_square</strong> that takes a parameter number and checks if the number is a perfect square. It should return True if the number is a perfect square and False if otherwise.</p>\r\n<p><strong>Sample Inputs</strong></p>\r\n<p>1) is_perfect_square(9)</p>\r\n<p>2) is_perfect_square(100)</p>\r\n<p>3) is_perfect_square(225)</p>\r\n<p>4) is_perfect_square(500)</p>\r\n<p><strong>Sample Output</strong></p>\r\n<p>1) True</p>\r\n<p>2) True</p>\r\n<p>3) True</p>\r\n<p>4) False</p>\r\n<p><strong> NB: No built in module should be used.</strong></p>', 'Beginner');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=457;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1630;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1920;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
