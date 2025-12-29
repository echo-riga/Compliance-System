-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2025 at 01:04 PM
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
  `category` text NOT NULL,
  `status` text NOT NULL DEFAULT 'Pending',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compliance`
--

INSERT INTO `compliance` (`id`, `users_id`, `file`, `category`, `status`, `date_created`) VALUES
(2, 54, 'LIST-OF-SUBJECT.docx', 'SALN', 'Approved', '2025-05-27 12:16:19'),
(3, 23, 'TIME-VALUE-OF-MONEY.xlsx', 'SALN', 'Pending', '2025-05-28 13:50:07'),
(4, 63, 'TappyCapstone-FINAL.pdf', 'SALN', 'Pending', '2025-10-25 12:30:20'),
(5, 63, 'Features (1).pdf', 'APE', 'Pending', '2025-10-25 12:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `img` text NOT NULL,
  `employeeid` text NOT NULL,
  `fullname` text NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `birthdate` date NOT NULL DEFAULT current_timestamp(),
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

INSERT INTO `users` (`users_id`, `img`, `employeeid`, `fullname`, `firstname`, `lastname`, `middlename`, `birthdate`, `address`, `contact`, `email`, `password`, `passwordtxt`, `type`, `status`, `code`, `passphrase`, `attempt`, `datetime`, `questionnaire`, `answer`, `status_of_employment`) VALUES
(2, '09f68495-142f-4999-9d2b-cb95c4bb16ab.jpg', '11144', 'juan test  cruzt', 'juan test ', 'cruzt', 'delat', '2025-10-11', 'na', '09629829146', 'admin@admin.com', '$2y$10$mf/xdoVJSHDGAVy2V0nZheqdt/0oK.oMv4I86T9VcNHf.aF8eD7X2', 'admin', 1, 1, '57150', 'test-flare-drift-aurora-laser-element-flicker-test-quake-sprint-crystal-zenith', 2, '2025-04-26 16:37:41', 'What is your favorite color?', 'black', ''),
(52, '', '11111', '', 'juan', 'Dorado', 'cruz', '2025-10-11', '', '', 'hrstaff@email.com', '$2y$10$VZGBL46EGm87EkGbrN.8TucIlvV1LbI79DoxDxfZrpD8wZ7q2no2u', '123', 2, 1, '386186', 'breeze-flair-drizzle-pixel-ocean-whisper-crush-tremor-blaze-dust-rumble-logic', 2, '2025-04-20 18:44:14', 'What is your favorite color', 'red', ''),
(53, '', '123456', '', 'juan', 'cruz', 'test', '2025-10-11', '', '', 'hrofficer@email.com', '$2y$10$VZGBL46EGm87EkGbrN.8TucIlvV1LbI79DoxDxfZrpD8wZ7q2no2u', '123', 3, 1, '970376', 'ocean-raven-mist-glow-logic-crush-blitz-gravity-glyph-ember-chroma-forest', 0, '2025-04-24 15:55:19', '', '', ''),
(54, '', '546546546', 'Juan dela Cruz', 'asdasd', 'asdasda', 'xcvxcv', '2025-10-11', '', '09629829146', 'godegkola@gmail.com', '$2y$10$2L/1VOY/qZnDnIb0uPPGh.AtPKazKkHhF7029gyuhFP8mvLGqkys.', '123', 0, 1, '902690', 'whisper-spectrum-mirage-fury-zephyr-silence-mist-ocean-cipher-element-neon-laser', 1, '2025-05-02 14:36:43', 'What is your favorite color?', 'red', 'Casual'),
(56, '', '', '', 'test', '', '', '2025-10-11', '', '', '', '$2y$10$4Q957UoNS5E4ze/xJU0oMO7P3GHmaxjjwjPcvSPtEpYD8ruM1CF1a', '£Aasd45$%', 0, 0, '', 'realm-ripple-zephyr-tempo-venom-flicker-vortex-flux-glimmer-zenith-ghost-vivid', 1, '2025-05-13 16:19:40', '', '', 'Job order'),
(57, '', '67657567', '', 'dela', 'cruz', 'asd', '2025-10-11', '', '', 'juandelacruz@gmail.com', '$2y$10$tTGHpKSjk0P/bj2zcxYn9erVTBNoqySfaWf/dLs0v59gCbCmyc.U.', '@A23\"asSA', 0, 1, '', 'spark-luster-whisper-stone-forest-mist-radiance-chroma-tempo-zenith-soul-pixel', 0, '2025-05-28 14:11:29', '', '', 'Job order'),
(59, '', '34535', 'Jethro Sedoguio', 'Jethro', 'Sedoguio', 'test', '2025-10-11', '', '09629829146', 'jethseds@gmail.com', '$2y$10$AAh8AXtn2FZhYukhW1NKMeXf0WQwAiQtheAlbu1Q66vQRLTuQ.mla', '@Aranas97', 0, 1, '177156', 'signal-ember-echo-tide-ripple-crystal-logic-quantum-sun-glyph-laser-flicker', 0, '2025-07-15 19:12:39', '', '', 'Job order'),
(62, '', '123', '', 'sdasd', 'asd', 'asd', '2001-07-13', '', '', 'pedro@gmail.com', '$2y$10$EHHXS9iyJPJXqobaNRbvVu5JzAjYYFPL0ThZ2ca8j.XzeGFgEQPyO', '12320010713', 0, 1, '133897', '', 0, '2025-10-11 16:16:20', '', '', 'Casual'),
(63, '', '999909', '', 'asd', 'asdas', 'sad', '2011-10-15', '', '', 'joneilfajardo05@gmail.com', '$2y$10$yhRP0cRuGCp2xkLrkHilmuRMJm7U1IrkA9PPtezLwZCA9NkohiCZe', '99990920111015', 0, 1, '365263', '', 0, '2025-10-25 12:22:01', '', '', 'Job order');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
