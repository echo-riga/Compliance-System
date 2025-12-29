-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2025 at 08:30 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annualcompliance`
--

-- --------------------------------------------------------

--
-- Table structure for table `compliance`
--

CREATE TABLE `compliance` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `file` text NOT NULL,
  `status` text NOT NULL DEFAULT 'Pending',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compliance`
--

INSERT INTO `compliance` (`id`, `users_id`, `file`, `status`, `date_created`) VALUES
(2, 54, 'LIST-OF-SUBJECT.docx', 'Disapproved', '2025-05-27 12:16:19'),
(3, 54, 'TIME-VALUE-OF-MONEY.xlsx', 'Approved', '2025-05-28 13:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `img` text NOT NULL,
  `employeeid` text NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `passwordtxt` text NOT NULL,
  `type` int(1) NOT NULL COMMENT 'employee=0,admin=1,hrstaff=2,hrofficer=3',
  `status` int(1) NOT NULL,
  `code` text NOT NULL,
  `passphrase` text NOT NULL,
  `attempt` int(1) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `questionnaire` text NOT NULL,
  `answer` text NOT NULL,
  `status_of_employment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `img`, `employeeid`, `firstname`, `lastname`, `middlename`, `address`, `contact`, `email`, `password`, `passwordtxt`, `type`, `status`, `code`, `passphrase`, `attempt`, `datetime`, `questionnaire`, `answer`, `status_of_employment`) VALUES
(2, 'image.jpg', '11144', 'juan test ', 'cruzt', 'delat', 'na', '09629829146', 'admin@admin.com', '$2y$10$60LRUxNz1x9yCpQv1xZsn.j8LmbYFeeH9pWJo7e4SuPFwSt0i9zOO', 'admin', 1, 1, '515522', 'test-flare-drift-aurora-laser-element-flicker-test-quake-sprint-crystal-zenith', 2, '2025-04-26 16:37:41', 'What is your favorite color?', 'black', ''),
(52, '', '11111', 'juan', 'Dorado', 'cruz', '', '', 'hrstaff@email.com', '$2y$10$VZGBL46EGm87EkGbrN.8TucIlvV1LbI79DoxDxfZrpD8wZ7q2no2u', '123', 2, 1, '392450', 'breeze-flair-drizzle-pixel-ocean-whisper-crush-tremor-blaze-dust-rumble-logic', 2, '2025-04-20 18:44:14', 'What is your favorite color', 'red', ''),
(53, '', '123456', 'juan', 'cruz', 'test', '', '', 'hrofficer@email.com', '$2y$10$VZGBL46EGm87EkGbrN.8TucIlvV1LbI79DoxDxfZrpD8wZ7q2no2u', '123', 3, 1, '', 'ocean-raven-mist-glow-logic-crush-blitz-gravity-glyph-ember-chroma-forest', 0, '2025-04-24 15:55:19', '', '', ''),
(54, '', '546546546', 'asdasd', 'asdasda', 'xcvxcv', '', '09629829146', 'godegkola@gmail.com', '$2y$10$2L/1VOY/qZnDnIb0uPPGh.AtPKazKkHhF7029gyuhFP8mvLGqkys.', '123', 0, 1, '896150', 'whisper-spectrum-mirage-fury-zephyr-silence-mist-ocean-cipher-element-neon-laser', 1, '2025-05-02 14:36:43', 'What is your favorite color?', 'red', 'Casual'),
(55, '', '4353453454354', 'testt', 'est', 'tset', '', '', 'test@gmail.com', '$2y$10$t6IcXm/OlDhtcroFTJK82uF7Qyd9Tn3dnyo3QCCRh6Lk7PxRIOVa2', '@Aasd23\"', 0, 1, '', 'neon-flare-drift-aurora-laser-element-flicker-tempo-quake-sprint-crystal-zenith', 0, '2025-05-09 17:46:36', '', '', 'Casual'),
(56, '', '', '', '', '', '', '', '', '$2y$10$4Q957UoNS5E4ze/xJU0oMO7P3GHmaxjjwjPcvSPtEpYD8ruM1CF1a', '£Aasd45$%', 0, 0, '', 'realm-ripple-zephyr-tempo-venom-flicker-vortex-flux-glimmer-zenith-ghost-vivid', 0, '2025-05-13 16:19:40', '', '', 'Job order'),
(57, '', '67657567', 'dela', 'cruz', 'asd', '', '', 'juandelacruz@gmail.com', '$2y$10$tTGHpKSjk0P/bj2zcxYn9erVTBNoqySfaWf/dLs0v59gCbCmyc.U.', '@A23\"asSA', 0, 1, '', 'spark-luster-whisper-stone-forest-mist-radiance-chroma-tempo-zenith-soul-pixel', 0, '2025-05-28 14:11:29', '', '', 'Job order');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compliance`
--
ALTER TABLE `compliance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compliance`
--
ALTER TABLE `compliance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
