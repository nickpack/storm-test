SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `storm`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(8) NOT NULL,
  `UsersName` varchar(255) NOT NULL,
  `LoginTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AvatarURL` varchar(255) DEFAULT NULL,
  `FBId` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`UserId`);